<?php

namespace App\Events;


use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Notes;


class NoteCreated
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $note;

    public function __construct(Notes $note)
    {
        $this->note = $note;
    }

    
}
