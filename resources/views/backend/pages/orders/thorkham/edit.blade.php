@extends('backend.layouts.master')

@section('title')
    Edit Order Thorkham - Roznamcha
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
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Edit Order Thorkham</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                                    class="text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Edit Orer</li>
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
                <div class=" card">
                    <div class="card-body">
                        <form action="{{route ('admin.orders.thorkham.update', $record->id)}} " method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            @include('backend.layouts.partials.messages')

                            <div class=" row">
                                <div class="col-sm-4 mb-2">
                                    <label for="product_owner_id">مال ولا نام:</label>
                                    <select class="form-control  nice-select  form-select" name="malwala"
                                        id="product_owner_id">
                                        <option value="{{ $record->malwala}}">{{$record->malwala}}</option>
                                        <option value="150" title="">.</option>
                                        <option value="152" title="">0</option>

                                    </select>
                                </div>
                                
                                <div class="col-sm-4 mb-2">
                                    <label for="serial_no">مسلسل نمبر:</label>
                                    <input type="text" class="form-control" name="musalsal_num" id="serial_no"
                                        value="{{$record->musalsal_num}}" required="">
                                </div>
                                <div class="col-sm-4 mb-2">
                                    <label for="date">تاریخ:</label>
                                    <input type="date" class="form-control" name="date" id="date"
                                        value="{{$record->date}}" required="">
                                </div>
                                <div class="col-sm-4 mb-2">
                                    <label for="city">ولایت:</label>
                                    <input type="text" class="form-control" name="city" id="city"
                                        value="{{$record->city}}" required="">
                                </div>
                                <div class="col-sm-4 mb-2">
                                    <label for="product">جنس:</label>
                                    <input type="text" class="form-control" name="product" id="product" value="{{$record->product}}"
                                        required="">
                                </div>
                                <div class="col-sm-4 mb-2">
                                    <label for="vehical_no">گاڑی نمبر:</label>
                                    <input type="text" class="form-control" name="vehicle_num" id="vehical_no"
                                        value="{{ $record->vehicle_num}}" required="">
                                </div>
                                <div class="col-sm-4 mb-2">
                                    <label for="qty">تعداد:</label>
                                    <input type="text" class="form-control" name="quantity" id="qty"
                                        value="{{ $record->quantity}}" required="">
                                </div>
                                <div class="col-sm-4 mb-2">
                                    <label for="torkham_details">تفصیل:</label>
                                    <input type="text" class="form-control" name="detail"
                                        id="torkham_details" value="{{$record->detail}}">
                                </div>


                                <div class="col-sm-4 mb-2 torkham_field">
                                    <label for="weight">وزن</label>

                                    <input type="text" class="form-control torkham_form" name="weight"
                                        id="weight" value="{{$record->weight}}">
                                </div>
                                <div class="col-sm-4 mb-2 torkham_field">
                                    <label for="weight per kg">وزن پچاس کلو مطابق:</label>
                                    <input type="text" class="form-control torkham_form" name="weight_acc_to_50kg"
                                        id="weight_per_kg" value="{{$record->weight_acc_to_50kg}}">

                                </div>
                                <div class="col-sm-4 mb-2 torkham_field">
                                    <label for="fixed_weight">جملہ تعداد:</label>

                                    <input type="text" class="form-control torkham_form" name="total_qty"
                                        id="fixed_weight" value="{{$record->total_qty}}" readonly="">
                                </div>
                                <div class="col-sm-4 mb-2 torkham_field">
                                    <label for="rate_p_50_kg">نرخ:</label>

                                    <input type="text" class="form-control torkham_form" name="narkh"
                                        id="rate_p_50_kg" value="{{$record->narkh}}">
                                </div>

                                <div class="col-sm-4 mb-2 torkham_field">
                                    <label for="labour_torkham">مزدوری:</label>

                                    <input type="text" class="form-control torkham_form" name="labour"
                                        id="labour_torkham" value="{{$record->labour}}">
                                </div>
                                <!-- added four field for torkham end-->

                               
                                <div class="col-sm-4 mb-2">
                                    <label for="ponch">پونچ:</label>

                                    <input type="text" name="ponch" value="{{$record->ponch}}"
                                        class="form-control torkham_form ponch">
                                </div>
                                <div class="col-sm-4 mb-2">
                                    <label for="total">ٹوٹل:</label>


                                    <input type="text" name="total" id="total" value="{{$record->total}}" required=""
                                        class="form-control" readonly="">
                                </div>

                            </div>

                        </div>
                        <div class="form-group row mt-2">
                            <div class="col-sm-12 text-right">
                                <button type="submit" class="btn btn-rounded btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
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
