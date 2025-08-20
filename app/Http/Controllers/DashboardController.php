<?php

namespace App\Http\Controllers;
use App\Models\Notes;
use App\Models\StudySession;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $notes = $request->user()->notes()->latest()->paginate(6);
        $sessions = $request->user()->sessions()->latest()->paginate(6);
        $user = Auth::user();
        $totalXP = $user->current_xp;
        $totalStudyTime = $user->sessions()->sum('study_duration');
        $totalSessions = $user->sessions()->count();
        $recents = $user->activities()->latest()->paginate(3);

        //all stats on one card, add a study goal that can be extended
        return view('dashboard', compact('notes', 'sessions', 'totalXP', 'totalStudyTime', 'totalSessions', 'user', 'recents'));
    }

    //add yt search functionality

}
