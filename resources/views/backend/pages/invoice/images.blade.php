@extends('backend.layouts.master')

@section('title')
    Ghulam Khan - Roznamcha
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
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Khalachi</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                                    class="text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Order Khalachi</li>
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
                    <div class="card-body">
                        @include('backend.layouts.partials.messages')

                            <div class="row">
                                <div class="col-md-12">
                                    <h2>Order Details</h2>
                                </div>
                            </div>
                    
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="text-black"><strong class="bold">Order ID:</strong>  {{ $info->id}}</p>
                                    <p class="text-black"><strong class="bold">Musalsal Number:</strong>  {{ $info->musalsal_num}}</p>
                                    <p class="text-black"><strong class="bold">Driver Name:</strong>  {{ $info->name_driver}}</p>
                                    <p class="text-black"><strong class="bold">Vechile Number:</strong>  {{ $info->vehicle_num}}</p>
                                </div>
                            </div>
                    
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Images</h4>
                                </div>
                            </div>
                    
                            <div class="row">
                                {{-- Display Images in a Grid --}}
                                @foreach($images ?? [] as $image)
                                    <div class="col-md-3 mb-3">
                                        <img src="{{ asset($image) }}" class="img-fluid" alt="Image">
                                    </div>
                                @endforeach
                            </div>
                        </div>
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
