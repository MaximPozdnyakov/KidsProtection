<?php

namespace App\Providers;

use SleepingOwl\Admin\Providers\AdminSectionsServiceProvider as ServiceProvider;

class AdminSectionsServiceProvider extends ServiceProvider
{

    /**
     * @var array
     */
    protected $sections = [
        \App\Models\User::class => 'App\Http\Sections\Users',
        \App\Models\Child::class => 'App\Http\Sections\Children',
        \App\Models\Subscription::class => 'App\Http\Sections\Subscriptions',
        \App\Models\SupportAppeal::class => 'App\Http\Sections\SupportAppeals',
        \App\Models\SupportTopic::class => 'App\Http\Sections\SupportTopics',
        \App\Models\Site::class => 'App\Http\Sections\Sites',
    ];

    /**
     * Register sections.
     *
     * @param \SleepingOwl\Admin\Admin $admin
     * @return void
     */
    public function boot(\SleepingOwl\Admin\Admin $admin)
    {
        //

        parent::boot($admin);
    }
}
