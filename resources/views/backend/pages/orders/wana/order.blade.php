@extends('backend.layouts.master')

@section('title')
Wana Khan - Roznamcha
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
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
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
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Wana</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                                    class="text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Order Wana</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-5 align-self-center">
                <div class="customize-input float-end">
                    @if (Auth::guard('admin')->user()->can('orders.wana.edit'))
                        <a class="btn btn-rounded btn-primary" href="{{ route('admin.orders.wana.create') }}">Create
                            New Order</a>
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


                        <div class="row">
                            <h3>Order Detail</h3>
                            <div class="col-sm-6">
                                <p></p>
                                <h6># No :</h6>
                                <p></p>
                                <p></p>
                                <h6>Product</h6>
                                <p></p>
                                <p></p>
                                <h6>Vehicle No</h6>
                                <p></p>
                                <p></p>
                                <h6>Quantity</h6>
                                <p></p>
                                <p></p>
                                <h6>City</h6>
                                <p></p>
                            </div>
                            <div class="col-sm-6">
                                <p>{{ $record->id }}</p>
                                <p>{{ $record->product }}</p>
                                <p>{{ $record->vehicle_num }}</p>
                                <p>{{ $record->quantity }}</p>
                                <p>{{ $record->city }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row mb-3">
                            <h3 class="text-center">Balty Pk</h3>
                            <div class="col-6 col-md-3" onclick="show_model(737)">
                                <img alt="Responsive image" class="img-thumbnail" src="/{{ $record->bilty }}">
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
