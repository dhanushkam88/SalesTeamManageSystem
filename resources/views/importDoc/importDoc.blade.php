@extends('layouts.main-layer')
@section('title') Import Doc @endsection
@section('custom_css')
@endsection
@section('content')
    <div class="container">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
        @endif
        <div class="row">
            <div class="col-lg-5 mx-auto">
                <div class="p-5 bg-white shadow rounded-lg"><img src="https://bootstrapious.com/i/snippets/sn-file-upload/img.png" alt="" width="200" class="d-block mx-auto mb-4 rounded-pill">
                    <h6 class="text-center mb-4 text-muted">
                        Upload your CSV File
                    </h6>
                    <form action="{{ route('import-doc') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="custom-file overflow-hidden rounded-pill mb-5">
                            <input id="customFile" name="file" type="file" class="custom-file-input rounded-pill" required>
                            <label for="customFile" class="custom-file-label rounded-pill">Choose file</label>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-success" type="submit">Upload your doc</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom_js')
@endsection
