<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TrackUserStreak
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
    public function handle(Login $event): void
    {
        
        $user = $event->user;
        $today = Carbon::now();
        $yesterday = Carbon::yesterday();
        $lastLoginDate = $user->last_login_date;

    
        if(!$lastLoginDate){
            $user->current_streak = 1;
            $lastLoginDate = $today;
            $user->save();
            return;
        }
        elseif( $lastLoginDate->isSameDay($today) ){ //Today → do nothing.
            return;
        }
        // Check if the last login was yesterday and the user is logging in today
        elseif ($lastLoginDate->isSameDay($yesterday)){
            $user->current_streak += 1;  //Yesterday → increment current_streak
            $user->longest_streak += 1;
            $lastLoginDate = Carbon::now();
            $user->save();
        }
        elseif (!$lastLoginDate->isSameDay($yesterday) && $lastLoginDate->isSameDay($today->copy()->subDays(2))) {
            $user->current_streak = 1; //Two days ago → reset current_streak to 1
            $user->save();
        } else {
            $user->current_streak = 0; //Any other day → reset current_streak to 0
            $user->longest_streak;
            $user->save();
        }

        if($user->current_streak > $user->longest_streak){
            $user->longest_streak = $user->current_streak; //Update longest_streak if current_streak is greater
            
        }

        $user->last_login_date = $today; //Update last_login_date to today
        $user->save(); //Save the user model
    }
}
