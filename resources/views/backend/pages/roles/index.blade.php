@extends('backend.layouts.master')

@section('title')
Roles - Roznamcha
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
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Roles</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-muted">Dashboard</a></li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Roles</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-5 align-self-center">
            <div class="customize-input float-end">
                @if (Auth::guard('admin')->user()->can('role.create'))
                    <a class="btn btn-rounded btn-primary" href="{{ route('admin.roles.create') }}">Create New Role</a>
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
                    <h4 class="card-title">List of Roles</h4>
                    <div class="table-responsive">
                        <table id="multi_col_order"
                            class="table border table-striped table-bordered text-nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="5%">Sl</th>
                                    <th width="10%">Name</th>
                                    <th width="60%">Permissions</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                               <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td style="display: flex; flex-wrap: wrap; gap: 5px">
                                        @foreach ($role->permissions as $perm)
                                            <span class="badge bg-primary text-white rounded-pill">
                                                {{ $perm->name }}
                                            </span>
                                        @endforeach
                                    </td>
                                    <td>
                                        @if (Auth::guard('admin')->user()->can('admin.edit'))
                                            <a class="btn btn-rounded btn-success" href="{{ route('admin.roles.edit', $role->id) }}">Edit</a>
                                        @endif

                                        @if (Auth::guard('admin')->user()->can('admin.edit'))
                                            <a class="btn btn-rounded btn-danger" href="{{ route('admin.roles.destroy', $role->id) }}"
                                            onclick="event.preventDefault(); document.getElementById('delete-form-{{ $role->id }}').submit();">
                                                Delete
                                            </a>

                                            <form id="delete-form-{{ $role->id }}" action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" style="display: none;">
                                                @method('DELETE')
                                                @csrf
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                               @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection