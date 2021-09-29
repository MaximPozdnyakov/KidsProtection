<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function jsonResponse($data, $code = 200, $header = [])
    {
        $header['Content-Type'] = 'application/json;charset=UTF-8';
        $header['Charset'] = 'utf-8';
        return response()->json($data, $code, $header, JSON_UNESCAPED_UNICODE);
    }
}
