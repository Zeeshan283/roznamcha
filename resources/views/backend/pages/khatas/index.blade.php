@extends('backend.layouts.master')

@section('title')
Khatas - Roznamcha
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
                        <li class="breadcrumb-item text-muted active" aria-current="page">Khatas Listing</li>
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
                    <h4 class="card-title">Khatas Listing</h4>
                    
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
                                <div class="table-responsive">
                                    <table id="multi_col_order"
                                        class="table border table-striped table-bordered text-nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>سیریل نمبر</th>
                                                <th>نام</th>
                                                <th>(بنام  PK)</th>
                                                <th>(جمع  PK)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($roznamchas_pk as $item)
                                            <tr>
                                                <td>{{$item->serial_num}}</td>
                                                <td>
                                                    <a href="{{ route('admin.khata.personal.index', $item->id) }}">{{$item->admin->name}}</a>
                                                </td>
                                                <td>
                                                    @if ($item->state == 'بنام')
                                                        <span style="color: red;">{{ $item->amount_pk }}</span>
                                                    @else
                                                        <span style="color: red;">0</span>
    
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->state == 'جمع')
                                                        <span style="color: green;">{{ $item->amount_pk }}</span>
                                                    @else
                                                        <span style="color: green;">0</span>
    
                                                    @endif
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
                                <div class="table-responsive">
                                    <table id="multi_col_order"
                                        class="table border table-striped table-bordered text-nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>سیریل نمبر</th>
                                                <th>نام</th>
                                                <th>(بنام  AF)</th>
                                                <th>(جمع  AF)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($roznamchas_af as $item)
                                            <tr>
                                                <td>{{$item->serial_num}}</td>
                                                <td>
                                                    <a href="{{ route('admin.khata.personal.index', $item->id) }}">{{$item->admin->name}}</a>
                                                </td>
                                                <td>
                                                    @if ($item->state == 'بنام')
                                                        <span style="color: red;">{{ $item->amount_af }}</span>
                                                    @else
                                                        <span style="color: red;">0</span>
    
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->state == 'جمع')
                                                        <span style="color: green;">{{ $item->amount_af }}</span>
                                                    @else
                                                        <span style="color: green;">0</span>
    
                                                    @endif
                                                </td>                                            
    
                                            </tr>
                                                
                                            @endforeach

                                            @foreach ($roznamchas_afg as $item)
                                            <tr>
                                                <td>{{$item->musalsal_num}}</td>
                                                <td>
                                                    <a href="{{ route('admin.khata.personal.index', $item->name) }}">{{$item->admin->name}}</a>
                                                </td>
                                                <td>
                                                    @if ($item->state == 'بنام')
                                                        <span style="color: red;">{{ $item->comission }}</span>
                                                    @else
                                                        <span style="color: red;">0</span>
    
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->comission)
                                                        <span style="color: green;">{{ $item->comission }}</span>
                                                    @else
                                                        <span style="color: green;">0</span>
    
                                                    @endif
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
                                <div class="table-responsive">
                                    <table id="multi_col_order"
                                        class="table border table-striped table-bordered text-nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>سیریل نمبر</th>
                                                <th>نام</th>
                                                <th>(بنام  USA)</th>
                                                <th>(جمع  USA)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($roznamchas_usa as $item)
                                            <tr>
                                                <td>{{$item->serial_num}}</td>
                                                <td>
                                                    <a href="{{ route('admin.khata.personal.index', $item->id) }}">{{$item->admin->name}}</a>
                                                </td>
                                                <td>
                                                    @if ($item->state == 'بنام')
                                                        <span style="color: red;">{{ $item->amount_usa }}</span>
                                                    @else
                                                        <span style="color: red;">0</span>
    
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->state == 'جمع')
                                                        <span style="color: green;">{{ $item->amount_usa }}</span>
                                                    @else
                                                        <span style="color: green;">0</span>
    
                                                    @endif
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
                            <div class="table-responsive">
                                <table id="multi_col_order"
                                    class="table border table-striped table-bordered text-nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>سیریل نمبر</th>
                                            <th>نام</th>
                                            <th>(بنام  PK)</th>
                                            <th>(جمع  PK)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roznamchas_pk as $item)
                                        <tr>
                                            <td>{{$item->serial_num}}</td>
                                            <td>
                                                <a href="{{ route('admin.khata.personal.index', $item->id) }}">{{$item->admin->name}}</a>
                                            </td>
                                            <td>
                                                @if ($item->state == 'بنام')
                                                    <span style="color: red;">{{ $item->amount_pk }}</span>
                                                @else
                                                    <span style="color: red;">0</span>

                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->state == 'جمع')
                                                    <span style="color: green;">{{ $item->amount_pk }}</span>
                                                @else
                                                    <span style="color: green;">0</span>

                                                @endif
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
                            <div class="table-responsive">
                                <table id="multi_col_order"
                                    class="table border table-striped table-bordered text-nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>سیریل نمبر</th>
                                            <th>نام</th>
                                            <th>(بنام  AF)</th>
                                            <th>(جمع  AF)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roznamchas_af as $item)
                                        <tr>
                                            <td>{{$item->serial_num}}</td>
                                            <td>
                                                <a href="{{ route('admin.khata.personal.index', $item->id) }}">{{$item->admin->name}}</a>
                                            </td>
                                            <td>
                                                @if ($item->state == 'بنام')
                                                    <span style="color: red;">{{ $item->amount_af }}</span>
                                                @else
                                                    <span style="color: red;">0</span>

                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->state == 'جمع')
                                                    <span style="color: green;">{{ $item->amount_af }}</span>
                                                @else
                                                    <span style="color: green;">0</span>

                                                @endif
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
                            <div class="table-responsive">
                                <table id="multi_col_order"
                                    class="table border table-striped table-bordered text-nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>سیریل نمبر</th>
                                            <th>نام</th>
                                            <th>(بنام  USA)</th>
                                            <th>(جمع  USA)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roznamchas_usa as $item)
                                        <tr>
                                            <td>{{$item->serial_num}}</td>
                                            <td>
                                                <a href="{{ route('admin.khata.personal.index', $item->id) }}">{{$item->admin->name}}</a>
                                            </td>
                                            <td>
                                                @if ($item->state == 'بنام')
                                                    <span style="color: red;">{{ $item->amount_usa }}</span>
                                                @else
                                                    <span style="color: red;">0</span>

                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->state == 'جمع')
                                                    <span style="color: green;">{{ $item->amount_usa }}</span>
                                                @else
                                                    <span style="color: green;">0</span>

                                                @endif
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
