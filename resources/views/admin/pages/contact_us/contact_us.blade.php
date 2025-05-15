

@extends('admin.layouts.master')
@section('content')
    @if(admin_user()->havePermission('contact_us_view'))
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{__('admin.contact_us')}}</h4>
                <div class="page-title-right d-flex align-items-center gap-3 flex-wrap">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"> {{__('admin.dashboard')}} </a></li>
                        <li class="breadcrumb-item active">{{__('admin.contact_us')}}</li>
                    </ol>
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
                            <th>{{__('admin.from')}}</th>
                            <th>{{__('inputs.name')}}</th>
                            <th>{{__('inputs.email')}}</th>
                            <th>{{__('inputs.title')}}</th>
                            <th>{{__('inputs.body')}}</th>
                            <th>{{__('buttons.actions')}}</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($contacts as $contact)
                            @php
                                $route = 'user.details';
                            if($contact->type == 'service_provider'){
                                $route = 'service_provider.details';
                            }else if($contact->type == 'market'){
                                $route = 'markets.details';
                            }
                            @endphp
                            <tr id="{{$contact->id}}">
                                <td style="width: 10px;">{{$contact->id}}</td>
                                <td>{{__('admin.'.$contact->type)}}</td>
                                <td>
                                    <a href="{{route($route,['id'=>$contact->user_id])}}">{{$contact->name}}</a>
                                </td>
                                <td>{{$contact->email}}</td>
                                <td>{{$contact->title}}</td>
                                <td>{{$contact->message}}</td>
                                @if(admin_user()->havePermission('contact_us_edit'))
                                    <td>

                                        <button class="btnn bttn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal"
                                                data-id="{{ $contact->id }}" data-url="{{ route('contact_us.delete')}}"
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
