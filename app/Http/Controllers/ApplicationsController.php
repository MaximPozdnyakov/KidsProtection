<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\MobileApplication;
use Illuminate\Http\Request;

class ApplicationsController extends Controller
{
    public function index(Request $request, $child)
    {
        return MobileApplication::where('parent_id', auth()->user()->id)
            ->where('child_id', $child)->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'display_name' => 'required|string',
            'child_id' => 'required',
        ],
            [
                'name.required' => 'Укажите навание приложения',
                'display_name.required' => 'Укажите отображаемое название приложения',
                'child_id.required' => 'Укажите id ребенка, которому принадлежит приложение',
                'name.string' => 'Параметр name должен быть строкой',
                'display_name.string' => 'Параметр display_name должен быть строкой',
            ]);
        $existedChild = Child::where('id', $request->child_id)->where("parent_id", auth()->user()->id)->first();
        if (!$existedChild) {
            return response()->json(['message' => 'Указанный ребенок вам не принадлежит'], 403);
        }
        $existedApplication = MobileApplication::where('name', $request->name)->where("child_id", $request->child_id)->first();
        if ($existedApplication) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => ['name' => 'Приложение с таким названием уже существует в списке приложений указанного ребенка'],
            ], 400);
        }
        $icon_name = null;
        if ($request->icon_name) {
            $request->validate(['icon_name' => 'string'], ['icon_name.string' => 'Параметр icon_name должен быть строкой']);
            if (file_exists(public_path() . '/icons/' . $request->icon_name)) {
                $icon_name = $request->icon_name;
            } else {
                return response()->json([
                    'message' => 'The given data was invalid.',
                    'errors' => ['icon_name' => 'Иконки с названием ' . $request->icon_name . ' не существует'],
                ], 400);
            }
        } elseif ($request->hasFile('icon')) {
            $request->validate(
                ['icon' => 'mimes:png,jpg,svg'],
                ['icon.mimes' => 'Иконка не соответствует не одному из форматов: PNG, JPG, SVG']
            );
            $icon = $request->file('icon');
            $icon->storeAs('', $icon->getClientOriginalName(), 'icons');
            $icon_name = $icon->getClientOriginalName();
        }
        $application = MobileApplication::create([
            'name' => $request->name,
            'display_name' => $request->display_name,
            'icon_name' => $icon_name,
            'parent_id' => auth()->user()->id,
            'child_id' => $request->child_id,
        ]);
        return response()->json([
            'message' => 'Мобильное приложение добавлено',
            'data' => MobileApplication::where('name', $request->name)
                ->where("child_id", $request->child_id)->first(),
        ], 201);
    }

    public function show(Request $request, $child, $application)
    {
        $existedChild = Child::where('id', $child)->where("parent_id", auth()->user()->id)->first();
        if (!$existedChild) {
            return response()->json([
                'message' => 'Указанный ребенок вам не принадлежит',
            ], 403);
        }
        return MobileApplication::where('id', $application)->where("child_id", $child)->first();
    }

    public function update(Request $request, $application)
    {
        $existedApplication = MobileApplication::where('id', $application)
            ->where("parent_id", auth()->user()->id)->first();
        if (!$existedApplication) {
            return response()->json([
                'message' => 'Не удалось найти приложение с указанным id',
            ], 404);
        }
        if ($request->name) {
            $request->validate(['name' => 'string'], ['name.string' => 'Параметр name должен быть строкой']);
            if (MobileApplication::where('name', $request->name)->where("child_id", $request->child_id)->first()) {
                return response()->json([
                    'message' => 'The given data was invalid.',
                    'errors' => ['name' => 'Приложение с таким названием уже существует в списке приложений указанного ребенка'],
                ], 400);
            }
            $existedApplication->name = $request->name;
        }
        if ($request->display_name) {
            $request->validate(['display_name' => 'string'], ['display_name.string' => 'Параметр display_name должен быть строкой']);
            $existedApplication->display_name = $request->display_name;
        }
        if ($request->is_blocked) {
            $request->validate(['is_blocked' => 'boolean'], ['is_blocked.boolean' => 'Параметр is_blocked должен быть булевым значением']);
            $existedApplication->is_blocked = $request->is_blocked;
        }
        if ($request->has('time_use_start')) {
            if (!is_null($request->time_use_start) && !preg_match('#^([01]?[0-9]|2[0-3]).[0-5][0-9]$#', $request->time_use_start)) {
                return response()->json([
                    'message' => 'The given data was invalid.',
                    'errors' => ['time_use_start' => 'Время старта использования приложения не соответствует формату HH.MM'],
                ], 400);
            }
            $existedApplication->time_use_start = $request->time_use_start;
        }
        if ($request->has('time_use_end')) {
            if (!is_null($request->time_use_end) && !preg_match('#^([01]?[0-9]|2[0-3]).[0-5][0-9]$#', $request->time_use_end)) {
                return response()->json([
                    'message' => 'The given data was invalid.',
                    'errors' => ['time_use_end' => 'Время конца использования приложения не соответствует формату HH.MM'],
                ], 400);
            }
            $existedApplication->time_use_end = $request->time_use_end;
        }
        if ($request->icon_name) {
            $request->validate(['icon_name' => 'string'], ['icon_name.string' => 'Параметр icon_name должен быть строкой']);
            if (file_exists(public_path() . '/icons/' . $request->icon_name)) {
                $existedApplication->icon_name = $request->icon_name;
            } else {
                return response()->json([
                    'message' => 'The given data was invalid.',
                    'errors' => ['icon_name' => 'Иконки с названием ' . $request->icon_name . ' не существует'],
                ], 400);
            }
        } elseif ($request->hasFile('icon')) {
            $request->validate(
                ['icon' => 'mimes:png,jpg,svg'],
                ['icon.mimes' => 'Иконка не соответствует не одному из форматов: PNG, JPG, SVG']
            );
            $icon = $request->file('icon');
            $icon->storeAs('', $icon->getClientOriginalName(), 'icons');
            $existedApplication->icon_name = $icon->getClientOriginalName();
        }
        $existedApplication->update();
        return response()->json([
            'message' => 'Данные приложения обновлены',
            'data' => $existedApplication,
        ], 202);
    }

    public function destroy(Request $request, $application)
    {
        $existedApplication = MobileApplication::where('id', $application)
            ->where("parent_id", auth()->user()->id)->first();
        if (!$existedApplication) {
            return response()->json([
                'message' => 'Не удалось найти приложение с указанным id',
            ], 404);
        }
        $existedApplication->delete();
        return response()->json([
            'message' => 'Приложение убрано из списка приложений',
        ], 200);
    }
}
