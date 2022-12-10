@extends('theme.content')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-8">
                        <div class="card-title">List All User</div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="card-title text-end">
                            <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">ສ້າງຜູ້ໃຊ້</a>
                        </div>
                    </div>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Profile</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $key => $val)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $val->name }}</td>
                                <td>{{ $val->email }}</td>
                                <td>{{ $val->mobile }}</td>
                                <td>{{ $val->status }}</td>
                                <td class="text-center">
                                    <button class="btn btn-info btn-sm">View</button>
                                    <button class="btn btn-primary btn-sm">Edit</button>
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
