@extends('backend.layouts.master')

@section('title')
    Update New Order Thorkham - Roznamcha
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
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Update Order Thorkham</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                                    class="text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Update Order</li>
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
                        <h4 class="header-title">Update Order Thorkham</h4>
                        @include('backend.layouts.partials.messages')

                        <form action="{{ route('admin.orders.thorkham.update', ['thorkham' => $record->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <input type="hidden" name="location_id" id="loc_id" value="2" required="">
                                <div class=" row append_data" id="order_form">
                                    <div class="col-sm-4 mb-2">
                                        <label for="serial_no"> Date:</label>
                                        <input class="form-control" autocomplete="off" name="date" type="date" value="{{$record->date}}"
                                            id="serial_no">
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <label for="serial_no">مسلسل نمبر:</label>
                                        <input class="form-control" autocomplete="off" name="musalsal_num" type="text" value="{{$record->musalsal_num}}"
                                            id="serial_no">
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <label for="product_owner_id">Name 1:</label>
                                        <select class="form-control  nice-select  form-select" name="name1"
                                            id="product_owner_id">
                                            <option value="{{$record->name1}}">{{$record->admin->name}}</option>
                                            @foreach ($admins as $admin)
                                                <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <label for="product_owner_id">Name 2:</label>
                                        <select class="form-control  nice-select  form-select" name="name2"
                                            id="product_owner_id">
                                            <option value="{{$record->name2}}">{{$record->admin1->name}}</option>
                                            @foreach ($admins as $admin)
                                                <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    
                                    <div class="col-sm-4 mb-2">
                                        <label for="city">Number Plate:</label>
                                        <input class="form-control" autocomplete="off" name="n_plate" type="text" value="{{$record->vehicle_num}}"
                                            id="city">
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <label for="city">PORT:</label>
                                        <input class="form-control" autocomplete="off" name="port" type="text" value="{{$record->port}}"
                                            id="city">
                                    </div>
                                    
                                    <div class="col-sm-4 mb-2">
                                        <label for="city">Place of Dischange:</label>
                                        <input class="form-control" autocomplete="off" name="p_of_d" type="text" value="{{$record->p_of_d}}"
                                            id="city">
                                    </div> 
                                    
                                    <div class="col-sm-4 mb-2">
                                        <label for="city">Number Plate USD:</label>
                                        <input class="form-control" autocomplete="off" name="n_plate_usd" type="text" value="{{$record->n_plate_usd}}"
                                            id="city">
                                    </div>
                                    
                                    <div class="col-sm-4 mb-2">
                                        <label for="city">Product:</label> 
                                        <input class="form-control" autocomplete="off" name="product" type="text" value="{{$record->product}}"
                                            id="city">
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <label for="city">Quantity:</label>
                                        <input class="form-control" autocomplete="off" name="quantity" type="text" value="{{$record->quantity}}"
                                            id="city">
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <label for="city">weight:</label>
                                        <input class="form-control" autocomplete="off" name="weight" type="text" value="{{$record->weight}}"
                                            id="city">
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <label for="city">Kariya/CRM:</label>
                                        <input class="form-control" autocomplete="off" name="kariya" type="text" value="{{$record->kariya}}"
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
                        @include('backend.layouts.partials.messages')
                
                        <div class="tab-content">
                            <div class="tab-pane show active" id="self">
                                @if($self_expense)
                                    <form class="table-responsive" action="{{ route('admin.order.updatetselfexpense', ['id' => $self_expense->id]) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                            <div class="row mt-2 collapse show"  >
                                            <div class="col-sm-6">
                                                <div class="col-sm-12 mb-2">
                                                    <label for="self_order_id">مسلسل نمبر:</label>
                                                    <select class="form-control  nice-select  form-select" name="musalsal_num" id="product_owner_id">
                                                        <option value="{{$self_expense->musalsal_num}}">{{$record->musalsal_num}}</option>
                                                        @foreach ($thorkham as $admin)
                                                            <option value="{{ $admin->id }}">{{ $admin->musalsal_num }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                
                                                
                                                <div class="col-sm-12 mb-2">
                                                    <label for="custom">Comission:</label>
                                                    <input
                                                        class="form-control
                                                    self_pk_calculation"
                                                        id="self_pk_custom" autocomplete="off" name="comission" value="{{$self_expense->comission}}"
                                                        type="text">
                                                </div>
                                                
                                            
                                            </div>
                                            
                                            <div class="col-sm-6">

                                                <div class="col-sm-12 mb-2">
                                                    <label for="product_owner_id">Name:</label>
                                                    <select class="form-control  nice-select  form-select" name="name"
                                                        id="product_owner_id">
                                                        <option value="{{$self_expense->name}}">{{$self_expense->admin->name}}</option>
                                                        @foreach ($admins as $admin)
                                                            <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>
                                                

                                        </div>
                                        <button type="submit" class="btn btn-rounded btn-primary">Save</button>
                                    </form>
                                @else
                                    <form class="table-responsive" action="{{ route('admin.order.tselfexpense') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        
                                            <div class="row mt-2 collapse show"  >
                                            <div class="col-sm-6">
                                                <div class="col-sm-12 mb-2">
                                                    <label for="self_order_id">مسلسل نمبر:</label>
                                                    <select class="form-control  nice-select  form-select" name="musalsal_num" id="product_owner_id">
                                                    <option value="">Select</option>
                                                        @foreach ($thorkham as $admin)
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
                                        <button type="submit" class="btn btn-rounded btn-primary">Save</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
            
            
              {{-- new form  --}}
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @include('backend.layouts.partials.messages')

                        <div class="tab-content">
                            <div class="tab-pane show active" id="self">
                                @if($roznamcha)
                                    <form class="table-responsive" action="{{ route('admin.order.updateroznamchast', ['id' => $roznamcha->id]) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row mt-2 collapse show">
                                            <div class="col-sm-6">
                                                <div class="col-sm-12 mb-2">
                                                    <label for="self_order_id">مسلسل نمبر:</label>
                                                    <select class="form-control  nice-select  form-select" name="musalsal_num"
                                                        id="product_owner_id">
                                                        <option value="{{$roznamcha->serial_num}}">{{$roznamcha->serial_num}}</option>
                                                        @foreach ($thorkham as $admin)
                                                            <option value="{{ $admin->musalsal_num }}">{{ $admin->musalsal_num }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-sm-12 mb-2">
                                                    <label for="serial_no"> Date:</label>
                                                    <input class="form-control" autocomplete="off" name="date_af" type="date" value="{{$roznamcha->date_af}}"
                                                        id="serial_no">
                                                </div>
                                                <div class="col-sm-12 mb-2">
                                                    <label for="serial_no"> Amount Af:</label>
                                                    <input class="form-control" autocomplete="off" name="amount_af" type="amount_af" value="{{$roznamcha->amount_af}}"
                                                        id="serial_no">
                                                </div>

                                                <input type="text" name="country" value="Afghanistan" hidden>
                                                <input type="text" name="state" id="" value="بنام" hidden>


                                            </div>

                                            <div class="col-sm-6">

                                                <div class="col-sm-12 mb-2">
                                                    <label for="product_owner_id">Name1:</label>
                                                    <select class="form-control  nice-select  form-select" name="name"
                                                        id="product_owner_id">
                                                        <option value="{{$roznamcha->khata_banam}}">{{$roznamcha->admin->name}}</option>
                                                        @foreach ($admins as $admin)
                                                            <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <input type="text" name="country" value="Afghanistan" hidden>
                                                <div class="col-sm-12">
                                                    <div class="col-sm-12 mb-2">
                                                        <label for="custom">Details:</label>
                                                        <input class="form-control" id="af_self_total" autocomplete="off" value="{{$roznamcha->detail}}"
                                                            name="detail" type="text">
                                                    </div>    
                                                </div>

                                            </div>


                                        </div>
                                        <button type="submit" class="btn btn-rounded btn-primary">Save</button>
                                    </form>
                                @else
                                    <form class="table-responsive" action="{{ route('admin.order.roznamchast') }}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <div class="row mt-2 collapse show">
                                            <div class="col-sm-6">
                                                <div class="col-sm-12 mb-2">
                                                    <label for="self_order_id">مسلسل نمبر:</label>
                                                    <select class="form-control  nice-select  form-select" name="musalsal_num"
                                                        id="product_owner_id">
                                                        <option value="">Select</option>
                                                        @foreach ($thorkham as $admin)
                                                            <option value="{{ $admin->musalsal_num }}">{{ $admin->musalsal_num }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-12 mb-2">
                                                    <label for="serial_no"> Amount Af:</label>
                                                    <input class="form-control" autocomplete="off" name="amount_af" type="amount_af"
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
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @include('backend.layouts.partials.messages')
                
                        <div class="tab-content">
                            <div class="tab-pane show active" id="self">
                                @if($self)
                                    <form class="table-responsive" action="{{ route('admin.order.updatetself', ['id' => $self->id]) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row mt-2 collapse show" id="af_form" style="">
                                            <div class="col-sm-6">
                                                <div class="col-sm-12 mb-2">
                                                    <label for="self_order_id">مسلسل نمبر:</label>
                                                    <select class="form-control  nice-select  form-select" name="musalsal_num" id="product_owner_id">
                                                    <option value="{{$self->musalsal_num}}">{{$record->musalsal_num}}</option>
                                                        @foreach ($thorkham as $admin)
                                                            <option value="{{ $admin->id }}">{{ $admin->musalsal_num }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="col-sm-12 mb-2">
                                                    <label for="custom">US Malwala:</label>
                                                    <input class="form-control" id="af_self_total" autocomplete="off" value="{{$self->us_malwala}}"
                                                        name="us_malwala" type="text">
                                                </div>    
                                            </div>
                                            <div class="col-sm-6 mb-2">
                                                <label for="Total"> Exchange Rate:</label>
                                                <input class="form-control" id="af_self_total" autocomplete="off" value="{{$self->exchange_rate}}"
                                                    name="exchange_rate" type="text">
                                            </div>  
                                            

                                            
                                        
                                            
                                                

                                        </div>
                                        <button type="submit" class="btn btn-rounded btn-primary">Save</button>
                                    </form>
                                @else
                                    <form class="table-responsive" action="{{ route('admin.order.roznamchast') }}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <div class="row mt-2 collapse show">
                                            <div class="col-sm-6">
                                                <div class="col-sm-12 mb-2">
                                                    <label for="self_order_id">مسلسل نمبر:</label>
                                                    <select class="form-control  nice-select  form-select" name="musalsal_num"
                                                        id="product_owner_id">
                                                        <option value="">Select</option>
                                                        @foreach ($thorkham as $admin)
                                                            <option value="{{ $admin->musalsal_num }}">{{ $admin->musalsal_num }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-12 mb-2">
                                                    <label for="serial_no"> Amount Af:</label>
                                                    <input class="form-control" autocomplete="off" name="amount_af" type="amount_af"
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
                                @endif
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
