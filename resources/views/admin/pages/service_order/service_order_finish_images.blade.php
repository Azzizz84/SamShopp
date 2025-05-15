@extends('admin.layouts.master')
@section('content')

    @if(admin_user()->havePermission('service_order_view'))
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{__('admin.service_orders')}}</h4>
                        <div class="page-title-right d-flex align-items-center gap-3 flex-wrap">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('home')}}"> {{__('admin.dashboard')}} </a>
                                </li>
                                <li class="breadcrumb-item active">{{__('admin.service_orders')}}</li>
                            </ol>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table id="example"
                                   class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                   style="width:100%">
                                <thead>
                                <tr>
                                    <th scope="col" style="width: 10px;">
                                        ID
                                    </th>
                                    <th>{{__('inputs.image')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($service_order->finished_images as $image)

                                    <tr id="{{$image->id}}">
                                        <td style="width: 10px;">{{$image->id}}</td>
                                        <td>
                                            <img src="{{ $image->image }}" alt="Video Thumbnail"
                                                 style="width: 50px; height: 50px; object-fit: cover; border-radius: 12px; cursor: pointer;">

                                        </td>

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
                            <script>document.write(new Date().getFullYear())</script>
                            © <a href="#!"
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

