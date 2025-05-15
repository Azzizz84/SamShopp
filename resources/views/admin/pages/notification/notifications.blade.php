@extends('admin.layouts.master')
@section('content')
    @if(admin_user()->havePermission('notification_view'))
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{__('admin.notifications')}}</h4>
                        <div class="page-title-right d-flex align-items-center gap-3 flex-wrap">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('home')}}"> {{__('admin.dashboard')}} </a></li>

                                <li class="breadcrumb-item active">{{__('admin.notifications')}}</li>
                            </ol>
                            @if(admin_user()->havePermission('notification_edit'))
                                <a href="{{route('notification.add')}}" class="btn btn-success">
                                    <i class="ri-add-circle-line align-middle me-1"></i> {{__('buttons.add_notification')}}
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
                                        <th>{{__('inputs.name_ar')}}</th>
                                        <th>{{__('inputs.name_en')}}</th>
                                        <th>{{__('inputs.description_ar')}}</th>
                                        <th>{{__('inputs.description_en')}}</th>
                                        <th>{{__('buttons.actions')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($notifications as $notification)
                                        <tr id="{{$notification->id}}">
                                            <td style="width: 10px;">{{$notification->id}}</td>
                                            <td>{{$notification->title_ar}}</td>
                                            <td>{{$notification->title_en}}</td>
                                            <td><p class="long-text">{{$notification->description_ar}}</p></td>
                                            <td>{{$notification->description_en}}</td>
                                            @if(admin_user()->havePermission('notification_edit'))
                                                <td>
                                                    <button class="btnn bttn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal"
                                                            data-id="{{ $notification->id }}" data-url="{{ route('notification.delete')}}"
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
                            <script>document.write(new Date().getFullYear())</script> © {{env('APP_NAME')}}.
                        </div>
                        <!-- <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                 by <a href="#!" target="_blank">Fans Food
                                </a>
                            </div>
                        </div> -->
                    </div>
                </div>
            </footer>
        </div>
    @endif
        @stop

        @section('js')

        @stop
