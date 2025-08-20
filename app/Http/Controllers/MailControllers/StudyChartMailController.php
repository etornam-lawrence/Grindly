<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudySession;
use App\Mail\StudyChartMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class StudyChartMailController extends Controller
{
    public function sendMail(Request $request)
    {
        //get auth user
        $user = Auth::user();

        //get data to be displayed
        $sessions = $user->sessions()->get();

        //generate pdf
        $pdf = Pdf::loadView('pdf.chart', [
            'username'=>$user->name,
            'sessions'=>$sessions
        ]);

        //filepath of stored PDF
        // $filePath = 'study_charts/chart_for_'.$user->id.'_.pdf';
        // Storage::makeDirectory('study_charts');
        // Storage::put($filePath, $pdf->output());

        Mail::to($user->email)->send(
            new StudyChartMail($user, $pdf->output())
        );

        return redirect()->back()->with('success', 'Study chart email sent successfully.');
    }

}
