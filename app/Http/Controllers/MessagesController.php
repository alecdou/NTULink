<?php

namespace App\Http\Controllers;

use App\Chat;
use Illuminate\Http\Request;
use App\Message;

class MessagesController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Send a message to the other user.
     *
     * @param  Request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function send(Request $request) {

        $user_id = auth()->user()->id;
        $text = $request->input('text');
        $chat_id = $request->input('chat_id');

        $message = new Message;
        $message->chat_id = $chat_id;
        $message->text = $text;

        $message->sender_id = $user_id;
        $message->save();

        // update table chats last_text and last_activity
        $chat = Chat::where('chat_id', $chat_id)->first();
        $chat->last_text = $text;
        $chat->last_activity = $message->time;

        return redirect('/chats/'.$chat_id);
    }

}
