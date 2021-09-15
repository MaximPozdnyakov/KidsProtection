<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\ApplicationHistory;
// use App\Models\Child;
use Illuminate\Http\Request;

class AppHistoryController extends Controller
{
    public function index(Request $request)
    {
        $d = \DateTime::createFromFormat('d.m.Y', $request->header('date'));
        if (!($d && $d->format('d.m.Y') === $request->header('date'))) {
            return response()->json('date должен быть датой формата dd.MM.yyyy', 404);
        }
        $records = ApplicationHistory::whereUser($request->header('child'))->where('day', 'LIKE', $request->header('date') . '%')->get()->makeHidden(['id', 'day', 'user']);
        foreach ($records as $i => $record) {
            $app = Application::whereUser($request->header('child'))->wherePack($record['app'])->first();
            $records[$i]['app'] = [
                'id' => $app['id'],
                'name' => $app['name'],
                'pack' => $app['pack'],
                'icon' => $app['icon'],
            ];
        }
        return $records;
    }

    public function store(Request $request)
    {
        $request->validate([
            '*.time' => 'required|integer',
            '*.pack' => 'required|string',
            '*.date' => 'required|date|date_format:d.m.Y H:i:s',
        ]);
        $records = $request->all();
        foreach ($records as $i => $record) {
            if (!Application::whereUser($request->header('child'))->wherePack($record['pack'])->first()) {
                return response()->json('Приложения ' . $record['pack'] . ' не существует в списке приложений указанного ребенка', 404);
            }
            $records[$i]['user'] = $request->header('child');
            $records[$i]['day'] = $record['date'];
            unset($records[$i]['date']);
            $records[$i]['app'] = $record['pack'];
            unset($records[$i]['pack']);
        }
        ApplicationHistory::insert($records);
        return response()->json('Истории приложений зафиксированы', 200);
    }
}
