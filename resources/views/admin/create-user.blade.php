@extends('layouts.main-layer')
@section('title') Create User @endsection
@section('custom_css')
<!-- Calander Custom CSS -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('calander/fonts/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('calander/css/rome.css') }}">
    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('calander/css/style.css') }}">
<!-- End Calander Custom Script -->
@endsection
@section('content')
    <div class="container">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger" id="error">{{$error}}</div>
            @endforeach
        @endif
        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-center mb-5 mt-3">Create User</h2>

                <form method="post" action="{{ route('user.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Full Name <span style="color:red;">*</span></label>
                            <input type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" id="fname" value="{{ old('fname') }}" required>
                            @error('fname')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Contact Number <span style="color:red;">*</span></label>
                            <input type="number" class="form-control @error('contact_number') is-invalid @enderror" id="contact_number" name="contact_number" value="{{ old('contact_number') }}" required>
                            @error('contact_number')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Email <span style="color:red;">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">User Type <span style="color:red;">*</span></label>
                            <select class="form-control text-capitalize" id="user_type" name="user_type">
                                <option hidden>Select user type</option>
                                @foreach ($roles as $role)
                                    @hasrole('manager')
                                        @if (!($role->id == 1))
                                        <option value="{{ $role->id }}" selected >{{ $role->name }}</option>
                                        @endif
                                    @endhasrole
                                    @hasrole('admin')
                                        <option value="{{ $role->id }}" selected >{{ $role->name }}</option>
                                    @endhasrole
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Password <span style="color:red;">*</span></label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Confirm Password <span style="color:red;">*</span></label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation">
                            @error('password_confirmation')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputAddress">Joined Date <span style="color:red;">*</span></label>
                            <input type="text" class="form-control @error('joined_date') is-invalid @enderror" id="input" name="joined_date" placeholder="YY-MM-DD" value="{{ old('joined_date') }}" required>
                            @error('joined_date')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleFormControlSelect2">Route <span style="color:red;">*</span></label>
                            <input type="text" class="form-control @error('route') is-invalid @enderror" id="route" name="route" value="{{ old('route') }}" required>
                            @error('route')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Address <span style="color:red;">*</span></label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}" required>
                            @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputCity">City <span style="color:red;">*</span></label>
                            <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" id="city" value="{{ old('city') }}" required>
                            @error('city')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputState">State / Province <span style="color:red;">*</span></label>
                            <input type="text" name="province" class="form-control @error('province') is-invalid @enderror" id="province" value="{{ old('province') }}" required>
                            @error('province')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputZip">Zip <span style="color:red;">*</span></label>
                            <input type="text" id="zip" name="zip" class="form-control @error('zip') is-invalid @enderror" value="{{ old('zip') }}" required>
                            @error('zip')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleFormControlTextarea1">Comments</label>
                            <textarea class="form-control @error('comments') is-invalid @enderror" name="comments" id="comments" rows="4"></textarea>
                            @error('comments')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="float-right pt-5">
                        <button type="reset" class="btn btn-danger btn-lg">Reset</button>
                        <button type="submit" class="btn btn-secondary btn-lg">Create account</button>
                    </div>
            </form>
            </div>
        </div>
    </div>
@endsection
@section('custom_js')
<!-- Calander Custom JS-->
    <script src="{{ asset('calander/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('calander/js/popper.min.js') }}"></script>
    <script src="{{ asset('calander/js/rome.js') }}"></script>
    <script src="{{ asset('calander/js/main.js') }}"></script>
<!-- End Calander Custon JS -->
@endsection
