@extends('admin.layouts.master')
@section('content')
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        @if(admin_user()->havePermission('service_edit'))
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{__('buttons.add_service')}}</h4>
                        <div class="page-title-right d-flex align-items-center gap-3 flex-wrap">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('home')}}"> {{__('admin.dashboard')}} </a></li>
                                @if(isset($service))
                                    <li class="breadcrumb-item">{{$service->title}}</li>
                                @else
                                    <li class="breadcrumb-item">{{__('admin.services')}}</li>
                                @endif
                                <li class="breadcrumb-item active">{{__('buttons.add_service')}}</li>
                            </ol>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            @php
                                $title_ar = "";
                                $title_en= "";
                                $description_ar= "";
                                $description_en= "";
                                $price= "";
                                $offer_price= "";
                                $deposit= "";
                                $subCategories = [];
                                $category_id = 0;
                                $sub_category_id = 0;
                                if(isset($service)){
                                    if($service->category!=null){
                                        $subCategories = $service->category->subCategories;
                                    }

                                    $category_id = $service->category_id;
                                    $sub_category_id = $service->sub_category_id;
                                    $title_ar = $service->title_ar??"";
                                    $title_en = $service->title_en??"";
                                    $description_ar = $service->description_ar??"";
                                    $description_en = $service->description_en??"";
                                    $price = $service->price??"";
                                    $deposit = $service->deposit??"";
                                    $offer_price = $service->offer_price??"";
                                    $route = route('service_update');
                                }else{
                                    $route = route('service_store',);
                                }
                            @endphp
                            <form action="{{$route}}" method="POST" class="h-100 m-0 row" enctype="application/x-www-form-urlencoded" id="form">
                                @csrf

                                @if(isset($service))
                                    <input type="hidden"  name="id" value="{{$service->id}}">
                                @endif
                                <div class="col-md-6 col-lg-4 col-12 p-2">
                                    <div>
                                        <label for="ArabicName" class="form-label">{{__('inputs.name_ar')}}</label>
                                        <input type="text" class="form-control" id="ArabicName" placeholder="" required name="title_ar" value="{{$title_ar}}" >
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 col-12 p-2">
                                    <div>
                                        <label for="EnglishName" class="form-label">{{__('inputs.name_en')}}</label>
                                        <input type="text" class="form-control" id="EnglishName" placeholder="" required name="title_en" value="{{$title_en}}">
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-4 col-12 p-2">
                                    <div>
                                        <label for="EnglishName" class="form-label">{{__('inputs.price')}}</label>
                                        <input type="number" step="0.01" class="form-control" id="EnglishName" placeholder="30.5" required name="price" value="{{$price}}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 col-12 p-2">
                                    <div>
                                        <label for="EnglishName" class="form-label">{{__('inputs.offer_price')}}</label>
                                        <input type="number" step="0.01" class="form-control" id="EnglishName" placeholder="" name="offer_price" value="{{$offer_price}}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 col-12 p-2">
                                    <div>
                                        <label for="EnglishName" class="form-label">{{__('inputs.deposit')}}</label>
                                        <input type="number" step="0.01" class="form-control" id="EnglishName" placeholder="" name="deposit" value="{{$deposit}}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 col-12 p-2">
                                    <label class="form-label">{{__('admin.categories')}}</label>
                                    <select class="js-example-basic-single" id="categorySelect" name="category_id">
                                        <option>{{__('admin.empty')}}</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" @if($category_id==$category->id) selected @endif>{{$category->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-md-6 col-lg-4 col-12 p-2">
                                    <label class="form-label">{{__('admin.sub_categories')}}</label>
                                    <select class="js-example-basic-single" name="sub_category_id">
                                        <option value="">{{__('admin.empty')}}</option>
                                        @foreach($subCategories as $subCategory)
                                            <option value="{{$subCategory->id}}" @if($sub_category_id==$subCategory->id) selected @endif>{{$subCategory->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-md-6 col-lg-4 col-12 p-2">
                                    <div>
                                        <label for="Image" class="form-label">{{__('inputs.image')}}</label>
                                        <input type="file" class="form-control" id="Image" name="image" @if(!isset($service))required @endif accept="image/*">
                                        <br>
                                        <div id="imageContainer">
                                            <img id="selectedImage" src="#" alt="Selected Image">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12 p-2">
                                    <div>
                                        <label for="ArabicDescription" class="form-label">{{__('inputs.description_ar')}}</label>
                                        <textarea class="form-control" id="ArabicDescription" placeholder="{{__('inputs.description_ar')}}" rows="5" required name="description_ar" value="{{$description_ar}}"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12 p-2">
                                    <div>
                                        <label for="ArabicDescription" class="form-label">{{__('inputs.description_en')}}</label>
                                        <textarea class="form-control" id="EnglishDescription" placeholder="{{__('inputs.description_en')}}" rows="5" required name="description_en" value="{{$description_ar}}"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 p-2 d-flex justify-content-end mt-auto">
                                    <button class="btn btn-success fs-7 fw-medium" type="submit" >
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
                            <script>document.write(new Date().getFullYear())</script> © {{env('APP_NAME')}}
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                 by <a href="https://epalsolutions.com" target="_blank">Epal
                                    Solutions</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        @endif
        <!-- end main content-->
@stop

@section('js')
    <script>
        var check = {!! json_encode(isset($service)?true:false) !!};
        if(check===true){
            var description_ar = {!! json_encode(isset($service->description_ar)?$service->description_ar:"") !!};
            var description_en = {!! json_encode(isset($service->description_en)?$service->description_en:"") !!};
            document.getElementById("ArabicDescription").defaultValue = description_ar;
            document.getElementById("EnglishDescription").defaultValue = description_en;
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#categorySelect').on('change', function() {
                var categoryId = $(this).val();
                var categoryIdInt = parseInt(categoryId, 10);
                if (Number.isInteger(categoryIdInt)) {
                    $.ajax({
                        url: '{{ route('admin.sub_categories') }}', // Replace with your server endpoint
                        type: 'POST',
                        data: {
                            id: categoryId,
                            _token: '{{ csrf_token() }}'
                        },
                        beforeSend: function(){
                            $('#global-loader').show();
                        },
                        success: function(response) {
                            $('#global-loader').hide();
                            if(response.code===200){
                                var subCategories = response.data; // Assuming response.data contains an array of sub-categories

                                // Clear existing options
                                $('select[name="sub_category_id"]').empty();

                                // Add the default empty option
                                $('select[name="sub_category_id"]').append('<option value="">{{__("admin.empty")}}</option>');

                                // Loop through subcategories and append options dynamically
                                $.each(subCategories, function(index, subCategory) {
                                    $('select[name="sub_category_id"]').append('<option value="' + subCategory.id + '">' + subCategory.name + '</option>');
                                });
                            }else{
                                my_toaster(response.message,'error');
                            }
                        },
                        error: function(xhr, status, error) {
                            $('#global-loader').hide();
                            alert(error);
                        }
                    })
                }else{
                    $('select[name="sub_category_id"]').empty();
                    $('select[name="sub_category_id"]').append('<option value="">{{__("admin.empty")}}</option>');
                }

            });
        });
    </script>
@stop
