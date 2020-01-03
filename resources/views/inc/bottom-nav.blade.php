<style>
    #bottom-nav {
        background-color: lightblue !important;
        z-index: 5 !important;
    }

    .nav-like-btn {
        background-color: transparent !important;
        color: white;
    }

    .nav-like-active-btn {
        background-color: transparent !important;
        color: lightpink !important;
    }


</style>

<link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/sticky-footer-navbar/">

<nav id="bottom-nav" class="navbar navbar-expand fixed-bottom navbar-light bg-light d-block d-sm-none pt-3">
    <div class="navbar d-flex justify-content-center">
        <ul class="navbar-nav align-items-center">
            @auth
                <!-- Like Button -->
                 <li class="py-0 my-0 nav-item mr-1">
                     @if(count(\App\Like::where('user_id', auth()->user()->id)->where('item_id', [$data['item']->id])->get()) == 0)
                         <form id="like-form" action="/like/new" method="post" class="p-0 m-0">
                             @csrf
                             <input name="item_id" type="hidden" value="{{ $data['item']->id }}">
                             <button for="like-form" type="submit" class="btn nav-like-btn py-0 my-0"><i class="far fa-heart fa-2x py-0"></i></button>
                         </form>
                     @else
                         <form action="/like/remove" method="post" class="p-0 m-0">
                             @csrf
                             <input name="item_id" type="hidden" value="{{ $data['item']->id }}">
                             <button type="submit" class="btn nav-like-active-btn py-0 my-0"><i class="fas fa-heart fa-2x py-0"></i></button>
                         </form>
                     @endif
                 </li>

                <!-- Offer Button -->
                <li class="py-0 my-0 nav-item mx-3">
                    @if(count(\App\Offer::where('buyer_id', auth()->user()->id)->where('item_id', [$data['item']->id])->get()) == 0)
                        <a class="nav-link btn text-monospace py-0 my-0" onclick="document.getElementById('sm-offer-modal').style.display='block'">
                            <h5 class="py-0 my-0" style="color: darkblue"><b>Make Offer</b></h5>
                        </a>
                    @else
                        <a class="nav-link btn text-monospace text-dark" href="/profiles/offer">
                            <h5 class="py-0 my-0" style="color: darkblue"><b>Check Offer</b></h5>
                        </a>
                    @endif
                </li>

                <li class="py-0 my-0 nav-item ml-1">
                    <!-- Chat button -->
                    <a class="nav-link text-monospace text-dark py-0" href="/chat/item-id={{ $data['item']->id }}">
                        <h5 class="py-0 my-0" style="color: white"><b>Chat</b></h5>
                    </a>
                </li>

                <!-- Offer Modal -->
                <div id="sm-offer-modal" class="modal">
                    <div class="modal-dialog modal-dialog-centered justify-content-center container-fluid col-12 col-md-6 col-lg-4">
                        <form id="offer-form" class="modal-content animate container-fluid" action="/offer/new" method="post">
                            @csrf
                            <div class="container-fluid px-0 mx-0">
                                <div onclick="document.getElementById('sm-offer-modal').style.display='none'" class="close" >&times;</div>

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
            @else
                <li class="mx-0 px-0 py-1 d-flex justify-content-center">
                    <h5 class="container-fluid d-flex">
                        <b>Hi</b>, please<a href="/login" class="text-dark text-monospace mx-1"><b> Log In </b></a>
                        or<a href="register" class="text-dark text-monospace mx-1"><b> Register </b></a>
                    </h5>
                </li>
            @endauth
        </ul>
    </div>
</nav>

<script>
    // Get the modal
    var smmodal = document.getElementById('sm-offer-modal');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == smmodal) {
        smmodal.style.display = "none";
        }
    }
</script>
