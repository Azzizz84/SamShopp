@extends('admin.layouts.master')
@section('content')
    @if(admin_user()->havePermission('permission_view'))
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{__('admin.permissions')}}</h4>
                <div class="page-title-right d-flex align-items-center gap-3 flex-wrap">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"> {{__('admin.dashboard')}} </a></li>
                        <li class="breadcrumb-item active">{{__('admin.permissions')}}</li>
                    </ol>
                    @if(admin_user()->havePermission('permission_edit'))
                        <a href="{{route('permission.add')}}" class="btn btn-success">
                            <i class="ri-add-circle-line align-middle me-1"></i> {{__('buttons.add_permission')}}
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
                            <th data-ordering="false">{{__('inputs.permission_ar')}}</th>
                            <th data-ordering="false">{{__('inputs.permission_en')}}</th>
                            <th data-ordering="false">{{__('buttons.actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($permissions as $permission)
                            <tr id="{{$permission->id}}">
                                <td style="width: 10px;">{{$permission->id}}</td>
                                <td>{{$permission->name_ar}}</td>
                                <td>{{$permission->name_en}}</td>
                                @if(admin_user()->havePermission('permission_edit'))
                                    <td>
                                        <!-- <button class="btnn bttn-success">
                                            <i class="ri-eye-fill fs-16"></i>
                                        </button> -->
                                        <a class="btnn bttn-dark" href="{{route('permission.edit',['id' => $permission->id])}}">
                                            <i class="ri-pencil-fill fs-16"></i>
                                        </a>
                                        <button class="btnn bttn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal"
                                                data-id="{{ $permission->id }}" data-url="{{ route('permission.delete')}}"
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
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        by <a href="#!" target="_blank">{{env('APP_NAME')}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
    @endif
@stop
