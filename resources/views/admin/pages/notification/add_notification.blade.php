@extends('admin.layouts.master')
@section('content')
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        @if(admin_user()->havePermission('notification_edit'))
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{__('buttons.add_notification')}}</h4>
                        <div class="page-title-right d-flex align-items-center gap-3 flex-wrap">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('home')}}"> {{__('admin.dashboard')}} </a></li>
                                <li class="breadcrumb-item">{{__('admin.notifications')}}</li>
                                <li class="breadcrumb-item active">{{__('buttons.add_notification')}}</li>
                            </ol>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('notification_store')}}" method="POST" class="h-100 m-0 row" enctype="application/x-www-form-urlencoded" id="form">
                                @csrf

                                <div class="col-md-6 col-lg-4 col-12 p-2">
                                    <div>
                                        <label for="ArabicName" class="form-label">{{__('inputs.name_ar')}}</label>
                                        <input type="text" class="form-control" id="ArabicName" placeholder="{{__('inputs.name_ar')}}" required name="title_ar">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 col-12 p-2">
                                    <div>
                                        <label for="EnglishName" class="form-label">{{__('inputs.name_en')}}</label>
                                        <input type="text" class="form-control" id="EnglishName" placeholder="{{__('inputs.name_en')}}" required name="title_en" >
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 col-12 p-2">
                                    <label class="form-label">{{__('inputs.for_who')}}</label>
                                    <select class="form-control" id="Status" name="type">
                                        <option value="user" selected>{{__('admin.users')}}</option>
                                        <option value="market" >{{__('admin.markets')}}</option>
                                        <option value="service_provider" >{{__('admin.service_providers')}}</option>
                                    </select>
                                </div>
                                <div class="col-md-6 col-12 p-2">
                                    <div>
                                        <label for="ArabicDescription" class="form-label">{{__('inputs.description_ar')}}</label>
                                        <textarea class="form-control" id="ArabicDescription" placeholder="{{__('inputs.description_ar')}}" rows="5" required name="description_ar"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12 p-2">
                                    <div>
                                        <label for="ArabicDescription" class="form-label">{{__('inputs.description_en')}}</label>
                                        <textarea class="form-control" id="EnglishDescription" placeholder="{{__('inputs.description_en')}}" rows="5" required name="description_en"></textarea>
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
