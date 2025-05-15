

@extends('admin.layouts.master')
@section('content')
    @if(admin_user()->havePermission('service_view'))
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{__('admin.services')}}</h4>
                <div class="page-title-right d-flex align-items-center gap-3 flex-wrap">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"> {{__('admin.dashboard')}} </a></li>
                        <li class="breadcrumb-item active">{{__('admin.services')}}</li>
                    </ol>
                    @if(admin_user()->havePermission('service_edit'))
                    <a href="{{route('service.add')}}" class="btn btn-success">
                        <i class="ri-add-circle-line align-middle me-1"></i> {{__('buttons.add_service')}}
                    </a>
                    @endif
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <table id="cityTable"
                           class="table table-bordered dt-responsive nowrap table-striped align-middle"
                           style="width:100%">
                        <thead>
                        <tr>
                            <th scope="col" style="width: 10px;">ID</th>
                            <th>{{__('inputs.image')}}</th>
                            <th>{{__('inputs.name_ar')}}</th>
                            <th>{{__('inputs.name_en')}}</th>
                            <th>{{__('inputs.price')}}</th>
                            <th>{{__('inputs.offer_price')}}</th>
                            <th>{{__('inputs.deposit')}}</th>
                            <th>{{__('inputs.description_ar')}}</th>
                            <th>{{__('inputs.description_en')}}</th>
                            @if(admin_user()->havePermission('service_edit'))
                            <th>{{__('buttons.actions')}}</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($services as $service)
                            <tr id="{{$service->id}}">
                                <td style="width: 10px;">{{$service->id}}</td>
                                <td><a href="{{{$service->image}}}" target="_blank">
                                        <img src="{{{$service->image}}}" alt="Section Image 3"
                                             style="width: 80px; height: 80px; object-fit: cover" >
                                    </a>
                                </td>
                                <td>{{$service->title_ar}}</td>
                                <td>{{$service->title_en}}</td>
                                <td>{{$service->price}}</td>
                                <td>{{$service->offer_price}}</td>
                                <td>{{$service->deposit}}</td>
                                <td>{{$service->description_ar}}</td>
                                <td>{{$service->description_en}}</td>
                                @if(admin_user()->havePermission('service_edit'))
                                <td>
                                    <a class="btnn bttn-dark" href="{{route('service.edit',[$service->id])}}">
                                        <i class="ri-pencil-fill fs-16"></i>
                                    </a>
                                    <button class="btnn bttn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal"
                                            data-id="{{ $service->id }}" data-url="{{ route('service.delete',)}}"
                                            id="delete_dialog">
                                        <i class="ri-delete-bin-fill fs-16"></i>
                                    </button>
                                </td>
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
                         by <a href="#!" target="_blank">Mazij
                        </a>
                    </div>
                </div> -->
            </div>
        </div>
    </footer>
</div>
    @endif
@stop
