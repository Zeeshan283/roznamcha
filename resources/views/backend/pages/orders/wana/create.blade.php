@extends('backend.layouts.master')

@section('title')
    Create New Order Wana - Roznamcha
@endsection

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .form-check-label {
            text-transform: capitalize;
        }   
    </style>
@endsection

@section('admin-content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Create Order Wana</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                                    class="text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Create Order</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- data table start -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Create Order Wana</h4>
                        @include('backend.layouts.partials.messages')

                        <form action="{{ route('admin.orders.wana.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="location_id" id="loc_id" value="2" required="">
                                <div class=" row append_data" id="order_form">
                                    <div class="col-sm-4 mb-2">
                                        <label for="serial_no"> Date:</label>
                                        <input class="form-control" autocomplete="off" name="date" type="date"
                                            id="serial_no">
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <label for="serial_no">مسلسل نمبر:</label>
                                        <input class="form-control" autocomplete="off" name="musalsal_num" type="text"
                                            id="serial_no">
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <label for="product_owner_id">Name 1:</label>
                                        <select class="form-control  nice-select  form-select" name="name1"
                                            id="product_owner_id">
                                            <option value="">Select</option>
                                            @foreach ($admins as $admin)
                                                <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <label for="product_owner_id">Name 2:</label>
                                        <select class="form-control  nice-select  form-select" name="name2"
                                            id="product_owner_id">
                                            <option value="">Select</option>
                                            @foreach ($admins as $admin)
                                                <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    
                                    <div class="col-sm-4 mb-2">
                                        <label for="city">BULIT NO:</label>
                                        <input class="form-control" autocomplete="off" name="bulit_no" type="text"
                                            id="city">
                                    </div>

                                    <div class="col-sm-4 mb-2">
                                        <label for="city">Name Driver:</label>
                                        <input class="form-control" autocomplete="off" name="name_driver" type="text"
                                            id="city">
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <label for="city">Driver Mobile no:</label>
                                        <input class="form-control" autocomplete="off" name="driver_num" type="text"
                                            id="city">
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <label for="city">Number Plate:</label>
                                        <input class="form-control" autocomplete="off" name="vehicle_num" type="text"
                                            id="city">
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <label for="city">Loading place:</label>
                                        <input class="form-control" autocomplete="off" name="loading_place" type="text"
                                            id="city">
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <label for="city">PORT:</label>
                                        <input class="form-control" autocomplete="off" name="port" type="text"
                                            id="city">
                                    </div>
                                    
                                    <div class="col-sm-4 mb-2">
                                        <label for="city">Place of Dischange:</label>
                                        <input class="form-control" autocomplete="off" name="p_of_d" type="text"
                                            id="city">
                                    </div> 
                                    
                                    <div class="col-sm-4 mb-2">
                                        <label for="city">Number Plate UZB:</label>
                                        <input class="form-control" autocomplete="off" name="n_plate_usd" type="text"
                                            id="city">
                                    </div>
                                    
                                    <div class="col-sm-4 mb-2">
                                        <label for="city">Product:</label>
                                        <input class="form-control" autocomplete="off" name="product" type="text"
                                            id="city">
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <label for="city">Quantity:</label>
                                        <input class="form-control" autocomplete="off" name="quantity" type="text"
                                            id="city">
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <label for="city">weight:</label>
                                        <input class="form-control" autocomplete="off" name="weight" type="text"
                                            id="city">
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <label for="city">Kariya:</label>
                                        <input class="form-control" autocomplete="off" name="kariya" type="text"
                                            id="city">
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <label for="city">CRM:</label>
                                        <input class="form-control" autocomplete="off" name="crm" type="text"
                                            id="city">
                                    </div>

                                </div>
                            </div>
                            <button type="submit" class="btn btn-rounded btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- data table end -->

            <!-- data table start -->
    


            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Commission</h4>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="self">
                                <form class="table-responsive" action="{{ route('admin.order.wselfexpense') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    
                                        <div class="row mt-2 collapse show"  >
                                        <div class="col-sm-6">
                                            <div class="col-sm-12 mb-2">
                                                <label for="self_order_id">مسلسل نمبر:</label>
                                                <select class="form-control  nice-select  form-select" name="musalsal_num" id="product_owner_id">
                                                <option value="">Select</option>
                                                    @foreach ($wana as $admin)
                                                        <option value="{{ $admin->id }}">{{ $admin->musalsal_num }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            
                                            
                                            <div class="col-sm-12 mb-2">
                                                <label for="custom">Comission:</label>
                                                <input
                                                    class="form-control
                                                self_pk_calculation"
                                                    id="self_pk_custom" autocomplete="off" name="comission"
                                                    type="text">
                                            </div>
                                            
                                           
                                        </div>
                                        
                                        <div class="col-sm-6">

                                            <div class="col-sm-12 mb-2">
                                                <label for="product_owner_id">Name:</label>
                                                <select class="form-control  nice-select  form-select" name="name"
                                                    id="product_owner_id">
                                                    <option value="">Select</option>
                                                    @foreach ($admins as $admin)
                                                        <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                            

                                    </div>
                                    {{-- <button type="submit" class="btn btn-rounded btn-primary">Save</button> --}}
                                {{-- </form> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
            
              {{-- new form  --}}
              <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Roznamcha</h4>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="self">
                                {{-- <form class="table-responsive" action="{{ route('admin.order.roznamchasw') }}" method="POST" enctype="multipart/form-data"> --}}
                                    {{-- @csrf --}}

                                    <div class="row mt-2 collapse show">
                                        <div class="col-sm-6">
                                            {{-- <div class="col-sm-12 mb-2">
                                                <label for="self_order_id">مسلسل نمبر:</label>
                                                <select class="form-control  nice-select  form-select" name="musalsal_num"
                                                    id="product_owner_id">
                                                    <option value="">Select</option>
                                                    @foreach ($wana as $admin)
                                                        <option value="{{ $admin->musalsal_num }}">{{ $admin->musalsal_num }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div> --}}
                                            <div class="col-sm-12 mb-2">
                                                <label for="serial_no"> Amount Af:</label>
                                                <input class="form-control" autocomplete="off" name="amount_af" type="amount_af"
                                                    id="serial_no">
                                            </div>

                                            <div class="col-sm-12 mb-2">
                                                <label for="serial_no">Images:</label>
                                                <input class="form-control" autocomplete="off" name="img" type="file"
                                                    id="serial_no">
                                            </div>

                                        </div>

                                        <div class="col-sm-6">

                                            <div class="col-sm-12">
                                                <div class="col-sm-12 mb-2">
                                                    <label for="custom">Details:</label>
                                                    <input class="form-control" id="af_self_total" autocomplete="off"
                                                        name="detail" type="text">
                                                </div>    
                                            </div>

                                        </div>

                                        <input type="text" name="state" id="" value="بنام" hidden>
                                        <input type="text" name="country" value="Afghanistan" hidden>


                                    </div>
                                    <button type="submit" class="btn btn-rounded btn-primary">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Malwala</h4>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="self">
                                <form class="table-responsive" action="{{ route('admin.order.wself') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    
                                    <div class="row mt-2 collapse show" id="af_form" style="">
                                        <div class="col-sm-6">
                                            <div class="col-sm-12 mb-2">
                                                <label for="self_order_id">مسلسل نمبر:</label>
                                                <select class="form-control  nice-select  form-select" name="musalsal_num" id="product_owner_id">
                                                <option value="">Select</option>
                                                    @foreach ($wana as $admin)
                                                        <option value="{{ $admin->id }}">{{ $admin->musalsal_num }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="col-sm-12 mb-2">
                                                <label for="custom">US Malwala:</label>
                                                <input class="form-control" id="af_self_total" autocomplete="off"
                                                    name="us_malwala" type="text">
                                            </div>    
                                        </div>
                                        <div class="col-sm-6 mb-2">
                                            <label for="Total"> Exchange Rate:</label>
                                            <input class="form-control" id="af_self_total" autocomplete="off"
                                                name="exchange_rate" type="text">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-rounded btn-primary">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- data table end -->

        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        })
    </script>
@endsection
