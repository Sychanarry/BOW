<?php
use App\Models\User;
use App\Models\Todo;
?>
@extends('theme.content')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">My Working</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width:80px ">no</th>
                            <th>project</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($myproject as $key=>$project)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                <a href="{{route('working.view', $project->id)}}">{{$project->project_name}}</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
