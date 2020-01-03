<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Offer;
use DB;
use Illuminate\Validation\ValidationException;

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

        $offer->offered_price = $request->input('price');
        $offer->item_id = $request->input('item_id');
        $offer->buyer_id = auth()->user()->id;
        // set the time zone
        date_default_timezone_set("Asia/Singapore");
        $offer->date_offered = date("Y-m-d h:i:s");

        if(auth()->user()->id == $request->input('user_id')) {
            if(count(Offer::where('buyer_id', auth()->user()->id)->where('item_id', $request->input('item_id'))->get()) == 0) {
                $offer->save();
                return redirect('/items/'.$request->input('item_id'))->with('success', 'Offer Made');
            } else {
                return redirect('/items/'.$request->input('item_id'))->with('error', 'You have already made an offer');
            }
        } else {
            return redirect('/items/'.$request->input('item_id'))->with('error', 'Offer Not Made');
        }

    }

}
