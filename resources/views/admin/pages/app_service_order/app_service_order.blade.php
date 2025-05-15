@extends('admin.layouts.master')
@section('content')

    @if(admin_user()->havePermission('app_service_order_view'))
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{__('admin.app_service_orders')}}</h4>
                        <div class="page-title-right d-flex align-items-center gap-3 flex-wrap">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('home')}}"> {{__('admin.dashboard')}} </a>
                                </li>
                                <li class="breadcrumb-item active">{{__('admin.app_service_orders')}}</li>
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
                                    <th>{{__('admin.service')}}</th>
                                    <th>{{__('inputs.order_date')}}</th>
                                    <th>{{__('inputs.video')}}</th>
                                    <th>{{__('inputs.address')}}</th>
                                    <th>{{__('inputs.price')}}</th>
                                    <th>{{__('inputs.deposit')}}</th>
                                    <th>{{__('inputs.deposit_paid')}}</th>
                                    <th>{{__('inputs.payment_method')}}</th>
                                    <th>{{__('inputs.note')}}</th>
                                    <th>{{__('admin.images')}}</th>
                                    <th>{{__('inputs.order_status')}}</th>
                                    <th>{{__('buttons.actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($app_service_orders as $order)
                                    @php
                                        $payment = $order->payment_method == "cash"?"cash":"online";
                                        $address = '';
                                        if($order->address_id!=null){
                                            $address = $order->address->address;
                                        }
                                        $status = ['new', 'in_progress', 'service_provider_finish', 'complete','canceled'];

                                    @endphp
                                    <tr id="{{$order->id}}">
                                        <td style="width: 10px;">{{$order->id}}</td>
                                        <td>
                                            <a href="{{route('user.details',['id'=>$order->user_id])}}">{{$order->user->name}}</a>
                                        </td>
                                        <td>
                                            <a href="{{route('service.details',['id'=>$order->app_service_id])}}">{{$order->service->title}}</a>
                                        </td>
                                        <td>{{$order->order_date}}</td>
                                        <td>
                                            @if($order->video!=null)
                                                <img src="{{ $order->video_image }}" alt="Video Thumbnail"
                                                     style="width: 50px; height: 50px; object-fit: cover; border-radius: 12px; cursor: pointer;"
                                                     data-video-url="{{ $order->video }}">
                                            @endif

                                        </td>
                                        <td>{{$address}}</td>
                                        <td>{{$order->price}}</td>
                                        <td>{{$order->deposit}}</td>
                                        <td>{{convertIntToString($order->deposit_paid)}}</td>
                                        <td>{{__('admin.'.$payment)}}</td>
                                        <td>{{$order->notes}}</td>
                                        <td><a class="btn btn-outline-info" href="{{route('app_service_order.images',['serviceOrderId'=>$order->id])}}">{{__('buttons.show_images')}}</a></td>

                                        @if(admin_user()->havePermission('app_service_order_edit'))
                                            <td>
                                                <form onsubmit="return submitForm(this)"
                                                      style="display: flex; width: 100%; flex: 1; gap: 8px;"
                                                      action="{{route('app_service_order.update_status')}}" method="POST"
                                                      enctype="application/x-www-form-urlencoded">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$order->id}}">
                                                    <select style="display: inline-block" class="form-select"
                                                            aria-label="Order Status" name="status">
                                                        @foreach($status as $singleStatus)
                                                            <option @if ($order->status === $singleStatus) selected
                                                                    @endif value="{{$singleStatus}}">{{__('admin.'.$singleStatus)}}</option>
                                                        @endforeach
                                                    </select>
                                                    <button style="display: inline-block"
                                                            class="btn btn-success fs-7 fw-medium" type="submit">
                                                        {{__('buttons.save')}}
                                                    </button>
                                                </form>
                                            </td>
                                        @else
                                            <td>{{__('admin.'.$order->status)}}</td>
                                        @endif


                                        @if(admin_user()->havePermission('app_service_order_edit'))
                                            <td>
                                                <button class="btnn bttn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#confirmModal"
                                                        data-id="{{ $order->id }}" data-url="{{ route('app_service_orders.delete')}}"
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
                            <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="videoModalLabel">{{__('admin.video_preview')}}</h5>
                                        </div>
                                        <div class="modal-body">
                                            <video id="videoPreview" controls style="width: 500px; height: auto;"></video>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

        $(document).ready(function() {
            $('img[data-video-url]').on('click', function() {
                var videoUrl = $(this).data('video-url');
                $('#videoPreview').attr('src', videoUrl);
                $('#videoModal').modal('show');
            });

            $('#videoModal').on('hidden.bs.modal', function () {
                $('#videoPreview').attr('src', '');
            });



        });
    </script>

@stop
