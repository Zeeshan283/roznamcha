@extends('backend.layouts.master')

@section('title')
Kharlachi- Roznamcha
@endsection
@section('styles')
    <!-- Start datatable css -->
    <link rel="stylesheet" href="{{ asset('assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extra-libs/datatables.net-bs4/css/responsive.dataTables.min.css') }}">
    <style>
        .dropdown {
                position: relative;
                display: inline-block;
            }

            /* Style the dropdown button itself */
            .dropdown .btn {
                background-color: #3498db;
                color: white;
                border: none;
            }

            /* Style the dropdown content (hidden by default) */
            .dropdown-content {
                display: none;
                position: absolute;
                background-color: #f9f9f9;
                min-width: 80px;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                z-index: 2;
            }

            /* Style the dropdown links */
            .dropdown-content a {
                padding: 6px 8px;
                text-decoration: none;
                display: block;
            }

            /* Change color on hover */
            .dropdown-content a:hover {
                background-color: #ddd;
            }

            /* Show the dropdown content when the button is hovered over */
            .dropdown:hover .dropdown-content {
                display: block;
        }
    </style>
@endsection

@section('admin-content')

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Kharlachi</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-muted">Dashboard</a></li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Order Kharlachi</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-5 align-self-center">
            <div class="customize-input float-end">
                @if (Auth::guard('admin')->user()->can('orders.kharlachi.edit'))
                    <a class="btn btn-rounded btn-primary" href="{{ route('admin.orders.kharlachi.create') }}">Create New Order</a>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">KharlachiOrders</h4>
                    @include('backend.layouts.partials.messages')

                    <div class="table-responsive">
                        <table id="multi_col_order"
                        class="table border table-striped table-bordered text-nowrap" style="width:100%">
                        <thead>
                            <tr role="row">
                                <th>Action</th>
                                <th>Date</th>
                                <th>Builty No</th>
                                <th>Name 1</th>
                                <th>Name 2</th>
                                <th>Nubmer Plate</th>
                                <!--<th>Landing Place</th>-->
                                <th>Port</th>
                                <th>Place of Discharge</th>
                                <th>No Plate UZB</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>weight</th>
                                <th>Name</th>
                                <th>Commission AF</th>
                                <th>Total Amount AF</th>
                                <th>US Malwala</th>
                                <th>Exchange Rate</th>
                                <th>Total Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                            @foreach ($orderData as $data)
                                <tr>
                                    <td> 
                                        <div class="dropdown">
                                            <button class="btn btn-info btn-sm" id="dropdownButton">
                                                <i class="fa fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-content" id="dropdownContent">
                                                <a href="{{ route('kharlachi.invoice', $data['id']) }}" class="fa fa-eye text-dark">View</a>
                                                <a href="{{ route('admin.orders.kharlachi.edit', $data['id']) }}" class="fa fa-edit text-dark">Edit</a>
                                                <a href="{{ route('admin.orders.kharlachi.destroy1', $data['id']) }}" class="fa fa-trash text-black" data-record-id="{{ $data['id'] }}">Delete</a>
                                            </div>
                                        </div>
                                    </td>     
                                    <td>{{$data['date'] }}</td>                                         
                                    <td>{{$data['musalsal_num']}}</td>
                                    <td>{{$data['name1']}}</td> 
                                    <td>{{$data['name2']}}</td> 
                                    <td>{{$data['vehicle_num']}}</td> 
                                    <td>{{$data['port']}}</td> 
                                    <td>{{$data['p_of_d']}}</td> 
                                    <td>{{$data['n_plate_usd']}}</td> 
                                    <td>{{$data['product']}}</td>                                         
                                    <td>{{$data['quantity']}}</td>                                         
                                    <td>{{$data['weight']}}</td>
                                    @if ($data['matchedSelf'])
                                        <td>{{ $data['name'] }}</td>
                                        <td>{{ $data['comission'] }}</td>
                                    @else
                                        <td colspan="2">No Self Records for Musalsal Num: <span style="color: red">
                                            {{ $data['musalsal_num'] }}</span></td>
                                    @endif 
                                    <td>{{ $data['total_amount_af'] }}</td>

                                    @if ($data['matchedSelf'])
                                        <td>{{ $data['us_malwala'] }}</td>
                                        <td>{{ $data['exchange_rate'] }}</td>
                                    @else
                                        <td colspan="2">No Self Records for Musalsal Num:  <span style="color: red">{{ $data['musalsal_num'] }}</span></td>
                                    @endif
                                    <td>{{ $data['total_munafa'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.delete-link').click(function(event) {
            event.preventDefault(); // Prevent the link from navigating

            if (confirm('Are you sure you want to delete this record?')) {
                // If the user confirms, submit the form for deletion
                var recordId = $(this).data('record-id');
                var form = $('#delete-form-' + recordId);
                form.submit();
            }
        });
    });
</script>
@endsection