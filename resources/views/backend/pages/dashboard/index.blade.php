@extends('backend.layouts.master')

@section('title')
Dashboard - Roznamcha
@endsection


@section('admin-content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Dashboard</h3>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
            <div class="col-sm-12 col-lg-4">
                <div class="card border-end">
                    <div class="card-body" style="background-color:{{ $totak_pk < 0 ? '#f93a5a' : '#029666'}}">
                        <div class="d-flex align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium">Rs. {{ abs($totak_pk)}}</h2>
                                </div>
                                <h6 class="font-weight-normal mb-0 w-100 text-truncate" style="color: black">
                                    Pakistan
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-4">
                <div class="card border-end">
                    <div class="card-body" style="background-color: {{ $toak_af < 0 ? '#f93a5a' : '#029666'}}">
                        <div class="d-flex align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium">Rs. {{ abs($toak_af)}}</h2>
                                </div>
                                <h6 class="font-weight-normal mb-0 w-100 text-truncate" style="color: black">
                                    Afghanistan
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-4">
                <div class="card border-end">
                    <div class="card-body" style="background-color: {{ $total_usa < 0 ? '#f93a5a' : '#029666'}}">
                        <div class="d-flex align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium">Rs. {{ abs($total_usa)}}</h2>
                                </div>
                                <h6 class="font-weight-normal mb-0 w-100 text-truncate" style="color: black">
                                    USA
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       
    </div>

    <div class="row">
        @foreach ($userDetails as $userDetail)
            @php
                $difference = $userDetail['total_jama'] - $userDetail['total_bnam'];
                $isPositive = $difference >= 0;
            @endphp
            <div class="col-sm-6 col-lg-3">
                <div class="card border-end">
                    <div class="card-body" style="background-color: #f93a5a">
                        <div class="d-flex align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium">Rs. {{ abs($difference) }}</h2>
                                </div>
                                <h6 class="font-weight-normal mb-0 w-100 text-truncate" style="color: black">
                                    {{ $userDetail['user'] }}
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        
        @foreach ($orderDetails as $orderDetail)
            @php
                $difference = $orderDetail['profit'] - $orderDetail['loss'];
                $isPositive = $difference >= 0;
                $color = $isPositive ? '#029666' : '#f93a5a';
            @endphp
            <div class="col-sm-6 col-lg-3">
                <div class="card border-end">
                    <div class="card-body" style="background-color: {{ $color }}">
                        <div class="d-flex align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium">Rs. {{ abs($difference) }}</h2>
                                </div>
                                <h6 class="font-weight-normal mb-0 w-100 text-truncate" style="color: black">
                                    {{ $isPositive ? $orderDetail['title_profit'] : $orderDetail['title_loss'] }}
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        
        <div class="col-sm-6 col-lg-3">
                <div class="card border-end">
                    <div class="card-body" style="background-color: #f76a2d">
                        <div class="d-flex align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium">Rs. {{ $still_free }}</h2>
                                </div>
                                <h6 class="font-weight-normal mb-0 w-100 text-truncate" style="color: black">
                                    Still Free
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
    </div>
</div>
@endsection