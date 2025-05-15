

@extends('admin.layouts.master')
@section('content')
    @if(admin_user()->havePermission('banner_view'))
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{__('admin.categories')}}</h4>
                <div class="page-title-right d-flex align-items-center gap-3 flex-wrap">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"> {{__('admin.dashboard')}} </a></li>
                        <li class="breadcrumb-item active">{{__('admin.banners')}}</li>
                    </ol>
                    @if(admin_user()->havePermission('banner_edit'))
                        <a href="{{route('banner.add')}}" class="btn btn-success">
                            <i class="ri-add-circle-line align-middle me-1"></i> {{__('buttons.add_banner')}}
                        </a>
                    @endif

                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <table id="sectionTable"
                           class="table table-bordered dt-responsive nowrap table-striped align-middle"
                           style="width:100%">
                        <thead>
                        <tr>
                            <th scope="col" style="width: 10px;">ID</th>
                            <th>{{__('inputs.image')}}</th>
                            <th>{{__('buttons.actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($banners as $banner)
                            <tr id="{{$banner->id}}">
                                <td style="width: 10px;">{{$banner->id}}</td>
                                <td><img src="{{$banner->image}}" alt="Section Image 1"
                                         style="width: 280px; height: 150px; object-fit: cover; border-radius: 12px;">
                                </td>

                                @if(admin_user()->havePermission('banner_edit'))
                                    <td>

                                        <button class="btnn bttn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal"
                                                data-id="{{ $banner->id }}" data-url="{{ route('banner.delete')}}"
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
