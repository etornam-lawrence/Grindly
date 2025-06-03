<?php

namespace App\Http\Controllers;

use App\Models\StudySession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;

class StudySessionController extends Controller
{
    public function index(StudySession $session)
    {
        $sessions = Auth::user()->sessions()->latest()->paginate(4);
        return view('sessions.index', compact('sessions'));
    }

    public function create()
    {
        // Logic to show the form for creating a new study session
        return view('sessions.create');
    }


    public function store(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'course_name' => 'required|string|max:255',
            'topic' => 'required|string|max:255',
            'date' => 'date|required',
            'start_time' => 'required',
            'duration' => 'integer|required|min:5',
        ]);

        // Combine date and start_time
        $startDateTime = Carbon::parse($validatedData['date'] . ' ' . $validatedData['start_time']);

        // Calculate end_time
        $validatedData['end_time'] = $startDateTime->copy()->addMinutes((int)$validatedData['duration']);
        $validatedData['start_time'] = $startDateTime;
        $validatedData['status'] = 'not-started';
        $validatedData['notes'] = 'No notes given';

        $insert = $user->sessions()->create($validatedData);

        if (!$insert) {
            return redirect()->back()->with('error', 'Failed to create study session.');
        }

        return redirect()->route('sessions.index')->with('success', 'Study session created successfully.');
    }



    public function show(StudySession $session)
    {
        return view('sessions.show', compact('session'));
    }

    public function start(StudySession $session)
    {
        // Logic to start a study session
        $session->status = 'started';
        $session->save();

        return redirect()->route('sessions.index')->with('success', 'Study session started successfully.');
    }

    public function complete(StudySession $session)
    {
        // Logic to mark a study session as completed
        $session->status = 'completed';
        $session->save();

        return redirect()->route('sessions.index')->with('success', 'Study session completed successfully.');
    }





    public function update(Request $request, StudySession $session, User $user)
    {
        $user = Auth::user();
        $validatedData = $request->validate([
            'course_name' => 'required|string|max:255',
            'topic' => 'required|string|max:255',
            'date' => 'date|required',
            'start_time' => 'required',
            'duration' => 'integer|required|min:5',
        ]);

        $startDateTime = Carbon::parse($validatedData['date'] . ' ' . $validatedData['start_time']);
        $validatedData['end_time'] = $startDateTime->copy()->addMinutes((int)$validatedData['duration']);
        $validatedData['start_time'] = $startDateTime;
        $validatedData['status'] = 'not-started';
        $validatedData['notes'] = 'No notes given';

        $sessions = $user->sessions()->where('id', $session->id)->first();
        $insert = $sessions->update($validatedData);

        if (!$insert) {
            return redirect()->back()->with('error', 'Failed to create study session.');
        }

        return redirect()->route('sessions.index', compact('session'))->with('success', 'Study session updated successfully.');
    }

    public function destroy(StudySession $session)
    {
        // Logic to delete a study session
        // Find the session by ID and delete it
        return redirect()->route('sessions.index')->with('success', 'Study session deleted successfully.');
    }

    // public function leaderboard()
    // {
    //     // Logic to display the leaderboard for study sessions
    //     return view('sessions.leaderboard');
    // }
    // public function stats()
    // {
    //     // Logic to display statistics for study sessions
    //     return view('sessions.stats');
    // }
    // public function history()
    // {
    //     // Logic to display the history of study sessions
    //     return view('sessions.history');
    // }
}
