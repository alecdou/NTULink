@extends('layouts.profile')

@section('content')

    <style>
        .chat-list {
            width: 100%;
            position: fixed;
            left: 0;
            bottom: 0;
            top: 100px;
            background-color: white;
            overflow-x: hidden;
            overflow-y: scroll;
            padding-top: 15px;

        }

        .chat-item {
            background-color: white;
            border-radius: 5px;
        }


        .chat-list a:hover {
            color: #f1f1f1;
        }

        .chat-item:hover {
            background-color: #f5f5f5 !important;
        }

        .message-box {
            height: calc(100% - 153px);
            width: 100%;
            position: fixed;
            right: 0;
            bottom: 0;
            top: 100px;
            background-color: #f6f7f9;
            overflow-x: hidden;
            overflow-y: scroll;
            padding-top: 15px;
            padding-bottom: 15px;
        }

        .message-item {
            border-radius: 5px;
        }


        .message-receiver {
            background-color: rgb(255, 162, 162);
            display: block;
            right: 0;
            min-width: 30%;
        }

        .message-sender {
            background-color: #b9d2ff;
            display: block;
            left: 0;
            min-width: 30%;
        }

        .chat-img {
            border-radius: 0;
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .chat-input-box {
            width: 100%;
            right: 0;
            position: fixed;
            bottom:0;
            z-index: 10;
            background-color: #e4e7eb !important;
        }

        #chat-input {

        }

        #send-btn {
            background-color: lightblue;
            border-color: lightblue;
        }

        .chat-item a {
            color: #272c31;
            text-decoration: none !important;
        }

        .chat-item a:hover {
            color: black;
            text-decoration: none !important;
        }



    </style>


    <div class="container container-fluid row mt-3 bg-light px-0 mx-0 col-12">

        <!-- chat List -->
        <div class="container-fluid col-12 col-md-4 chat-list px-0 mx-0 pr-1">
            <div class="container-fluid px-0 mx-0 ml-3 pb-2 row col-12 px-0 mx-0 pr-1">

            @if(count($chats) > 0)
                @foreach($chats as $chat)
                    <!-- List item -->
                    <div class="container-fluid chat-item row mt-0 mb-0 col-12 pt-0 pb-2 text-dark">
                        <!-- profile picture -->
                        <img class="container-fluid col-2 pt-2 px-0 mx-0 chat-img" src="noimage.jpg">
                        <!-- user name and message -->
                        <a class="container-fluid col-10 d-flex pl-2 p-0 m-0" href="/chats/{{ $chat->chat_id }}">
                            <div class="container-fluid p-0 m-0 d-block justify-content-start align-self-center">
                                <h5 class="container-fluid px-0 pt-2 text-truncate text-monospace font-weight-bold" style="display: block">
                                    @if(auth()->user()->id == $chat->user1_id)
                                        {{ \App\User::where('id', $chat->user2_id)->first()->name }}
                                    @else
                                        {{ \App\User::where('id', $chat->user1_id)->first()->name }}
                                    @endif
                                </h5>
                                <p class="p-0 m-0 text-truncate" style="display: block">
                                    {{ $chat->last_text }}
                                </p>
                                <p class="p-0 m-0 small pull-right pt-1">Last chatted <b>{{ $chat->last_activity }}</b></p>
                            </div>
                        </a>
                    </div>
                    <div class="container-fluid pl-0 mr-2"><hr class="py-0 mb-0 mt-0"></div>
                    <!-- /List item -->
                @endforeach
            @endif



            </div>

        </div>


        <!-- Message Box -->
        <div class="container-fluid d-none d-md-block col-8 message-box border-0">

        </div>



    </div>



@endsection
