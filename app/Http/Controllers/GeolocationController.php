<?php

namespace App\Http\Controllers;

use App\Models\Geolocation;
use Illuminate\Http\Request;

class GeolocationController extends Controller
{
    public function index(Request $request)
    {
        $d = \DateTime::createFromFormat('d.m.Y', $request->header('date'));
        if (!($d && $d->format('d.m.Y') === $request->header('date'))) {
            return response()->json(['message' => 'date должен быть датой формата dd.MM.yyyy'], 404);
        }
        return Geolocation::whereChild($request->header('child'))->where('date', 'LIKE', $request->header('date') . '%')->get()->makeHidden(['id', 'child']);
    }

    public function store(Request $request)
    {
        $request->validate([
            '*.latitude' => ['required', 'string', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            '*.longitude' => ['required', 'string', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            '*.address' => 'string',
            '*.date' => 'required|date|date_format:d.m.Y H:i',
            '*.child' => 'required|string',
        ],
            [
                '*.latitude.regex' => 'Параметр latitude должен быть валидной широтой',
                '*.longitude.regex' => 'Параметр longitude должен быть валидной долготой',
            ]);
        $geolocation = Geolocation::insert($request->all());
        return response()->json(['message' => 'Геолокация добавлена'], 200);
    }
}
