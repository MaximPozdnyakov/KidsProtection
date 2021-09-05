<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Site;
use App\Models\SiteHistory;
use Illuminate\Http\Request;

class SiteHistoryController extends Controller
{
    public function index(Request $request, $child, $host)
    {
        if (!Child::where('id', $child)->where("parent", auth()->user()->id)->first()) {
            return response()->json(['message' => 'Указанный ребенок вам не принадлежит'], 403);
        }
        return SiteHistory::where('user', $child)->where('host', $host)->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'host' => 'required|string',
            'user' => 'required|string',
            'date' => 'required|date|date_format:d.m.Y H:i',
        ],
            [
                'host.required' => 'Параметр host обязателен',
                'host.string' => 'Параметр host должен быть строкой',
                'user.required' => 'Укажите id ребенка, которому принадлежит приложение',
                'user.string' => 'Параметр user должен быть строкой',
                'date.required' => 'Параметр date обязателен',
                'date.date' => 'Параметр date должен быть датой',
                'date.date_format' => 'Параметр date не соответствует формату dd.MM.yyyy hh:mm',
            ]);
        if (!preg_match('/^(?!:\/\/)(?=.{1,255}$)((.{1,63}\.){1,127}(?![0-9]*$)[a-z0-9-]+\.?)$/i', $request->host)) {
            $request->validate(['host' => 'ip'], ['host.ip' => 'Параметр host должен быть валидным хостом или IP-адресом']);
        }
        if (!Child::where('id', $request->user)->where("parent", auth()->user()->id)->first()) {
            return response()->json(['message' => 'Указанный ребенок вам не принадлежит'], 403);
        }
        $existedSite = Site::where('host', $request->host)->where("user", $request->user)->first();
        if (!$existedSite) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => ['package' => 'Сайта ' . $request->host . ' не существует в списке сайтов указанного ребенка'],
            ], 400);
        }
        $siteHistory = SiteHistory::create([
            'host' => $request->host,
            'locked' => $existedSite->locked,
            'user' => $request->user,
            'date' => $request->date,
        ]);
        return response()->json([
            'message' => 'История посещения сайта добавлена',
            'data' => SiteHistory::find($siteHistory->id),
        ], 201);
    }

    public function show(Request $request, $child, $host, $date)
    {
        if (!Child::where('id', $child)->where("parent", auth()->user()->id)->first()) {
            return response()->json(['message' => 'Указанный ребенок вам не принадлежит'], 403);
        }
        $d = \DateTime::createFromFormat('d.m.Y', $date);
        if (!($d && $d->format('d.m.Y') === $date)) {
            return response()->json(['message' => 'Параметр date должен быть датой формата dd.MM.yyyy'], 400);
        }
        return SiteHistory::where('user', $child)->where('host', $host)
            ->where('date', 'LIKE', $date . '%')->get();
    }

    public function destroy(Request $request, $site)
    {
        $existedSiteHistory = SiteHistory::where('id', $site)->first();
        if (!$existedSiteHistory) {
            return response()->json(['message' => 'Не удалось найти историю сайта с указанным id'], 404);
        }
        if (!Child::where('id', $existedSiteHistory->user)->where("parent", auth()->user()->id)->first()) {
            return response()->json(['message' => 'Этот сайт не принадлежит вашему ребенку'], 403);
        }
        $existedSiteHistory->delete();
        return response()->json(['message' => 'История посещения была удалена'], 200);
    }
}
