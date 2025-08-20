<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     */
    protected $listen = [
    \Illuminate\Auth\Events\Login::class => [
        \App\Listeners\TrackUserStreak::class,
    ],

    \App\Events\NoteCreated::class => [
        \App\Listeners\NoteLogs::class,
    ],

    \App\Events\StudySessionCreated::class => [
        \App\Listeners\StudySessionLogs::class,
    ],
    \App\Events\StudyStarted::class => [
        \App\Listeners\StudyMail::class,
    ]

    
    
];


}
