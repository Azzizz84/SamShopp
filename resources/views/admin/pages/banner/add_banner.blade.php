@extends('admin.layouts.master')
@section('content')
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        @if(admin_user()->havePermission('banner_edit'))
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{__('buttons.add_banner')}}</h4>
                        <div class="page-title-right d-flex align-items-center gap-3 flex-wrap">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('home')}}"> {{__('admin.dashboard')}} </a></li>
                                @if(isset($banner))
                                    <li class="breadcrumb-item">{{$banner->name}}</li>
                                @else
                                    <li class="breadcrumb-item">{{__('admin.banners')}}</li>
                                @endif
                                <li class="breadcrumb-item active">{{__('buttons.add_banner')}}</li>
                            </ol>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            @php
                                $route = route('banner_store');
                            @endphp
                            <form action="{{$route}}" method="POST" class="h-100 m-0 row" enctype="application/x-www-form-urlencoded" id="form">
                                @csrf


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


