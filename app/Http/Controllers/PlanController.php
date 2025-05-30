<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Plan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PlanController extends Controller
{
    public function index()
    {
        // Logic to display all plans
        return view('plans.index');
    }
    
    // public function create()
    // {
    //     // Logic to show the form for creating a new plan
    //     return view('plans.create');
    // }

    public function edit(Plan $plan)
    {
        // Logic to show the form for editing an existing plan
        return view('plans.edit', compact('plan'));
    }

    public function store()
    {
        $user = Auth::user();
        $validatedData = $user->plans()->create([
            'title' => 'Untitled',
            // 'user_id' => $user->id,
            'goal' => 'What do you want to achieve',
            'how_to' => 'How will you achieve it',
            'bg_image' => 'backkground image url',
            'start_date' => now(),
        ]);

        return redirect()->route('plans.edit', ['plan' => $validatedData->id])
            ->with('success', 'Plan created successfully.');

    }
}
