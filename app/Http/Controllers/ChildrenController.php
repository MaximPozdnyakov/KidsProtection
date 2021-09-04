<?php

namespace App\Http\Controllers;

use App\Models\Child;
use Illuminate\Http\Request;

class ChildrenController extends Controller
{
    public function index()
    {
        return Child::where('parent', auth()->user()->id)->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'date' => 'required|date|date_format:d.m.Y',
        ],
            [
                'name.required' => 'Укажите имя ребенка',
                'name.string' => 'Параметр name должен быть строкой',
                'date.required' => 'Укажите день рождения ребенка',
                'date.date' => 'Параметр date должен быть датой',
                'date.date_format' => 'Параметр date не соответствует формату dd.MM.yyyy',
            ]);
        $child = Child::create([
            'name' => $request->name,
            'date' => $request->date,
            'parent' => auth()->user()->id,
        ]);
        return response()->json([
            'message' => 'Ребенок создан',
            'data' => Child::where('id', $child->id)->first(),
        ], 201);
    }

    public function show(Request $request, $child)
    {
        $existedChild = Child::where('id', $child)->where("parent", auth()->user()->id)->first();
        if (!$existedChild) {
            return response()->json(['message' => 'Этот ребенок вам не принадлежит'], 403);
        }
        return $existedChild;
    }

    public function update(Request $request, $child)
    {
        $existedChild = Child::where('id', $child)->where("parent", auth()->user()->id)->first();
        if (!$existedChild) {
            return response()->json(['message' => 'Этот ребенок вам не принадлежит'], 403);
        }
        if ($request->name) {
            $request->validate(['name' => 'string'], ['name.string' => 'Параметр name должен быть строкой']);
            $existedChild->name = $request->name;
        }
        if ($request->date) {
            $request->validate([
                'date' => 'date|date_format:d.m.Y',
            ],
                [
                    'date.date' => 'Параметр date должен быть датой',
                    'date.date_format' => 'Параметр date не соответствует формату dd.MM.yyyy',
                ]);
            $existedChild->date = $request->date;
        }
        if ($request->block_all_apps) {
            $request->validate(['block_all_apps' => 'boolean'], ['block_all_apps.boolean' => 'Параметр block_all_apps должен быть булевым']);
            $existedChild->block_all_apps = $request->block_all_apps;
        }
        if ($request->block_all_phones) {
            $request->validate(['block_all_phones' => 'boolean'], ['block_all_phones.boolean' => 'Параметр block_all_phones должен быть булевым']);
            $existedChild->block_all_phones = $request->block_all_phones;
        }
        if ($request->block_all_site) {
            $request->validate(['block_all_site' => 'boolean'], ['block_all_site.boolean' => 'Параметр block_all_site должен быть булевым']);
            $existedChild->block_all_site = $request->block_all_site;
        }
        if ($request->block_all_youtube) {
            $request->validate(['block_all_youtube' => 'boolean'], ['block_all_youtube.boolean' => 'Параметр block_all_youtube должен быть булевым']);
            $existedChild->block_all_youtube = $request->block_all_youtube;
        }
        $existedChild->update();
        return response()->json([
            'message' => 'Данные ребенка обновлены',
            'data' => $existedChild,
        ], 202);
    }

    public function destroy(Request $request, $child)
    {
        $existedChild = Child::where('id', $child)->where("parent", auth()->user()->id)->first();
        if (!$existedChild) {
            return response()->json(['message' => 'Этот ребенок вам не принадлежит'], 403);
        }
        $existedChild->delete();
        return response()->json(['message' => 'Ребенок удален'], 200);
    }
}
