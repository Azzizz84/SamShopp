

@extends('admin.layouts.master')
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{__('admin.verifications')}}</h4>
                <div class="page-title-right d-flex align-items-center gap-3 flex-wrap">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"> {{__('admin.dashboard')}} </a></li>
                        <li class="breadcrumb-item active">{{__('admin.verifications')}}</li>
                    </ol>


                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <table id="sectionTable"
                           class="table table-bordered dt-responsive nowrap table-striped align-middle"
                           style="width:100%">
                        <thead>
                        <tr>
                            <th scope="col" style="width: 10px;">ID</th>
                            <th>{{__('inputs.image')}}</th>
                            <th>{{__('buttons.actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($verifications as $verification)
                            <tr id="{{$verification->id}}">
                                <td style="width: 10px;">{{$verification->id}}</td>
                                <td>{{$verification->file_path}}</td>
                                <td><button class="btn btn-outline-info" onclick="downloadFile('{{$verification->image}}','{{$verification->file_path}}')">{{__('buttons.download')}}</button></td>
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
@stop

@section('js')
    <script>
        async function downloadFile(url, filename) {
            try {
                // Fetch the file from the given URL
                const response = await fetch(url);
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                // Get the file's blob
                const blob = await response.blob();

                // Create a URL for the blob
                const blobUrl = URL.createObjectURL(blob);

                // Create an anchor element
                const a = document.createElement('a');
                a.href = blobUrl;
                a.download = filename;

                // Append the anchor to the body
                document.body.appendChild(a);

                // Programmatically click the anchor to trigger the download
                a.click();

                // Clean up
                document.body.removeChild(a);
                URL.revokeObjectURL(blobUrl);
            } catch (error) {
                console.error('There was an error downloading the file:', error);
            }
        }

    </script>
@stop

