<?php

namespace App\Http\Controllers;


use App\Item;
use Illuminate\Support\Facades\DB as DB;
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $promotions = DB::table('items')
            ->where('is_promoted', true)
            ->select('items.*')
            ->get();

        $items = Item::all();

        $data = [
            'promotions' => $promotions,
            'items' => $items
        ];

        return view('/home')->with('data', $data);
    }
}
