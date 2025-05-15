@extends('admin.layouts.master')
@section('content')
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        @if(admin_user()->havePermission('city_edit'))
            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">{{__('admin.add_new_city')}}</h4>
                            <div class="page-title-right d-flex align-items-center gap-3 flex-wrap">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{route('home')}}"> {{__('admin.dashboard')}} </a></li>
                                    @if(isset($city))
                                        <li class="breadcrumb-item">{{$city->name}}</li>
                                    @else
                                        <li class="breadcrumb-item">{{__('admin.cities')}}</li>
                                    @endif
                                    <li class="breadcrumb-item active">{{__('admin.add_new_city')}}</li>
                                </ol>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                @php
                                    $name_ar = "";
                                    $name_en= "";
                                    if(isset($city)){
                                        $name_ar = $city?->name_ar??"";
                                    $name_en= $city?->name_en??"";
                                        $route = route('city_update');
                                    }else{
                                        $route = route('city_store');
                                    }
                                @endphp
                                <form action="{{$route}}" method="POST" class="h-100 m-0 row" enctype="application/x-www-form-urlencoded" id="form">
                                    @csrf

                                    @if(isset($city))
                                        <input type="hidden"  name="id" value="{{$city->id}}">
                                    @endif
                                    <div class="col-md-6 col-lg-4 col-12 p-2">
                                        <div>
                                            <label for="ArabicName" class="form-label">{{__('inputs.name_ar')}}</label>
                                            <input type="text" class="form-control" id="ArabicName" placeholder="الرياض" required name="name_ar" value="{{$name_ar}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-12 p-2">
                                        <div>
                                            <label for="EnglishName" class="form-label">{{__('inputs.name_en')}}</label>
                                            <input type="text" class="form-control" id="EnglishName" placeholder="Riyadh" required name="name_en" value="{{$name_en}}">
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
                                <script>document.write(new Date().getFullYear())</script> © {{env('APP_NAME')}}.
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
