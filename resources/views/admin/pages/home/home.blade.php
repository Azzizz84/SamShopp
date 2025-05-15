@extends('admin.layouts.master')

@section('content')
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{__("admin.dashboard")}}</h4>
                        <div class="page-title-right d-flex align-items-center gap-3 flex-wrap">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('home')}}"> {{__("admin.dashboard")}} </a></li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 p-2">
                            <div class="row">
                                <a href="{{route('orders')}}" class="col-lg-4 col-md-6 p-2">
                                    <div style="background-color: #6fcbfa;" class="card-tr">
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="48" height="48" x="0"
                                            y="0" viewBox="0 0 682.667 682.667"
                                            style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                            <g>
                                                <defs>
                                                    <clipPath id="a" clipPathUnits="userSpaceOnUse">
                                                        <path d="M0 512h512V0H0Z" fill="#ffffff" opacity="1"
                                                            data-original="#000000"></path>
                                                    </clipPath>
                                                </defs>
                                                <g clip-path="url(#a)"
                                                    transform="matrix(1.33333 0 0 -1.33333 0 682.667)">
                                                    <path d="m0 0-60-90h-186l60 90z"
                                                        style="stroke-linecap: round; stroke-linejoin: round; stroke-miterlimit: 10; stroke-dasharray: none; stroke-opacity: 1;"
                                                        transform="translate(256 256)" fill="none" stroke="#FFFFFF"
                                                        stroke-width="20px" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-miterlimit="10"
                                                        stroke-dasharray="none" stroke-opacity=""
                                                        data-original="#000000" class="" opacity="1"></path>
                                                    <path d="M0 0v-156h372V0"
                                                        style="stroke-linecap: round; stroke-linejoin: round; stroke-miterlimit: 10; stroke-dasharray: none; stroke-opacity: 1;"
                                                        transform="translate(70 166)" fill="none" stroke="#FFFFFF"
                                                        stroke-width="20px" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-miterlimit="10"
                                                        stroke-dasharray="none" stroke-opacity=""
                                                        data-original="#000000" class="" opacity="1"></path>
                                                    <path d="M0 0v246"
                                                        style="stroke-linecap: round; stroke-linejoin: round; stroke-miterlimit: 10; stroke-dasharray: none; stroke-opacity: 1;"
                                                        transform="translate(256 10)" fill="none" stroke="#FFFFFF"
                                                        stroke-width="20px" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-miterlimit="10"
                                                        stroke-dasharray="none" stroke-opacity=""
                                                        data-original="#000000" class="" opacity="1"></path>
                                                    <path
                                                        d="M0 0c-53.38 44.48-90 67.8-90 103.03C-90 128.5-71.64 150-45 150c34.2 0 45-37.5 45-37.5S10.8 150 45 150c26.64 0 45-21.5 45-46.97C90 67.8 53.38 44.48 0 0Z"
                                                        style="stroke-linecap: round; stroke-linejoin: round; stroke-miterlimit: 10; stroke-dasharray: none; stroke-opacity: 1;"
                                                        transform="translate(196 352)" fill="none" stroke="#FFFFFF"
                                                        stroke-width="20px" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-miterlimit="10"
                                                        stroke-dasharray="none" stroke-opacity=""
                                                        data-original="#000000" class="" opacity="1"></path>
                                                    <path
                                                        d="M0 0s7.2 26.25 30 26.25c17.76 0 30-15.05 30-32.88 0-24.66-24.42-40.98-60-72.12-35.58 31.14-60 47.46-60 72.12 0 17.83 12.24 32.88 30 32.88C-7.2 26.25 0 0 0 0Z"
                                                        style="stroke-linecap: round; stroke-linejoin: round; stroke-miterlimit: 10; stroke-dasharray: none; stroke-opacity: 1;"
                                                        transform="translate(376 400.75)" fill="none" stroke="#FFFFFF"
                                                        stroke-width="20px" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-miterlimit="10"
                                                        stroke-dasharray="none" stroke-opacity=""
                                                        data-original="#000000" class="" opacity="1"></path>
                                                    <path
                                                        d="M0 0c-5.518 0-10 4.482-10 10s4.482 10 10 10 10-4.482 10-10S5.518 0 0 0"
                                                        style="fill-opacity:1;fill-rule:nonzero;stroke:none"
                                                        transform="translate(359 246)" fill="#FFFFFF"
                                                        data-original="#000000" opacity="1"></path>
                                                    <path d="M0 0h-58L2-90h186L128 0H90"
                                                        style="stroke-linecap: round; stroke-linejoin: round; stroke-miterlimit: 10; stroke-dasharray: none; stroke-opacity: 1;"
                                                        transform="translate(314 256)" fill="none" stroke="#FFFFFF"
                                                        stroke-width="20px" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-miterlimit="10"
                                                        stroke-dasharray="none" stroke-opacity=""
                                                        data-original="#000000" class="" opacity="1"></path>
                                                </g>
                                            </g>
                                        </svg>
                                        <div style="text-align: center;">
                                            <h2>{{$data['orders']}}</h2>
                                            <p>{{__('admin.orders')}}</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="{{route('users')}}" class="col-lg-4 col-md-6 p-2">
                                    <div style="background-color: #ffe2e6;" class="card-tr">
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="48" height="48" x="0"
                                            y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512"
                                            xml:space="preserve" class="">
                                            <g>
                                                <g fill="#000" fill-rule="evenodd" clip-rule="evenodd">
                                                    <path
                                                        d="M12 11.667A3.333 3.333 0 1 0 12 5a3.333 3.333 0 0 0 0 6.667zm0-1A2.333 2.333 0 1 0 12 6a2.333 2.333 0 0 0 0 4.667zM7.5 10.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0zm-1 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"
                                                        fill="#FFFFFF" opacity="1" data-original="#000000" class="">
                                                    </path>
                                                    <path
                                                        d="M1.5 19v-2a3.5 3.5 0 0 1 6.428-1.918 4.5 4.5 0 0 1 8.144 0A3.5 3.5 0 0 1 22.5 17v2a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5zm1-2a2.5 2.5 0 0 1 5 0v1.5h-5zm19 1.5V17a2.5 2.5 0 0 0-5 0v1.5zm-6 0V17a3.5 3.5 0 1 0-7 0v1.5z"
                                                        fill="#FFFFFF" opacity="1" data-original="#000000" class="">
                                                    </path>
                                                    <path
                                                        d="M21.5 10.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0zm-1 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"
                                                        fill="#FFFFFF" opacity="1" data-original="#000000" class="">
                                                    </path>
                                                </g>
                                            </g>
                                        </svg>
                                        <div style="text-align: center;">
                                            <h2>{{$data['users']}}</h2>
                                            <p>{{__('admin.users')}}</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="{{route('service_orders')}}" class="col-lg-4 col-md-6 p-2">
                                    <div style="background-color: #6fcbfa;" class="card-tr">
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" width="48" height="48" x="0"
                                             y="0" viewBox="0 0 682.667 682.667"
                                             style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                            <g>
                                                <defs>
                                                    <clipPath id="a" clipPathUnits="userSpaceOnUse">
                                                        <path d="M0 512h512V0H0Z" fill="#ffffff" opacity="1"
                                                              data-original="#000000"></path>
                                                    </clipPath>
                                                </defs>
                                                <g clip-path="url(#a)"
                                                   transform="matrix(1.33333 0 0 -1.33333 0 682.667)">
                                                    <path d="m0 0-60-90h-186l60 90z"
                                                          style="stroke-linecap: round; stroke-linejoin: round; stroke-miterlimit: 10; stroke-dasharray: none; stroke-opacity: 1;"
                                                          transform="translate(256 256)" fill="none" stroke="#FFFFFF"
                                                          stroke-width="20px" stroke-linecap="round"
                                                          stroke-linejoin="round" stroke-miterlimit="10"
                                                          stroke-dasharray="none" stroke-opacity=""
                                                          data-original="#000000" class="" opacity="1"></path>
                                                    <path d="M0 0v-156h372V0"
                                                          style="stroke-linecap: round; stroke-linejoin: round; stroke-miterlimit: 10; stroke-dasharray: none; stroke-opacity: 1;"
                                                          transform="translate(70 166)" fill="none" stroke="#FFFFFF"
                                                          stroke-width="20px" stroke-linecap="round"
                                                          stroke-linejoin="round" stroke-miterlimit="10"
                                                          stroke-dasharray="none" stroke-opacity=""
                                                          data-original="#000000" class="" opacity="1"></path>
                                                    <path d="M0 0v246"
                                                          style="stroke-linecap: round; stroke-linejoin: round; stroke-miterlimit: 10; stroke-dasharray: none; stroke-opacity: 1;"
                                                          transform="translate(256 10)" fill="none" stroke="#FFFFFF"
                                                          stroke-width="20px" stroke-linecap="round"
                                                          stroke-linejoin="round" stroke-miterlimit="10"
                                                          stroke-dasharray="none" stroke-opacity=""
                                                          data-original="#000000" class="" opacity="1"></path>
                                                    <path
                                                        d="M0 0c-53.38 44.48-90 67.8-90 103.03C-90 128.5-71.64 150-45 150c34.2 0 45-37.5 45-37.5S10.8 150 45 150c26.64 0 45-21.5 45-46.97C90 67.8 53.38 44.48 0 0Z"
                                                        style="stroke-linecap: round; stroke-linejoin: round; stroke-miterlimit: 10; stroke-dasharray: none; stroke-opacity: 1;"
                                                        transform="translate(196 352)" fill="none" stroke="#FFFFFF"
                                                        stroke-width="20px" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-miterlimit="10"
                                                        stroke-dasharray="none" stroke-opacity=""
                                                        data-original="#000000" class="" opacity="1"></path>
                                                    <path
                                                        d="M0 0s7.2 26.25 30 26.25c17.76 0 30-15.05 30-32.88 0-24.66-24.42-40.98-60-72.12-35.58 31.14-60 47.46-60 72.12 0 17.83 12.24 32.88 30 32.88C-7.2 26.25 0 0 0 0Z"
                                                        style="stroke-linecap: round; stroke-linejoin: round; stroke-miterlimit: 10; stroke-dasharray: none; stroke-opacity: 1;"
                                                        transform="translate(376 400.75)" fill="none" stroke="#FFFFFF"
                                                        stroke-width="20px" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-miterlimit="10"
                                                        stroke-dasharray="none" stroke-opacity=""
                                                        data-original="#000000" class="" opacity="1"></path>
                                                    <path
                                                        d="M0 0c-5.518 0-10 4.482-10 10s4.482 10 10 10 10-4.482 10-10S5.518 0 0 0"
                                                        style="fill-opacity:1;fill-rule:nonzero;stroke:none"
                                                        transform="translate(359 246)" fill="#FFFFFF"
                                                        data-original="#000000" opacity="1"></path>
                                                    <path d="M0 0h-58L2-90h186L128 0H90"
                                                          style="stroke-linecap: round; stroke-linejoin: round; stroke-miterlimit: 10; stroke-dasharray: none; stroke-opacity: 1;"
                                                          transform="translate(314 256)" fill="none" stroke="#FFFFFF"
                                                          stroke-width="20px" stroke-linecap="round"
                                                          stroke-linejoin="round" stroke-miterlimit="10"
                                                          stroke-dasharray="none" stroke-opacity=""
                                                          data-original="#000000" class="" opacity="1"></path>
                                                </g>
                                            </g>
                                        </svg>
                                        <div style="text-align: center;">
                                            <h2>{{$data['service_orders']}}</h2>
                                            <p>{{__('admin.service_orders')}}</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="{{route('service_providers')}}" class="col-lg-4 col-md-6 p-2">
                                    <div style="background-color: #9AC8CD;" class="card-tr">
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="48" height="48" x="0"
                                            y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512"
                                            xml:space="preserve" class="">
                                            <g>
                                                <path
                                                    d="M271 338.508V286c0-8.29-6.71-15-15-15s-15 6.71-15 15v52.5l-53.992 40.504c-6.637 4.965-7.985 14.367-3.004 20.988 2.941 3.942 7.441 6.008 12.012 6.008 3.132 0 6.285-.98 8.976-3.004L256 364.742l51.008 38.254a14.888 14.888 0 0 0 8.976 3.004c4.57 0 9.067-2.066 12.012-6.008 4.98-6.62 3.633-16.023-3.004-20.988zM316 60c0-33.09-26.91-60-60-60s-60 26.91-60 60 26.91 60 60 60 60-26.91 60-60zM346 225v-15c0-49.629-40.371-90-90-90s-90 40.371-90 90v15c0 8.29 6.71 15 15 15h150c8.29 0 15-6.71 15-15zM482 332c0-33.09-26.91-60-60-60s-60 26.91-60 60 26.91 60 60 60 60-26.91 60-60zm0 0"
                                                    fill="#FFFFFF" opacity="1" data-original="#000000" class=""></path>
                                                <path
                                                    d="M422 392c-49.629 0-90 40.371-90 90v15c0 8.29 6.71 15 15 15h150c8.29 0 15-6.71 15-15v-15c0-49.629-40.371-90-90-90zM150 332c0-33.09-26.91-60-60-60s-60 26.91-60 60 26.91 60 60 60 60-26.91 60-60zM90 392c-49.629 0-90 40.371-90 90v15c0 8.29 6.71 15 15 15h150c8.29 0 15-6.71 15-15v-15c0-49.629-40.371-90-90-90zm0 0"
                                                    fill="#FFFFFF" opacity="1" data-original="#000000" class=""></path>
                                            </g>
                                        </svg>
                                        <div style="text-align: center;">
                                            <h2>{{$data['service_providers']}}</h2>
                                            <p>{{__('admin.service_providers')}}</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="{{route('markets')}}" class="col-lg-4 col-md-6">
                                    <div style="background-color: #fff4de;" class="card-tr">
                                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_2421_2558)">
                                                <path d="M20.0801 13.1215H20.9514C21.5674 13.1232 22.1775 13.0027 22.7466 12.7669C23.3157 12.5312 23.8323 12.1848 24.2666 11.748L29.0625 6.91406L27.7606 5.60156L22.8633 10.4988L21.8455 9.48105L26.7428 4.5832L25.3952 3.27598L20.516 8.15449L19.5012 7.13672L24.3985 2.23887L23.086 0.9375L18.252 5.7334C17.8151 6.16779 17.4688 6.68454 17.2331 7.25371C16.9973 7.82287 16.8768 8.43316 16.8785 9.04922V9.91992L14.3514 12.4471L2.81253 0.9375C0.218002 4.15254 1.75023 10.0611 4.67113 12.9826L9.68089 17.9924C11.2366 19.548 11.5453 19.6869 13.3102 18.9768C13.6905 18.8238 13.8287 18.8408 14.1832 19.1947L14.945 19.9055C15.1166 20.0813 15.1207 20.1328 15.1207 20.4691V20.7938C15.1207 22.0289 15.9106 22.7391 16.4309 23.2687L22.5 29.0625L26.7188 24.8438L17.553 15.6486L20.0801 13.1215Z" fill="white"/>
                                                <path d="M13.3225 20.7768C11.5752 21.1348 10.5035 21.4646 8.45449 19.4156C8.42168 19.3828 8.3877 19.3512 8.35488 19.3184L7.2123 18.1758L0.9375 24.375L5.625 29.0625L14.0625 20.625L13.3225 20.7768Z" fill="white"/>
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_2421_2558">
                                                    <rect width="30" height="30" fill="white"/>
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <div style="text-align: center;">
                                            <h2>{{$data['markets']}}</h2>
                                            <p>{{__('admin.markets')}}</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="{{route('banners')}}" class="col-lg-4 col-md-6">
                                    <div style="background-color: #f4e8ff;" class="card-tr">
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" width="48" height="48" x="0"
                                             y="0" viewBox="0 0 682.667 682.667"
                                             style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                            <g>
                                                <defs>
                                                    <clipPath id="a" clipPathUnits="userSpaceOnUse">
                                                        <path d="M0 512h512V0H0Z" fill="#ffffff" opacity="1"
                                                              data-original="#000000"></path>
                                                    </clipPath>
                                                </defs>
                                                <g clip-path="url(#a)"
                                                   transform="matrix(1.33333 0 0 -1.33333 0 682.667)">
                                                    <path d="m0 0-60-90h-186l60 90z"
                                                          style="stroke-linecap: round; stroke-linejoin: round; stroke-miterlimit: 10; stroke-dasharray: none; stroke-opacity: 1;"
                                                          transform="translate(256 256)" fill="none" stroke="#FFFFFF"
                                                          stroke-width="20px" stroke-linecap="round"
                                                          stroke-linejoin="round" stroke-miterlimit="10"
                                                          stroke-dasharray="none" stroke-opacity=""
                                                          data-original="#000000" class="" opacity="1"></path>
                                                    <path d="M0 0v-156h372V0"
                                                          style="stroke-linecap: round; stroke-linejoin: round; stroke-miterlimit: 10; stroke-dasharray: none; stroke-opacity: 1;"
                                                          transform="translate(70 166)" fill="none" stroke="#FFFFFF"
                                                          stroke-width="20px" stroke-linecap="round"
                                                          stroke-linejoin="round" stroke-miterlimit="10"
                                                          stroke-dasharray="none" stroke-opacity=""
                                                          data-original="#000000" class="" opacity="1"></path>
                                                    <path d="M0 0v246"
                                                          style="stroke-linecap: round; stroke-linejoin: round; stroke-miterlimit: 10; stroke-dasharray: none; stroke-opacity: 1;"
                                                          transform="translate(256 10)" fill="none" stroke="#FFFFFF"
                                                          stroke-width="20px" stroke-linecap="round"
                                                          stroke-linejoin="round" stroke-miterlimit="10"
                                                          stroke-dasharray="none" stroke-opacity=""
                                                          data-original="#000000" class="" opacity="1"></path>
                                                    <path
                                                        d="M0 0c-53.38 44.48-90 67.8-90 103.03C-90 128.5-71.64 150-45 150c34.2 0 45-37.5 45-37.5S10.8 150 45 150c26.64 0 45-21.5 45-46.97C90 67.8 53.38 44.48 0 0Z"
                                                        style="stroke-linecap: round; stroke-linejoin: round; stroke-miterlimit: 10; stroke-dasharray: none; stroke-opacity: 1;"
                                                        transform="translate(196 352)" fill="none" stroke="#FFFFFF"
                                                        stroke-width="20px" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-miterlimit="10"
                                                        stroke-dasharray="none" stroke-opacity=""
                                                        data-original="#000000" class="" opacity="1"></path>
                                                    <path
                                                        d="M0 0s7.2 26.25 30 26.25c17.76 0 30-15.05 30-32.88 0-24.66-24.42-40.98-60-72.12-35.58 31.14-60 47.46-60 72.12 0 17.83 12.24 32.88 30 32.88C-7.2 26.25 0 0 0 0Z"
                                                        style="stroke-linecap: round; stroke-linejoin: round; stroke-miterlimit: 10; stroke-dasharray: none; stroke-opacity: 1;"
                                                        transform="translate(376 400.75)" fill="none" stroke="#FFFFFF"
                                                        stroke-width="20px" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-miterlimit="10"
                                                        stroke-dasharray="none" stroke-opacity=""
                                                        data-original="#000000" class="" opacity="1"></path>
                                                    <path
                                                        d="M0 0c-5.518 0-10 4.482-10 10s4.482 10 10 10 10-4.482 10-10S5.518 0 0 0"
                                                        style="fill-opacity:1;fill-rule:nonzero;stroke:none"
                                                        transform="translate(359 246)" fill="#FFFFFF"
                                                        data-original="#000000" opacity="1"></path>
                                                    <path d="M0 0h-58L2-90h186L128 0H90"
                                                          style="stroke-linecap: round; stroke-linejoin: round; stroke-miterlimit: 10; stroke-dasharray: none; stroke-opacity: 1;"
                                                          transform="translate(314 256)" fill="none" stroke="#FFFFFF"
                                                          stroke-width="20px" stroke-linecap="round"
                                                          stroke-linejoin="round" stroke-miterlimit="10"
                                                          stroke-dasharray="none" stroke-opacity=""
                                                          data-original="#000000" class="" opacity="1"></path>
                                                </g>
                                            </g>
                                        </svg>
                                        <div style="text-align: center;">
                                            <div style="text-align: center;">
                                                <h2>{{$data['banners']}}</h2>
                                                <p>{{__('admin.banners')}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-12 p-2">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="card">

                                        <div class="card-body">
                                            <div id="line_chart_datalabel" data-colors='["#16a34a", "#f6c77d"]'
                                                class="apex-charts" dir="ltr"></div>
                                        </div>
                                    </div>
                                </div>
{{--                                <div class="col-xl-6">--}}
{{--                                    <div class="card">--}}
{{--                                        <div class="card-header">--}}
{{--                                            <h4 class="card-title mb-2">{{__('admin.orders')}}</h4>--}}
{{--                                            <h5 class="mb-0 fw-bold">{{$data['orders_chart']}}</h5>--}}
{{--                                        </div>--}}
{{--                                        <div class="card-body">--}}
{{--                                            <div id="simple_dount_chart" data-colors='["#90be6d", "#f8961e", "#cd2701"]'--}}
{{--                                                class="apex-charts" dir="ltr">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
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
        @php
            $labels = [
        __('admin.January'),
        __('admin.February'),
        __('admin.March'),
        __('admin.April'),
        __('admin.May'),
        __('admin.June'),
        __('admin.July'),
        __('admin.August'),
        __('admin.September'),
        __('admin.October'),
        __('admin.November'),
        __('admin.December')
    ];
        @endphp
        var currentYearData = {{ json_encode($data['orders_chart'])}};
        var labels = {!! json_encode($labels) !!};
        var previousYearData = {{ json_encode($data['service_order_chart'])}};
        var current = {!! json_encode(__('admin.orders')) !!};
        var previous = {!!json_encode(__('admin.service_orders'))!!};

        createLineChart(
            "line_chart_datalabel",
            [
                {
                    name: current,
                    data: currentYearData,
                },
                {
                    name: previous,
                    data: previousYearData,
                },
            ],
            labels,
            380
        );
        {{--var success = {{json_encode($data['success'])}};--}}
        {{--var inProgress = {{json_encode($data['in_progress'])}};--}}
        {{--var cancelled = {{json_encode($data['cancelled'])}};--}}
        {{--var successTitle = {!! json_encode(__('admin.success')) !!};--}}
        {{--var inProgressTitle = {!! json_encode(__('admin.in_progress')) !!};--}}
        {{--var cancelledTitle = {!! json_encode(__('admin.cancelled')) !!};--}}
        {{--createDonutChart(--}}
        {{--    "simple_dount_chart",--}}
        {{--    [success, inProgress, cancelled],--}}
        {{--    [successTitle, inProgressTitle, cancelledTitle],--}}
        {{--    412--}}
        {{--);--}}
    </script>
@stop
