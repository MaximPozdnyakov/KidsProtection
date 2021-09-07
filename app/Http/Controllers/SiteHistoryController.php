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
        return SiteHistory::whereUser($child)->whereHost($host)->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'host' => 'required|string',
            'user' => 'required|string',
            'date' => 'required|date|date_format:d.m.Y H:i',
        ]);
        if (!preg_match('/^(?!:\/\/)(?=.{1,255}$)((.{1,63}\.){1,127}(?![0-9]*$)[a-z0-9-]+\.?)$/i', $request->host)) {
            $request->validate(['host' => 'ip'], ['host.ip' => 'Параметр host должен быть валидным хостом или IP-адресом']);
        }
        $existedSite = Site::whereHost($request->host)->whereUser($request->user)->first();
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
        $d = \DateTime::createFromFormat('d.m.Y', $date);
        if (!($d && $d->format('d.m.Y') === $date)) {
            return response()->json(['message' => 'Параметр date должен быть датой формата dd.MM.yyyy'], 400);
        }
        return SiteHistory::whereUser($child)->whereHost($host)
            ->where('date', 'LIKE', $date . '%')->get();
    }

    public function destroy(Request $request, $site)
    {
        $existedSiteHistory = SiteHistory::find($site);
        if (!$existedSiteHistory) {
            return response()->json(['message' => 'Не удалось найти историю сайта с указанным id'], 404);
        }
        if (!Child::whereId($existedSiteHistory->user)->whereParent(auth()->user()->id)->first()) {
            return response()->json(['message' => 'Этот сайт не принадлежит вашему ребенку'], 403);
        }
        $existedSiteHistory->delete();
        return response()->json(['message' => 'История посещения была удалена'], 200);
    }
}
