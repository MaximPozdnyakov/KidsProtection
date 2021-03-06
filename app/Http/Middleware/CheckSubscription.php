<?php

namespace App\Http\Middleware;

use App\Models\ActiveSubscription;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class CheckSubscription
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
        $subscriptions = ActiveSubscription::whereUser(auth()->user()->id)->get()->toArray();
        if (!count($subscriptions)) {
            return response()->json(
                'Оформите подписку',
                404,
                ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                JSON_UNESCAPED_UNICODE
            );
        }
        $now = Carbon::now();
        $latestSubscriptionDate = Carbon::now();
        foreach ($subscriptions as $subscription) {
            $subscriptionDate = Carbon::createFromFormat('d.m.Y H:i', $subscription['endDate']);
            if ($subscriptionDate->gt($latestSubscriptionDate)) {
                $latestSubscriptionDate = $subscriptionDate;
            }
        }
        if ($latestSubscriptionDate->format('d.m.Y H:i') == $now->format('d.m.Y H:i')) {
            return response()->json(
                'Действие вашей подписки истекло, оформите новую',
                404,
                ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                JSON_UNESCAPED_UNICODE
            );
        }
        return $next($request);
    }
}
