<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Geolocation;
use Illuminate\Http\Request;

class GeolocationController extends Controller
{
    public function index(Request $request, $child)
    {
        if (!Child::where('id', $child)->where("parent", auth()->user()->id)->first()) {
            return response()->json(['message' => 'Указанный ребенок вам не принадлежит'], 403);
        }
        return Geolocation::where('user', $child)->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'latitude' => ['required', 'string', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'longitude' => ['required', 'string', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'address' => 'string',
            'date' => 'required|date|date_format:d.m.Y H:i',
            'user' => 'required|string',
        ],
            [
                'latitude.regex' => 'Параметр latitude должен быть валидной широтой',
                'longitude.regex' => 'Параметр longitude должен быть валидной долготой',
            ]);
        if (!Child::where('id', $request->user)->where("parent", auth()->user()->id)->first()) {
            return response()->json(['message' => 'Указанный ребенок вам не принадлежит'], 403);
        }
        $geolocation = Geolocation::create([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'address' => $request->get('address', null),
            'date' => $request->date,
            'user' => $request->user,
        ]);
        return response()->json([
            'message' => 'Геолокация добавлена',
            'data' => Geolocation::find($geolocation->id),
        ], 201);
    }

    public function show(Request $request, $child, $date)
    {
        if (!Child::where('id', $child)->where("parent", auth()->user()->id)->first()) {
            return response()->json(['message' => 'Указанный ребенок вам не принадлежит'], 403);
        }
        $d = \DateTime::createFromFormat('d.m.Y', $date);
        if (!($d && $d->format('d.m.Y') === $date)) {
            return response()->json(['message' => 'Параметр date должен быть датой формата dd.MM.yyyy'], 400);
        }
        return Geolocation::where('user', $child)->where('date', 'LIKE', $date . '%')->get();
    }

    public function destroy(Request $request, $geolocation)
    {
        $existedGeolocation = Geolocation::find($geolocation);
        if (!$existedGeolocation) {
            return response()->json(['message' => 'Не удалось найти геолокацию с указанным id'], 404);
        }
        if (!Child::where('id', $existedGeolocation->user)->where("parent", auth()->user()->id)->first()) {
            return response()->json(['message' => 'Эта геолокация не принадлежит вашему ребенку'], 403);
        }
        $existedGeolocation->delete();
        return response()->json(['message' => 'Геолокация была удалена'], 200);
    }
}
