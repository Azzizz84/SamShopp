@extends('admin.layouts.master')
@section('content')
    @if(admin_user()->havePermission('market_view'))
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">{{__('admin.markets')}}</h4>
                    <div class="page-title-right d-flex align-items-center gap-3 flex-wrap">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('home')}}"> {{__('admin.dashboard')}} </a></li>
                            <li class="breadcrumb-item active">{{__('admin.markets')}}</li>
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
                                <th scope="col" style="width: 10px;">ID</th>
                                <th>{{__('inputs.name')}}</th>
                                <th>{{__('inputs.description')}}</th>
                                <th>{{__('inputs.image')}}</th>
                                <th>{{__('inputs.logo')}}</th>
                                <th>{{__('inputs.email')}}</th>
                                <th>{{__('inputs.phone')}}</th>
                                <th>{{__('inputs.address')}}</th>
                                <th>{{__('inputs.work_hours')}}</th>
                                <th>{{__('inputs.delivery_price')}}</th>
                                <th>{{__('inputs.active')}}</th>
                                <th>{{__('admin.verified')}}</th>
                                <th>{{__('admin.paid')}}</th>
                                <th>{{__('buttons.view_verification')}}</th>
                                <th>{{__('inputs.section')}}</th>
                                <th>{{__('admin.orders')}}</th>
                                <th>{{__('buttons.ratings')}}</th>
                                <th>{{__('inputs.wallet')}}</th>
                                <th>{{__('inputs.block/un')}}</th>
                                <th>{{__('buttons.actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($markets as $market)
                                @php
                                    $verified = $market->verified==0?"verify":"un_verify";

                                 @endphp
                                <tr id="{{$market->id}}">
                                    <td style="width: 10px;">{{$market->id}}</td>
                                    <td>{{$market->name}}</td>
                                    <td>{{$market->description}}</td>
                                    <td><img src="{{{$market->image}}}" alt="Section Image 3"
                                             style="width: 100%; height: 40px; object-fit: fill;" >
                                    </td>
                                    <td><img src="{{{$market->logo}}}" alt="Section Image 3"
                                             style="width:  40px; height:  40px; object-fit: contain; " >
                                    </td>
                                    <td>{{$market->email}}</td>
                                    <td>{{$market->phone}}</td>
                                    <td>{{$market->address}}</td>
                                    <td>{{$market->work_hours}}</td>
                                    <td>{{$market->delivery_price}}</td>
                                    <td>{{convertIntToString($market->status)}}</td>
                                    <td>@if(admin_user()->havePermission('user_edit'))<button id="block-btn-{{ $market->id }}-active" class="btn btn-outline-success block-btn"
                                                                                              data-status="{{$market->verified}}" data-user-id="{{ $market->id }}"  data-active="{{__("admin.un_verify")}}" data-un-active="{{__("admin.verify")}}" data-url="{{ route("market.update_active") }}" onclick="submitFormButton(this)">
                                            {{__('admin.'. $verified)}}</button>@else
                                            {{__('admin.'. $verified)}}
                                        @endif</td>


                                    <td>{{convertIntToString($market->paid)}}</td>
                                    <td><a href="{{route('verifications',['id'=>$market->id])}}" class="btn btn-success">{{__('admin.verifications')}}</a></td>
                                    <td><a class="btn btn-outline-success" href="{{route('sections',['marketId'=>$market->id])}}">{{__('buttons.view_products')}}</a></td>
                                    <td><a class="btn btn-outline-info" href="{{route('orders.users',['type'=>"market",'id'=>$market->id])}}">{{__('buttons.show_orders')}}</a></td>
                                    <td><a class="btn btn-outline-warning" href="{{route('rates',['marketId' => $market->id])}}">{{__('buttons.view_ratings')}}</a></td>
                                    @if(admin_user()->havePermission('user_edit'))
                                        <td style="display: inline-block; min-width: 100px">
                                            <form onsubmit="return submitForm(this)" id="{{"wallet-form"}}" style="display: flex; width: 100%; flex: 1; gap: 8px;" action="{{route('market.update_wallet')}}" method="POST" enctype="application/x-www-form-urlencoded">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{$market->id}}">
                                                <input type="text" class="form-control" id="{{"wallet".$market->id}}" style="width: 100px; display: inline-block" required name="wallet" value="{{$market->wallet}}">
                                                <button style="display: inline-block" class="btn btn-success fs-7 fw-medium" type="submit" >
                                                    {{__('buttons.save')}}
                                                </button>
                                            </form>
                                        </td>
                                        @php
                                            $block = $market->block==0?"block":"unblock";
                                        @endphp
                                        <td><button id="block-btn-{{ $market->id }}" class="btn btn-outline-dark block-btn"
                                                    data-status="{{$market->block}}" data-user-id="{{ $market->id }}"  data-active="{{__("buttons.unblock")}}" data-un-active="{{__("buttons.block")}}" data-url="{{ route("market.update_block") }}" onclick="submitFormButton(this)">
                                                {{__('buttons.'.$block)}}</button></td>
                                    @else
                                        <td></td>
                                        <td></td>
                                    @endif
                                    @if(admin_user()->havePermission('market_edit'))

                                        <td>
                                            <!-- <button class="btnn bttn-success">
                                                <i class="ri-eye-fill fs-16"></i>
                                            </button> -->

                                            <button class="btnn bttn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal"
                                                    data-id="{{ $market->id }}" data-url="{{ route('markets.delete')}}"
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
@section('js')
    <script>

        function submitFormButton(button) {
            var userId = $(button).data('user-id');
            var status = $(button).data('status');
            var active = $(button).data('active');
            var url = $(button).data('url');
            var unActive = $(button).data('un-active');
            {{--var url = '{{ route("user.update_block") }}';--}}

            // AJAX request
            $.ajax({
                url: url,
                type: 'POST', // Or 'GET' depending on your route configuration
                data: {_token: '{{ csrf_token() }}', id: userId}, // Include CSRF token if required
                beforeSend: function(){
                    $('#global-loader').show();
                },
                success: function(response) {
                    $('#global-loader').hide();
                    if (response.code == 200) {
                        my_toaster('{{ __('admin.success_operation') }}');
                    } else {
                        my_toaster(response.message, 'error');
                    }

                    // Toggle button text based on block status
                    if (status === 0) {
                        $(button).text(active);
                    } else {
                        $(button).text(unActive);
                    }

                    // Update data-block attribute value
                    $(button).data('status', status === 0 ? 1 : 0);
                },
                error: function(data) {
                    $('#global-loader').hide();
                    var error = Object.values(data.responseJSON.errors);
                    $(error).each(function(index, message) {
                        my_toaster(message, 'error');
                    });
                }
            });
        }

    </script>
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
                beforeSend: function(){
                    $('#global-loader').show()
                },
                success: function(data) {
                    window.setTimeout(function() {
                        $('#global-loader').hide()
                        if (data.code == 200) {
                            my_toaster({!! json_encode(__('admin.success_operation')) !!})
                        }
                        if (data.code != 200) {
                            my_toaster(data.message,'error')

                        }
                    }, 1000);

                    // Optionally, display a success message or perform other actions
                },
                error: function (data) {
                    $('#global-loader').hide()
                    var error = Object.values(data.responseJSON.errors);
                    $( error ).each(function(index, message ) {
                        my_toaster(message,'error')
                    });
                }
            });

            // Return false to prevent the default form submission
            return false;
        }

    </script>
@stop
