<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Casts\ArrayObject;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Events\MessageSentEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Monolog\Logger;


class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request  $request)
    {
        $messages = Message::with('user')->get();

        return view(
            'chat',
            [
                "messages" =>$messages
            ]
        );

    }

    public function store(Request $request)
    {
        try {
            $user = Auth::user();

            $message = $user->messages()->create([
                'message' => $request->input('message')
            ]);


            // send event to listeners
            broadcast(new MessageSentEvent($message, $user))->toOthers();

            return redirect('/chat');
        } catch (\Exception $e){
           Log::error($e);
        }
    }
}
