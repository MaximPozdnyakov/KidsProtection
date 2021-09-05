<?php

namespace Database\Seeders;

use App\Models\SupportTopic;
use Illuminate\Database\Seeder;

class SupportTopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SupportTopic::insert([
            ['name' => 'Ошибка в приложении'],
            ['name' => 'Ошибка с оплатой'],
            ['name' => 'Ошибка в синхронизации'],
            ['name' => 'Предложения'],
        ]);
    }
}
