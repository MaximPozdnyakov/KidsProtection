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
        $appHistory = ApplicationHistory::whereUser($child)->wherePackage($package)->get();
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
        ]);
        $existedApplication = Application::wherePackage($request->package)->whereUser($request->user)->first();
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
        $appHistory = ApplicationHistory::find($appHistory->id);
        $appHistory->image = 'data:image/png;base64,' . base64_encode($appHistory->image);

        return response()->json([
            'message' => 'История использования приложения добавлена',
            'data' => $appHistory,
        ], 201);
    }

    public function show(Request $request, $child, $package, $date)
    {
        $d = \DateTime::createFromFormat('d.m.Y', $date);
        if (!($d && $d->format('d.m.Y') === $date)) {
            return response()->json(['message' => 'Параметр date должен быть датой формата dd.MM.yyyy'], 400);
        }
        $appHistory = ApplicationHistory::whereUser($child)->wherePackage($package)
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
                'data' => ['history' => $appHistory, 'image' => $image],
            ], 200);
        }
        return [];
    }

    public function update(Request $request, $application_history)
    {
        $existedAppHistory = ApplicationHistory::find($application_history);
        if (!$existedAppHistory) {
            return response()->json(['message' => 'Не удалось найти историю приложения с указанным id'], 404);
        }
        if (!Child::whereId($existedAppHistory->user)->whereParent(auth()->user()->id)->first()) {
            return response()->json(['message' => 'Это приложение не принадлежит вашему ребенку'], 403);
        }
        if ($request->end_dt) {
            $request->validate(['end_dt' => 'date|date_format:d.m.Y H:i']);
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
        $existedAppHistory = ApplicationHistory::find($application_history);
        if (!$existedAppHistory) {
            return response()->json(['message' => 'Не удалось найти историю приложения с указанным id'], 404);
        }
        if (!Child::whereId($existedAppHistory->user)->whereParent(auth()->user()->id)->first()) {
            return response()->json(['message' => 'Это приложение не принадлежит вашему ребенку'], 403);
        }
        $existedAppHistory->delete();
        return response()->json(['message' => 'История была удалена'], 200);
    }
}
