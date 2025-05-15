<!doctype html>

<html lang="{{App::getLocale()}}" data-appColor="default" data-layout="vertical" data-topbar="light" data-sidebar="light"
    data-sidebar-size="lg" data-sidebar-image="none" data-preloader="enable" dir="{{ App::getLocale() == 'en' ? 'ltr' : 'rtl' }}">
<head>
    <meta charset="utf-8" />
    <title>{{env('APP_NAME')}} Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="{{env('APP_NAME')}} Admin & Dashboard" name="description" />
    <meta content="{{env('APP_NAME')}}" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset("admin/assets/images/fav.svg")}}">
    <!-- Layout config Js -->
    <script src="{{asset("admin/assets/js/layout.js")}}"></script>
    <!-- Bootstrap Css -->
    <link href="{{asset("admin/assets/css/bootstrap.min.css")}}" id="bootstrapCss" rel="stylesheet" />
    <!-- Icons Css -->
    <link href="{{asset("admin/assets/css/icons.min.css")}}" rel="stylesheet" />
    <!-- App Css-->
    <link href="{{asset("admin/assets/css/app.min.css")}}" id="appCss" rel="stylesheet" />
    <!-- custom Css-->
    <link rel="stylesheet" href="{{asset("admin/assets/css/custom.css")}}">

    <style>
        #global-loader {
            display: none;
        }
    </style>
</head>
<body>
    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->

        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>
            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>
        <!-- auth page content -->

        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="" class="d-inline-block auth-logo">
                                    <img src="{{asset("admin/assets/images/logo-light.svg")}}" alt="" class="menuLogo">
                                </a>
                            </div>
                            <p class="mt-3 fs-15 fw-medium"> {{__("admin.app_dashboard")}} </p>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">
                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <div id="global-loader">
                                        <img src="{{url('admin')}}/assets/images/loader.svg" class="loader-img" alt="Loader">
                                    </div>
                                    <h5 class="text-primary">{{__("admin.welcome")}}</h5>
                                    <p class="text-muted">{{__('admin.sign_in')}}</p>
                                </div>
                                <div class="p-2 mt-4">
                                    <form id="login_form" action="{{ route('send_login') }}" method="POST" enctype="application/x-www-form-urlencoded">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="email" class="form-label">{{__('inputs.email')}}</label>
                                            <input type="email" class="form-control" name="email"
                                                placeholder="{{__('inputs.hint_email')}}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="password-input">{{__("inputs.password")}}</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" class="form-control pe-5 password-input"
                                                    placeholder="***********" id="password-input" required name="password">
{{--                                                <button--}}
{{--                                                    class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"--}}
{{--                                                    type="button" id="password-addon"><i--}}
{{--                                                        class="ri-eye-fill align-middle"></i></button>--}}
                                            </div>
                                        </div>
{{--                                        <div class="form-check">--}}
{{--                                            <input class="form-check-input" type="checkbox" value=""--}}
{{--                                                id="auth-remember-check" name="remember">--}}
{{--                                            <label class="form-check-label" for="auth-remember-check">{{__('inputs.remember')}}</label>--}}
{{--                                        </div>--}}
                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" type="submit" href="#">{{__("buttons.sign_in")}}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->
        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">&copy;
                                <script>document.write(new Date().getFullYear())</script>
                                {{env('APP_NAME')}}.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->
    <!-- JAVASCRIPT -->
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    @include('admin.layouts.toaster')
    <script src="{{asset("admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
    <script src="{{asset("admin/assets/libs/feather-icons/feather.min.js")}}"></script>
    <script src="{{asset("admin/assets/js/plugins.js")}}"></script>
    <script>
        $(document).on('submit', '#login_form', function (event) {
            event.preventDefault();
            var form_data = new FormData(document.getElementById("login_form"));
            var url = $('#login_form').attr('action');
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
                            location.href = 'login';
                            my_toaster(data.message)
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
</body>
</html>
