<?php

namespace App\Http\Controllers;

use App\Models\Child;
use Illuminate\Http\Request;

class ChildrenController extends Controller
{
    /**
     * @api {get} /api/children Получить список детей
     * @apiName                 GetChildren
     * @apiGroup                Child
     * @apiHeaderExample        {"Authorization": "Bearer {token}"}
     */

    public function index()
    {
        return Child::where('parent_id', auth()->user()->id)->get();
    }

    /**
     * @api {post} /api/children Создать ребенка
     * @apiName                  StoreChild
     * @apiGroup                 Child
     * @apiHeaderExample         {"Authorization": "Bearer {token}"}
     * @apiParam name            Имя ребенка
     * @apiParam year_of_birth   Год рождения ребенка
     */

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

    /**
     * @api {delete} /api/children/:id Удалить ребенка
     * @apiName                        DeleteChild
     * @apiGroup                       Child
     * @apiHeaderExample               {"Authorization": "Bearer {token}"}
     */

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
