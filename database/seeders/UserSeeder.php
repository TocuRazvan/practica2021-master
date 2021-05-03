<?php


namespace Database\Seeders;


use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin2',
            'email' => 'admin2@admin.ro',
            'password' => Hash::make('parola')
        ]);
    }
}
