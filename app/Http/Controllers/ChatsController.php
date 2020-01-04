<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB as DB;
use App\Chat;

class ChatsController extends Controller
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
     * Display a chat history.
     *
     * @return void
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $chats = DB::table('chats')
            ->where('user1_id', $user_id)
            ->orWhere('user2_id', $user_id)
            ->latest('chats.last_activity')
            ->select('*')
            ->get();
        return view('/chats/index')->with('chats', $chats);
    }


    /**
     * Return messages sent between the sender and receiver.
     *
     * @param int $id
     * @return View
     */
    public function show($id) {
        $user_id = auth()->user()->id;
        $list = DB::table('chats')
            ->where('user1_id', $user_id)
            ->orWhere('user2_id', $user_id)
            ->latest('chats.last_activity')
            ->select('*')
            ->get();
        $messages = DB::table('messages')
            ->where('chat_id', $id)
            ->oldest('time')
            ->get();

        $chat = DB::table('chats')->where('chat_id', $id)->first();
        if($user_id == $chat->user1_id) {
            $sender = DB::table('users')->where('id', $chat->user2_id)->first();
        } else {
            $sender = DB::table('users')->where('id', $chat->user1_id)->first();
        }

        $chats = [
            'chats' => $list,
            'messages' => $messages,
            'sender' => $sender,
            'current_chat_id' => $id
        ];
        return  view('/chats/show')->with('chats', $chats);
    }


    /**
     * Return the status of the message receiver.
     *
     * @param  int  $category
     * @return View
     */
    public function status() {

    }

    /**
     * Create a chat between two users.
     *
     * @param  Request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function create(Request $request) {
        $item_id = $request->input('item_id');
        $user_id = auth()->user()->id;
        $sender_id = DB::table('items')->where('id', $item_id)->first()->user_id;

        if ($user_id == $sender_id) {
            return redirect('/items/'.$item_id)->with('error', 'You cannot chat with yourself');
        }

        $current_chat = DB::table('chats')
            ->where([
                ['user1_id', $user_id],
                ['user2_id', $sender_id]
            ])
            ->orWhere([
                ['user2_id', $user_id],
                ['user1_id', $sender_id]
            ])
            ->get();

        if (count($current_chat) == 0) {
            $chat = new Chat;
            $chat->user1_id = $user_id;
            $chat->user2_id = $sender_id;
            $chat->last_text = 'Start your conversation with '.User::where('id', $sender_id)->first()->name;
            $chat->save();
            return redirect('/chats/'.$chat->chat_id);
        } else {
            return redirect('/chats/'.$current_chat->first()->chat_id);
        }
    }

}