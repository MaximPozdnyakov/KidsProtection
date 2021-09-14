<?php

namespace App\Http\Controllers;

use App\Models\ActiveSubscription;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index(Request $request)
    {
        return Subscription::all();
    }

    public function getActiveSubscription(Request $request)
    {
        $activeSubscriptions = ActiveSubscription::whereUser(auth()->user()->id)->get()->toArray();
        $now = Carbon::now();
        $latestSubscriptionDate = Carbon::now();
        $activeSubscription = null;
        foreach ($activeSubscriptions as $subscription) {
            $subscriptionDate = Carbon::createFromFormat('d.m.Y H:i', $subscription['endDate']);
            if ($subscriptionDate->gt($latestSubscriptionDate)) {
                $latestSubscriptionDate = $subscriptionDate;
                $activeSubscription = $subscription;
            }
        }
        $subscriptions = Subscription::all()->toArray();
        foreach ($subscriptions as $index => $subscription) {
            if ($subscription['name'] == $activeSubscription['subscribe']) {
                $subscriptions[$index]['active'] = true;
            } else {
                $subscriptions[$index]['active'] = false;
            }
        }
        return $subscriptions;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'payed_num_of_months' => 'required|integer|min:0',
        ]);
        $subscriptionData = Subscription::whereName($request->name)->first();
        if (!$subscriptionData) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => ['name' => 'Не существует подписки с названием ' . $request->name],
            ], 404);
        }
        $activeSubscriptions = ActiveSubscription::whereUser(auth()->user()->id)->get()->toArray();
        $latestSubscriptionDate = Carbon::now();
        foreach ($activeSubscriptions as $subscription) {
            $subscriptionDate = Carbon::createFromFormat('d.m.Y H:i', $subscription['endDate']);
            if ($subscriptionDate->gt($latestSubscriptionDate)) {
                $latestSubscriptionDate = $subscriptionDate;
            }
        }
        $free_month = count($activeSubscriptions) ? 0 : $subscriptionData->free_month;
        $newSubscription = ActiveSubscription::create([
            'subscribe' => $subscriptionData->name,
            'fromDate' => $latestSubscriptionDate->format('d.m.Y H:i'),
            'endDate' => $latestSubscriptionDate->addMonths($free_month + $request->payed_num_of_months)->format('d.m.Y H:i'),
            'user' => auth()->user()->id,
        ]);

        return response()->json('Подписка добавлена', 200);
    }
}
