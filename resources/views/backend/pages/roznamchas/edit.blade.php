
@extends('backend.layouts.master')

@section('title')
Edit Roznamcha - Roznamcha
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
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Roznamchas</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-muted">Dashboard</a></li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Edit Roznamcha</li>
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
                    <h4 class="header-title">Edit Roznamchas</h4>
                    @include('backend.layouts.partials.messages')
                    
                    <form action="{{ route('admin.roznamchas.update', ['roznamcha' => $roznamcha->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                                <div class=" row append_data" id="order_form">
                                    <div class="col-sm-4 mb-2">
                                        <label for="user">کهاته بنام:</label>
                                        <select class="form-control" id="user" name="user" required>
                                            <option value="{{$roznamcha->admin->id}}">{{$roznamcha->admin->name}}</option>
                                            @foreach ($users as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="col-sm-4 mb-2">
                                        <label for="sr_no">سیریل نمبر:</label>
                                        <input type="text" class="form-control" id="sr_no" name="sr_no" value="{{$roznamcha->serial_num}}">
                                    </div>
                                    
                                    <div class="col-sm-4 mb-2">
                                        <label for="detail">تفصیل:</label>
                                        <input type="text" class="form-control" id="detail" name="detail" value="{{$roznamcha->detail}}">
                                    </div>
    
                                    <div class="col-sm-4 mb-2">
                                        <label for="date">تاریخ:</label>
                                        <input type="date" class="form-control" id="date" name="date"  value="{{ $roznamcha->country == 'Pakistan' ? $roznamcha->date_pk : $roznamcha->date_af }}">
                                    </div>
                                    
                                    <div class="col-sm-4 mb-2">
                                        <label for="state">جمع / بنام::</label>
                                        <select class="form-control" id="state" name="state" required>
                                            <option value="{{$roznamcha->state}}">{{$roznamcha->state}}</option>
                                            <option value="جمع">جمع</option>
                                            <option value="بنام">بنام</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-4 mb-2">
                                        <label id="countryLabel">Amount PK</label>
                                        <input type="number" class="form-control" id="amount_pk" name="amount_pk" value="{{ $roznamcha->amount_pk }}">
                                    </div>
                                    
                                    <div class="col-sm-4 mb-2">
                                        <label id="countryLabel">Amount AF</label>
                                        <input type="number" class="form-control" id="amount_af" name="amount_af" value="{{ $roznamcha->amount_af }}">
                                    </div>
                                    
                                    <div class="col-sm-4 mb-2">
                                        <label id="countryLabel">Amount USD</label>
                                        <input type="number" class="form-control" id="amount_usd" name="amount_usd" value="{{ $roznamcha->amount_usa }}">
                                    </div>
                            
                                    <div class="col-sm-4 mb-2">
                                        <label for="bilty">عکس وپلټئ:</label>
                                        <input type="file" class="form-control" id="bilty" name="bilty[]" multiple value="{{ asset($roznamcha->bilty) }}">
                                    </div>
                                    
                                    <div class="col-sm-4 mb-2">
                                        <label for="bilty">عکس وپلټئ:</label>
                                        <img src="{{ asset($roznamcha->bilty) }}">
                                    </div>
                                    
                                </div>
                            </div>
                    
                        <div class="pt-5">
                            <button type="submit" class="btn btn-rounded btn-primary">Save</button>
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