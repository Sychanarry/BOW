<?php
use App\Models\User;
?>
@extends('theme.content')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-8">
                        <h5 class="card-title">ລາຍການໂຄງການທັງຫມົດ</h5>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="card-title text-end">
                            <a href="{{ route('project.create') }}" class="btn btn-primary btn-sm">ສ້າງໂຄງການໃໝ່</a>
                        </div>
                    </div>
                </div>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Project Name</th>
                            <th>Asign To Staff</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($project as $key => $val)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <div class="text-title">{{ $val->project_name }}</div>
                                    <small class="text-detail">{{ $val->remark }}</small>
                                </td>
                                <td>
                                    <?php
                                    $users = User::join('asign', 'asign.asign_to_id', 'users.id')
                                        ->where('asign.project_id', $val->id)
                                        ->select('users.profile', 'asign.asign_to_id')
                                        ->get();
                                    ?>
                                    <div class="row">
                                        @foreach ($users as $user)
                                            <div class="col-12 col-sm-4 col-md-3 col-lg-2">
                                                <div class="d-flex align-content-center">
                                                    <div class="user-profile">
                                                        <a href="{{ route('project.viewprojectbyuser',[ $val->id, $user->asign_to_id]) }}">
                                                            <img class="img-fluid rounded-circle" width="80px"
                                                                src="{{ asset('assets/profile') }}/{{ $user->profile }}"
                                                                alt="" srcset="">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('project.destroy', $val->id) }}" method="post">
                                        @csrf
                                        <button type="button" id="deleteMenu_{{ $val->id }}"
                                            class="btn btn-sm btn-danger deleteMenu">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        $(document).ready(function() {
            $('.deleteMenu').on('click', function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var el = this;
                var id = this.id;
                var splitid = id.split("_");
                var name = splitid[0];
                var deleteid = splitid[1];
                Swal.fire({
                    icon: "warning",
                    title: "Are you sure?",
                    text: "Do you want to delete this information?",
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'Yes',
                    denyButtonText: 'No',
                    customClass: {
                        actions: 'my-actions',
                        cancelButton: 'order-1 right-gap',
                        confirmButton: 'order-2',
                        denyButton: 'order-3',
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "project/" + deleteid,
                            type: 'DELETE',
                            data: {
                                id: deleteid
                            },
                            success: function(res) {
                                console.log(res.status);
                                if (!res) {
                                    Swal.fire('Warning!', "Delete Failed!", 'error');
                                    Swal.Close();
                                } else {
                                    Swal.fire('Success!', "Delete Successfully!",
                                        'success');
                                    $(el).closest('tr').css('background', 'tomato');
                                    $(el).closest('tr').fadeOut(700, function() {
                                        $(this).remove();
                                    });
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
