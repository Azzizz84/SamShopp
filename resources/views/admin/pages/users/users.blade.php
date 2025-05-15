@extends('admin.layouts.master')

@section('content')
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{__('admin.users')}}</h4>
                        <div class="page-title-right d-flex align-items-center gap-3 flex-wrap">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('home')}}"> {{__('admin.dashboard')}} </a></li>
                                <li class="breadcrumb-item active">{{__('admin.users')}}</li>
                            </ol>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            @if(admin_user()->havePermission('user_view'))
                            <table id="example"
                                class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 10px;">ID</th>
                                        <th>{{__('inputs.name')}}</th>
                                        <th>{{__('inputs.email')}}</th>
                                        <th>{{__('inputs.image')}}</th>
                                        <th>{{__('inputs.phone')}}</th>
                                        <th>{{__('inputs.wallet')}}</th>
                                        <th>{{__('inputs.block/un')}}</th>
                                        <th>{{__('admin.orders')}}</th>
                                        <th>{{__('admin.service_orders')}}</th>
                                        <th>{{__('buttons.actions')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr id="{{$user->id}}">
                                            <td style="width: 10px;">{{$user->id}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td><img src="{{$user->image}}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 12px;"></td>
                                            <td>{{$user->phone}}</td>
                                            @if(admin_user()->havePermission('user_edit'))
                                                <td style="display: inline-block; min-width: 100px">
                                                    <form onsubmit="return submitForm(this)" id="{{"wallet-form"}}" style="display: flex; width: 100%; flex: 1; gap: 8px;" action="{{route('user.update_wallet')}}" method="POST" enctype="application/x-www-form-urlencoded">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{$user->id}}">
                                                        <input type="text" class="form-control" id="{{"wallet".$user->id}}" style="width: 100px; display: inline-block" required name="wallet" value="{{$user->wallet}}">
                                                        <button style="display: inline-block" class="btn btn-success fs-7 fw-medium" type="submit" >
                                                            {{__('buttons.save')}}
                                                        </button>
                                                    </form>
                                                </td>
                                                @php
                                                    $block = $user->block==0?"block":"unblock";
                                                @endphp
                                                <td><button id="block-btn-{{ $user->id }}" class="btn btn-outline-dark block-btn" data-user-id="{{ $user->id }}" data-block="{{ $user->block }}" onclick="submitFormButton(this)">
                                                        {{__('buttons.'.$block)}}</button></td>
                                            @else
                                                <td></td>
                                                <td></td>
                                            @endif

                                            <td><a href="{{route('orders.users',['type'=>"user",'id'=>$user->id])}}" class="btn btn-outline-info">{{__('buttons.show_orders')}}</a></td>
                                            <td><a href="{{route('service_orders.users',['type'=>"user",'id'=>$user->id])}}" class="btn btn-outline-warning">{{__('buttons.show_service_orders')}}</a></td>
                                            @if(admin_user()->havePermission('user_edit'))
                                                <td>
                                                    <button class="btnn bttn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal"
                                                            data-id="{{ $user->id }}" data-url="{{ route('user.delete')}}"
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
                            @endif
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
@stop

@section('js')
    <script>

        function submitFormButton(button) {
            var userId = $(button).data('user-id');
            var block = $(button).data('block');
            var url = '{{ route("user.update_block") }}';

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
                    if (block === 0) {
                        $(button).text({!! json_encode(__('buttons.unblock')) !!});
                    } else {
                        $(button).text({!! json_encode(__('buttons.block')) !!});
                    }

                    // Update data-block attribute value
                    $(button).data('block', block === 0 ? 1 : 0);
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
