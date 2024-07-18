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
use Carbon\Carbon;


class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        $user = $request->user();
        $subscription = $user->subscription;

        $endDate = null;
        if ($subscription && $subscription->ends_at) {
            $endDate = Carbon::parse($subscription->ends_at);
        }

        return view('profile.edit', [
            'user' => $request->user(),
            'subscription' => $subscription,
            'endDate' => $endDate,
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        $user->fill($request->validated());
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
}
