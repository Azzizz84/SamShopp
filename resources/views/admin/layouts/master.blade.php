@php use Illuminate\Support\Facades\Auth; @endphp
<!doctype html>
<html lang="{{App::getLocale()}}" data-appColor="default" data-layout="vertical" data-topbar="light" data-sidebar="light"
      data-sidebar-size="lg" data-sidebar-image="none" data-preloader="enable" >

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{__('admin.app_dashboard')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="{{env('APP_NAME')}} Admin & Dashboard" name="description" />
    <meta content="{{env('APP_NAME')}}" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset("admin/assets/images/fav.svg")}}">
    <link rel="stylesheet" href="{{asset('admin/assets/libs/glightbox/css/glightbox.min.css')}}">
    <!-- Layout config Js -->

    <script src="{{asset("admin/assets/js/layout.js")}}"></script>
    <!-- Bootstrap Css -->

    <link href="{{asset("admin/assets/css/bootstrap.min.css")}}" id="bootstrapCss" rel="stylesheet" />


    <!-- Icons Css -->
    <link href="{{asset("admin/assets/css/icons.min.css")}}" rel="stylesheet" />
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <!-- select2 Css-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- App Css-->

    <link href="{{asset("admin/assets/css/app.min.css")}}" id="appCss" rel="stylesheet" />

    <!-- custom Css-->
    <link rel="stylesheet" href="{{asset("admin/assets/css/custom.css")}}">
    <style>
        #global-loader {
            display: none; /* Initially hide the loader */
            position: fixed;
            z-index: 9999; /* Ensure the loader appears above all other content */
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(255, 255, 255, 0.7); /* Semi-transparent white background */
        }

        #global-loader .loader-img {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        #imageContainer {
            width: 200px; /* Set the desired width of the container */
            height: 200px; /* Set the desired height of the container */
            border: 0px solid #ccc; /* Optional border styling */
            display: none; /* Use flexbox for centering */
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            overflow: hidden; /* Hide overflow */
        }


        #selectedImage {
            max-width: 100%; /* Ensure the image fits within the container */
            max-height: 100%; /* Ensure the image fits within the container */
            width: auto; /* Allow the width to adjust based on the image */
            height: auto; /* Allow the height to adjust based on the image */
            display: none; /* Ensure the image is displayed as a block element */
            margin: auto; /* Center the image within the container */
        }
        #bannerContainer {
            width: 200px; /* Set the desired width of the container */
            height: 200px; /* Set the desired height of the container */
            border: 0px solid #ccc; /* Optional border styling */
            display: none; /* Use flexbox for centering */
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            overflow: hidden; /* Hide overflow */
        }

        #selectedBanner {
            max-width: 100%; /* Ensure the image fits within the container */
            max-height: 100%; /* Ensure the image fits within the container */
            width: auto; /* Allow the width to adjust based on the image */
            height: auto; /* Allow the height to adjust based on the image */
            display: none; /* Ensure the image is displayed as a block element */
            margin: auto; /* Center the image within the container */
        }

        /*.dtr-data{*/
        /*    white-space: break-spaces;*/
        /*}*/
        #userListChat{
            height: 150px;
            overflow-y: scroll;
        }
        #userListChat::-webkit-scrollbar {
            display: none;
        }
        #chat-container{
            height: 100%;
            overflow-y: scroll;
        }
        #chat-container::-webkit-scrollbar {
            display: none;
        }
        #content-container::-webkit-scrollbar {
            display: none;
        }
        ul.dtr-details {
            display: flex !important;
            flex-direction: column;
        }
        .dtr-details .dtr-data {
            white-space: normal;
            display: inline-flex;
            flex-wrap: wrap;
            gap: 4px;
        }
        .dtr-details > li {
            border-bottom: 1px solid #efefef;
            padding: 0.5em 0;
            display: flex;
            width: 100%;
            flex-wrap: wrap;
            align-items: center;
            gap: 8px;
        }

        @media screen and (max-width: 576px) {
            .container-fluid {
                padding: 0;
            }
            .page-title-box {
                margin: -23px -12px 16px;
                  }
        }
    </style>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="{{asset('admin/assets/libs/quill/quill.core.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("admin/assets/libs/quill/quill.bubble.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("admin/assets/libs/quill/quill.snow.css")}}" rel="stylesheet" type="text/css" />
