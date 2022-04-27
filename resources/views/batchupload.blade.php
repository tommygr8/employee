@extends('layout.master')
@section('cssasset')
@endsection
@section('content')

    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <p>Waitlist Batch upload.</p>
                </div>
            </div>

            <div class="card card-preview">
                <div class="card-inner">
                    <div class="preview-block">
                        <span class="preview-title-lg overline-title"><a href="{{app_path('upload/sample.xlsx')}}">Download Sample</a> </span>
                        <div class="row gy-4">
                            <form enctype="multipart/form-data" action="{{url('batch-upload')}}" method="POST">
                                @csrf

                            <div class="col-sm-10">
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if ( session('error') )
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                    @if ( session('success') )
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label" for="default-06">Upload File</label>
                                    <div class="form-control-wrap">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="batch" name="batch">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-lg-7">
                                        <div class="form-group mt-2">
                                            <button type="submit" class="btn btn-lg btn-primary">Send</button>
                                        </div>
                                    </div>
                                </div>


                        </div>


                    </div>
                            </form>
                </div>
            </div><!-- .card-preview -->


        </div>
    </div>


@section('jsasset')
@endsection
@endsection