<?php
// dd($listtodo);
?>
@extends('theme.content')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h5 class="card-title">List Todo.</h5>
                    </div>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Project Name</th>
                            <th>Asign To Staff</th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($listtodo as $key=>$val)
                        <tr>
                            <td>{{$key+=1}}</td>
                            <td>{{$val->title}}</td>
                            <td>{{$val->title}}</td>
                            <td>{{$val->title}}</td>
                        </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
