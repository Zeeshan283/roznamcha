@extends('backend.layouts.master')

@section('title')
    Personal Khata - Roznamcha
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
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Personal Khata</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                                    class="text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Personal Khata</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body card-body-cust">
                        <!-- header of invoice -->
                        <div class="row">
                            <div class="col-sm-6">
                                <h4>Personal Khata</h4>
                                <h6>Phone</h6>
                                <h6>{{ $admin->currency }} Received</h6>
                                <h6>{{ $admin->currency }} Paid</h6>
                            </div>
                            <div class="col-sm-6">
                                <h4>{{ $admin->name }}</h4>
                                <h6>{{ $admin->phone }}</h6>
                                <h6 style="color: green">{{ $amount_recv }}</h6>
                                <h6 style="color: orange">{{ $amount_paid }}</h6>


                            </div>
                        </div>
                        <hr>
                        <!-- header end here -->
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
