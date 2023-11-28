
@extends('backend.layouts.master')

@section('title')
Create Roznamcha - Roznamcha
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
                        <li class="breadcrumb-item text-muted active" aria-current="page">Create Roznamcha</li>
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
                    {{-- @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif --}}

                    <h4 class="card-title mb-3">Create New Roznamcha</h4>
                    @include('backend.layouts.partials.messages')
                        <form action="{{ route('admin.roznamchas.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if($currency=="PK")
                                <input type="hidden" name="country" value="Pakistan">
                            @endif
                            @if($currency=="AF")
                                <input type="hidden" name="country" value="Afghanistan">
                            @endif
                            @if($currency=="USD")
                                <input type="hidden" name="country" value="USA">
                            @endif
                            @if($currency=="all")
                                <input type="hidden" name="country" value="all">
                            @endif
                            <div class="form-group">
                                <div class=" row append_data" id="order_form">
                                    <div class="col-sm-4 mb-2">
                                        <label for="user">کهاته بنام:</label>
                                        <select class="form-control" id="user" name="user" required>
                                            <option value="">Select</option>
                                            @foreach ($users as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="col-sm-4 mb-2">
                                        <label for="sr_no">سیریل نمبر:</label>
                                        <input type="text" class="form-control" id="sr_no" name="sr_no">
                                    </div>
                                    
                                    <div class="col-sm-4 mb-2">
                                        <label for="detail">تفصیل:</label>
                                        <input type="text" class="form-control" id="detail" name="detail" placeholder="Enter Details">
                                    </div>
    
                                    <div class="col-sm-4 mb-2">
                                        <label for="date">تاریخ:</label>
                                        <input type="date" class="form-control" id="date" name="date" placeholder="Select Date">
                                    </div>
                                    
                                    <div class="col-sm-4 mb-2">
                                        <label for="state">جمع / بنام::</label>
                                        <select class="form-control" id="state" name="state" required>
                                            <option value="">جمع / بنام:</option>
                                            <option value="جمع">جمع</option>
                                            <option value="بنام">بنام</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-4 mb-2">
                                        <label id="countryLabel">Amount PK</label>
                                        <input type="number" class="form-control" id="amount_pk" name="amount_pk" placeholder="Enter amount">
                                    </div>
                                    
                                    <div class="col-sm-4 mb-2">
                                        <label id="countryLabel">Amount AF</label>
                                        <input type="number" class="form-control" id="amount_af" name="amount_af" placeholder="Enter amount">
                                    </div>
                                    
                                    <div class="col-sm-4 mb-2">
                                        <label id="countryLabel">Amount USD</label>
                                        <input type="number" class="form-control" id="amount_usd" name="amount_usd" placeholder="Enter amount">
                                    </div>
                            
                                    <div class="col-sm-4 mb-2">
                                        <label for="bilty">عکس وپلټئ:</label>
                                        <input type="file" class="form-control" id="bilty" name="bilty[]" multiple>
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

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    })
</script>
<script>
    document.getElementById('country').addEventListener('change', function() {
    var selectedCountry = this.value;
    var label = document.getElementById('countryLabel');

    switch (selectedCountry) {
        case 'Pakistan':
            label.textContent = 'Amount Pak';
            break;
        case 'Afghanistan':
            label.textContent = 'Amount Af';
            break;
        case 'USA':
            label.textContent = 'Amount USD';
            break;
        default:
            label.textContent = 'Select a country to see the label';
            break;
    }
});

</script>
@endsection