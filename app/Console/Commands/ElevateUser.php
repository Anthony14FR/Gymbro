<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class ElevateUser extends Command
{
    protected $signature = 'roles:elevate {role}';

    protected $description = 'Change rights for one user';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        if (env('APP_ENV') === 'production') {
            return exit(1);
        }

        $role = $this->argument('role');
        $user = User::where('email', env('DEV_USER_EMAIL'))->firstOrFail();
        $roles = Role::all()->pluck('name')->toArray();

        if (\in_array($role, $roles)) {
            $user->syncRoles($role)->save();

            return Command::SUCCESS;
        }

        exit(0);
    }
}
