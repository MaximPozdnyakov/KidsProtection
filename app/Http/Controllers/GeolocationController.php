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
            return $this->jsonResponse('date должен быть датой формата dd.MM.yyyy', 404);
        }
        return $this->jsonResponse(Geolocation::whereChild($request->header('child'))->where('date', 'LIKE', $request->header('date') . '%')->get()->makeHidden(['id', 'child']));
    }

    public function store(Request $request)
    {
        $request->validate([
            'gps' => 'nullable',
            'gps.*.latitude' => ['required', 'string', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'gps.*.longitude' => ['required', 'string', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'gps.*.address' => 'string',
            'gps.*.date' => 'required|date|date_format:d.m.Y H:i',
            'child' => 'required|string',
        ],
            [
                'gps.*.latitude.regex' => 'Параметр latitude должен быть валидной широтой',
                'gps.*.longitude.regex' => 'Параметр longitude должен быть валидной долготой',
            ]);
        $gps = $request->gps;
        foreach ($gps as $i => $gpsRecord) {
            $gps[$i]['child'] = $request->child;
        }
        $geolocation = Geolocation::insert($gps);
        return $this->jsonResponse('Геолокация добавлена', 200);
    }
}
