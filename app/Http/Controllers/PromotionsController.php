<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Item;
use Illuminate\Support\Facades\DB as DB;

class PromotionsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth' => 'verified']);


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        if(User::find(auth()->user()->id)->is_admin != true) {
            return redirect('/')->with('error', 'Unauthorized User');
        }
        $promotions = DB::table('items')
            ->where('is_promoted', true)
            ->select('items.*')
            ->get();

        $others = DB::table('items')
            ->where('is_promoted', false)
            ->select('items.*')
            ->get();

        $items = [
            'promotions' => $promotions,
            'others' => $others
        ];
        return view('/admin/promotion')->with('items', $items);
    }

    /**
     * Add an item into the promoted list.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function add(Request $request) {

        if(User::find(auth()->user()->id)->is_admin != true) {
            return redirect('/')->with('error', 'Unauthorized Page');
        }

        $item_id = $request->input('item_id');
        $item = Item::find($item_id);
        $item->is_promoted = true;
        $item->save();
        return redirect('admin/promotion')->with('success', 'Item Promoted');;

    }

    /**
     * Remove an item into the promoted list.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function remove(Request $request) {
        if(User::find(auth()->user()->id)->is_admin != true) {
            return redirect('/')->with('error', 'Unauthorized Page');
        }

        $item_id = $request->input('item_id');
        $item = Item::find($item_id);
        $item->is_promoted = false;
        $item->save();
        return redirect('admin/promotion')->with('success', 'Removed Item from Promotion');;
    }

}
