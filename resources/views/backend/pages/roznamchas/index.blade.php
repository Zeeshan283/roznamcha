@extends('backend.layouts.master')

@section('title')
Roznamchas - Roznamcha
@endsection
@section('styles')
    <!-- Start datatable css -->
    <link rel="stylesheet" href="{{ asset('assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extra-libs/datatables.net-bs4/css/responsive.dataTables.min.css') }}">
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
                        <li class="breadcrumb-item text-muted active" aria-current="page">List of Roznamchas</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-5 align-self-center">
            <div class="customize-input float-end">
                @if (Auth::guard('admin')->user()->can('roznamchas.edit'))
                    <a class="btn btn-rounded btn-primary" href="{{ route('admin.roznamchas.create') }}">Create New Roznamcha</a>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">List of Roznamchas</h4>

                    @if ($currency=="all")
                        <ul class="nav nav-pills bg-nav-pills nav-justified mb-3" style="width: 40%;">
                            <li class="nav-item">
                                <a href="#pak" data-bs-toggle="tab" aria-expanded="true"
                                    class="nav-link rounded-0 active">
                                    <i class="mdi mdi-home-variant d-lg-none d-block me-1"></i>
                                    <span class="d-none d-lg-block">Pakistan</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#afg" data-bs-toggle="tab" aria-expanded="flase"
                                    class="nav-link rounded-0">
                                    <i class="mdi mdi-account-circle d-lg-none d-block me-1"></i>
                                    <span class="d-none d-lg-block">Afghanistan</span>
                                </a>
                            </li> 
                            <li class="nav-item">
                                <a href="#usa" data-bs-toggle="tab" aria-expanded="flase"
                                    class="nav-link rounded-0">
                                    <i class="mdi mdi-account-circle d-lg-none d-block me-1"></i>
                                    <span class="d-none d-lg-block">USA</span>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane show active" id="pak">
                                <div style="display: flex; justify-content: space-between" class="mb-3">
                                    <div>
                                        <span style="color: red">
                                            بنام Pk: [ {{$pk_bnam}} ]
                                        </span>
                                    </div>
                                    <div>
                                        <span style="color: black">
                                            جمع Pk: [ {{$pk_jama}} ] 
                                        </span>
                                    </div>
                                    <div>
                                        @php
                                        $totalPk = $pk_jama - $pk_bnam;
                                        $totalColor = $totalPk >= 0 ? 'green' : 'red';
                                        @endphp
                                        <span style="color: {{ $totalColor }}">
                                            Total Pk: [ {{ abs($totalPk) }} ]
                                        </span>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="multi_col_order"
                                        class="table border table-striped table-bordered text-nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>سیریل نمبر</th>
                                                <th>تاریخ</th>
                                                <th>کهاته بنام</th>
                                                <th>تفصیل</th>
                                                <th>جمع / بنام</th>
                                                <th>Amount PK</th>
                                                <th>Amount AF</th>
                                                <th>Amount USD</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($roznamchas_pk as $item)
                                                <tr>
                                                    <td>{{$item->serial_num}}</td>
                                                    <td>{{$item->date_pk}}</td>
                                                    <td>
                                                        <a href="{{ route('admin.khata.personal.index', $item->id) }}">{{$item->admin->name}}</a>
                                                    </td>
                                                    <td>{{$item->detail}}</td>
                                                    <td style="color: {{ $item->state == 'جمع' ? 'green' : 'red' }}">
                                                        {{ $item->state }}
                                                    </td>
                                                    <td>{{$item->amount_pk}}</td>
                                                    <td>{{$item->amount_af}}</td>
                                                    <td>{{$item->amount_usa}}</td>
                                                    <td>
                                                        <a href="{{ route('admin.roznamchas.edit', ['roznamcha' => $item->id]) }}"><button class="btn btn-info">Edit</button></a>
                                                        <a href="{{ route('admin.roznamchas.remove', ['id' => $item->id]) }}"
                                                            onclick="event.preventDefault(); if (confirm('Are you sure you want to delete this item?')) { document.getElementById('delete-form-{{ $item->id }}').submit(); }">
                                                            <button class="btn btn-danger">Delete</button>
                                                        </a>
                                                        <form id="delete-form-{{ $item->id }}" action="{{ route('admin.roznamchas.remove', ['id' => $item->id]) }}" method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
    
                        <div class="tab-content">
                            <div class="tab-pane" id="afg">
                                <div style="display: flex; justify-content: space-between" class="mb-3">
                                    <div>
                                        <span style="color: red">
                                            بنام Af: [ {{$af_bnam}} ]
                                        </span>
                                    </div>
                                    <div>
                                        <span style="color: black">
                                            جمع Af: [ {{$af_jama}} ] 
                                        </span>
                                    </div>
                                    <div>
                                        @php
                                        $totalPk = $af_jama - $af_bnam;
                                        $totalColor = $totalPk >= 0 ? 'green' : 'red';
                                        @endphp
                                        <span style="color: {{ $totalColor }}">
                                            Total Pk: [ {{ abs($totalPk) }} ]
                                        </span>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="multi_col_order"
                                        class="table border table-striped table-bordered text-nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>سیریل نمبر</th>
                                                <th>تاریخ</th>
                                                <th>کهاته بنام</th>
                                                <th>تفصیل</th>
                                                <th>جمع / بنام</th>
                                                <th>Amount PK</th>
                                                <th>Amount AF</th>
                                                <th>Amount USD</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($roznamchas_af as $item)
                                                <tr>
                                                    <td>{{$item->serial_num}}</td>
                                                    <td>{{$item->date_af}}</td>
                                                    <td>
                                                        <a href="{{ route('admin.khata.personal.index', $item->id) }}">{{$item->admin->name}}</a>   
                                                    </td>
                                                    <td>{{$item->detail}}</td>
                                                    <td style="color: {{ $item->state == 'جمع' ? 'green' : 'red' }}">
                                                        {{ $item->state }}
                                                    </td>
                                                    <td>{{$item->amount_pk}}</td>
                                                    <td>{{$item->amount_af}}</td>
                                                    <td>{{$item->amount_usa}}</td>
                                                    <td>        
                                                        <a href="{{ route('admin.roznamchas.edit', ['roznamcha' => $item->id]) }}"><button class="btn btn-info">Edit</button></a>
                                                        <a href="{{ route('admin.roznamchas.remove', ['id' => $item->id]) }}"
                                                            onclick="event.preventDefault(); if (confirm('Are you sure you want to delete this item?')) { document.getElementById('delete-form-{{ $item->id }}').submit(); }">
                                                            <button class="btn btn-danger">Delete</button>
                                                        </a>
                                                        <form id="delete-form-{{ $item->id }}" action="{{ route('admin.roznamchas.remove', ['id' => $item->id]) }}" method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </td>
                                                </tr>
                                                
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> 
                        
                        <div class="tab-content">
                            <div class="tab-pane" id="usa">
                                <div style="display: flex; justify-content: space-between" class="mb-3">
                                    <div>
                                        <span style="color: red">
                                            بنام USD: [ {{$usa_bnam}} ]
                                        </span>
                                    </div>
                                    <div>
                                        <span style="color: black">
                                            جمع  USD: [ {{$usa_jama}} ] 
                                        </span>
                                    </div>
                                    <div>
                                        @php
                                        $totalPk = $usa_jama - $usa_bnam;
                                        $totalColor = $totalPk >= 0 ? 'green' : 'red';
                                        @endphp
                                        <span style="color: {{ $totalColor }}">
                                            Total Pk: [ {{ abs($totalPk) }} ]
                                        </span>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="multi_col_order"
                                        class="table border table-striped table-bordered text-nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>سیریل نمبر</th>
                                                <th>تاریخ</th>
                                                <th>کهاته بنام</th>
                                                <th>تفصیل</th>
                                                <th>جمع / بنام</th>
                                                <th>Amount PK</th>
                                                <th>Amount AF</th>
                                                <th>Amount USD</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($roznamchas_usa as $item)
                                                <tr>
                                                    <td>{{$item->serial_num}}</td>
                                                    <td>{{$item->date_usa}}</td>
                                                    <td>
                                                        <a href="{{ route('admin.khata.personal.index', $item->id) }}">{{$item->admin->name}}</a>
                                                    </td>
                                                    <td>{{$item->detail}}</td>
                                                    <td style="color: {{ $item->state == 'جمع' ? 'green' : 'red' }}">
                                                        {{ $item->state }}
                                                    </td>
                                                    <td>{{$item->amount_pk}}</td>
                                                    <td>{{$item->amount_af}}</td>
                                                    <td>{{$item->amount_usa}}</td>
                                                    <td>        
                                                        <a href="{{ route('admin.roznamchas.edit', ['roznamcha' => $item->id]) }}"><button class="btn btn-info">Edit</button></a>
                                                        <a href="{{ route('admin.roznamchas.remove', ['id' => $item->id]) }}"
                                                            onclick="event.preventDefault(); if (confirm('Are you sure you want to delete this item?')) { document.getElementById('delete-form-{{ $item->id }}').submit(); }">
                                                            <button class="btn btn-danger">Delete</button>
                                                        </a>
                                                        <form id="delete-form-{{ $item->id }}" action="{{ route('admin.roznamchas.remove', ['id' => $item->id]) }}" method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </td>
                                                </tr>
                                                
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    @if($currency=="PK")
                        <div class="tab-content">
                            <div style="display: flex; justify-content: space-between" class="mb-3">
                                <div>
                                    <span style="color: red">
                                        بنام Pk: [ {{$pk_bnam}} ]
                                    </span>
                                </div>
                                <div>
                                    <span style="color: black">
                                        جمع Pk: [ {{$pk_jama}} ] 
                                    </span>
                                </div>
                                <div>
                                    @php
                                    $totalPk = $pk_jama - $pk_bnam;
                                    $totalColor = $totalPk >= 0 ? 'green' : 'red';
                                    @endphp
                                    <span style="color: {{ $totalColor }}">
                                        Total Pk: [ {{ abs($totalPk) }} ]
                                    </span>
                                </div>
                            </div>
                            <div class="table-responsive">
                            <table id="multi_col_order"
                                class="table border table-striped table-bordered text-nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>سیریل نمبر</th>
                                        <th>تاریخ</th>
                                        <th>کهاته بنام</th>
                                        <th>تفصیل</th>
                                        <th>جمع / بنام</th>
                                        <th>Amount PK</th>
                                        <th>Amount AF</th>
                                        <th>Amount USD</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roznamchas_pk as $item)
                                        <tr>
                                            <td>{{$item->serial_num}}</td>
                                            <td>{{$item->date_pk}}</td>
                                            <td>
                                                <a href="{{ route('admin.khata.personal.index', $item->id) }}">{{$item->admin->name}}</a>    
                                            </td>
                                            <td>{{$item->detail}}</td>
                                            <td style="color: {{ $item->state == 'جمع' ? 'green' : 'red' }}">
                                                {{ $item->state }}
                                            </td>
                                            <td>{{$item->amount_pk}}</td>
                                            <td>{{$item->amount_af}}</td>
                                            <td>{{$item->amount_usa}}</td>
                                            <td>
                                                <a href="{{ route('admin.roznamchas.edit', ['roznamcha' => $item->id]) }}"><button class="btn btn-info">Edit</button></a>
                                                <a href="{{ route('admin.roznamchas.remove', ['id' => $item->id]) }}"
                                                    onclick="event.preventDefault(); if (confirm('Are you sure you want to delete this item?')) { document.getElementById('delete-form-{{ $item->id }}').submit(); }">
                                                    <button class="btn btn-danger">Delete</button>
                                                </a>
                                                <form id="delete-form-{{ $item->id }}" action="{{ route('admin.roznamchas.remove', ['id' => $item->id]) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif

                    @if($currency=="AF")
                        <div class="tab-content">
                            <div style="display: flex; justify-content: space-between" class="mb-3">
                                <div>
                                    <span style="color: red">
                                        بنام Af: [ {{$af_bnam}} ]
                                    </span>
                                </div>
                                <div>
                                    <span style="color: black">
                                        جمع Af: [ {{$af_jama}} ] 
                                    </span>
                                </div>
                                <div>
                                    @php
                                    $totalPk = $af_jama - $af_bnam;
                                    $totalColor = $totalPk >= 0 ? 'green' : 'red';
                                    @endphp
                                    <span style="color: {{ $totalColor }}">
                                        Total Pk: [ {{ abs($totalPk) }} ]
                                    </span>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="multi_col_order"
                                    class="table border table-striped table-bordered text-nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>سیریل نمبر</th>
                                            <th>تاریخ</th>
                                            <th>کهاته بنام</th>
                                            <th>تفصیل</th>
                                            <th>جمع / بنام</th>
                                            <th>Amount PK</th>
                                            <th>Amount AF</th>
                                            <th>Amount USD</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roznamchas_af as $item)
                                            <tr>
                                                <td>{{$item->serial_num}}</td>
                                                <td>{{$item->date_af}}</td>
                                                <td>
                                                    <a href="{{ route('admin.khata.personal.index', $item->id) }}">{{$item->admin->name}}</a>
                                                </td>
                                                <td>{{$item->detail}}</td>
                                                <td style="color: {{ $item->state == 'جمع' ? 'green' : 'red' }}">
                                                    {{ $item->state }}
                                                </td>
                                                <td>{{$item->amount_pk}}</td>
                                                <td>{{$item->amount_af}}</td>
                                                <td>{{$item->amount_usa}}</td>
                                                <td>        
                                                    <a href="{{ route('admin.roznamchas.edit', ['roznamcha' => $item->id]) }}"><button class="btn btn-info">Edit</button></a>
                                                    <a href="{{ route('admin.roznamchas.remove', ['id' => $item->id]) }}"
                                                        onclick="event.preventDefault(); if (confirm('Are you sure you want to delete this item?')) { document.getElementById('delete-form-{{ $item->id }}').submit(); }">
                                                        <button class="btn btn-danger">Delete</button>
                                                    </a>
                                                    <form id="delete-form-{{ $item->id }}" action="{{ route('admin.roznamchas.remove', ['id' => $item->id]) }}" method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>
                                            
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div> 
                    @endif
                    
                    @if($currency=="USD")
                        <div class="tab-content">
                            <div style="display: flex; justify-content: space-between" class="mb-3">
                                <div>
                                    <span style="color: red">
                                        بنام USD: [ {{$usa_bnam}} ]
                                    </span>
                                </div>
                                <div>
                                    <span style="color: black">
                                        جمع  USD: [ {{$usa_jama}} ] 
                                    </span>
                                </div>
                                <div>
                                    @php
                                    $totalPk = $usa_jama - $usa_bnam;
                                    $totalColor = $totalPk >= 0 ? 'green' : 'red';
                                    @endphp
                                    <span style="color: {{ $totalColor }}">
                                        Total Pk: [ {{ abs($totalPk) }} ]
                                    </span>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="multi_col_order"
                                    class="table border table-striped table-bordered text-nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>سیریل نمبر</th>
                                            <th>تاریخ</th>
                                            <th>کهاته بنام</th>
                                            <th>تفصیل</th>
                                            <th>جمع / بنام</th>
                                            <th>Amount PK</th>
                                            <th>Amount AF</th>
                                            <th>Amount USD</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roznamchas_usa as $item)
                                            <tr>
                                                <td>{{$item->serial_num}}</td>
                                                <td>{{$item->date_usa}}</td>
                                                <td>
                                                    <a href="{{ route('admin.khata.personal.index', $item->id) }}">{{$item->admin->name}}</a>
                                                </td>
                                                <td>{{$item->detail}}</td>
                                                <td style="color: {{ $item->state == 'جمع' ? 'green' : 'red' }}">
                                                    {{ $item->state }}
                                                </td>
                                                <td>{{$item->amount_pk}}</td>
                                                <td>{{$item->amount_af}}</td>
                                                <td>{{$item->amount_usa}}</td>
                                                <td>        
                                                    <a href="{{ route('admin.roznamchas.edit', ['roznamcha' => $item->id]) }}"><button class="btn btn-info">Edit</button></a>
                                                    <a href="{{ route('admin.roznamchas.remove', ['id' => $item->id]) }}"
                                                        onclick="event.preventDefault(); if (confirm('Are you sure you want to delete this item?')) { document.getElementById('delete-form-{{ $item->id }}').submit(); }">
                                                        <button class="btn btn-danger">Delete</button>
                                                    </a>
                                                    <form id="delete-form-{{ $item->id }}" action="{{ route('admin.roznamchas.remove', ['id' => $item->id]) }}" method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>
                                            
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection