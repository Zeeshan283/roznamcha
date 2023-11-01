
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

<div class="main-content-inner">
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
                        <div class="form-row mb-3" style="display: flex; flex-wrap:wrap; justify-content: space-between">
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="name">هیواد:</label>
                                <select class="form-control" id="country" name="country" required>
                                    <option value="{{$roznamcha->country}}">{{$roznamcha->country}}</option>
                                    <option value="Pakistan">Pakistan</option>
                                    <option value="Afghanistan">Afghanistan</option>
                                </select>
                                @if($roznamcha->country=="PK")
                                    <input type="hidden" name="country" value="Pakistan">
                                @endif
                                @if($roznamcha->country=="AF")
                                    <input type="hidden" name="country" value="Afghanistan">
                                @endif
                                @if($roznamcha->country=="USD")
                                    <input type="hidden" name="country" value="USA">
                                @endif
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="user">کهاته بنام:</label>
                                <select class="form-control" id="user" name="user" required>
                                    <option value="{{$roznamcha->admin->id}}">{{$roznamcha->admin->name}}</option>
                                    @foreach ($users as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="sr_no">سیریل نمبر:</label>
                                <input type="text" class="form-control" id="sr_no" name="sr_no" value="{{$roznamcha->serial_num}}">
                            </div>
                        </div>
                        <div class="form-row mb-3" style="display: flex; flex-wrap:wrap; justify-content: space-between">
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="detail">تفصیل:</label>
                                <input type="text" class="form-control" id="detail" name="detail"  value="{{$roznamcha->detail}}">
                            </div>

                            <div class="form-group col-md-4 col-sm-12">
                                <label for="date">تاریخ:</label>
                                <input type="date" class="form-control" id="date" name="date" value="{{ $roznamcha->country == 'Pakistan' ? $roznamcha->date_pk : $roznamcha->date_af }}">
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="amount">Amount</label>
                                <input type="number" class="form-control" id="amount" name="amount" value="{{ $roznamcha->country == 'Pakistan' ? $roznamcha->amount_pk : $roznamcha->amount_af }}">
                            </div>
                        </div>                        

                        <div class="form-row mb-3" style="display: flex; flex-wrap:wrap; justify-content: space-between">
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="state">جمع / بنام::</label>
                                <select class="form-control" id="state" name="state" required>
                                    <option value="{{$roznamcha->state}}">{{$roznamcha->state}}</option>
                                    <option value="جمع">جمع</option>
                                    <option value="بنام">بنام</option>
                                </select>
                            </div>
                            @if ($roznamcha->country=='AF')
                                <div class="form-group col-md-4 col-sm-12">
                                    <label for="detail">افعانی:</label>
                                    <input type="text" class="form-control" id="afghani" name="afghani" value="{{ $roznamcha->afghani }}">
                                </div>
                            @endif
                            <div class="form-group col-md-5 col-sm-6">
                                <label for="bilty">عکس وپلټئ:</label>
                                <input type="file" class="form-control" id="bilty" name="bilty" placeholder="Enter Phone Number" value="{{ asset($roznamcha->bilty) }}">
                                <img src="{{ asset($roznamcha->bilty) }}" style="height: 100px;width:100px" alt="Image Description">
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