<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use App\Models\User;

class WelcomeMailJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public $user;
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // $user = User::find()
        $user = User::find($this->user);
        Mail::to($user->email)->send(new WelcomeMail($user));
    }

    public $tries = 3;
    //This will log details anytime the job fails.
    public function failed(\Throwable $exception ){
        Log::info("StudyStartedMail Job failed: " . $exception->getMessage());
    }

    //if another mode of notification is desired 
    // public function failed(\Throwable $exception)
    // {
    //     \Log::channel('slack')->error("🚨 Job failed: " . $exception->getMessage());
    // }

}