</head>
@php
    if(admin_user()->super){
        $cities = \App\Models\City::all();
    }else{
        $cities = admin_user()->citites;
    }

@endphp
<body>
<!-- Begin page -->
<div id="global-loader">
    <img src="{{asset("admin/assets/images/loader.svg")}}" class="loader-img" alt="Loader">
</div>
<div id="layout-wrapper">
    <header id="page-topbar">
        <div class="layout-width">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box horizontal-logo">
                        <a href="{{route('home')}}" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{asset("admin/assets/images/fav.svg")}}" alt="" class="menuFav">
                                </span>
                            <span class="logo-lg">
                                    <img src="{{asset("admin/assets/images/logo-dark.svg")}}" alt="" class="menuLogo">
                                </span>
                        </a>
                        <a href="{{route('home')}}" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{asset("admin/assets/images/fav.svg")}}" alt="" class="menuFav">
                                </span>
                            <span class="logo-lg">
                                    <img src="{{asset("admin/assets/images/logo-light.svg")}}" alt="" class="menuLogo">
                                </span>
                        </a>
                    </div>
                    <button type="button"
                            class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger"
                            id="topnav-hamburger-icon">
                            <span class="hamburger-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                    </button>

                    <!-- App Search-->

                </div>
                <div class="d-flex align-items-center">

                    <div style="width: 150px">
                        <select class="js-example-basic-multiple" name="country_id" onchange="redirectToRoute(this)">
                            @foreach($cities as $city)
                                @php
                                    $selected = 0;
                                    if($city->id==admin_user()->city_id){
                                        $selected = 1;
                                    }
                                @endphp
                                <option value="{{$city->id}}" @if($selected==1) selected @endif> {{$city->name}} </option>
                            @endforeach
                        </select>
                    </div>
                    <a href="{{route('change_lang',['lang'=>App::getLocale()=='ar'?'en':"ar"])}}"  class="btn text-dark  btn-ghost-secondary"> {{App::getLocale()=='ar'?"English":"عربي"}} </a>
{{--                    <button id="toggleDirectionBtn" class="btn text-dark  btn-ghost-secondary"> عربي </button>--}}
                    <div class="ms-1 header-item d-none d-sm-flex">
                        <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                                data-toggle="fullscreen">
                            <i class='bx bx-fullscreen fs-22'></i>
                        </button>
                    </div>
                    <div class="ms-1 header-item d-none d-sm-flex">
                        <button type="button"
                                class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                            <i class='bx bx-moon fs-22'></i>
                        </button>
                    </div>

                    <div class="dropdown ms-sm-3 header-item topbar-user">
                        <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="d-flex align-items-center">
                                    <img class="rounded-circle header-profile-user"
                                         src="{{asset("admin/assets/images/users/user-dummy-img.jpg")}}" alt="Header Avatar">
                                    <span class="text-start ms-xl-2">

                                        <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text"> {{admin_user()->name}}
                                        </span>
                                        @if(admin()->check())
                                            <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">{{admin_user()->super?__('admin.super'):admin_user()->role->name}}</span>
                                        @endif
                                    </span>
                                </span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <h6 class="dropdown-header">Welcome {{admin_user()->name}}</h6>
                            <!-- <a class="dropdown-item" href="#!">
                                <i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i>
                                <span class="align-middle">Profile</span>
                            </a>
                            <div class="dropdown-divider"></div> -->
{{--                            <a class="dropdown-item" href="settings.html">--}}
{{--                                <i class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i>--}}
{{--                                <span class="align-middle">Settings</span>--}}
{{--                            </a>--}}
                            <a class="dropdown-item" href="{{route('admin.logout')}}">
                                <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                                <span class="align-middle">{{__('buttons.logout')}}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- removeNotificationModal -->
    <div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            id="NotificationModalbtn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                   colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>Are you sure ?</h4>
                            <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Notification ?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete
                            It!</button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!-- ========== App Menu ========== -->
    <div class="app-menu navbar-menu">
        <!-- LOGO -->
        <div class="navbar-brand-box">
            <!-- Dark Logo-->
            <a href="{{route('home')}}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{asset("admin/assets/images/fav.svg")}}" class="menuFav" alt="">
                    </span>
                <span class="logo-lg">
                        <img src="{{asset("admin/assets/images/logo-dark.svg")}}" class="menuLogo" alt="">
                    </span>
            </a>
            <!-- Light Logo-->
            <a href="{{route('home')}}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{asset("admin/assets/images/fav2.svg")}}" class="menuFav" alt="">
                    </span>
                <span class="logo-lg">
                        <img src="{{asset("admin/assets/images/logo-light.svg")}}" class="menuLogo" alt="">
                    </span>
            </a>
            <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                    id="vertical-hover">
                <i class="ri-record-circle-line"></i>
            </button>
        </div>

        <div id="scrollbar">
            <div class="container-fluid">
                <div id="two-column-menu">
                </div>
                    <ul class="navbar-nav" id="navbar-nav">

                @if(admin()->check())


                        <li class="menu-title"><span>{{__('admin.main_pages')}}</span></li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{route('home')}}">
                                <i class="ri-dashboard-2-line"></i> <span>{{__('admin.dashboard')}}</span>
                            </a>
                        </li>
                            @if(admin_user()->havePermission('city_view'))
                                <li class="nav-item">
                                    <a class="nav-link menu-link" href="{{route('cities')}}">
                                        <i class="ri-building-line"></i> <span>{{__('admin.cities')}}</span>
                                    </a>
                                </li>
                            @endif
                            @if(admin_user()->havePermission('banner_view'))
                                <li class="nav-item">
                                    <a class="nav-link menu-link" href="{{route('banners')}}">
                                        <i class="ri-coupon-line"></i> <span>{{__('admin.banners')}}</span>
                                    </a>
                                </li>
                            @endif
                        @if(admin_user()->havePermission('user_view'))
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{route('users')}}">
                                    <i class="ri-group-line"></i> <span>{{__('admin.users')}}</span>
                                </a>
                            </li>
                        @endif
                            @if(admin_user()->havePermission('service_provider_view'))
                                <li class="nav-item">
                                    <a class="nav-link menu-link" href="{{route('service_providers')}}">
                                        <i class="ri-group-line"></i> <span>{{__('admin.service_providers')}}</span>
                                    </a>
                                </li>
                            @endif
                        @if(admin_user()->havePermission('category_view'))
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{route('categories')}}">
                                    <i class="ri-apps-line"></i> <span>{{__('admin.categories')}}</span>
                                </a>
                            </li>
                        @endif
                            @if(admin_user()->havePermission('service_view'))
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{route('services')}}">
                                    <i class="ri-service-line"></i> <span>{{__('admin.services')}}</span>
                                </a>
                            </li>
                        @endif
                        @if(admin_user()->havePermission('market_view'))
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{route('markets')}}">
                                    <i class="ri-store-2-line"></i> <span>{{__('admin.markets')}}</span>
                                </a>
                            </li>
                        @endif
                        @if(admin_user()->havePermission('banner_view'))
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{route('banners')}}">
                                    <i class="ri-coupon-line"></i> <span>{{__('admin.banners')}}</span>
                                </a>
                            </li>
                        @endif
                        @if(admin_user()->havePermission('order_view'))
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{route('orders')}}">
                                    <i class="ri-order-play-line"></i> <span>{{__('admin.orders')}}</span>
                                </a>
                            </li>
                        @endif
                            @if(admin_user()->havePermission('service_order_view'))
                                <li class="nav-item">
                                    <a class="nav-link menu-link" href="{{route('service_orders')}}">
                                        <i class="ri-order-play-line"></i> <span>{{__('admin.service_orders')}}</span>
                                    </a>
                                </li>
                            @endif
                            @if(admin_user()->havePermission('app_service_order_view'))
                                <li class="nav-item">
                                    <a class="nav-link menu-link" href="{{route('app_service_orders')}}">
                                        <i class="ri-order-play-line"></i> <span>{{__('admin.app_service_orders')}}</span>
                                    </a>
                                </li>
                            @endif
                        @if(admin_user()->havePermission('notification_view'))
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{route('notifications')}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M4 19v-2h2v-7q0-2.075 1.25-3.687T10.5 4.2v-.7q0-.625.438-1.062T12 2t1.063.438T13.5 3.5v.7q2 .5 3.25 2.113T18 10v7h2v2zm8 3q-.825 0-1.412-.587T10 20h4q0 .825-.587 1.413T12 22"/></svg> <span>{{__('admin.notifications')}} </span>
                                </a>
                            </li>
                        @endif
                            @if(admin_user()->havePermission('contact_us_view'))
                                <li class="nav-item">
                                    <a class="nav-link menu-link" href="{{route('contact_us')}}">
                                        <i class="ri-customer-service-2-line"></i> <span>{{__('admin.contact_us')}}</span>
                                    </a>
                                </li>
                            @endif
                        @if(admin_user()->havePermission('settings_view'))
                            <li class="menu-title"><span>{{__('admin.settings')}}</span></li>
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{route('settings')}}">
                                    <i class="ri-equalizer-line"></i> <span>{{__('admin.settings')}}</span>
                                </a>
                            </li>
                        @endif
                        @if(admin_user()->havePermission('permission_view'))
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{route('permissions')}}">
                                    <i class="ri-settings-5-line"></i> <span>{{__('admin.permissions')}}</span>
                                </a>
                            </li>
                        @endif
                        @if(admin_user()->havePermission('admin_view'))
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{route('admins')}}">
                                    <i class="ri-file-user-line"></i> <span>{{__('admin.admins')}}</span>
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{route('theme')}}">
                                <i class="ri-shape-fill"></i> <span>{{__('admin.theme')}}</span>
                            </a>
                        </li>
                @endif
                    </ul>
            </div>
            <!-- Sidebar -->
        </div>

        <div class="sidebar-background"></div>
    </div>
    <!-- Left Sidebar End -->
    <!-- Vertical Overlay-->
    <div class="vertical-overlay"></div>
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    @yield('content')
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">{{__('admin.confirmation')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="confirmToggleCancel">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{__('admin.confirmation_delete')}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="confirmToggleCancelButton">{{__('buttons.cancel')}}</button>
                    <button type="button" class="btn btn-danger" id="confirmToggle">{{__('buttons.confirm')}}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end main content-->
