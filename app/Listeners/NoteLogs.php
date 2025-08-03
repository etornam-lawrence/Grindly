<?php

namespace App\Listeners;

use App\Events\NoteCreated;
use App\Models\ActivityLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NoteLogs
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
    public function handle(NoteCreated $event): void
    {
        $note = $event->note;
        ActivityLog::create([
            'user_id' => $note->user_id,
            'activity_type' => 'note_created',
            'description' => "Created {$note->title} note",
            'created_at'=> now(),
        ]);
    }
}
