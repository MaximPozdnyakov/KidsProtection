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
                'date.required' => 'Укажите день рождения ребенка',
            ]);
        $child = Child::create([
            'name' => $request->name,
            'date' => $request->date,
            'parent' => auth()->user()->id,
        ]);
        return response()->json([
            'message' => 'Ребенок создан',
            'data' => Child::find($child->id),
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
            $request->validate(['name' => 'string']);
            $existedChild->name = $request->name;
        }
        if ($request->date) {
            $request->validate(['date' => 'date|date_format:d.m.Y']);
            $existedChild->date = $request->date;
        }
        if ($request->block_all_apps) {
            $request->validate(['block_all_apps' => 'boolean']);
            $existedChild->block_all_apps = $request->block_all_apps;
        }
        if ($request->block_all_phones) {
            $request->validate(['block_all_phones' => 'boolean']);
            $existedChild->block_all_phones = $request->block_all_phones;
        }
        if ($request->block_all_site) {
            $request->validate(['block_all_site' => 'boolean']);
            $existedChild->block_all_site = $request->block_all_site;
        }
        if ($request->block_all_youtube) {
            $request->validate(['block_all_youtube' => 'boolean']);
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