</div>
<!--start back-to-top-->
<button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
    <i class="ri-arrow-up-line"></i>
</button>
<!--preloader-->
<div id="preloader">
    <div id="status">
        <div class="spinner-border text-primary avatar-sm" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>

<!-- +++++++++++++++++++++++++++++++++++++ -->
<!-- +++++++++++++++++++++++++++++++++++++ -->
<!-- +++++++++++++++ JAVASCRIPT ++++++++++ -->
<!-- +++++++++++++++++++++++++++++++++++++ -->
<!-- +++++++++++++++++++++++++++++++++++++ -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="{{asset("admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<script src="{{asset("admin/assets/libs/simplebar/simplebar.min.js")}}"></script>
<script src="{{asset("admin/assets/libs/node-waves/waves.min.js")}}"></script>
<script src="{{asset("admin/assets/libs/feather-icons/feather.min.js")}}"></script>
<!-- apexcharts -->
<script src="{{asset("admin/assets/libs/apexcharts/apexcharts.min.js")}}"></script>
<!-- App js -->
<script src="{{asset("admin/assets/js/app.js")}}"></script>
{{--<script src="{{asset("admin/assets/js/directionChange.js")}}"></script>--}}

<!-- piecharts init -->
<script src="{{asset("admin/assets/js/pages/apexcharts-costom.js")}}"></script>
<!--jquery cdn-->
{{--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}
<!--select2 cdn-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- select 2 init -->
<script src="{{asset("admin/assets/js/pages/select2.init.js")}}" ></script>
<!--datatable js-->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>


<script src="{{asset("admin/assets/js/pages/datatables.init.js")}}"></script>
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

@include('admin.layouts.toaster')

<script>

    $.ajaxSetup({
        headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });

    $(document).on('click', '#delete_dialog', function() {
        var id = $(this).data('id');
        var url = $(this).data('url');
        $('#confirmToggle').data('id', id);
        $('#confirmToggle').data('url', url);
    });

    $(document).ready(function() {



        $('#confirmToggle').click(function() {

            $('#confirmModal').modal('hide');
            var id = $(this).data('id');
            var url = $(this).data('url');
            // Send Ajax request
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    "id": id,
                    '_token': "<?php echo e(csrf_token()); ?>",
                },
                // cache: false,
                // contentType: false,
                // processData: false,
                beforeSend: function(){
                    $('#global-loader').show()
                },
                success: function (data) {
                    window.setTimeout(function() {
                        $('#global-loader').hide()
                        if (data.code === 200) {
                            if(data.data==='delete'){
                                var rowToDelete = document.getElementById(id);
                                if (rowToDelete) {
                                    if (rowToDelete.classList.contains('dt-hasChild')) {
                                        var nextElement = rowToDelete.nextElementSibling;
                                        nextElement.remove();
                                    }
                                    rowToDelete.remove();

                                }
                                // $('#'+id).remove();
                            }else{
                                window.location.href = data.data;
                            }

                            my_toaster({!! json_encode(__('admin.success_operation')) !!})
                        }
                        if (data.code != 200) {
                            my_toaster(data.message,'error')

                        }
                    }, 1000);
                }, error: function (data) {
                    $('#global-loader').hide()
                    var error = Object.values(data.responseJSON.errors);
                    $( error ).each(function(index, message ) {
                        my_toaster(message,'error')
                    });
                }
            });
        });
        $('#confirmToggleCancel').click(function() {
            $('#confirmModal').modal('hide');
        });
        $('#confirmToggleCancelButton').click(function() {
            $('#confirmModal').modal('hide');
        });
    });

