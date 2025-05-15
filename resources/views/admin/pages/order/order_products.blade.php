

@extends('admin.layouts.master')
@section('content')
    @if(admin_user()->havePermission('order_view'))
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{__('admin.order_products')}}</h4>
                <div class="page-title-right d-flex align-items-center gap-3 flex-wrap">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"> {{__('admin.dashboard')}} </a></li>
                        <li class="breadcrumb-item active">{{__('admin.order_products')}}</li>
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
                            <th>{{__('inputs.logo')}}</th>
                            <th>{{__('inputs.name')}}</th>
                            <th>{{__('inputs.description')}}</th>
                            <th>{{__('inputs.quantity')}}</th>
                            <th>{{__('inputs.price')}}</th>
                            <th>{{__('inputs.total')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order->products as $orderProduct)
                            @php
                            $product = $orderProduct->product;
                            $total = 0;
                            $total += $orderProduct->price;
                            $total = $total*$orderProduct->quantity;
                            @endphp
                            <tr id="{{$product->id}}">
                                <td style="width: 10px;">{{$product->id}}</td>
                                <td><img src="{{{$orderProduct->product->image}}}" alt="Section Image 3"
                                         style="width: 80px; height: 80px; object-fit: cover" >
                                </td>
                                <td>{{$product->title}}</td>
                                <td>{{$product->description}}</td>
                                <td>{{$orderProduct->quantity}}</td>
                                <td>{{$orderProduct->price}}</td>
                                <td>{{$total}}</td>
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
