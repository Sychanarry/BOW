@extends('theme.content')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Edit User</div>
                <form action="{{ route('user.update',$user->id) }}" method="post" name="formuser" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="profile" class="">Upload Profile <span class="text-danger"></span></label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" id="profile" name="profile" >
                            </div>
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <label for="">Gender <span class="text-danger">*</span></label>
                            <select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender"
                                value="{{ old('gender') }}" required autocomplete="gender" autofocus>
                                <option>--Select Gender--</option>
                                <option value="Mr" @if($user->gender === "Mr") selected @endif>Male</option>
                                <option value="Ms" @if($user->gender === "Ms") selected @endif>Female</option>
                            </select>
                            @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <label for="">Name <span class="text-danger">*</span></label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name',$user->name) }}" required autocomplete="name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <label for="">Email <span class="text-danger">*</span></label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email',$user->email) }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <label for="">Password<span class="text-danger">*</span></label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                value="{{ old('password',$user->password) }}" required autocomplete="password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="">Mobile <span class="text-danger">*</span></label>
                            <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror"
                                name="mobile" value="{{ old('mobile',$user->mobile) }}" required autocomplete="mobile">
                            @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <label for="">Role <span class="text-danger">*</span></label>
                            <select id="role" class="form-control @error('role') is-invalid @enderror" name="role"
                                value="{{ old('role') }}" required autocomplete="role">
                                <option>--Select Role--</option>
                                <option value="admin" @if($user->role ==="admin") selected @endif>Manager</option>
                                <option value="staff" @if($user->role ==="staff") selected @endif >Staff</option>
                            </select>
                            @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" name="status" value="active" type="checkbox"
                                    id="status" @if($user->status ==="active")checked @endif>
                                <label class="form-check-label" for="gridCheck">
                                    Active
                                </label>
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
