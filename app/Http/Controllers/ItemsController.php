<?php

namespace App\Http\Controllers;


use App\Item;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB as DB;
use App\User;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Intervention\Image\Facades\Image as ImageManager;



class ItemsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth' => 'verified'], ['except' => ['home', 'list', 'show', 'search']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        //
    }


    /**
     * Return a list of items of the requested category.
     *
     * @param  int  $category
     * @return View
     */
    public function list($category) {

        if($category == 'All Items') {
            $items = Item::all();
        } else {
            $items = DB::table('items')
                ->join('categories', 'items.category_id', '=', 'categories.id')
                ->where('categories.category_name', $category)
                ->select('items.*')
                ->get();
        }
        return view('/items/list')->with('items', $items);
    }

    /**
     * Return a list of items according to search keywords.
     *
     * @param Request $request
     * @return View
     */
    public function search(Request $request) {
        $keywords = $request->input('keywords');
        $items = Item::search($keywords)->get();
        return view('items.search')->with('items', $items);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('/items/create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required | max: 40',
            'price' => 'required',
            'description' => 'required | max: 80',
            'details' => 'nullable',
            'is_new' => 'required',
            'category' => 'nullable',
            //'cover_image' => 'image | nullable | max:1999'
        ]);

        // handle file upload
        if($request->hasFile('cover_image')) {
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extention = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extention;
            $std_size = 300;

            // get the submitted image
            $img = ImageManager::make($_FILES['cover_image']['tmp_name']);

            // we need to resize image
            if ($img->width() > $std_size) {
                $img->resize($std_size, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }

            if ($img->height() > $std_size) {
                $img->resize(null, $std_size, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }

            // create empty canvas
            $img->resizeCanvas($std_size, $std_size, 'center', false, '#ffffff');

            // save the image
            $img->save($fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $item = new Item;
        $item->user_id = auth()->user()->id;
        $item->name = $request->input('name');
        $item->price = $request->input('price');
        $item->description = $request->input('description');
        $item->details = $request->input('details');
        if ($request->input('is_new') == 'true') {
            $item->is_new = true;
        } else {
            $item->is_new = false;
        }

        $item->category_id = $request->input('category');
        $item->save();

        $image = new Image;
        $image->image_path = $fileNameToStore;
        $image->item_id = $item->id;
        $image->save();

        return redirect('/profiles')->with('success', 'Item Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function show($id)
    {
        $item = Item::find($id);

        $similarItems = Item::inRandomorder()->take(4)->get();

        $data = [
            'item' => $item,
            'similarItems' => $similarItems
        ];
        return view('/items/show')->with('data', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function edit($id)
    {
        $item = Item::find($id);

        // check for correct user
        if(auth()->user()->id !== $item->user_id && (User::find(auth()->user()->id)->is_admin != true)) {
            return redirect('/profiles')->with('error', 'Unauthorized Page');
        }

        return view('/items/edit')->with('item', $item);
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
            'price' => 'required',
            'description' => 'required',
            'details' => 'nullable',
            'is_new' => 'required',
            'category' => 'nullable',
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
            $std_size = 300;


            // get the submitted image
            $img = ImageManager::make($_FILES['cover_image']['tmp_name']);

            // we need to resize image
            if ($img->width() > $std_size) {
                $img->resize($std_size, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }

            if ($img->height() > $std_size) {
                $img->resize(null, $std_size, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }

            // create empty canvas
            $img->resizeCanvas($std_size, $std_size, 'center', false, '#ffffff');

            // save the image
            $img->save($fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $item = Item::find($id);
        $item->name = $request->input('name');
        $item->price = $request->input('price');
        $item->description = $request->input('description');
        $item->details = $request->input('details');
        if ($request->input('is_new') == 'true') {
            $item->is_new = true;
        } else {
            $item->is_new = false;
        }

        $item->category_id = $request->input('category');
        $item->save();

        $image = image::where('item_id', $id)->first();
        if($request->hasFile('cover_image')) {
            $image->image_path = $fileNameToStore;
        }
        $image->save();

        // check for correct user
        if(auth()->user()->id !== $item->user_id && (user::find(auth()->user()->id)->is_admin != true)) {
            return redirect('#')->with('error', 'Unauthorized Page');
        }

        return redirect('/profiles')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $item = Item::find($id);


        // check for correct user
        if(auth()->user()->id !== $item->user_id && (User::find(auth()->user()->id)->is_admin != true)) {
            return redirect('/profiles')->with('error', 'Unauthorized Page');
        }

        if($item->cover_image !== "noimage.jpg") {
            // Delete image
            Storage::delete('public/cover_images/'.$item->cover_image);
        }
        $item->delete();

        return redirect('/profiles')->with('success', 'Post Removed');
    }
}
