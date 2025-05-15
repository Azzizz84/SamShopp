@extends('admin.layouts.master')
@section('content')

    @if(admin_user()->havePermission('order_view'))
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{__('admin.orders')}}</h4>
                        <div class="page-title-right d-flex align-items-center gap-3 flex-wrap">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('home')}}"> {{__('admin.dashboard')}} </a>
                                </li>
                                <li class="breadcrumb-item active">{{__('admin.orders')}}</li>
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
                                    <th>{{__('inputs.user_name')}}</th>
                                    <th>{{__('inputs.market_name')}}</th>
                                    <th>{{__('inputs.sub_total')}}</th>
                                    <th>{{__('inputs.delivery_price')}}</th>
                                    <th>{{__('inputs.taxes')}}</th>
                                    <th>{{__('inputs.total')}}</th>
                                    <th>{{__('inputs.payment_method')}}</th>
                                    <th>{{__('inputs.comment')}}</th>
                                    <th>{{__('inputs.address')}}</th>
                                    <th>{{__('admin.products')}}</th>
                                    <th>{{__('inputs.order_status')}}</th>
                                    <th>{{__('buttons.actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    @php
                                        $payment = $order->payment_method == "cash"?"cash":"online";
                                        $address = '';
                                        if($order->address_id!=null){
                                            $address = $order->address->address;
                                        }
                                        $status = ['new', 'in_progress', 'delivery', 'complete','canceled'];
                                        $route = null;
                                        $order_products_route = 'order_product';
                                    @endphp
                                    <tr id="{{$order->id}}">
                                        <td style="width: 10px;">{{$order->id}}</td>
                                        <td>
                                            <a href="{{route('user.details',['id'=>$order->user_id])}}">{{$order->user->name}}</a>
                                        </td>
                                        <td>
                                            <a href="{{route('markets.details',['id'=>$order->market_id])}}">{{$order->market->name}}</a>
                                        </td>
                                        <td>{{$order->sub_total}}</td>
                                        <td>{{$order->delivery_price}}</td>
                                        <td>{{$order->taxes}}</td>
                                        <td>{{$order->total}}</td>
                                        <td>{{__('admin.'.$payment)}}</td>
                                        <td>{{$order->note}}</td>
                                        <td>{{$address}}</td>
                                        <td><a class="btn btn-outline-info"
                                               href="{{route($order_products_route,['orderId'=>$order->id])}}">{{__('buttons.view_order_products')}}</a>
                                        </td>
                                        <td>{{__('admin.'.$order->status)}}</td>


                                        @if(admin_user()->havePermission('order_edit'))
                                            <td>
                                                <button class="btnn bttn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#confirmModal"
                                                        data-id="{{ $order->id }}" data-url="{{ route('order.delete')}}"
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

@section('js')
    <script>
        function submitForm(form) {
            // Your AJAX submission logic here
            var formData = new FormData(form);

            // Example AJAX request
            $.ajax({
                url: form.action,
                method: form.method,
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function () {
                    $('#global-loader').show()
                },
                success: function (data) {
                    window.setTimeout(function () {
                        $('#global-loader').hide()
                        if (data.code == 200) {
                            my_toaster({!! json_encode(__('admin.success_operation')) !!})
                        }
                        if (data.code != 200) {
                            my_toaster(data.message, 'error')

                        }
                    }, 1000);

                    // Optionally, display a success message or perform other actions
                },
                error: function (data) {
                    $('#global-loader').hide()
                    var error = Object.values(data.responseJSON.errors);
                    $(error).each(function (index, message) {
                        my_toaster(message, 'error')
                    });
                }
            });

            // Return false to prevent the default form submission
            return false;
        }

    </script>
@stop
