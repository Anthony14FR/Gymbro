<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class EmailVerificationController extends Controller
{
    public function verifyNewEmail($token)
    {
        $user = User::where('email_verification_token', $token)->firstOrFail();
        $user->email = $user->new_email;
        $user->new_email = null;
        $user->email_verified_at = now();
        $user->email_verification_token = null;
        $user->save();

        return redirect()->route('profile.edit')->with('status', 'email-verified');
    }
}
