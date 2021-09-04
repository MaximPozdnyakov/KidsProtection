<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\ApplicationStatistics;
use App\Models\Child;
use Illuminate\Http\Request;

class AppStatisticsController extends Controller
{
    public function index(Request $request, $child, $package)
    {
        if (!Child::where('id', $child)->where("parent", auth()->user()->id)->first()) {
            return response()->json(['message' => 'Указанный ребенок вам не принадлежит'], 403);
        }
        $appStatistics = ApplicationStatistics::where('user', $child)->where('package', $package)->get();
        $image = null;
        if (count($appStatistics)) {
            $image = 'data:image/png;base64,' . base64_encode($appStatistics[0]->image);
        }
        foreach ($appStatistics as $index => $appStatistic) {
            $appStatistic->toArray();
            unset($appStatistic->image);
        }
        if ($image) {
            return response()->json([
                'data' => ['statistics' => $appStatistics, 'image' => $image],
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

        $appStatistics = ApplicationStatistics::create([
            'package' => $request->package,
            'name' => $existedApplication->name,
            'image' => $existedApplication->image,
            'locked' => $existedApplication->locked,
            'start_dt' => $request->start_dt,
            'user' => $request->user,
        ]);
        $appStatistics = ApplicationStatistics::where('id', $appStatistics->id)->first();
        $appStatistics->image = 'data:image/png;base64,' . base64_encode($appStatistics->image);

        return response()->json([
            'message' => 'Статистика мобильного приложения создана',
            'data' => $appStatistics,
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
        $appStatistics = ApplicationStatistics::where('user', $child)->where('package', $package)
            ->where('start_dt', 'LIKE', $date . '%')->get();
        $image = null;
        if (count($appStatistics)) {
            $image = 'data:image/png;base64,' . base64_encode($appStatistics[0]->image);
        }
        foreach ($appStatistics as $index => $appStatistic) {
            $appStatistic->toArray();
            unset($appStatistic->image);
        }
        if ($image) {
            return response()->json([
                'data' => ['statistics' => $appStatistics, 'image' => $image],
            ], 200);
        }
        return [];
    }

    public function update(Request $request, $application_statistics)
    {
        $existedAppStatistics = ApplicationStatistics::where('id', $application_statistics)->first();
        if (!$existedAppStatistics) {
            return response()->json(['message' => 'Не удалось найти статистику приложения с указанным id'], 404);
        }
        if (!Child::where('id', $existedAppStatistics->user)->where("parent", auth()->user()->id)->first()) {
            return response()->json(['message' => 'Это приложение не принадлежит вашему ребенку'], 403);
        }
        if ($request->end_dt) {
            $request->validate(['end_dt' => 'date|date_format:d.m.Y H:i'],
                [
                    'end_dt.date' => 'Параметр end_dt должен быть датой',
                    'end_dt.date_format' => 'Параметр end_dt не соответствует формату dd.MM.yyyy hh:mm',
                ]);
            $existedAppStatistics->end_dt = $request->end_dt;
        }
        $existedAppStatistics->update();
        $existedAppStatistics->image = 'data:image/png;base64,' . base64_encode($existedAppStatistics->image);
        return response()->json([
            'message' => 'Статистика приложения обновлена',
            'data' => $existedAppStatistics,
        ], 202);
    }

    public function destroy(Request $request, $application_statistics)
    {
        $existedAppStatistics = ApplicationStatistics::where('id', $application_statistics)->first();
        if (!$existedAppStatistics) {
            return response()->json(['message' => 'Не удалось найти статистику приложения с указанным id'], 404);
        }
        if (!Child::where('id', $existedAppStatistics->user)->where("parent", auth()->user()->id)->first()) {
            return response()->json(['message' => 'Это приложение не принадлежит вашему ребенку'], 403);
        }
        $existedAppStatistics->delete();
        return response()->json(['message' => 'Статистика была удалена'], 200);
    }
}
