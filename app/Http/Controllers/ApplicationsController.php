<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\ApplicationHistory;
use Illuminate\Http\Request;

class ApplicationsController extends Controller
{
    public function index(Request $request, $child)
    {
        $applications = Application::whereParent(auth()->user()->id)->whereUser($child)->get();
        foreach ($applications as $application) {
            $application->image = 'data:image/png;base64,' . base64_encode($application->image);
        }
        return $applications;
    }

    public function store(Request $request)
    {
        $request->validate([
            'package' => 'required|string',
            'name' => 'required|string',
            'image' => 'required|mimes:png,jpg,svg',
            'user' => 'required|string',
        ]);
        $existedApplication = Application::wherePackage($request->package)->whereUser($request->user)->first();
        if ($existedApplication) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => ['package' => 'Приложение с таким названием уже существует в списке приложений указанного ребенка'],
            ], 404);
        }

        $file = $request->file('image');
        $contents = $file->openFile()->fread($file->getSize());

        $application = Application::create([
            'package' => $request->package,
            'name' => $request->name,
            'image' => $contents,
            'parent' => auth()->user()->id,
            'user' => $request->user,
        ]);
        $application = Application::find($application->id);
        $application->image = 'data:image/png;base64,' . base64_encode($application->image);

        return response()->json([
            'message' => 'Мобильное приложение добавлено',
            'data' => $application,
        ], 200);
    }

    public function show(Request $request, $child, $application)
    {
        $application = Application::whereId($application)->whereUser($child)->first();
        if ($application) {
            $application->image = 'data:image/png;base64,' . base64_encode($application->image);
        }
        return $application;
    }

    public function update(Request $request, $application)
    {
        $existedApplication = Application::whereId($application)->whereParent(auth()->user()->id)->first();
        if (!$existedApplication) {
            return response()->json(['message' => 'Не удалось найти приложение с указанным id'], 404);
        }
        if ($request->name) {
            $request->validate(['name' => 'string']);
            $existedApplication->name = $request->name;
        }
        if ($request->hasFile('image')) {
            $request->validate(['image' => 'mimes:png,jpg,svg']);
            $file = $request->file('image');
            $contents = $file->openFile()->fread($file->getSize());
            $existedApplication->image = $contents;
        }
        if ($request->has('locked')) {
            $request->validate(['locked' => 'boolean']);
            $existedApplication->locked = $request->locked;
        }
        if ($request->has('start_dt')) {
            if (!is_null($request->start_dt)) {
                $request->validate(['start_dt' => 'date|date_format:d.m.Y H:i']);
            }
            $existedApplication->start_dt = $request->start_dt;
        }
        if ($request->has('end_dt')) {
            if (!is_null($request->end_dt)) {
                $request->validate(['end_dt' => 'date|date_format:d.m.Y H:i']);
            }
            $existedApplication->end_dt = $request->end_dt;
        }

        $existedApplication->update();

        ApplicationHistory::whereUser($existedApplication->user)->wherePackage($existedApplication->package)
            ->update([
                'name' => $existedApplication->name,
                'image' => $existedApplication->image,
                'locked' => $existedApplication->locked,
            ]);

        $existedApplication->image = 'data:image/png;base64,' . base64_encode($existedApplication->image);
        return response()->json([
            'message' => 'Данные приложения обновлены',
            'data' => $existedApplication,
        ], 200);
    }

    public function destroy(Request $request, $application)
    {
        $existedApplication = Application::whereId($application)->whereParent(auth()->user()->id)->first();
        if (!$existedApplication) {
            return response()->json(['message' => 'Не удалось найти приложение с указанным id'], 404);
        }
        $existedApplication->delete();
        return response()->json(['message' => 'Приложение убрано из списка приложений'], 200);
    }
}
