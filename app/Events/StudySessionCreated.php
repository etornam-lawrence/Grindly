<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use App\Models\StudySession;

class StudySessionCreated
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $session;
    
    public function __construct(StudySession $session)
    {
        $this->session = $session;
    }

}
