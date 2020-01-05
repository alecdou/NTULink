<!-- Add a new item -->

@extends('layouts.app')
@section('content')

    <style>
        .accept-btn {
            color: white !important;
            background: lightblue !important;
            border: none !important;
        }

        .decline-btn {
            color: white !important;
            background: rgba(240, 128, 128, 0.6) !important;
            border: none !important;
        }

        .chat-btn,
        .review-btn {
            color: black !important;
            background: white !important;
            border-width: 1px !important;
            border: black;
            border-style: solid;
        }


    </style>

    <div class="container my-3">
        <div class="jumbotron">
            <h3>Offer Details</h3>
            <h5 class="text-muted"> <!-- Offer Status --> Pending</h5>
        </div>


        <div class="container-fluid row px-0 mx-0">
            <div class="table-responsive col-12 col-md-9 col-lg-10">
                <table class="table" style="width: 1200px;">
                    <thead>
                    <tr>
                        <th style="width: 100px;">Item</th>
                        <th style="width: 200px;">Item Name</th>
                        <th style="width: 100px;">Condition</th>
                        <th style="width: 100px;">Sale Price</th>
                        <th style="width: 200px;">Buyer</th>
                        <th style="width: 100px;">Offer</th>
                        <th style="width: 200px;">Date Offered</th>
                        <th style="width: 100px;">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th style="width: 100px;"><img src="/noimage.jpg" style="width: 100px; object-fit: contain"></th>
                        <td style="width: 200px;"><a href="#">Item name Item name Item name Item name Item name Item name</a></td>
                        <td style="width: 100px;">New</td>
                        <td style="width: 100px;">S$10000</td>
                        <td style="width: 200px;">Seller Name Seller Name</td>
                        <td style="width: 100px;"> S$10000</td>
                        <td style="width: 200px;">2019-10-1 12:59:00</td>
                        <td style="width: 100px;">Pending</td>
                    </tr>
                    </tbody>
                </table>
            </div>


            <div class="d-block col-12 col-md-3 col-lg-2 px-0 pl-md-5 pr-md-1">
                <div class="btn accept-btn text-monospace font-weight-bold m-1 mt-0 btn-block">Accept</div>
                <div class="btn decline-btn text-monospace font-weight-bold m-1 btn-block">Decline</div>
                <div class="btn chat-btn text-monospace font-weight-bold m-1 btn-block">Chat</div>
                <div class="btn review-btn text-monospace font-weight-bold m-1 btn-block">Comment</div>
            </div>

        </div>






    </div>

@endsection
