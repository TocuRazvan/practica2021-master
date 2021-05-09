<?php

namespace App\Http\Controllers;

use App\Models\User;
use http\Env\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class AdminController
 *
 * @package App\Http\Controllers
 */
class AdminController extends Controller
{
    public function users()
    {
        $users = DB::table('users')->paginate(10);

        return view(
            'users.index',
            [
                'users' => $users
            ]
        );
    }
    public function profile()
    {

        return redirect('index.profile');
    }
}

    /**
     * update the specified resource in storage
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return  \Illuminate\Http\Response
     */
    public function update(Request  $request,$id)
    {
        $this->validate($request,[
            'role'=>'required',
            'id'=>'requiered'
        ]);
        $user=DB::find($id);
        $user->role=$request->get('role');
        $user->id=$request->get('id');
        $user->save();
        return redirect()->route('Users.update')->with('success','data updated');

    }

    public function destroy($id)
    {
        $user = DB::find($id);

        $user->delete();

        return response()->json([
            'message' => 'Data deleted successfully!'
        ]);
    }
}


