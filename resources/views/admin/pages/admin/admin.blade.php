@extends('admin.layouts.master')
@section('content')

    @if(admin_user()->havePermission('admin_view'))
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{__('admin.admins')}}</h4>
                <div class="page-title-right d-flex align-items-center gap-3 flex-wrap">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"> {{__('admin.dashboard')}} </a></li>
                        <li class="breadcrumb-item active">{{__('admin.admins')}}</li>
                    </ol>
                    @if(admin_user()->havePermission('admin_edit'))
                        <a href="{{route('admin.add')}}" class="btn btn-success">
                            <i class="ri-add-circle-line align-middle me-1"></i> {{__('buttons.add_admin')}}
                        </a>
                    @endif

                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <table id="example"
                           class="table table-bordered dt-responsive nowrap table-striped align-middle"
                           style="width:100%">
                        <thead>
                        <tr>
                            <th scope="col" style="width: 10px;">ID</th>
                            <th data-ordering="false">{{__('inputs.name')}}</th>
                            <th data-ordering="false">{{__('inputs.role')}}</th>
                            <th data-ordering="false">{{__('inputs.phone')}}</th>
                            <th data-ordering="false">{{__('inputs.email')}}</th>
                            <th data-ordering="false">{{__('buttons.actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($admins as $admin)
                            <tr id="{{$admin->id}}">
                                <td style="width: 10px;">{{$admin->id}}</td>
                                <td>{{$admin->name}}</td>
                                <td>{{$admin->super?__('admin.super'):$admin->role->name}}</td>
                                <td>{{$admin->phone}}</td>
                                <td>{{$admin->email}}</td>
                                @if(admin_user()->havePermission('admin_edit'))
                                    <td>

                                        <a class="btnn bttn-dark" href="{{route('admin.edit',['id' => $admin->id])}}">
                                            <i class="ri-pencil-fill fs-16"></i>
                                        </a>
                                        <button class="btnn bttn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal"
                                                data-id="{{ $admin->id }}" data-url="{{ route('admin.delete')}}"
                                                id="delete_dialog">
                                            <i class="ri-delete-bin-fill fs-16"></i>
                                        </button>
                                    </td>
                                @else
                                    <td></td>
                                @endif

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page-content -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>document.write(new Date().getFullYear())</script> © <a href="#!"
                                                                                   target="_blank">{{env('APP_NAME')}}</a>
                </div>
                <!-- <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                         by <a href="#!" target="_blank">{{env('APP_NAME')}}
                        </a>
                    </div>
                </div> -->
            </div>
        </div>
    </footer>
</div>
    @endif

@stop
