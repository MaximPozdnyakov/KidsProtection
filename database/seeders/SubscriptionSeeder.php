<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subscription::insert([
            [
                'name' => 'Small',
                'device' => 3,
                'freeMonth' => 1,
                'price' => 199,
            ], [
                'name' => 'Medium',
                'device' => 5,
                'freeMonth' => 1,
                'price' => 249,
            ], [
                'name' => 'Large',
                'device' => 10,
                'freeMonth' => 1,
                'price' => 299,
            ],
        ]);
    }
}
