@extends('admin.layouts.master')
@section('content')

    @if(admin_user()->havePermission('rate_view'))
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{__('admin.rates')}}</h4>
                <div class="page-title-right d-flex align-items-center gap-3 flex-wrap">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"> {{__('admin.dashboard')}} </a></li>
                        <li class="breadcrumb-item active">{{$market->name}}</li>
                    </ol>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <table id="branchTable"
                           class="table table-bordered dt-responsive nowrap table-striped align-middle"
                           style="width:100%">
                        <thead>
                        <tr>
                            <th scope="col" style="width: 10px;">ID</th>
                            <th>{{__('inputs.user_name')}}</th>
                            <th>{{__('inputs.comment')}}</th>
                            <th>{{__('inputs.rate')}}</th>
                            <th>{{__('buttons.actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($market->comments as $rate)
                            <tr id="{{$rate->id}}">
                                <td style="width: 10px;">{{$rate->id}}</td>
                                @php
                                $user_route = '';
                                if(admin()->check()){
                                   $user_route = route('user.details',['id'=>$rate->user_id]);
                                }
                                @endphp
                                <td><a href="{{$user_route}}">{{$rate->user->name}}</a></td>
                                <td>{{$rate->comment}}</td>
                                <td>{{$rate->rate}}</td>
                                @if(admin_user()->havePermission('rate_edit'))
                                    <td>
                                        <button class="btnn bttn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal"
                                                data-id="{{ $rate->id }}" data-url="{{ route('rate.delete',['marketId' => $market->id])}}"
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
                    <script>document.write(new Date().getFullYear())</script> © {{env('APP_NAME')}}
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
