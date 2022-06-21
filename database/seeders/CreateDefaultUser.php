<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class CreateDefaultUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = 'MailerLite Admin';
        $user->email = 'johndoe@mailerlite.com';
        $user->password = Hash::make('mailerlite');
        $user->save();
    }
}
