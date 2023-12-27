@extends('backend.layouts.master')

@section('title')
    Personal Khata - Roznamcha
@endsection
@section('styles')
    <!-- Start datatable css -->
    <link rel="stylesheet" href="{{ asset('assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extra-libs/datatables.net-bs4/css/responsive.dataTables.min.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
                <div class="col-md-12">
                    
                    <div class="card col-md-12" style="margin-right: 10px;">
                        <div class="card-header bg-secondary text-white">
                            Personal Details
                        </div>
                        <div class="card-body card-body-cust">
                            <!-- header of invoice -->
                            <div class="row pt-3">
                                <div class="col-sm-6">
                                    <h3>Personal Khata</h3>
                                    <h4>Phone</h4>
                                    <h4>Email</h4>
                                    <h4>{{ $admin->country  }} Received</h4>
                                    <h4>{{ $admin->country }} Paid</h4>
                                </div>
                                <div class="col-sm-6">
                                    <h3>{{ $admin->name }}</h3>
                                    <h4>{{ $admin->phone }}</h4>
                                    <h4>{{ $admin->email }}</h4>
                                    <h4 style="color: green">{{ $amount_recv }}</h4>
                                    <h4 style="color: orange">{{ $amount_paid }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="card col-md-12">
                        <div class="card-header bg-secondary text-white d-flex justify-content-between">
                            <div>
                                Roznamcha
                            </div> 
                            <div>
                                <input class="form-control text-white" id="roznamchaSearch" type="text" placeholder="Search..">
                            </div>
                        </div>
                        <div class="card-body">
                            <div style="{{ count($roznamchas ?? []) > 5 ? 'max-height: 300px; overflow-y: auto;' : '' }}">
                                <table class="table">
                                    <thead>
                                      <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Country</th>
                                        <th scope="col">Musalsal Num</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Khata Banam</th>
                                        <th scope="col">Details</th>
                                        <th scope="col">State</th>
                                        <th scope="col">Amount</th>
                                      </tr>
                                    </thead>
                                    <tbody id="roznamcha">
                                        @foreach ($roznamchas ?? [] as $key => $item )
                                        <tr>
                                            <th scope="row">{{ $key+1 ?? null}}</th>
                                            <td>{{ $item->country ?? null }}</td>
                                            <td>{{ $item->serial_num ?? null }}</td>
                                            <td>{{ $item->date_pk ?? null }} {{ $item->date_af ?? null }} {{ $item->date_usa ?? null}}</td>
                                            <td>{{ $item->admin->name ?? null}}</td>
                                            <td>{{ $item->detail ?? null}}</td>
                                            <td>{{ $item->state ?? null}}</td>
                                            <td>{{ $item->amount_pk ?? null}} {{ $item->amount_af ?? null}} {{ $item->amount_usa ?? null}}</td>
                                          </tr>
                                        @endforeach        
                                    </tbody>
                                  </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex">
                    <div class="card col-md-12">
                        <div class="card-header bg-secondary text-white d-flex justify-content-between">
                            <div>
                                Orders
                            </div>
                            <div>
                                <input class="form-control text-white" id="orderSearch" type="text" placeholder="Search..">

                            </div>
                        </div>
                        <div class="card-body row">
                            <form action="{{ route('admin.khata.personal.showOrders')}}" method="get" class="d-flex">
                                <div class="form-group col-md-8 flex-grow-1 mr-2">
                                    <label for="city" class="mr-2">Select City:</label>
                                    <select class="form-control" id="city" name="city">
                                        <option selected disabled>{{$cityname}}</option>
                                        <option value="1">Ghulamkhan</option>
                                        <option value="2">Kharlachi</option>
                                        <option value="3">Thorkham</option>
                                        <option value="4">Wana</option>
                                    </select>
                                </div>
                                <input type="hidden" name="id" value="{{$admin->id}}">
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary">Show Orders</button>
                                </div>
                            </form>
                            
                            <div style="{{ count($orders ?? []) > 5 ? 'max-height: 300px; overflow-y: auto;' : '' }}">
                                <table class="table">
                                    <thead>
                                      <tr>
                                        <th scope="col">Order ID</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Musalsal Number</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Kariya</th> 
                                        <th scope="col">CRM</th>
                                      </tr>
                                    </thead>
                                    <tbody id="orderDetails">

                                        @foreach ($orders ?? [] as $key => $item )
                                        <tr>
                                            <th scope="row">{{ $key+1 }}</th>
                                            <td>{{ $item->date}}</td>
                                            <td>{{ $item->musalsal_num}}</td>
                                            <td>{{ $item->product}}</td>
                                            <td>{{ $item->quantity}}</td>
                                            <td>{{ $item->kariya}}</td>
                                            <td>{{ $item->crm}}</td>
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
        $(document).ready(function(){
          $("#roznamchaSearch").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#roznamcha tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
          $("#orderSearch").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#orderDetails tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
        });
    </script>


@endsection
