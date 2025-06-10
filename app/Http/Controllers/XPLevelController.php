<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserXP; 


class XPLevelController extends Controller
{
    public function index()
    {
        // Fetch all XP levels
        $xpLevels = UserXP::all();

        // Return the view with the XP levels
        return view('xp_levels.index', compact('xpLevels'));
    }
}
