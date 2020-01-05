<?php



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');

Auth::routes();


//Route::get('/', 'ItemsController@index');
//Route::get('/', 'PromotionsController@index');

Route::get('/list/{category}', 'ItemsController@list');

// pass $id
Route::get('/items/{id}', 'ItemsController@show')->where('id', '[0-9]+');;
Route::post('/search', 'ItemsController@search')->name('search');
Route::get('/items/create', 'ItemsController@create');
Route::post('/items/store', 'ItemsController@store');


Route::get('/profiles/item', 'ProfilesController@item');
Route::get('/profiles/offer', 'ProfilesController@offer');
Route::get('/profiles/review', 'ProfilesController@review');



Route::post('/offer/new', 'OffersController@make');

Route::resource('profiles', 'ProfilesController');
Route::resource('items', 'ItemsController');

Route::post('/like/new', 'LikesController@add');
Route::post('/like/remove', 'LikesController@remove');
Route::get('/like', 'LikesController@index');




Route::get('/admin/promotion', 'PromotionsController@index');
Route::post('/admin/promotion/add', 'PromotionsController@add');
Route::post('/admin/promotion/remove', 'PromotionsController@remove');


//Route::get('chats/', function () {
//    return view('chats/index');
//});

//Route::get('chats/1', function () {
//    return view('chats/show');
//});


Route::get('/chats', 'ChatsController@index');
Route::get('/chats/{id}', 'ChatsController@show');
Route::post('chats/create', 'ChatsController@create');

Route::post('/messages/send', 'MessagesController@send');
Route::get('/test', function () {
    return view('/test');
});

Route::get('offers/{id}', 'OffersController@show');
