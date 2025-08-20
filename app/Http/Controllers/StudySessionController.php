<?php

namespace App\Http\Controllers;

use App\Events\StudySessionCreated;
use App\Http\Requests\SessionFormRequest;
use App\Models\StudySession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class StudySessionController extends Controller
{
    public function index(Request $request)
    {
        $sessions = Auth::user()->sessions()->latest()->paginate(6);

        //getting the total xp, time a user has studied, and the total number of sessions. implement one-click session creation like it is, in the windows focus timer app.
        $user = Auth::user();
        $totalXP = $user->current_xp;
        $totalStudyTime = $user->sessions()->sum('study_duration');
        $totalSessions = $user->sessions()->count();
        $sessions = $user->sessions()->latest()->orderBy('start_time')->paginate(5);
        return view('sessions.index', compact('sessions', 'totalXP', 'totalStudyTime', 'totalSessions','sessions'));
    }
    

    public function store(SessionFormRequest $request)
    {
        // dd($request->validated());

        $user = Auth::user();

        $data = StudySession::applySessionData($request->validated());

        $session = $user->sessions()->create($data);

        //call complete function after
        $xp = StudySession::calculateXPForSession($session->study_duration);
        $user->current_xp += $xp;
        $user->save();

        event(new StudySessionCreated($session));


        if (!$session && StudySession::inSession($user)) {
            return redirect()->back()->with('error', 'Failed to create study session.');
        }

        return redirect()->route('sessions.index')->with('success', 'Start study session.');
    }

    //data for the consistency based line chart
    public function lineChart()
    {
        $user = Auth::user();
        if(!$user){
            return redirect()->route('sessions.index')->with('error', 'User not found.');
        }
        
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $weekRange = $user->sessions()->whereBetween('start_time', [$startOfWeek, $endOfWeek])->get();

        $weekData = [
            'Monday'=> 0,
            'Tuesday'=> 0,
            'Wednesday'=>0,
            'Thursday'=>0,
            'Friday'=>0,
            'Saturday'=>0,
            'Sunday'=>0
        ];

        
        foreach($weekRange as $session) {
            $day = Carbon::parse($session->start_time)->format('l');
            $weekData[$day] += $session->study_duration;
        }

        return response()->json([
            
            'labels' => array_keys($weekData),
            'data' => array_values($weekData)
        ]);

    }
}
