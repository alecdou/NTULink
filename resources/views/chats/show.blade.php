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
            height: 100%;
            width: 100%;
            position: fixed;
            right: 0;
            bottom: 0;
            top: 100px;
            background-color: #f6f7f9;
            overflow-x: hidden;
            overflow-y: scroll;
            padding-top: 15px;
            padding-bottom: 200px;
        }

        .message-item {
            border-radius: 5px;
        }


        .message-receiver {
            background-color: rgb(255, 162, 162);
            display: block;
            right: 0;
            min-width: 30%;
            max-width: 80%;
        }

        .message-sender {
            background-color: #b9d2ff;
            display: block;
            left: 0;
            min-width: 30%;
            max-width: 80%;
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
            bottom: 0;
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
        <div class="container-fluid col-0 col-md-4 chat-list px-0 mx-0 pr-1">
            <div class="container-fluid px-0 mx-0 ml-3 pb-2 row col-12 px-0 mx-0 pr-1">

            @if(count($chats['chats']) > 0)
                @foreach($chats['chats'] as $chat)
                    <!-- List item -->
                        <div class="container-fluid chat-item row mt-0 mb-0 col-12 pt-0 pb-2">
                            <!-- profile picture -->
                            <img class="container-fluid col-2 pt-2 px-0 mx-0 chat-img" src="/noimage.jpg">
                            <!-- user name and message -->
                            <a class="container-fluid col-10 d-flex pl-2 p-0 m-0" href="/chats/{{ $chat->id }}">
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
        <div class="container-fluid col-12 col-md-8 message-box border-0">

            <!-- Input Box -->
            <div class="navbar navbar-expand chat-input-box bg-light col-12 col-md-8">
                <div id="chat-input" class="navbar container-fluid py-0 px-1 m-0">
                    <form method="POST" action="/messages/send" class="input-group" style="z-index: 11">
                        @csrf
                        <input name="text" class="form-control rounded-left" type="text">
                        <input name="chat_id" type="hidden" value="{{ $chats['current_chat_id'] }}">
                        <div class="input-group-append">
                            <button id="send-btn" class="btn btn-primary" type="submit">
                                <i class="far fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /Input Box -->

            <!-- Title -->
            <div class="jumbotron py-2 d-block col-12">

                <div class="container-fluid col-12 row d-flex justify-content-between px-0 px-0">

                    <div class="container-fluid col-12 row align-items-center">
                        <img class="container-fluid col-3 px-2 chat-img" src="/noimage.jpg">
                        <div class="container-fluid col-9 align-self-center d-block p-0 m-0">
                            <h5 class="container-fluid px-0 pt-2 text-truncate text-monospace font-weight-bold pull-left" style="display: block">
                                {{ $chats['sender']->name }}
                            </h5>
                        </div>
                    </div>

                </div>

            </div>
            <!-- /Title -->


            <div class="container-fluid row px-0 mx-0 col-12">
                @if(count($chats['messages']) > 0)
                    @foreach($chats['messages'] as $message)

                        @if(auth()->user()->id == $message->sender_id)
                            <!-- Sender -->
                            <div class="container-fluid col-12 px-0 d-block my-1">
                                <div class="pull-right card border-0 message-item message-sender px-0">
                                    <div class="card-body py-1 px-2 my-1">
                                        <p class="small py-0 my-0">
                                            {{ $message->time }}
                                        </p>
                                        <p class="py-0 my-0">
                                            @if($message->is_system)
                                                {!! html_entity_decode($message->text) !!}
                                            @else
                                                {{ $message->text }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- /Sender -->
                        @else
                            <!-- Receiver -->
                            <div class="container-fluid col-12 px-0 d-block my-1">
                                <div class="pull-left card border-0 message-item message-receiver px-0">
                                    <div class="card-body py-1 px-2 my-1">
                                        <p class="small py-0 my-0">
                                            {{ $message->time }}
                                        </p>
                                        <p class="py-0 my-0">
                                            @if($message->is_system)
                                                {!! html_entity_decode($message->text) !!}
                                            @else
                                                {{ $message->text }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- /Receiver -->
                        @endif
                    @endforeach
                @endif

            </div>

        </div>

    </div>



@endsection
