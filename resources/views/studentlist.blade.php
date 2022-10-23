@extends('welcome')

@section('content')
    <div class="container">
        <h4 class="bg-warning p-2">Student Details</h4>
        <div class="mt-4">
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add
            </button>
            <div class="alert alert-primary mt-3" role="alert" id="alert">

            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form method="post" id="registration" action="{{ url('/store') }}">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="age">Age</label>
                                <input type="text" id="age" name="age" class="form-control" />
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="M">
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="F">
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                            <div class="form-group">
                                <label for="reporting_teacher">Reporting Teacher</label>
                                <input type="text" id="reporting_teacher" name="reporting_teacher" class="form-control" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="submit" class="btn btn-primary btn-sm">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form method="post" id="edit_registration" action="{{ url('/update') }}">
                    @csrf
                    <input type="hidden" id="edit_id" name="edit_id">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="edit_name" name="edit_name" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="age">Age</label>
                                <input type="text" id="edit_age" name="edit_age" class="form-control" />
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="edit_gender" value="M">
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="edit_gender" value="F">
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                            <div class="form-group">
                                <label for="reporting_teacher">Reporting Teacher</label>
                                <input type="text" id="edit_reporting_teacher" name="edit_reporting_teacher" class="form-control" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="edit_submit" class="btn btn-primary btn-sm">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="mt-4">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <form method="GET" id="filter" action="{{ url('/') }}">
                            @csrf
                            <label for="search">Search</label>
                            <input type="text" id="search" name="search" class="form-control" />
                            <div class="my-2">
                                <button class="btn btn-primary btn-sm" type="submit">search</button>
                                <button class="btn btn-danger btn-sm" id="reset">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <div class="mt-4">
            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Age</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Reporting Teacher</th>
                        <th scope="col">Actions</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach($result['data'] as $item)
                    <tr>
                        <th scope="row">{{$i++}}</th>
                        <td>{{$item['name']}}</td>
                        <td>{{$item['age']}}</td>
                        <td>{{$item['gender']}}</td>
                        <td>{{$item['reporting_teacher']}}</td>
                        <td>
                            <button type="button" id="edit" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal" onclick="editdetails(<?php echo $item['id']; ?>)">
                                <i class="fa fa-edit"></i> Edit
                            </button>
                            <button type="button" id="delete" class="btn btn-danger btn-sm" onclick="deletedetails(<?php echo $item['id']; ?>)">
                                <i class="fa fa-delete"></i> Delete
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

<script>
    $(document).ready(function() {
        $("#registration").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3
                },
                age: {
                    required: true
                },
                gender: {
                    required: true
                },
                reporting_teacher: {
                    required: true,
                    minlength: 3
                }
            },
        });
    });


    $(document).ready(function(e) {
        $('#reset').on('click', (function(e) {
            $('#search').val('');
        }));
        $('#alert').hide();
        $('#submit').on('click', (function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '/store',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: $("#registration").serialize(),
                async: true,
                dataType: 'json',
                cache: false,
                success: function(data) {
                    Swal({
                        title: "Successfully added!",
                        type: "success",
                        confirmButtonText: "Ok!",
                    }).then((result) => {
                        window.location = '/'
                    });

                },
                error: function(data) {
                    $('#alert').show();
                    $('#alert').text('failed to add');
                }
            });
        }));

        $('#edit_submit').on('click', (function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '/update',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: $("#edit_registration").serialize(),
                async: true,
                dataType: 'json',
                cache: false,
                success: function(result) {
                    Swal({
                        title: "It was updated!",
                        type: "success",
                        confirmButtonText: "Ok!",
                    }).then((result) => {
                        window.location = '/'
                    });
                },
                error: function(result) {
                    $('#alert').show();
                    $('#alert').text('failed to edit');
                }
            });
        }));



    });

    function editdetails(id) {
        $.ajax({
            type: 'POST',
            url: '/edit',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id
            },
            async: true,
            dataType: 'json',
            cache: false,
            success: function(data) {
                $('#edit_id').val(id);
                $('#edit_name').val(data[0]['name']);
                $('#edit_age').val(data[0]['age']);
                if (data[0]['gender'] == "M") {
                    $('#edit_registration').find(':radio[name=edit_gender][value="M"]').prop('checked', true);
                } else {
                    $('#edit_registration').find(':radio[name=edit_gender][value="F"]').prop('checked', true);
                }
                $('#edit_reporting_teacher').val(data[0]['reporting_teacher']);
            },
            error: function(data) {
                $('#alert').show();
                $('#alert').text('failed to edit');
            }
        });

    }

    function deletedetails(id) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover it!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: 'ok'
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: '/delete/' + id,
                    type: "GET",
                    success: function(resp) {
                        window.location.href = '/';
                    }
                });
            }
            return false;
        });
    }
</script>
@endsection