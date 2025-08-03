<?php

namespace App\Listeners;

use App\Events\StudySessionCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Models\ActivityLog;

class StudySessionLogs
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(StudySessionCreated $event): void
    {
        $session = $event->session;

        ActivityLog::create([
            'user_id' => $session->user_id,
            'activity_type' => 'studysession_created',
            'description' => "Studied {$session->title} - {$session->study_duration} minutes",
            'created_at'=> now(),
        ]);
        
    }
}
