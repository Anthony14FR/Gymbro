<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function incrementLevel(User $user)
    {
        $user->increment('level');
        return response()->json(['message' => 'Niveau augmenté avec succès', 'new_level' => $user->level]);
    }

    public function getUserLevel(User $user)
    {
        return response()->json(['level' => $user->level]);
    }
}