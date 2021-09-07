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
            return response()->json(['message' => 'Оформите подписку'], 403);
        }
        $now = Carbon::now();
        $latestSubscriptionDate = Carbon::now();
        foreach ($subscriptions as $subscription) {
            $subscriptionDate = Carbon::createFromFormat('d.m.Y H:i', $subscription['end_dt']);
            if ($subscriptionDate->gt($latestSubscriptionDate)) {
                $latestSubscriptionDate = $subscriptionDate;
            }
        }
        if ($latestSubscriptionDate->format('d.m.Y H:i') == $now->format('d.m.Y H:i')) {
            return response()->json(['message' => 'Действие вашей подписки истекло, оформите новую'], 403);
        }
        return $next($request);
    }
}
