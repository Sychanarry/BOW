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
                            <th class="text-center">List Todo</th>
                            <th class="text-center"> </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($project as $key => $val)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <div class="d-flex">
                                        <div class="user-profile">
                                            <img class="img-fluid rounded-circle me-2" width="45px"
                                                                src="{{ asset('assets/profile') }}/{{ $val->profile }}"
                                                                alt="" srcset="">
                                        </div>
                                        <div class="user-detail">
                                            <div class="text-title">{{ $val->project_name }}</div>
                                            <small class="text-detail">{{ $val->remark }}</small>
                                        </div>

                                    </div>

                                </td>
                                <td class="text-center">
                                   <div id="getcounttodo{{$val->id}}"></div>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-primary btn-sm"
                                    data-bs-toggle="modal" data-bs-target="#largeModal{{$val->id}}"
                                    >Add todo</button>
                                </td>
                            </tr>
                            @include('page.todo.modal')
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
