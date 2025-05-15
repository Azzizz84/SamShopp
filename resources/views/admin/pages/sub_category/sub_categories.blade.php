

@extends('admin.layouts.master')
@section('content')
    @if(admin_user()->havePermission('sub_category_view'))
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{__('admin.sub_categories')}}</h4>
                <div class="page-title-right d-flex align-items-center gap-3 flex-wrap">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"> {{__('admin.dashboard')}} </a></li>
                        <li class="breadcrumb-item active">{{__('admin.sub_categories')}}</li>
                    </ol>
                    @if(admin_user()->havePermission('sub_category_edit'))
                        <a href="{{route('sub_category.add',['categoryId' => $category->id])}}" class="btn btn-success">
                            <i class="ri-add-circle-line align-middle me-1"></i> {{__('buttons.add_sub_category')}}
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
                            <th>{{__('inputs.name_ar')}}</th>
                            <th>{{__('inputs.name_en')}}</th>
                            <th>{{__('inputs.percentage')}}</th>
                            <th>{{__('buttons.actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($category->subCategories as $sub_category)
                            <tr id="{{$sub_category->id}}">
                                <td style="width: 10px;">{{$sub_category->id}}</td>
                                <td><img src="{{{$sub_category->image}}}" alt="Section Image 3"
                                         style="width: 20px; height: 20px; object-fit: cover" >
                                </td>
                                <td>{{$sub_category->name_ar}}</td>
                                <td>{{$sub_category->name_en}}</td>
                                <td>{{$sub_category->percentage}}</td>
                                @if(admin_user()->havePermission('sub_category_edit'))
                                    <td>
                                        <!-- <button class="btnn bttn-success">
                                            <i class="ri-eye-fill fs-16"></i>
                                        </button> -->
                                        <a class="btnn bttn-dark" href="{{route('sub_category.edit',['categoryId' => $category->id,'id'=>$sub_category->id])}}">
                                            <i class="ri-pencil-fill fs-16"></i>
                                        </a>
                                        <button class="btnn bttn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal"
                                                data-id="{{ $sub_category->id }}" data-url="{{ route('sub_category.delete',['categoryId' => $category->id])}}"
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
