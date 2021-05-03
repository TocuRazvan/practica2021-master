<?php


namespace Database\Seeders;


use App\Models\User;
use Illuminate\Support\Facades\Hash;

class BoardsSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BoardsSeeder::create([
            'name' => 'Admin',
            'user' => 'alin',
            'members' => 'alin'
        ]);
    }
}
