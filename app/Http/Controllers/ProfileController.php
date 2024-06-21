<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Notification;
use App\Notifications\VerifyEmailChange;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $newEmail = $request->input('email');

        if ($newEmail !== $user->email) {
            // Generate email verification token and save it to the user model
            $user->new_email = $newEmail;
            $user->email_verification_token = Str::random(60);
            $user->save();

            // Send email verification notification
            Notification::send($user, new VerifyEmailChange($user));

            return Redirect::route('profile.edit')->with('status', 'verification-link-sent');
        }

        $user->fill($request->validated());
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
}
