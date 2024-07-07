<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class DatabaseSeeder extends Seeder
{
    use HasRoles;
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::create([
            'username' => 'admin',
            'email' => 'admin@orus.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin'),
            'remember_token' => Str::random(10),
        ]);

        $user = User::create([
            'username' => 'user',
            'email' => 'user@orus.com',
            'email_verified_at' => now(),
            'password' => Hash::make('user'),
            'remember_token' => Str::random(10),
        ]);

        $premium = User::create([
            'username' => 'premium',
            'email' => 'premium@orus.com',
            'email_verified_at' => now(),
            'password' => Hash::make('premium'),
            'remember_token' => Str::random(10),
        ]);
            

        $this->call([
            MuscleSeeder::class,
            ExerciseSeeder::class,
            ProgramSeeder::class,
            RoleSeeder::class,
        ]);

        $admin->assignRole('admin');
        $admin->update(['role' => 'admin']);
        $user->assignRole('user');
        $user->update(['role' => 'user']);
        $premium->assignRole('premium');
        $premium->update(['role' => 'premium']);
    }
}
