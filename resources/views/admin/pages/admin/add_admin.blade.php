@extends('admin.layouts.master')
@section('content')
    @if(admin_user()->havePermission('admin_edit'))
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{__('buttons.add_admin')}}</h4>
                <div class="page-title-right d-flex align-items-center gap-3 flex-wrap">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"> {{__('admin.dashboard')}} </a></li>
                        @if(isset($admin))
                            <li class="breadcrumb-item">{{$admin->name}}</li>
                        @else
                            <li class="breadcrumb-item">{{__('admin.admins')}}</li>
                        @endif
                        <li class="breadcrumb-item active">{{__('admin.add_admin')}}</li>
                    </ol>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    @php
                        $name = "";
                        $phone = "";
                        $email = "";
                        $role_id = '0';
                        if(isset($admin)){
                            if(!$admin->super){
                                $role_id = $admin->role->first()->id;
                            }
                            $name = $admin->name??"";
                        $phone= $admin->phone??"";
                        $email= $admin->email??"";
                            $route = route('admin_update');
                        }else{
                            $route = route('admin_store');
                        }
                    @endphp
                    <form action="{{$route}}" method="POST" class="h-100 m-0 row" enctype="application/x-www-form-urlencoded" id="form">
                        @csrf

                        @if(isset($admin))
                            <input type="hidden"  name="id" value="{{$admin->id}}">
                        @endif
                        <div class="col-md-6 col-lg-4 col-12 p-2">
                            <div>
                                <label for="Name" class="form-label">{{__('inputs.name')}}</label>
                                <input type="text" class="form-control" id="Name" placeholder="{{__('inputs.name')}}" required name="name" value="{{$name}}">
                            </div>
                        </div>
                        @if(!isset($admin)||!$admin->super)
                            <div class="col-md-6 col-lg-4 col-12 p-2">
                                <label class="form-label">{{__('inputs.permission')}}</label>
                                <select class="js-example-basic-single" name="role_id">

                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}" @if($role_id==$role->id) selected @endif>{{$role->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                        @endif

                        <div class="col-md-6 col-lg-4 col-12 p-2">
                            <div>
                                <label for="Name" class="form-label">{{__('inputs.phone')}}</label>
                                <input type="text" class="form-control" id="phone" placeholder="{{__('inputs.phone')}}" required name="phone" value="{{$phone}}">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-12 p-2">
                            <div>
                                <label for="Name" class="form-label">{{__('inputs.email')}}</label>
                                <input type="text" class="form-control" id="email" placeholder="{{__('inputs.email')}}" required name="email" value="{{$email}}">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-12 p-2">
                            <div>
                                <label for="Password" class="form-label">{{__('inputs.password')}}</label>
                                <input type="password" class="form-control" id="Password"
                                       placeholder="*******" name="password">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-12 p-2">
                            <label class="form-label">{{__('admin.cities')}}</label>
                            <select class="js-example-basic-multiple" name="cities[]" multiple>
                                @foreach($cities as $city)
                                    @php
                                        $selected = 0;
                                        if(isset($admin)){
                                            $selected = $admin->cities()->where('cities.id',$city->id)->exists();
                                        }
                                    @endphp
                                    <option value="{{$city->id}}" @if($selected==1) selected @endif> {{$city->name}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 p-2 d-flex justify-content-end mt-auto">
                            <button class="btn btn-success fs-7 fw-medium" type="submit">
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

            </div>
        </div>
    </footer>
</div>
    @endif

@stop
