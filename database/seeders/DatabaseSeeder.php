<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SubscriptionSeeder::class);
        $this->call(SupportTopicSeeder::class);
        $this->call(UserSeeder::class);
    }

}
