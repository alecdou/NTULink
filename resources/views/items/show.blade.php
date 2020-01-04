<!-- display one clicked item -->

@extends('layouts.app')

@section('content')

    <style>

        .delete-btn {
            color: white !important;
            background: indianred !important;
            border: none;
            width: 70px;
            height: 35px;
            text-align: center;
        }

        .edit-btn {
            color: white !important;
            background: darkseagreen !important;
            border: none !important;
            width: 70px;
            height: 35px;
            text-align: center;
        }

        .checkout-btn {
            color: white !important;
            background: lightcoral !important;
            border: none !important;

        }

        .chat-btn {
            color: black !important;
            background: white !important;

            text-align: center;
        }

        .like-btn-active {
            color: black !important;
            background: white !important;

        }

        .like-btn {
            color: black !important;
            background: white !important;


        }
    </style>


    @include('inc.bottom-nav')
    <!-- Content -->
    <div class="container-fluid mx-0 px-0 justify-content-center d-flex row">
        <!-- Product Introduction -->
        <div class="container-fluid mx-0 px-0 row justify-content-center d-flex">

            <!-- Image -->
            <div class="card-body container-fluid mx-0 px-1 col-12 col-md-5 px-md-5">
                <div class="swiper-container swiper-container-item">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="/{{ App\Image::where('item_id', $data['item']->id)->first()->image_path }}" alt="Item Image" class="product-img">
                        </div>
                    </div>
                    <!-- Add Arrows -->
                    <div class="swiper-button-next swiper-button-next-item"></div>
                    <div class="swiper-button-prev swiper-button-prev-item"></div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination swiper-pagination-item"></div>
                </div>
            </div>

            <!-- Description -->
            <div class="card-body container-fluid mx-0 px-1 row col-12 col-md-7 px-md-5">

                    <!-- Item Information -->
                    <div class="container-fluid border-0 d-flex justify-content-between">
                        <div class="card-body container col-12 col-md-6">
                            <!-- Edit & Delete Button -->
                            <div class="px-0 mx-0">
                                @if(!Auth::guest())
                                    @if((Auth::user()->id == $data['item']->user_id) || (\App\User::find(auth()->user()->id)->is_admin == true))
                                        <a class="dropdown-toggle" id="profile-dropdown" data-toggle="dropdown">
                                            <i class="fas fa-cog fa-2x"></i>
                                        </a>

                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li class="dropdown-item bg-white px-0 mx-0 d-flex justify-content-center">
                                                <a href="/items/{{$data['item']->id}}/edit" class="btn edit-btn"><i class="far fa-edit"></i> Edit</a>
                                            </li>

                                            <li class="dropdown-item bg-white px-0 mx-0 d-flex justify-content-center">
                                                {!! Form::open(['action' => ['ItemsController@destroy', $data['item']->id], 'method' => 'POST', 'class' => 'float-right']) !!}
                                                @csrf
                                                {{Form::hidden('_method', 'DELETE')}}

                                                {{Form::submit('Delete', ['class' => ['btn delete-btn']])}}
                                                {!! Form::close() !!}
                                            </li>
                                        </ul>
                                    @endif
                                @endif
                            </div>
                            <!-- /Edit & Delete Button -->
                            <h3 class="text-monospace font-weight-bold">{{ $data['item']->name }}</h3>
                            <h3>S${{ $data['item']->price }}</h3>
                            <p class="">{{ $data['item']->description }}</p>
                            <hr>
                            <div class="container-fluid justify-content-center px-0">
                                <p>Meet-up location</p>
                                <p>Payment method</p>
                                <p>Contact information</p>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="card-body mt-0 pt-0 container col-12 col-md-6 d-none d-sm-block">
                            @auth
                                @if(count(\App\Offer::where('buyer_id', auth()->user()->id)->where('item_id', [$data['item']->id])->get()) == 0)
                                    <div class="btn checkout-btn btn-block px-md-5 my-1 py-2 text-monospace font-weight-bold" onclick="document.getElementById('offer-modal').style.display='block'">Make Offer</div>
                                @else
                                    <a class="btn checkout-btn btn-block px-md-5 my-1 py-2 text-monospace font-weight-bold" href="/profiles/offer">Check Offer</a>
                                @endif

                                <!-- Offer Modal -->
                                <div id="offer-modal" class="modal">
                                    <div class="modal-dialog modal-dialog-centered justify-content-center container-fluid col-12 col-md-6 col-lg-4">
                                        <form id="offer-form" class="modal-content animate container-fluid" action="/offer/new" method="post">
                                            @csrf
                                            <div class="container-fluid px-0 mx-0">
                                                <div onclick="document.getElementById('offer-modal').style.display='none'" class="close" >&times;</div>

                                                <div class="container-fluid mt-5 mb-3 mx-0">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Your offer</span>
                                                            <span class="input-group-text">SGD</span>
                                                        </div>
                                                        <input type="number" class="form-control"
                                                               placeholder="You are offering ..."
                                                               name="price" required>

                                                    </div>
                                                    <input name="user_id" type="hidden" value="{{ auth()->user()->id }}">
                                                    <input name="item_id" type="hidden" value="{{ $data['item']->id }}">

                                                    <label for="message" class="col-form-label text-md-right">Message</label>
                                                    <textarea type="text" class="form-control border rounded mb-2"
                                                              placeholder="Leaving a message for the seller ..." name="message" rows="3"></textarea>
                                                    <button for="offer-form" type="submit" class="btn btn-success checkout-btn container-fluid">Make Offer</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- /Offer Modal -->

                                <!-- Chat button -->

                                    <form action="/chats/create" method="post" class="container d-inline p-0 m-0">
                                        @csrf
                                        <input name="item_id" type="hidden" value="{{ $data['item']->id }}">
                                        <button type="submit" class="btn like-btn-active btn-block px-md-5 my-1 text-monospace font-weight-bold border-dark">Chat</button>
                                    </form>


                                <!-- Like Button -->
                                @if(count(\App\Like::where('user_id', auth()->user()->id)->where('item_id', [$data['item']->id])->get()) == 0)
                                    <form id="like-form" action="/like/new" method="post" class="container d-inline p-0 m-0">
                                        @csrf
                                        <input name="item_id" type="hidden" value="{{ $data['item']->id }}">
                                        <button for="like-form" type="submit" class="btn like-btn btn-block px-md-5 my-1 text-monospace font-weight-bold border-dark"><i class="far fa-heart py-0"></i> Like</button>
                                    </form>
                                @else
                                    <form action="/like/remove" method="post" class="container d-inline p-0 m-0">
                                        @csrf
                                        <input name="item_id" type="hidden" value="{{ $data['item']->id }}">
                                        <button type="submit" class="btn like-btn-active btn-block px-md-5 my-1 text-monospace font-weight-bold border-dark"><i class="fas fa-heart py-0"></i> Remove</button>
                                    </form>
                                @endif

                            @else
                                <a href="/login">
                                    <div class="btn checkout-btn btn-block px-md-5 my-1 text-monospace font-weight-bold border-dar">Login to make an offer</div>
                                </a>
                            @endauth
                        </div>
                    </div>



                    <!-- /Item Information -->
            </div>
        </div>
    </div>










        <!-- Detailed product information -->
        <div class="=container-fluid jumbotron jumbotron-fluid mx-3 mx-md-5">
            <div class="container-fluid">
                <h5 class="text-monospace font-weight-bold">More Information</h5>
                <p>
                    The cot base can be placed at two different heights.

                    Your baby will sleep both safely and comfortably as the durable materials in the cot base have been tested to ensure they give their body the support it needs.

                    The cot base is well ventilated for good air circulation which gives your child a pleasant sleeping climate.

                    Complies with European standard EN 716-1 and Japanese standard CPSA 0023.

                    For your child's safety, use a cot and mattress of the same size.

                    Recommended for ages from 0 year.

                    Mattress and bedlinen are sold separately.
                </p>
            </div>
        </div>

    <div class="container-fluid my-3 mx-0 px-0">
        @if(count($data['similarItems']) > 0)
            <h1 class="d-flex justify-content-center pt-3">Items You May Like</h1>
            <div class="container-fluid px-0 row mx-1">
                @foreach($data['similarItems'] as $item)
                    <div class="container col-6 col-xl-2 col-md-3 col-sm-4 mb-3 px-1 m-0">
                        <div class="card product-card border-0 justify-content-center">
                            <a href="/items/{{ $item->id }}" class="d-flex justify-content-center my-0 pb-0">
                                <img src="/{{ App\Image::where('item_id', $item->id)->first()->image_path }}" alt="Item Image" class="product-img">
                            </a>
                            <div class="card-body justify-content-center mt-1 pt-1">
                                <h5 id="item-name" class="card-title text-truncate mb-0" style="display: block">
                                    {{ $item->name }}
                                </h5>
                                <p class="card-text text-truncate mt-0 text-muted" style="display: block">{{ $item->description }}</p>
                                <div class="container row justify-content-between mx-0 px-0 pb-0 mb-0">
                                    <h5 id="item-price" class="card-title d-flex justify-content-start mb-0">
                                        <b>S${{ $item->price }}</b>
                                    </h5>
                                    <h5 class="text-muted pb-0 mb-0">Used</h5>
                                </div>


                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="jumbotron justify-content-center d-block">
                <h5 class="d-flex justify-content-center mt-2">You haven't uploaded any items yet</h5>
                <a href="/items/create" class="d-flex justify-content-center">
                    <div class="btn btn-primary">Upload Now</div>
                </a>
            </div>
        @endif
    </div>



    @endsection


@section('extra-js')
    <script>
        var swiper = new Swiper('.swiper-container-item', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            pagination: {
                el: '.swiper-pagination-promotion',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next-item',
                prevEl: '.swiper-button-prev-item',
            },
        });

        var swiper2 = new Swiper('.swiper-container-product', {
            slidesPerView: 4,
            spaceBetween: 30,
            freeMode: true,
            navigation: {
                nextEl: '.swiper-button-next-product',
                prevEl: '.swiper-button-prev-product',
            },
        });

        // Get the modal
        var modal = document.getElementById('offer-modal');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>


@endsection
