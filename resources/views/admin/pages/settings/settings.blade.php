@extends('admin.layouts.master')
@section('content')
    @if(admin_user()->havePermission('settings_view'))
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{__('admin.settings')}}</h4>
                <div class="page-title-right d-flex align-items-center gap-3 flex-wrap">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"> {{__('admin.dashboard')}} </a></li>
                        <li class="breadcrumb-item active">{{__('admin.settings')}}</li>
                    </ol>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{route('settings.update')}}" method="POST" class="h-100 m-0 row" enctype="application/x-www-form-urlencoded" id="form">
                        <input type="hidden" id="id0" name="privacy_ar" value="{{$settings->privacy_ar}}">
                        <input type="hidden" id="id1" name="privacy_en" value="{{$settings->privacy_en}}">
                        <input type="hidden" id="id2" name="terms_ar" value="{{$settings->terms_ar}}">
                        <input type="hidden" id="id3" name="terms_en" value="{{$settings->terms_en}}">
                        <input type="hidden" id="id4" name="about_ar" value="{{$settings->about_ar}}">
                        <input type="hidden" id="id5" name="about_en" value="{{$settings->about_en}}">
                        <input type="hidden" id="id6" name="return_ar" value="{{$settings->return_ar}}">
                        <input type="hidden" id="id7" name="return_en" value="{{$settings->return_en}}">
                        <div class="row">


                            <div class="col-lg-4 col-md-6 p-2">
                                <label for="{{env('APP_NAME')}}Range" class="form-label">{{__('inputs.phone')}}</label>
                                <input type="tel"  class="form-control" id="phone" placeholder="966654654231" required name="phone" value="{{$settings->phone}}">
                            </div>
                            <div class="col-lg-4 col-md-6 p-2">
                                <label for="{{env('APP_NAME')}}Range" class="form-label">{{__('inputs.verification_cost')}}</label>
                                <input type="number" step="0.01"  class="form-control" id="cost" placeholder="" required name="verification_cost" value="{{$settings->verification_cost}}">
                            </div>
                            <div class="col-lg-4 col-md-6 p-2">
                                <label for="{{env('APP_NAME')}}Range" class="form-label">Whatsapp</label>
                                <input type="tel"  class="form-control" id="whatsapp" placeholder="+9665XXXXXXX" name="whatsapp" value="{{$settings->whatsapp}}">
                            </div>
                            <div class="col-lg-4 col-md-6 p-2">
                                <label for="{{env('APP_NAME')}}Range" class="form-label">{{__('inputs.market_code')}}</label>
                                <input type="text"  class="form-control" id="market_code" placeholder="Amara46Y" required name="market_code" value="{{$settings->market_code}}">
                            </div>
                            <div class="col-lg-8 col-md-6 p-2">
                            </div>
                            <div class="col-lg-6 col-md-6 p-2">
                                <label for="policyArabic" class="form-label">{{__('inputs.policy_ar')}}</label>
                                <div class="snow-editor" id="0" style="height: 300px;"> </div>
                            </div>
                            <div class="col-lg-6 col-md-6 p-2">
                                <label for="policyEnglish" class="form-label">{{__('inputs.policy_en')}}</label>
                                <div class="snow-editor" id="1" style="height: 300px;"> </div>
                            </div>
                            <div class="col-lg-6 col-md-6 p-2">
                                <label for="termsArabic" class="form-label">{{__('inputs.terms_ar')}}</label>
                                <div class="snow-editor" id="2" style="height: 300px;"> </div>
                            </div>
                            <div class="col-lg-6 col-md-6 p-2">
                                <label for="termsEnglish" class="form-label">{{__('inputs.terms_en')}}</label>
                                <div class="snow-editor" id="3" style="height: 300px;"> </div>
                            </div>
                            <div class="col-lg-6 col-md-6 p-2">
                                <label for="aboutArabic" class="form-label">{{__('inputs.about_ar')}}</label>
                                <div class="snow-editor" id="4" style="height: 300px;"> </div>
                            </div>
                            <div class="col-lg-6 col-md-6 p-2">
                                <label for="aboutEnglish" class="form-label">{{__('inputs.about_en')}}</label>
                                <div class="snow-editor" id="5" style="height: 300px;"> </div>
                            </div>
                            <div class="col-lg-6 col-md-6 p-2">
                                <label for="aboutEnglish" class="form-label">{{__('inputs.return_ar')}}</label>
                                <div class="snow-editor" id="6" style="height: 300px;"> </div>
                            </div>
                            <div class="col-lg-6 col-md-6 p-2">
                                <label for="aboutEnglish" class="form-label">{{__('inputs.return_en')}}</label>
                                <div class="snow-editor" id="7" style="height: 300px;"> </div>
                            </div>
                        </div>
                        <div class="p-2 d-flex justify-content-end">
                            <button class="btn btn-success fs-7 fw-medium" type="submit">{{__('buttons.save')}}</button>
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
    <script src="{{asset('admin/assets/libs/quill/quill.min.js')}}"></script>
    <script>
        var snowEditors = document.querySelectorAll(".snow-editor");
        snowEditors && Array.from(snowEditors).forEach(function (editor, index) {
            var o = {};
            if (editor.classList.contains("snow-editor")) {
                o.theme = "snow";
                o.modules = {
                    toolbar: [
                        [{ font: [] }, { size: [] }],
                        ["bold", "italic", "underline", "strike"],
                        [{ color: [] }, { background: [] }],
                        [{ script: "super" }, { script: "sub" }],
                        [{ header: [!1, 1, 2, 3, 4, 5, 6] }, "blockquote", "code-block"],
                        [
                            { list: "ordered" },
                            { list: "bullet" },
                            { indent: "-1" },
                            { indent: "+1" },
                        ],
                        ["direction", { align: [] }],
                        ["link", "image", "video"],
                        ["clean"],
                    ],
                };
                var initialValue = document.querySelector('#id' + index).value;
                var quill = new Quill(editor, o);
                quill.root.innerHTML = initialValue;

                // Update the corresponding hidden input field with the content of the Quill editor
                quill.on('text-change', function() {
                    var editorContent = document.querySelector('#id' + index);
                    editorContent.value = quill.root.innerHTML;
                });
            }
        });
    </script>
@stop

