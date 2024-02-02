<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\User\Models\User;
use App\User\Models\UserSettings;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->id = config('app.config.demo_user_id');
        $user->uuid = uniqid();
        $user->name = "foo bar";
        $user->password = bcrypt("password");
        $user->email = "foo@email.it";
        $user->email_verified_at = date("Y-m-d H:i:s");
        $user->save();
    }
}
