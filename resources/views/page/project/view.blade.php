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
                        <div class="card-title">ໂຄງການ</div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="card-title text-end">
                            <a href="{{ route('project.index') }}" class="btn btn-primary btn-sm">ລາຍການໂຄງການທັງຫົມດ</a>
                        </div>
                    </div>
                </div>

                <!-- Accordion without outline borders -->
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    @foreach ($project as $val)
                        <?php
                        $users = User::join('asign', 'asign.asign_to_id', 'users.id')
                            ->where('asign.project_id', $val->id)
                            ->select('users.*')
                            ->get();
                        ?>
                        @foreach ($users as $user)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseOne{{ $user->id }}" aria-expanded="false"
                                        aria-controls="flush-collapseOne{{ $user->id }}">
                                        <img class="img-fluid rounded-circle me-2" width="45px"
                                            src="{{ asset('assets/profile') }}/{{ $user->profile }}" alt=""
                                            srcset="">
                                        <strong>ຊື່ໂຄງການ: </strong>&nbsp; {{ $val->project_name }}
                                    </button>
                                </h2>
                                <div id="flush-collapseOne{{ $user->id }}" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample"
                                    style="">
                                    <div class="accordion-body">
                                        {{ $val->remark }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div><!-- End Accordion without outline borders -->

            </div>
        </div>
    </div>
@endsection
