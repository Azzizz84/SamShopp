

@extends('admin.layouts.master')
@section('content')
    @if(admin_user()->havePermission('product_view'))
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{__('admin.sections')}}</h4>
                <div class="page-title-right d-flex align-items-center gap-3 flex-wrap">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"> {{__('admin.dashboard')}} </a></li>
                        <li class="breadcrumb-item active">{{__('admin.sections')}}</li>
                    </ol>

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
                            <th>{{__('inputs.name')}}</th>
                            <th>{{__('admin.products')}}</th>
                            <th>{{__('buttons.actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($market->sections as $section)
                            <tr id="{{$section->id}}">
                                <td style="width: 10px;">{{$section->id}}</td>
                                </td>
                                <td><img src="{{{$section->image}}}" alt="Section Image 3"
                                         style="width: 80px; height: 80px; object-fit: cover" >
                                </td>
                                <td>{{$section->title}}</td>
                                <td><a class="btn btn-outline-info" href="{{route('products',['marketId' => $market->id,'sectionId' => $section->id])}}">{{__('buttons.view_products')}}</a></td>
                                <td>
                                    <button class="btnn bttn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal"
                                            data-id="{{ $section->id }}" data-url="{{ route('section.delete',['marketId' => $market->id])}}"
                                            id="delete_dialog">
                                        <i class="ri-delete-bin-fill fs-16"></i>
                                    </button>
                                </td>
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
