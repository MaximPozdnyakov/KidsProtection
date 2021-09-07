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
        return ActiveSubscription::whereUser(auth()->user()->id)->get();
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
            ], 400);
        }
        $activeSubscriptions = ActiveSubscription::whereUser(auth()->user()->id)->get()->toArray();
        $latestSubscriptionDate = Carbon::now();
        foreach ($activeSubscriptions as $subscription) {
            $subscriptionDate = Carbon::createFromFormat('d.m.Y H:i', $subscription['end_dt']);
            if ($subscriptionDate->gt($latestSubscriptionDate)) {
                $latestSubscriptionDate = $subscriptionDate;
            }
        }
        $free_month = count($activeSubscriptions) ? 0 : $subscriptionData->free_month;
        $newSubscription = ActiveSubscription::create([
            'name' => $subscriptionData->name,
            'price' => $subscriptionData->price,
            'free_month' => $free_month,
            'start_dt' => $latestSubscriptionDate->format('d.m.Y H:i'),
            'end_dt' => $latestSubscriptionDate->addMonths($free_month + $request->payed_num_of_months)->format('d.m.Y H:i'),
            'user' => auth()->user()->id,
        ]);

        return response()->json([
            'message' => 'Подписка добавлен',
            'data' => ActiveSubscription::find($newSubscription->id),
        ], 201);
    }
}
