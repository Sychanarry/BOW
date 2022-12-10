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
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    @foreach ($project as $key => $val)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne{{ $val->id }}" aria-expanded="false"
                                    aria-controls="flush-collapseOne{{ $val->id }}">
                                    <img class="img-fluid rounded-circle me-2" width="45px"
                                        src="{{ asset('assets/profile') }}/{{ $val->profile }}" alt=""
                                        srcset="">
                                    <strong>ຊື່ໂຄງການ: </strong>&nbsp; {{ $val->project_name }}
                                </button>
                            </h2>
                            <div id="flush-collapseOne{{ $val->id }}" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample" style="">
                                @include('page.todo.listodo')
                                <div class="accordion-body">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
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
