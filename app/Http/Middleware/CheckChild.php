<?php

namespace App\Http\Middleware;

use App\Models\Child;
use Closure;
use Illuminate\Http\Request;

class CheckChild
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $child = $request->header('child');
        if (!$child) {
            $child = $request->child;
        }
        if (!is_string($child) && is_array($child) && array_key_exists('id', $child)) {
            $child = $request->child['id'];
        }
        if ($child && is_string($child) && !Child::whereId($child)->whereParent(auth()->user()->id)->first()) {
            return response()->json(['message' => 'Указанный ребенок вам не принадлежит'], 404);
        }
        return $next($request);
    }
}
