<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\ApplicationHistory;
use App\Models\Child;
use Illuminate\Http\Request;

class AppHistoryController extends Controller
{
    public function index(Request $request, $child, $package)
    {
        if (!Child::where('id', $child)->where("parent", auth()->user()->id)->first()) {
            return response()->json(['message' => 'Указанный ребенок вам не принадлежит'], 403);
        }
        $appHistory = ApplicationHistory::where('user', $child)->where('package', $package)->get();
        $image = null;
        if (count($appHistory)) {
            $image = 'data:image/png;base64,' . base64_encode($appHistory[0]->image);
        }
        foreach ($appHistory as $index => $appStatistic) {
            $appStatistic->toArray();
            unset($appStatistic->image);
        }
        if ($image) {
            return response()->json([
                'data' => ['history' => $appHistory, 'image' => $image],
            ], 200);
        }
        return [];
    }

    public function store(Request $request)
    {
        $request->validate([
            'package' => 'required|string',
            'user' => 'required|string',
            'start_dt' => 'required|date|date_format:d.m.Y H:i',
        ],
            [
                'package.required' => 'Параметр package обязателен',
                'package.string' => 'Параметр package должен быть строкой',
                'user.required' => 'Укажите id ребенка, которому принадлежит приложение',
                'user.string' => 'Параметр user должен быть строкой',
                'start_dt.required' => 'Параметр start_dt обязателен',
                'start_dt.date' => 'Параметр start_dt должен быть датой',
                'start_dt.date_format' => 'Параметр start_dt не соответствует формату dd.MM.yyyy hh:mm',
            ]);
        $existedChild = Child::where('id', $request->user)->where("parent", auth()->user()->id)->first();
        if (!$existedChild) {
            return response()->json(['message' => 'Указанный ребенок вам не принадлежит'], 403);
        }
        $existedApplication = Application::where('package', $request->package)->where("user", $request->user)->first();
        if (!$existedApplication) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => ['package' => 'Приложение с названием ' . $request->package . ' не существует в списке приложений указанного ребенка'],
            ], 400);
        }

        $appHistory = ApplicationHistory::create([
            'package' => $request->package,
            'name' => $existedApplication->name,
            'image' => $existedApplication->image,
            'locked' => $existedApplication->locked,
            'start_dt' => $request->start_dt,
            'user' => $request->user,
        ]);
        $appHistory = ApplicationHistory::where('id', $appHistory->id)->first();
        $appHistory->image = 'data:image/png;base64,' . base64_encode($appHistory->image);

        return response()->json([
            'message' => 'История мобильного приложения создана',
            'data' => $appHistory,
        ], 201);
    }

    public function show(Request $request, $child, $package, $date)
    {
        if (!Child::where('id', $child)->where("parent", auth()->user()->id)->first()) {
            return response()->json(['message' => 'Указанный ребенок вам не принадлежит'], 403);
        }
        $d = \DateTime::createFromFormat('d.m.Y', $date);
        if (!($d && $d->format('d.m.Y') === $date)) {
            return response()->json(['message' => 'Параметр date должен быть датой формата dd.MM.yyyy'], 400);
        }
        $appHistory = ApplicationHistory::where('user', $child)->where('package', $package)
            ->where('start_dt', 'LIKE', $date . '%')->get();
        $image = null;
        if (count($appHistory)) {
            $image = 'data:image/png;base64,' . base64_encode($appHistory[0]->image);
        }
        foreach ($appHistory as $index => $appStatistic) {
            $appStatistic->toArray();
            unset($appStatistic->image);
        }
        if ($image) {
            return response()->json([
                'data' => ['History' => $appHistory, 'image' => $image],
            ], 200);
        }
        return [];
    }

    public function update(Request $request, $application_history)
    {
        $existedAppHistory = ApplicationHistory::where('id', $application_history)->first();
        if (!$existedAppHistory) {
            return response()->json(['message' => 'Не удалось найти историю приложения с указанным id'], 404);
        }
        if (!Child::where('id', $existedAppHistory->user)->where("parent", auth()->user()->id)->first()) {
            return response()->json(['message' => 'Это приложение не принадлежит вашему ребенку'], 403);
        }
        if ($request->end_dt) {
            $request->validate(['end_dt' => 'date|date_format:d.m.Y H:i'],
                [
                    'end_dt.date' => 'Параметр end_dt должен быть датой',
                    'end_dt.date_format' => 'Параметр end_dt не соответствует формату dd.MM.yyyy hh:mm',
                ]);
            $existedAppHistory->end_dt = $request->end_dt;
        }
        $existedAppHistory->update();
        $existedAppHistory->image = 'data:image/png;base64,' . base64_encode($existedAppHistory->image);
        return response()->json([
            'message' => 'История приложения обновлена',
            'data' => $existedAppHistory,
        ], 202);
    }

    public function destroy(Request $request, $application_history)
    {
        $existedAppHistory = ApplicationHistory::where('id', $application_history)->first();
        if (!$existedAppHistory) {
            return response()->json(['message' => 'Не удалось найти историю приложения с указанным id'], 404);
        }
        if (!Child::where('id', $existedAppHistory->user)->where("parent", auth()->user()->id)->first()) {
            return response()->json(['message' => 'Это приложение не принадлежит вашему ребенку'], 403);
        }
        $existedAppHistory->delete();
        return response()->json(['message' => 'История была удалена'], 200);
    }
}
