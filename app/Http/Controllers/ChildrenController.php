<?php

namespace App\Http\Controllers;

use App\Models\Child;
use Illuminate\Http\Request;

class ChildrenController extends Controller
{
    public function index()
    {
        return Child::where('parent_id', auth()->user()->id)->get()->makeHidden(['created_at', 'column_two', 'column_n']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'year_of_birth' => 'required|numeric',
        ],
            [
                'name.required' => 'Укажите имя ребенка',
                'year_of_birth.required' => 'Укажите год рождения ребенка',
                'year_of_birth.numeric' => 'Год рождения должен быть числом',
            ]);
        $child = Child::create([
            'name' => $request->name,
            'year_of_birth' => $request->year_of_birth,
            'parent_id' => auth()->user()->id,
        ]);
        return response()->json([
            'message' => 'Ребенок создан',
            'data' => $child,
        ], 201);
    }

    public function destroy(Request $request, $child)
    {
        $existedChild = Child::where('id', $child)->where("parent_id", auth()->user()->id)->first();
        if (!$existedChild) {
            return response()->json([
                'message' => 'Forbidden',
                'errors' => [
                    'child' => 'Этот ребенок вам не принадлежит',
                ],
            ], 403);
        }
        $existedChild->delete();
        return response()->json([
            'message' => 'Ребенок удален',
        ], 200);
    }
}
