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


    </style>


    <div class="container container-fluid row mt-3 bg-light px-0 mx-0 col-12">

        <!-- chat List -->
        <div class="container-fluid col-12 col-md-4 chat-list">
            <div class="container-fluid px-0 mx-0 ml-3 pb-2 row col-12">


                <!-- List item -->
                <div class="container-fluid chat-item row mt-0 mb-0 col-12 pt-0 pb-2">
                    <img class="container-fluid col-3 pt-2 px-0 mx-0 chat-img" src="noimage.jpg">
                    <div class="container-fluid col-9 d-flex pl-2 p-0 m-0">
                        <div class="container-fluid p-0 m-0 d-block justify-content-start align-self-center">
                            <h5 class="container-fluid px-0 pt-2 text-truncate text-monospace font-weight-bold" style="display: block">
                                item name item name item name item name item name item nameitem name item
                            </h5>
                            <p class="p-0 m-0">You offered <b>User Name</b> S$5</p>
                            <p class="p-0 m-0">Last chatted on <b>2019/01/12</b></p>
                            <p class="p-0 m-0">Accepted</p>
                        </div>
                    </div>
                </div>
                <div class="container-fluid mx-1"><hr class="py-0 mb-0 mt-0"></div>
                <!-- /List item -->

                <!-- List item -->
                <div class="container-fluid chat-item row mt-0 mb-0 col-12 pt-0 pb-2">
                    <img class="container-fluid col-3 pt-2 px-0 mx-0 chat-img" src="noimage.jpg">
                    <div class="container-fluid col-9 d-flex pl-2 p-0 m-0">
                        <div class="container-fluid p-0 m-0 d-block justify-content-start align-self-center">
                            <h5 class="container-fluid px-0 pt-2 text-truncate text-monospace font-weight-bold" style="display: block">
                                item name item name item name item name item name item nameitem name item
                            </h5>
                            <p class="p-0 m-0"><b>User Name</b> offered you S$10</p>
                            <p class="p-0 m-0">Last chatted on <b>2019/01/12</b></p>
                            <p class="p-0 m-0">Pending</p>
                        </div>
                    </div>
                </div>
                <div class="container-fluid mx-1"><hr class="py-0 mb-0 mt-0"></div>
                <!-- /List item -->

            </div>

        </div>


        <!-- Message Box -->
        <div class="container-fluid d-none d-md-block col-8 message-box border-0">

        </div>



    </div>



@endsection
