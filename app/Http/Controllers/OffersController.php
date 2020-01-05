<?php

namespace App\Http\Controllers;


use App\Message;
use Illuminate\Http\Request;
use App\Offer;
use DB;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\ChatsController;

class OffersController extends Controller
{

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
        date_default_timezone_set("Asia/Singapore");
        $offer->date_offered = date("Y-m-d h:i:s");
        $offer->message = $request->input('message');

        if(auth()->user()->id == $request->input('user_id')) {
            if(count(Offer::where('buyer_id', auth()->user()->id)->where('item_id', $request->input('item_id'))->get()) == 0) {
                $offer->save();

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
                return redirect('/items/'.$request->input('item_id'))->with('error', 'You have already made an offer');
            }
        } else {
            return redirect('/items/'.$request->input('item_id'))->with('error', 'Offer Not Made');
        }

    }

}
