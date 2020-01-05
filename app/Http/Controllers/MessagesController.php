<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Item;
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
        $chat = Chat::where('id', $chat_id)->first();
        $chat->last_text = $text;
        $chat->save();

        return redirect('/chats/'.$chat_id);
    }

    /**
     * Send a message to the other user by the system.
     *
     * @param  array $info
     * @return void
     */
    public static function auto_send_offer($info) {

        $message = new Message;
        $message->chat_id = $info['chat_id'];
        $message->sender_id = auth()->user()->id;
        $item_id = $info['item_id'];
        $item = Item::where('id', $item_id)->first();
        $text = 'Offered '.'<b class="text-dark text-monospace">S$'.$info['offer']->offered_price.'</b>'.' for <b><a class="text-dark text-monospace" href="/items/'.$item->id.'">'.$item->name.'</a></b>';
        $text = $text . '<br>' . '<a class="text-muted  text-dark" href="/offers/'. $info['offer']->id .'">Check the offer</a>';
        $message->text = $text;
        $message->is_system = true;
        $message->save();


        if ($info['offer']->message != null) {
            $message = new Message;
            $message->chat_id = $info['chat_id'];
            $message->sender_id = auth()->user()->id;
            $message->text = $info['offer']->message;
            $message->save();
            // update table chats last_text and last_activity
            Chat::where('id', $info['chat_id'])->update(['last_text' => $message->text]);
        }



    }

    /**
     * Send a message to the other user by the system.
     *
     * @param  array $info
     * @return void
     */
    public static function auto_send_accepted($info) {

        $message = new Message;
        $message->chat_id = $info['chat_id'];
        $message->sender_id = auth()->user()->id;
        $item_id = $info['item_id'];
        $item = Item::where('id', $item_id)->first();
        $text = 'I accepted your offer for <b><a class="text-dark text-monospace" href="/items/'.$item->id.'">'.$item->name.'</a></b>';
        $text = $text . '<br>' . '<a class="text-muted  text-dark" href="/offers/'. $info['offer']->id .'">Check the offer</a>';
        $message->text = $text;
        $message->is_system = true;
        $message->save();
    }

    /**
     * Send a message to the other user by the system.
     *
     * @param  array $info
     * @return void
     */
    public static function auto_send_declined($info) {

        $message = new Message;
        $message->chat_id = $info['chat_id'];
        $message->sender_id = auth()->user()->id;
        $item_id = $info['item_id'];
        $item = Item::where('id', $item_id)->first();
        $text = 'I declined your offer for <b><a class="text-dark text-monospace" href="/items/'.$item->id.'">'.$item->name.'</a></b>';
        $text = $text . '<br>' . '<a class="text-muted  text-dark" href="/offers/'. $info['offer']->id .'">Check the offer</a>';
        $message->text = $text;
        $message->is_system = true;
        $message->save();
    }

    /**
     * Send a message to the other user by the system.
     *
     * @param  array $info
     * @return void
     */
    public static function auto_send_canceled($info) {

        $message = new Message;
        $message->chat_id = $info['chat_id'];
        $message->sender_id = auth()->user()->id;
        $item_id = $info['item_id'];
        $item = Item::where('id', $item_id)->first();
        $text = 'I canceled my offer for <b><a class="text-dark text-monospace" href="/items/'.$item->id.'">'.$item->name.'</a></b>';
        $text = $text . '<br>' . '<a class="text-muted  text-dark" href="/offers/'. $info['offer']->id .'">Check the offer</a>';
        $message->text = $text;
        $message->is_system = true;
        $message->save();
    }


}
