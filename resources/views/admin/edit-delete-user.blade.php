@extends('layouts.main-layer')
@section('title') Edit / Delete Users @endsection
@section('custom_css')
@endsection
@section('content')
<div class="container-fluid">
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
    <h4 class="mb-3">Edit /Delete Users</h4>
        <div class="card p-1">
            <table class="table table-striped table-hover" style="font-size: 14px;" id="viewUsersTable">
                <thead>
                    <tr>
                        <th scope="col">Full Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Conatct Number</th>
                        <th scope="col">Current Route(s)</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $key => $user)
                        <tr>
                            <th scope="row">{{ $key+1 }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->current_route }}</td>
                            <td class="row">
                                <a href="#editUser" class="btn btn-warning btn-sm mr-1 open-AddBookDialog"
                                    data-toggle="modal" data-id= "{{ $user->id }}"
                                    data-fname= "{{ $user->name }}" data-contactnumber="{{ $user->contact }}"
                                    data-email="{{ $user->email }}" data-usertype="{{ $roles }}"
                                    data-joineddate="{{ $user->joined_date }}"
                                    data-route="{{ $user->current_route }}"
                                    data-address="{{ $user->address }}" data-city="{{ $user->city }}"
                                    data-province="{{ $user->province }}" data-zip="{{ $user->zip }}"
                                    data-comments="{{ $user->comment }}">
                                    Edit user
                                </a>
                                <a href="#deleteUser" class="btn btn-danger btn-sm open-AddBookDialogs"
                                    data-toggle="modal" data-id= "{{ $user->id }}">
                                    Delete user
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Modal -->
        <div class="modal hide" id="editUser" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                        {{ Form::open(array('url' => '/admin/user/update', 'method' => 'PUT', 'class'=>'col-md-12', 'user' => 'key', 'id' => 'edit-form')) }}
                        @csrf
                            <input type="hidden" class="form-control" name="id" id="id" value="" >
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Full Name <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" id="fname" value="{{ old('fname') }}" >
                                    @error('fname')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Contact Number <span style="color:red;">*</span></label>
                                    <input type="number" class="form-control @error('contact_number') is-invalid @enderror" id="contact_number" name="contact_number" value="{{ old('contact_number') }}">
                                    @error('contact_number')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Email <span style="color:red;">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">User Type <span style="color:red;">*</span></label>
                                    <select class="form-control text-capitalize" id="user_type" name="user_type">
                                        @if (count($roles) >= 1)
                                            @foreach ($allRoles as $role)
                                                @hasrole('manager')
                                                    @if (!($role->id == 1))
                                                    <option value="{{ $role->id }}" selected >{{ $role->name }}</option>
                                                    @endif
                                                @endhasrole
                                                @hasrole('admin')
                                                    <option value="{{ $role->id }}" selected >{{ $role->name }}</option>
                                                @endhasrole
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Password <span style="color:red;">*</span></label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="*************" id="password" name="password">
                                    @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Confirm Password <span style="color:red;">*</span></label>
                                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="*************" id="password_confirmation" name="password_confirmation">
                                    @error('password_confirmation')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputAddress">Joined Date <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control @error('joined_date') is-invalid @enderror" id="joined_date" name="joined_date" placeholder="YY-MM-DD" value="{{ old('joined_date') }}">
                                    @error('joined_date')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleFormControlSelect2">Route <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control @error('route') is-invalid @enderror" id="route" name="route" value="{{ old('route') }}">
                                    @error('route')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress">Address <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}">
                                    @error('address')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputCity">City <span style="color:red;">*</span></label>
                                    <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" id="city" value="{{ old('city') }}">
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
                                <button type="reset" class="btn btn-danger btn-lg" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-secondary btn-lg">Edit account</button>
                            </div>
                    {{ Form::close() }}
                </div>
            </div>
            </div>
        </div>
        <!-- end modal-->
        <!-- Delete Modal -->
        <div class="modal fade" id="deleteUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                <h2 class="display-6 text-center pb-2 pt-2"><b>Whoa, there!</b></h2>
                <p class="text-center">Once you delete this account, there's no getting it back. <br> Make sure you want to do this.</p>
                    {{ Form::open(array('url' => '/admin/user/destroy', 'method' => 'DELETE', 'class'=>'col-md-12', 'user' => 'key', 'id' => 'destroy-form')) }}
                        @csrf
                    <div class="mb-3">
                        <input type="hidden" id="id" name="id" value="" />
                        <input class="form-control form-control-lg" type="text" placeholder="Confirm by typing DELETE" id="confirmText" name="confirmText" required>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-light btn-lg" data-dismiss="modal">CANCEL</button>
                    <button type="submit" class="btn btn-danger btn-lg">YEP, DELETE IT</button>
                </div>
            </form>
            </div>
            </div>
        </div>
        <div class="pull-right pt-5">
            {{ $users->links() }}
        </div>
    </div>
@endsection
@section('custom_js')
<script>
    $(document).on("click", ".open-AddBookDialog", function () {
        var id = $(this).data('id');
        var fname = $(this).data('fname');
        var contact_number = $(this).data('contactnumber');
        var email = $(this).data('email');
        var user_type = $(this).data('usertype');
        var joined_date = $(this).data('joineddate');
        var route = $(this).data('route');
        var address = $(this).data('address');
        var city = $(this).data('city');
        var province = $(this).data('province');
        var zip = $(this).data('zip');
        var comments = $(this).data('comments');
        $(".modal-body #edit-form").attr('user',id );
        $(".modal-body #destroy-form").attr('user',id );
        $(".modal-body #id").val( id );
        $(".modal-body #fname").val( fname );
        $(".modal-body #contact_number").val( contact_number );
        $(".modal-body #email").val( email );
        $(".modal-body #user_type").val( user_type );
        $(".modal-body #joined_date").val( joined_date );
        $(".modal-body #route").val( route );
        $(".modal-body #address").val( address );
        $(".modal-body #city").val( city );
        $(".modal-body #province").val( province );
        $(".modal-body #zip").val( zip );
        $(".modal-body #comments").val( comments );
    $('#editUser').modal('show');
});
</script>

<script>
    $(document).on("click", ".open-AddBookDialogs", function () {
        var id = $(this).data('id');
        $(".modal-body #id").val( id );
    $('#deleteUser').modal('show');
});

</script>
@endsection
