@extends('layouts.main-layer')
@section('title') My Dashboard @endsection
@section('custom_css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap4.min.css">
@endsection
@section('content')
    <div class="container-fluid">
        <h4>My Sales Team</h4>
        <table id="viewUsersTable" class="table table-bordered table-hover dataTable" style="width:100%">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                    <th>Current Route</th>
                    <th>status</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <!-- Modal -->
    <div class="modal hide" id="view_user" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">View User</h5>
                        <form class="row g-3">
                            <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">Full Name</label>
                                <input type="text" id="full_name" class="form-control" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="inputPassword4" class="form-label">Email</label>
                                <input type="text" id="email" class="form-control" readonly>
                            </div>
                            <div class="col-6">
                                <label for="inputAddress" class="form-label">Contact Number</label>
                                <input type="text" id="contact" class="form-control" readonly>
                            </div>
                            <div class="col-6">
                                <label for="inputAddress2" class="form-label">User Type</label>
                                <input type="text" id="user_type" class="form-control" readonly>
                            </div>
                            <div class="col-6">
                                <label for="inputAddress2" class="form-label">Joined Date</label>
                                <input type="text" id="joined_date" class="form-control" readonly>
                            </div>
                            <div class="col-6">
                                <label for="inputAddress2" class="form-label">Current Route</label>
                                <input type="text" id="current_route" class="form-control" readonly>
                            </div>
                            <div class="col-12">
                                <label for="inputAddress" class="form-label">Address</label>
                                <input type="text" id="address" class="form-control" readonly>
                            </div>
                            <div class="col-6">
                                <label for="inputAddress2" class="form-label">City</label>
                                <input type="text" id="city" class="form-control" readonly>
                            </div>
                            <div class="col-4">
                                <label for="inputAddress2" class="form-label">Province</label>
                                <input type="text" id="province" class="form-control" readonly>
                            </div>
                            <div class="col-2">
                                <label for="inputAddress2" class="form-label">Zip</label>
                                <input type="text" id="zip" class="form-control" readonly>
                            </div>
                            <div class="col-12">
                                <label for="inputAddress2" class="form-label">Comment</label>
                                <textarea class="form-control" id="comment" rows="3" readonly></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-muted text-center">
                        <button class="btn btn-primary" data-dismiss="modal" aria-label="Close">Close</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    <!-- end modal-->
@endsection
@section('custom_js')
<script>
    $(document).ready(function () {
    $('#viewUsersTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url:  '{{ route("dashboard.index") }}',
        },
        columns: [
            {data: 'full_name', name: 'full_name'},
            {data: 'email', name: 'email',searchable:true},
            {data: 'contact_number', name: 'contact_number',searchable:true},
            {data: 'current_route', name: 'current_route',searchable:true},
            { "data": "status", "name": "status",
                fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html("<a href='#view_user' class='btn btn-warning btn-sm mr-1 open-AddBookDialog' data-toggle='modal' data-id= " +oData.status+ ">View</a>");
                }
            },
        ],
        order: [[0, "desc"]],
        lengthMenu: [[50,100,500,1000,-1],[50,100,500,1000,"All"]],
        searchDelay: 500
    });
});
</script>

<script>
    $(document).on("click", ".open-AddBookDialog", function () {
        console.log($(this).data('id'));
        var dashboard = $(this).data('id');
        var url = '{{ route("dashboard.show", ":id") }}';
        url = url.replace(':id',dashboard);
        console.log(url);
        $.ajax ({
            url:  url,
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                console.log(res);
                $('#full_name').val(res[0].name);
                $('#email').val(res[0].email);
                $('#contact').val(res[0].contact);
                $('#joined_date').val(res[0].joined_date);
                $('#user_type').val(res[1]);
                $('#current_route').val(res[0].current_route);
                $('#address').val(res[0].address);
                $('#city').val(res[0].city);
                $('#province').val(res[0].province);
                $('#zip').val(res[0].zip);
                $('#comment').val(res[0].comment);
            }
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap4.min.js"></script>
@endsection
