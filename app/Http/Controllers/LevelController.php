<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LevelController extends Controller
{

    public function getUserLevel(User $user)
    {
        return $user->level;
    }

    public function getUserExperience(User $user)
    {
        return $user->experience;
    }

    public function setUserLevel(User $user, $level)
    {
        $user->level = $level;
        $user->save();
    }

    public function setUserExperience(User $user, $experience)
    {
        $user->experience = $experience;
        $user->save();
    }
}