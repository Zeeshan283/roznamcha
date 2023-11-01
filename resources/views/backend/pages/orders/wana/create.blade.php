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
                                        <label for="product_owner_id">مال ولا نام:</label>
                                        <select class="form-control  nice-select  form-select" name="malwala"
                                            id="product_owner_id">
                                            <option value="">Select</option>
                                            @foreach ($admins as $admin)
                                                <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <label for="serial_no">مسلسل نمبر:</label>
                                        <input class="form-control" autocomplete="off" name="musalsal_num" type="text"
                                            id="serial_no">
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <label for="date">تاریخ:</label>
                                        <input class="form-control" name="date" type="date" id="date">
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <label for="city">ولایت:</label>
                                        <input class="form-control" autocomplete="off" name="city" type="text"
                                            id="city">
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <label for="product">جنس:</label>
                                        <input class="form-control" autocomplete="off" name="product" type="text"
                                            id="product">
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <label for="vehical_no">گاڑی نمبر:</label>
                                        <input class="form-control" autocomplete="off" name="vehicle_num" type="text"
                                            id="vehical_no">
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <label for="qty">تعداد:</label>
                                        <input class="form-control" autocomplete="off" name="quantity" type="text"
                                            id="qty">
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <label for="torkham_details">تفصیل:</label>
                                        <input class="form-control" id="torkham_details" autocomplete="off"
                                            name="detail" type="text">
                                    </div>
                                    <div class="col-sm-4 mb-2 ">
                                        <label for="rent">کرایہ:</label>
                                        <input class="form-control product_rent " id="kiraya" autocomplete="off"
                                            name="kiraya" type="text">
                                    </div>
                                    <div class="col-sm-4 mb-2 ">
                                        <label for="fixed_rent">مطابق کرایہ:</label>
                                        <input class="form-control product_rent" id="fixed_rent" autocomplete="off"
                                            name="mutabik_kiraya" type="text">
                                    </div>
                                    <div class="col-sm-4 mb-2 ">
                                        <label for="extra_rent">اضافی کرایہ:</label>
                                        <input class="form-control " id="extra_rent"  name="extra_kiraya"
                                            type="text">
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <label for="ponch">پونچ:</label>
                                        <input class="form-control torkham_form" id="ponch" autocomplete="off"
                                            name="ponch" type="text">
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <label for="total_pk">ٹوٹل:</label>
                                        <input class="form-control" id="total"                                              name="total" type="text">
                                    </div>
                                    <div class="col-sm-4 mb-2 not_torkham_field">
                                        <label for="total Afghan"> توتل افعانی:</label>
                                        <input class="form-control" id="afghan_total" autocomplete="off"
                                            name="total_af" type="text">
                                    </div>
                                    <div class="col-sm-4 mb-2 not_torkham_field">
                                        <label for="total Afghan"> کمیشن :</label>
                                        <input class="form-control" id="afghan_total" autocomplete="off"
                                            name="comission" type="text">
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <label for="balty_pak">Balty</label>
                                        <input type="file" name="bilty" id="balty_pak" multiple="">
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
                                    <ul class="nav nav-pills bg-nav-pills nav-justified mb-3" style="width: 40%;">
                                        <li class="nav-item">
                                            <a href="#self" data-bs-toggle="tab" aria-expanded="true"
                                                class="nav-link rounded-0 active">
                                                <i class="mdi mdi-home-variant d-lg-none d-block me-1"></i>
                                                <span class="d-none d-lg-block">Self</span>
                                            </a>
                                        </li>
                                        {{-- <li class="nav-item">
                                            <a href="#other" data-bs-toggle="tab" aria-expanded="flase" class="nav-link rounded-0">
                                                <i class="mdi mdi-account-circle d-lg-none d-block me-1"></i>
                                                <span class="d-none d-lg-block">Other</span>
                                            </a>
                                        </li> --}}
                                    </ul>
            
                                    <div class="tab-content">
                                        <div class="tab-pane show active" id="self">
                                            <form class="table-responsive" action="{{ route('admin.order.wselfdata') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-sm-6 mb-2">
                                                        <label for="self_order_id">مسلسل نمبر:</label>
                                                        <select class="form-control  nice-select  form-select" name="musalsal_num" id="product_owner_id">
                                                        <option value="">Select</option>
                                                            @foreach ($wana as $admin)
                                                                <option value="{{ $admin->id }}">{{ $admin->musalsal_num }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-6 mb-2">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="hidden" name="type" value="self" id="type">
                                                        <div class="col-sm-12 mb-2">
                                                            <label for="staff_id">نام پاکستان</label>
                                                            <select class="form-control  nice-select  form-select" name="name1"
                                                                id="name_pk_id">
                                                                <option value="">Select</option>
                                                                @foreach ($admins as $admin)
                                                                    <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-12 mb-2">
                                                            <label for="date">تاریخ:</label>
                                                            <input class="form-control" name="date" type="date" id="date">
                                                        </div>
                                                        <div class="col-sm-12 mb-2">
                                                            <label for="punjab_rent"> خرچہ:</label>
                                                            <input class="form-control pak_calculation" id="punjab_rent"
                                                                autocomplete="off" name="kharcha" type="text">
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="col-sm-12 mb-2">
                                                            <label for="staff_id">نام افعانی:</label>
                                                            <select class="form-control  nice-select  form-select" name="name2"
                                                                id="name_af_id">
                                                                <option value="">Select</option>
                                                                @foreach ($admins as $admin)
                                                                    <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
            
                                                        <div class="col-sm-12 mb-2">
                                                            <label for="Gumrak">گاڑی نمبر :</label>
                                                            <input class="form-control af_calculation"
                                                                id="gumrak_aff" autocomplete="off" name="vehicle_num" type="text">
                                                        </div>
                                                        <div class="col-sm-12 mb-2">
                                                            <label for="Gumrak">تفصیل:</label>
                                                            <input
                                                                class="form-control
                                                        af_calculation"
                                                                id="gumrak_aff" autocomplete="off" name="details" type="text">
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                    <!-- button should be here -->
                                                    <div class="col-sm-4 mt-4">
                                                        <a aria-controls="collapseExample" aria-expanded="false"
                                                            class="btn btn-success" data-bs-toggle="collapse" href="#af_form"
                                                            role="button">
                                                            +
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="row mt-2 collapse show" id="af_form" style="">
                                                    <div class="col-sm-6">
                                                        <div class="col-sm-12 mb-2">
                                                            <label for="product_owner_id">مال ولا نام:</label>
                                                            <select class="form-control  nice-select  form-select" name="malwala"
                                                                id="product_owner_id">
                                                                <option value="">Select</option>
                                                                @foreach ($admins as $admin)
                                                                    <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-12 mb-2">
                                                            <label for="self_order_id">مسلسل نمبر:</label>
                                                            <select class="form-control  nice-select  form-select" name="sde_musalsal_num" id="product_owner_id">
                                                            <option value="">Select</option>
                                                                @foreach ($wana as $admin)
                                                                    <option value="{{ $admin->id }}">{{ $admin->musalsal_num }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
            
                                                        <div class="col-sm-12 mb-2">
                                                            <label for="custom">کسټم:</label>
                                                            <input
                                                                class="form-control
                                                            self_pk_calculation"
                                                                id="self_pk_custom" autocomplete="off" name="sde_ecchange_rate"
                                                                type="text">
                                                        </div>
                                                        
                                                       
                                                    </div>
                                                    
                                                    <div class="col-sm-6">
            
                                                        <div class="col-sm-12 mb-2">
                                                            <label for="Total">ٹوٹل افعانی:</label>
                                                            <input class="form-control" id="af_self_total" autocomplete="off"
                                                                name="sde_total_af" type="text">
                                                        </div>
                                                        <div class="col-sm-12 mb-2">
                                                            <label for="Rent">munafa :</label>
                                                            <input class="form-control self_pk_calculation" 
                                                                id="punjab_self_rent" autocomplete="off" name="sde_munafa"
                                                                type="text">
                                                        </div>
            
                                                    </div>
                                                        
            
                                                </div>
                                                <button type="submit" class="btn btn-rounded btn-primary">Save</button>
                                            </form>
                                        </div>
                                    </div>
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
