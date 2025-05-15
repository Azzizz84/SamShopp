@extends('admin.layouts.master')
@section('content')
    @if(admin_user()->havePermission('permission_edit'))
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{__('buttons.add_permission')}}</h4>
                <div class="page-title-right d-flex align-items-center gap-3 flex-wrap">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"> {{__('admin.dashboard')}} </a></li>
                        @if(isset($permission))
                            <li class="breadcrumb-item">{{$permission->name}}</li>
                        @else
                            <li class="breadcrumb-item">{{__('admin.permissions')}}</li>
                        @endif
                        <li class="breadcrumb-item active">{{__('buttons.add_permission')}}</li>
                    </ol>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    @php
                        $name_ar = "";
                        $name_en= "";
                        if(isset($permission)){
                            $name_ar = $permission->name_ar??"";
                        $name_en= $permission->name_en??"";
                            $route = route('permission_update');
                        }else{
                            $route = route('permission_store');
                        }
                    @endphp
                    <form action="{{$route}}" method="POST" class="h-100 m-0 row" enctype="application/x-www-form-urlencoded" id="form">
                        @csrf

                        @if(isset($permission))
                            <input type="hidden"  name="id" value="{{$permission->id}}">
                        @endif
                        <div>
                            <label for="name" class="form-label">{{__('inputs.permission_ar')}}</label>
                            <input type="text" class="form-control" id="name" name="name_ar" required value="{{$name_ar}}">
                        </div>
                        <div>
                            <label for="name" class="form-label">{{__('inputs.permission_en')}}</label>
                            <input type="text" class="form-control" id="name" name="name_en" required value="{{$name_en}}">
                        </div>
                        <div class=" p-2">
                            <h5 class="mt-2 mb-2 fw-bold">{{__('admin.permissions')}}</h5>
                        </div>
                        <div class=" row p-2">
                        @foreach($permission_section as $section)
                            @php
                            $viewChecked = 1;
                            $editChecked = 1;
                            if(isset($permission)){
                              if(isset($section['edit'])){
                                  $editChecked = $permission->permissions()->where('key_name',$section['edit'])->exists();
                              }
                                $viewChecked = $permission->permissions()->where('key_name',$section['view'])->exists();
                            }
                            @endphp
                                <div class="col-md-6 col-lg-4 col-xl-3 p-2">
                                    <div class="singleRole">
                                        <h6 class="permsionName"> {{__('admin.'.$section['title'])}} </h6>
                                        <div class="permsionRole">
                                            <label for="viewRole1" class="form-label">
                                                {{__('admin.can_view')}}
                                            </label>
                                            <div
                                                class="form-check form-switch form-switch-right form-switch-md">
                                                <input class="form-check-input code-switcher "
                                                       type="checkbox" id="viewRole1" name="{{$section['view']}}"
                                                       @if($viewChecked) checked @endif>
                                            </div>
                                        </div>
                                        @if(isset($section['edit']))
                                            <div class="permsionRole">
                                                <label for="editRole1" class="form-label">
                                                    {{__('admin.can_edit')}}
                                                </label>
                                                <div
                                                    class="form-check form-switch form-switch-right form-switch-md">
                                                    <input class="form-check-input code-switcher "
                                                           type="checkbox" id="editRole1" @if($editChecked) checked @endif name="{{$section['edit']}}">
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                        @endforeach
                        </div>
                        <div class="p-2 d-flex justify-content-end">
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
                    <script>document.write(new Date().getFullYear())</script> © <a
                        href="#!" target="_blank">{{env('APP_NAME')}}</a>
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
