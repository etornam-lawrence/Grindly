<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\LoggedInMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class LoginMailController extends Controller
{
    public function loginMail(Request $request)
    {
        $user = Auth::user();
                
        return redirect()->route('dashboard');

    }
}
