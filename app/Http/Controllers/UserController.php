<?php


namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;

class UserController
{
    public function profile()
    {

        return redirect('index.profile');
    }
}
public function users()
{
    $users = DB::table('users')->paginate(10);

    return view(
        'bord',
        [
            'users' => $users
        ]
    );
}
