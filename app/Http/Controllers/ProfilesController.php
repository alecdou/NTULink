<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as DB;
use App\User;

class ProfilesController extends Controller
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
     * Display the profile with all items.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $user_id = auth()->user()->id;


        $items = DB::table('items')
            ->where('user_id', $user_id)
            ->select('*')
            ->get();
        return view('/profiles/index')->with('items', $items);
    }

    /**
     * Display the profile with all items.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function item() {

        return redirect('/profiles/index');
    }

    /**
     * Display the profile with all offers.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function offer() {
        $user_id = auth()->user()->id;


        $items = DB::table('offers')
            ->join('items', 'items.id', '=', 'offers.item_id')
            ->where('offers.buyer_id', $user_id)
            ->orWhere('offers.seller_id', $user_id)
            ->select('*', 'offers.id')
            ->get();
        return view('/profiles/offer')->with('items', $items);
    }

    /**
     * Display the profile with all reviews.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function review() {
        $user_id = auth()->user()->id;


        $reviews = DB::table('reviews')
            ->where('receiver_id', $user_id)
            ->latest('created_at')
            ->get();

        //print_r($reviews);
        return view('/profiles/review')->with('reviews', $reviews);
    }

    /**
     * Show the user profile page.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function show()
    {
        return redirect('/profiles');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::find($id);

        // check for correct user
        if(auth()->user()->id !== $user->id) {
            return redirect('/profiles')->with('error', 'Unauthorized Page');
        }

        return view('/profiles/edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'cover_image' => 'image | nullable | max:1999'
        ]);

        // handle file upload
        if($request->hasFile('cover_image')) {
            // Get file name with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just extension
            $extention = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extention;
            // Upload the image
            // public/cover_images will create a folder inside storage/public which is not accessible in the browser
            // thus, we have to make a symbolic link to the public folder to load the image
            // run this command to do this
            // php artisan storage:link
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $user= User::find($id);
        $user->name = $request->input('name');
        $user->profile_image = $fileNameToStore;
        $user->save();

        // check for correct user
        if(auth()->user()->id !== $user->id) {
            return redirect('#')->with('error', 'Unauthorized Page');
        }

        return redirect('/profiles')->with('success', 'Post Updated');
    }

}
