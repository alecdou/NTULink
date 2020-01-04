<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use Illuminate\Support\Facades\DB as DB;

class LikesController extends Controller
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $items = DB::table('likes')
            ->join('items', 'items.id', '=', 'likes.item_id')
            ->where('likes.user_id', $user_id)
            ->select('*')
            ->get();
        return view('/likes/index')->with('items', $items);
    }

    /**
     * Add an item into the like list.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function add(Request $request)
    {
        $item_id = $request->input('item_id');

        $like = new Like;
        $like->user_id = auth()->user()->id;
        $like->item_id = $item_id;
        $like->save();
        return redirect('/items/' . $request->input('item_id'))->with('success', 'You liked this item');
    }

    /**
     * Remove an item from the like list.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function remove(Request $request)
    {
        $user_id = auth()->user()->id;
        $item_id = $request->input('item_id');

        DB::table('likes')
            ->where('user_id', $user_id)
            ->where('item_id', $item_id)
            ->delete();
        return redirect('/items/' . $request->input('item_id'))->with('success', 'You removed this item from your likes');
    }
}
