@extends('admin.layouts.master')
@section('content')
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        @if(admin_user()->havePermission('category_edit'))
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{__('admin.add_new_category')}}</h4>
                        <div class="page-title-right d-flex align-items-center gap-3 flex-wrap">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('home')}}"> {{__('admin.dashboard')}} </a></li>
                                @if(isset($category))
                                    <li class="breadcrumb-item">{{$category->name}}</li>
                                @else
                                    <li class="breadcrumb-item">{{__('admin.categories')}}</li>
                                @endif
                                <li class="breadcrumb-item active">{{__('admin.add_new_category')}}</li>
                            </ol>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            @php
                                $name_ar = "";
                                $name_en= "";
                                $color = "FFBC34";
                                $percentage = '0';
                                if(isset($category)){
                                    $name_ar = $category->name_ar??"";
                                $name_en= $category->name_en??"";
                                $color= $category->color??"";
                                $percentage= $category->percentage??"0";
                                    $route = route('category_update');
                                }else{
                                    $route = route('category_store');
                                }
                            @endphp
                            <form action="{{$route}}" method="POST" class="h-100 m-0 row" enctype="application/x-www-form-urlencoded" id="form">
                                @csrf

                                @if(isset($category))
                                    <input type="hidden"  name="id" value="{{$category->id}}">
                                @endif
                                <div class="col-md-6 col-lg-4 col-12 p-2">
                                    <div>
                                        <label for="ArabicName" class="form-label">{{__('inputs.name_ar')}}</label>
                                        <input type="text" class="form-control" id="ArabicName" placeholder="{{__('inputs.name_ar')}}" required name="name_ar" value="{{$name_ar}}" >
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 col-12 p-2">
                                    <div>
                                        <label for="EnglishName" class="form-label">{{__('inputs.name_en')}}</label>
                                        <input type="text" class="form-control" id="EnglishName" placeholder="{{__('inputs.name_en')}}" required name="name_en" value="{{$name_en}}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 col-12 p-2">
                                    <div>
                                        <label for="EnglishName" class="form-label">{{__('inputs.color')}}</label>
                                        <input type="color" class="form-control" id="colorPicker"  required name="color" value="{{$color}}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 col-12 p-2">
                                    <div>
                                        <label for="EnglishName" class="form-label">{{__('inputs.percentage')}}</label>
                                        <input type="number" step="0.01" class="form-control" id="percentage"  required name="percentage" value="{{$percentage}}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 col-12 p-2">
                                    <div>
                                        <label for="Image" class="form-label">{{__('inputs.image')}}</label>
                                        <input type="file" class="form-control" id="Image" name="image" accept="image/*">
                                        <br>
                                        <div id="imageContainer">
                                            <img id="selectedImage" src="#" alt="Selected Image">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 p-2 d-flex justify-content-end mt-auto">
                                    <button class="btn btn-success fs-7 fw-medium" type="submit" >
                                        {{__('buttons.save')}}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Page-content -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>document.write(new Date().getFullYear())</script> © {{env('APP_NAME')}}
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                 by <a href="https://epalsolutions.com" target="_blank">Epal
                                    Solutions</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        @endif
        <!-- end main content-->
@stop

@section('js')
    <script>

    </script>
@stop
