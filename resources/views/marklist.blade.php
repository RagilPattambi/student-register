@extends('welcome')

@section('content')
    <div class="container">
        <h4 class="bg-warning p-2">Mark List</h4>
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
                <form method="post" id="marklist">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <select name="student" id="student" class="form-control">
                                    <option>select</option>
                                    @if(isset($result['student']))
                                        @foreach($result['student'] as $student)
                                        <option value="{{$student['id']}}">{{$student['name']}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="maths">Maths</label>
                                <input type="text" id="maths" name="maths" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="science">Science</label>
                                <input type="text" id="science" name="science" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="history">History</label>
                                <input type="text" id="history" name="history" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="term">Term</label>
                                <input type="text" id="term" name="term" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="total_marks">Total Marks</label>
                                <input type="text" id="total_marks" name="total_marks" class="form-control" />
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
                <form method="post" id="edit_marklist" >
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
                                <select name="edit_student" id="edit_student" class="form-control">
                                    <option>select</option>
                                    @if(isset($result['student']))
                                        @foreach($result['student'] as $student)
                                        <option value="{{$student['id']}}">{{$student['name']}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="maths">Maths</label>
                                <input type="text" id="edit_maths" name="edit_maths" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="science">Science</label>
                                <input type="text" id="edit_science" name="edit_science" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="history">History</label>
                                <input type="text" id="edit_history" name="edit_history" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="term">Term</label>
                                <input type="text" id="edit_term" name="edit_term" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="total_marks">Total Marks</label>
                                <input type="text" id="edit_total_marks" name="edit_total_marks" class="form-control" />
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
                        <form method="GET" id="filter" action="{{ url('/marklist') }}">
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
                        <th scope="col">Maths</th>
                        <th scope="col">Science</th>
                        <th scope="col">History</th>
                        <th scope="col">Term</th>
                        <th scope="col">Total Marks</th>
                        <th scope="col">Created On</th>
                        <th scope="col">Actions</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach($result['data'] as $item)
                    
                    <tr>
                        <th scope="row">{{$i++}}</th>
                        <td>{{$item->name}}</td>
                        <td>{{$item->maths}}</td>
                        <td>{{$item->science}}</td>
                        <td>{{$item->history}}</td>
                        <td>{{$item->term}}</td>
                        <td>{{$item->total_marks}}</td>
                        <td>{{Carbon\Carbon::parse($item->created_at)->format('M d, Y H:i a')}}</td>
                         
                        <td>
                            <button type="button" id="edit" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal" onclick="editdetails(<?php echo $item->mid; ?>)">
                                <i class="fa fa-edit"></i> Edit
                            </button>
                            <button type="button" id="delete" class="btn btn-danger btn-sm" onclick="deletedetails(<?php echo $item->mid; ?>)">
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
        $("#marklist").validate({
            rules: {
                name: {
                    required: true
                },
                maths: {
                    required: true
                },
                science: {
                    required: true
                },
                history: {
                    required: true
                },
                term: {
                    required: true
                },
                total_marks: {
                    required: true
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
                url: '/marklist/store',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: $("#marklist").serialize(),
                async: true,
                dataType: 'json',
                cache: false,
                success: function(data) {
                    Swal({
                        title: "Successfully added!",
                        type: "success",
                        confirmButtonText: "Ok!",
                    }).then((result) => {
                        window.location = '/marklist'
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
                url: '/marklist/update',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: $("#edit_marklist").serialize(),
                async: true,
                dataType: 'json',
                cache: false,
                success: function(result) {
                    Swal({
                        title: "It was updated!",
                        type: "success",
                        confirmButtonText: "Ok!",
                    }).then((result) => {
                        window.location = '/marklist'
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
            url: '/marklist/edit',
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
                $('#edit_student').val(data[0]['mid']);
                $('#edit_maths').val(data[0]['maths']);
                $('#edit_science').val(data[0]['science']);
                $('#edit_history').val(data[0]['history']);
                $('#edit_term').val(data[0]['term']);
                $('#edit_total_marks').val(data[0]['total_marks']);
            },
            error: function(data) {
                $('#alert').show();
                $('#alert').text('failed to edit');
            }
        });

    }

    function deletedetails(id){
        swal({
    title: "Are you sure?",
    text: "Once deleted, you will not be able to recover it!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: 'ok'
    }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: '/marklist/delete/'+id,
                    type: "GET",
                    success: function(resp){
                        window.location.href = '/marklist';
                    }
                });
                }
            return false;
        });
    }
</script>

@endsection