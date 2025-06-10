<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserXPLevel extends Controller
{
    
    public $user_xp;
    public $next_level_up;
    public $xp_earned;

    public function __construct($xp_earned){
        $this->xp_earned = $xp_earned;
    }

    public function xp_gain($xp_earned)
    {
        $user = Auth::user();
        if($user)
        {
            $this->user_xp += $xp_earned;
        }
    }

    
}
