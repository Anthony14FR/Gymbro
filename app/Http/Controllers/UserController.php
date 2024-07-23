<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;
use App\Models\Program;
use Illuminate\Support\Facades\DB;
use App\Models\Subscription;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(2);
        $totalUsers = User::count();
        $verifiedUsers = User::whereNotNull('email_verified_at')->count();
        $newUsers = User::where('created_at', '>=', now()->subDays(30))->count();
        $subscribedUsers = Subscription::count();
        $totalPrograms = Program::count();
        $publicPrograms = Program::where('status', true)->count();

        return view('users.index', compact('users', 'totalUsers', 'verifiedUsers', 'newUsers', 'subscribedUsers', 'totalPrograms', 'publicPrograms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|min:2|max:50|string',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|max:200',
        ]);

        $password = $request->password;
        $password_confirmation = $request->password_confirmation;

        if ($password === $password_confirmation) {
            $hashedPassword = bcrypt($password);
            $request->merge(['password' => $hashedPassword]);
            $user = User::create($request->all());
            return redirect()->route('users.index')->with('success', 'L\'utilisateur ' . $user->username . ' a été créé avec succès');
        } else {
            return redirect()->route('users.index')->with('warning', 'Les mots de passe ne correspondent pas');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        $programs = Program::where('user_id', $id)->get();
        $daysCount = DB::table('exercises_programs')
            ->count(DB::raw('DISTINCT day'));

        return view('users.show', compact('user', 'programs', 'daysCount'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $requestId = $request->user_id;

        $user = User::findOrFail($requestId);
        $user->fill($request->validate([
            'username' => 'required|min:2|max:50|string',
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]));
        $user->save();

        return redirect()->route('users.index')->with('success', "L'utilisateur " . $user->username . " a été mis à jour avec succès");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')->with('warning', 'You cannot delete yourself ! There is only one you <3');
        }
        $user->delete();

        return redirect()->route('users.index')->with('success', "L'utilisateur " . $user->username . " a été supprimé avec succès");
    }

    public function updateRole(Request $request, User $user)
    {
        if ($user->id === 1 || ($user->id === auth()->id() && $user->hasRole('admin'))) {
            return back()->with('error', 'Vous ne pouvez pas modifier le rôle de cet utilisateur.');
        }

        if ($user->hasRole('admin')) {
            $user->removeRole('admin');
            $message = 'L\'utilisateur a été rétrogradé avec succès.';
        } else {
            $user->assignRole('admin');
            $message = 'L\'utilisateur a été promu administrateur avec succès.';
        }

        return back()->with('success', $message);
    }
}
