<?php

namespace App\Http\Controllers;

use App\Offer;
use App\Review;
use App\User;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class ReviewsController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($id)
    {
        $offer = Offer::where('id', $id)->first();
        if (count((Review::where('offer_id', $offer->id)->where('sender_id', auth()->user()->id))->get()) > 0) {
            return redirect()->back()->with('error', 'You can only comment on this offer once');
        }
        return view('/reviews/create')->with('offer', $offer);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $offer_id = $request->input('offer_id');
        $this->validate($request, [
            'rating' => 'required',
            'comment' => 'required | nullable',
        ]);

        $offer = Offer::where('id', $offer_id)->first();
        $user_id = auth()->user()->id;
        if ($user_id == $offer->buyer_id) {
            $role = 'buyer';
            $receiver_role = 'seller';
            $receiver_id = $offer->seller_id;
        } else {
            $role = 'seller';
            $receiver_role = 'buyer';
            $receiver_id = $offer->buyer_id;
        }
        $text = $request->input('comment');
        $rating = $request->input('rating');

        $review = new Review;
        $review->offer_id = $offer_id;
        $review->sender_id = $user_id;
        $review->receiver_id = $receiver_id;
        $review->sender_role = $role;
        $review->receiver_role = $receiver_role;
        $review->text = $text;
        $review->rating = $rating;
        $review->save();

        // update receiver's rating
        $this->update_rating($review->receiver_id);

        return redirect('/profiles/review')->with('success', 'A new review is added');
    }

    public static function update_rating($user_id) {

        $user_ratings = Review::where('receiver_id', $user_id)->select('rating')->get();
        $sum = 0;
        foreach($user_ratings as $user_rating) {
            $sum += $user_rating['rating'];
        }

        $average = $sum / count($user_ratings);
        User::where('id', $user_id)->update(['rating' => $average]);

    }

}