</script>
<script>
    var input = document.getElementById('Image');

    // Add an event listener to listen for changes in the file input
    if(input !== null){
        input.addEventListener('change', function(event) {
            // Get the selected file
            var file = event.target.files[0];

            // Check if a file was selected
            if (file) {
                // Create a FileReader object
                var reader = new FileReader();

                // Set up the FileReader to read the selected file as a data URL
                reader.readAsDataURL(file);

                // When the FileReader has loaded the file, update the image source
                reader.onload = function() {
                    var img = document.getElementById('selectedImage');
                    var imageContainer = document.getElementById('imageContainer');
                    img.src = reader.result;
                    img.style.display = 'block'; // Show the image
                    imageContainer.style.display = 'flex'; // Show the image
                    // imageContainer.style.height = img.height + 'px';
                };
            }
        });
    }
</script>
<script>
    var input = document.getElementById('Banner');
    if(input !== null){
        input.addEventListener('change', function(event) {
            // Get the selected file
            var file = event.target.files[0];

            // Check if a file was selected
            if (file) {
                // Create a FileReader object
                var reader = new FileReader();

                // Set up the FileReader to read the selected file as a data URL
                reader.readAsDataURL(file);

                // When the FileReader has loaded the file, update the image source
                reader.onload = function() {
                    var img = document.getElementById('selectedBanner');
                    var imageContainer = document.getElementById('bannerContainer');
                    img.src = reader.result;
                    img.style.display = 'block'; // Show the image
                    imageContainer.style.display = 'flex'; // Show the image
                    // imageContainer.style.height = img.height + 'px';
                };
            }
        });
    }
    // Add an event listener to listen for changes in the file input

</script>
<script>
    $(document).on('submit', '#form', function (event) {
        event.preventDefault();
        var form_data = new FormData(document.getElementById("form"));
        var url = $('#form').attr('action');
        $.ajax({
            type: 'POST',
            url: url,
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function(){
                $('#global-loader').show()
            },
            success: function (data) {
                window.setTimeout(function() {
                    $('#global-loader').hide()
                    if (data.code == 200) {
                        window.location.href = data.data;
                        my_toaster({!! json_encode(__('admin.success_operation')) !!})
                    }
                    if (data.code != 200) {
                        my_toaster(data.message,'error')

                    }
                }, 1000);
            }, error: function (data) {
                $('#global-loader').hide()
                var error = Object.values(data.responseJSON.errors);
                $( error ).each(function(index, message ) {
                    my_toaster(message,'error')
                });
            }
        });
    });
</script>
<script>
    function redirectToRoute(selectElement) {
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        var selectedCityId = selectedOption.value;

        // Construct the URL with the route and country ID
        var url = "{{ route('city.change', ':id') }}".replace(':id', selectedCityId);

        // Redirect to the route with the country ID parameter
        window.location.href = url;
    }
</script>
@yield('js')
</body>

</html>

