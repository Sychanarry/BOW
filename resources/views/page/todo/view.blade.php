<?php
use App\Models\User;
?>
@extends('theme.content')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h5 class="card-title">ລາຍການໂຄງການທີ່ໄດ້ຮັບເໝາະໝາຍ.</h5>
                    </div>
                </div>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Project Name</th>
                            <th class="text-center">Add Doto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($project as $key => $val)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <div class="row">
                                        <div class="d-flex align-content-center">
                                            <div class="user-profile me-2">
                                                <a href="{{ route('project.show', $val->asign_to_id) }}">
                                                    <img class="img-fluid rounded-circle" width="45px"
                                                        src="{{ asset('assets/profile') }}/{{ $val->profile }}"
                                                        alt="" srcset="">
                                                </a>
                                            </div>
                                            <div class="user-detail">
                                                <div class="text-title">{{ $val->project_name }}</div>
                                                <small class="text-detail">{{ $val->remark }}</small>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                                <td class="text-center">
                                    <button class="btn btn-primary btn-sm"><i class="bi bi-journal-arrow-down"></i></button>
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
