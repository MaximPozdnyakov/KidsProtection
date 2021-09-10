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
        \App\Models\ActiveSubscription::class => 'App\Http\Sections\ActiveSubscriptions',
        \App\Models\SupportAppeal::class => 'App\Http\Sections\SupportAppeals',
        \App\Models\SupportTopic::class => 'App\Http\Sections\SupportTopics',
        \App\Models\Site::class => 'App\Http\Sections\Sites',
        \App\Models\Youtube::class => 'App\Http\Sections\Youtube',
        \App\Models\Geolocation::class => 'App\Http\Sections\Geolocation',
        \App\Models\Phone::class => 'App\Http\Sections\Phones',
        \App\Models\CallSmsHistory::class => 'App\Http\Sections\CallSmsHistory',
        \App\Models\Application::class => 'App\Http\Sections\Applications',
        \App\Models\ApplicationHistory::class => 'App\Http\Sections\ApplicationHistory',
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
