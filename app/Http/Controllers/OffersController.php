<?php

namespace App\Http\Controllers;


use App\Http\Controllers\ChatsController;

use App\Message;
use Illuminate\Http\Request;
use App\Offer;
use DB;
use Illuminate\Validation\ValidationException;
use App\Item;

class OffersController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws ValidationException
     */
    public function make(Request $request) {
        // add this offer info into the database

        // validation
        $this->validate($request, [
            'price' => 'required',
            'message' => 'nullable | string | max:200',
        ]);

        $offer = new Offer;
        $offer->seller_id = DB::table('items')
            ->where('items.id', $request->input('item_id'))
            ->value('user_id');

        if (auth()->user()->id == $offer->seller_id) {
            return redirect('/items/'.$request->input('item_id'))->with('error', 'You cannot make an offer to yourself');
        }

        $offer->offered_price = $request->input('price');
        $offer->item_id = $request->input('item_id');
        $offer->buyer_id = auth()->user()->id;
        // set the time zone
        $offer->message = $request->input('message');

        if(auth()->user()->id == $request->input('user_id')) {
            if(count(Offer::where('buyer_id', auth()->user()->id)->where('item_id', $request->input('item_id'))->where('status', 'pending')->get()) == 0) {
                $offer->save();

                // generate a system message to inform the seller
                $chat_id = ChatsController::auto_create($offer->seller_id);
                $info = [
                    'sender_id' => $offer->seller_id,
                    'chat_id' => $chat_id,
                    'item_id' => $offer->item_id,
                    'offer' => $offer,
                ];
                MessagesController::auto_send_offer($info);

                return redirect('/items/'.$request->input('item_id'))->with('success', 'Offer Made! Click Chat to start your conversation with the seller ^_^');
            } else {
                return redirect('/items/'.$request->input('item_id'))->with('error', 'Please wait for the seller to accept your offer or you can cancel it');
            }
        } else {
            return redirect('/items/'.$request->input('item_id'))->with('error', 'Offer Not Made');
        }

    }


    public function show($id) {
        $offer = Offer::where('id', $id)->first();
        $item = Item::where('id', $offer->item_id)->first();

        $data = [
            'offer' => $offer,
            'item' => $item
        ];

        return view('/offers/show')->with('data', $data);
    }

    public function cancel($id) {
        Offer::where('id', $id)
            ->update(['status' => 'canceled']);

        // send a system generated message
        $offer = Offer::where('id', $id)->first();
        $chat_id = ChatsController::find($offer->buyer_id, $offer->seller_id);
        $info = [
            'sender_id' => auth()->user()->id,
            'chat_id' => $chat_id,
            'item_id' => $offer->item_id,
            'offer' => $offer,
        ];
        MessagesController::auto_send_canceled($info);

        return redirect()->back();
    }

    public function accept($id) {
        Offer::where('id', $id)
            ->update(['status' => 'accepted']);

        // send a system generated message
        $offer = Offer::where('id', $id)->first();
        $chat_id = ChatsController::find($offer->buyer_id, $offer->seller_id);
        $info = [
            'sender_id' => auth()->user()->id,
            'chat_id' => $chat_id,
            'item_id' => $offer->item_id,
            'offer' => $offer,
        ];
        MessagesController::auto_send_accepted($info);

        return redirect()->back();
    }

    public function decline($id) {
        Offer::where('id', $id)
            ->update(['status' => 'declined']);

        // send a system generated message
        $offer = Offer::where('id', $id)->first();
        $chat_id = ChatsController::find($offer->buyer_id, $offer->seller_id);
        $info = [
            'sender_id' => auth()->user()->id,
            'chat_id' => $chat_id,
            'item_id' => $offer->item_id,
            'offer' => $offer,
        ];
        MessagesController::auto_send_declined($info);

        return redirect()->back();
    }

}
