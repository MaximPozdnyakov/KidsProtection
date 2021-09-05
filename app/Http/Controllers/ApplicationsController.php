<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\ApplicationHistory;
use App\Models\Child;
use Illuminate\Http\Request;

class ApplicationsController extends Controller
{
    public function index(Request $request, $child)
    {
        $applications = Application::where('parent', auth()->user()->id)->where('user', $child)->get();
        foreach ($applications as $application) {
            $application->image = 'data:image/png;base64,' . base64_encode($application->image);
        }
        return $applications;
    }

    public function store(Request $request)
    {
        $request->validate([
            'package' => 'required|string',
            'name' => 'required|string',
            'image' => 'required|mimes:png,jpg,svg',
            'user' => 'required|string',
        ],
            [
                'package.required' => 'Параметр package обязателен',
                'package.string' => 'Параметр package должен быть строкой',
                'name.required' => 'Параметр name обязателен',
                'name.string' => 'Параметр name должен быть строкой',
                'image.required' => 'Параметр image обязателен',
                'image.mimes' => 'Изображение не соответствует не одному из форматов: PNG, JPG, SVG',
                'user.required' => 'Укажите id ребенка, которому принадлежит приложение',
                'user.string' => 'Параметр user должен быть строкой',
            ]);
        $existedChild = Child::where('id', $request->user)->where("parent", auth()->user()->id)->first();
        if (!$existedChild) {
            return response()->json(['message' => 'Указанный ребенок вам не принадлежит'], 403);
        }
        $existedApplication = Application::where('package', $request->package)->where("user", $request->user)->first();
        if ($existedApplication) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => ['package' => 'Приложение с таким названием уже существует в списке приложений указанного ребенка'],
            ], 400);
        }

        $file = $request->file('image');
        $contents = $file->openFile()->fread($file->getSize());

        $application = Application::create([
            'package' => $request->package,
            'name' => $request->name,
            'image' => $contents,
            'parent' => auth()->user()->id,
            'user' => $request->user,
        ]);
        $application = Application::where('id', $application->id)->first();
        $application->image = 'data:image/png;base64,' . base64_encode($application->image);

        return response()->json([
            'message' => 'Мобильное приложение добавлено',
            'data' => $application,
        ], 201);
    }

    public function show(Request $request, $child, $application)
    {
        $existedChild = Child::where('id', $child)->where("parent", auth()->user()->id)->first();
        if (!$existedChild) {
            return response()->json(['message' => 'Указанный ребенок вам не принадлежит'], 403);
        }
        $application = Application::where('id', $application)->where("user", $child)->first();
        if ($application) {
            $application->image = 'data:image/png;base64,' . base64_encode($application->image);
        }
        return $application;
    }

    public function update(Request $request, $application)
    {
        $existedApplication = Application::where('id', $application)->where("parent", auth()->user()->id)->first();
        if (!$existedApplication) {
            return response()->json(['message' => 'Не удалось найти приложение с указанным id'], 404);
        }
        if ($request->name) {
            $request->validate(['name' => 'string'], ['name.string' => 'Параметр name должен быть строкой']);
            $existedApplication->name = $request->name;
        }
        if ($request->hasFile('image')) {
            $request->validate(['image' => 'mimes:png,jpg,svg'], ['image.mimes' => 'Изображение не соответствует не одному из форматов: PNG, JPG, SVG']);
            $file = $request->file('image');
            $contents = $file->openFile()->fread($file->getSize());
            $existedApplication->image = $contents;
        }
        if ($request->has('locked')) {
            $request->validate(['locked' => 'boolean'], ['locked.boolean' => 'Параметр locked должен быть булевым значением']);
            $existedApplication->locked = $request->locked;
        }
        if ($request->has('start_dt')) {
            if (!is_null($request->start_dt)) {
                $request->validate(['start_dt' => 'date|date_format:d.m.Y H:i'],
                    [
                        'start_dt.date' => 'Параметр start_dt должен быть датой',
                        'start_dt.date_format' => 'Параметр start_dt не соответствует формату dd.MM.yyyy hh:mm',
                    ]);
            }
            $existedApplication->start_dt = $request->start_dt;
        }
        if ($request->has('end_dt')) {
            if (!is_null($request->end_dt)) {
                $request->validate(['end_dt' => 'date|date_format:d.m.Y H:i'],
                    [
                        'end_dt.date' => 'Параметр end_dt должен быть датой',
                        'end_dt.date_format' => 'Параметр end_dt не соответствует формату dd.MM.yyyy hh:mm',
                    ]);
            }
            $existedApplication->end_dt = $request->end_dt;
        }

        $existedApplication->update();

        ApplicationHistory::where('user', $existedApplication->user)->where('package', $existedApplication->package)
            ->update([
                'name' => $existedApplication->name,
                'image' => $existedApplication->image,
                'locked' => $existedApplication->locked,
            ]);

        $existedApplication->image = 'data:image/png;base64,' . base64_encode($existedApplication->image);
        return response()->json([
            'message' => 'Данные приложения обновлены',
            'data' => $existedApplication,
        ], 202);
    }

    public function destroy(Request $request, $application)
    {
        $existedApplication = Application::where('id', $application)->where("parent", auth()->user()->id)->first();
        if (!$existedApplication) {
            return response()->json(['message' => 'Не удалось найти приложение с указанным id'], 404);
        }
        $existedApplication->delete();
        return response()->json(['message' => 'Приложение убрано из списка приложений'], 200);
    }
}
