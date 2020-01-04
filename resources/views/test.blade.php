@extends('layouts.app')

@section('content')



    <style>


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

    <h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1>
    <h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1>
    <h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1>
    <h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1>
    <h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1><h1>HE</h1>

    <!-- Input Box -->


    <div class="container-fluid col-0 col-md-4 message-box border-0">
    </div>
    <div class="container-fluid col-12 col-md-8 message-box border-0">
    <div class="navbar navbar-expand chat-input-box bg-light col-12 col-md-8">
        <div class="navbar container-fluid py-0 px-1 m-0">
            <form method="POST" action="/messages/send" class="input-group" style="z-index: 11">
                @csrf
                <input name="text" class="form-control rounded-left" type="text">
                <input name="chat_id" type="hidden" value="1">
                <div class="input-group-append">
                    <button id="send-btn" class="btn btn-primary" type="submit">
                        <i class="far fa-paper-plane"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    </div>
    <!-- /Input Box -->
    @endsection
