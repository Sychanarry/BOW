@extends('theme.content')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card-title">ຟອມສ້າງໂຄງການໃຫມ່</div>
                    </div>
                </div>

                <form action="{{ route('project.store') }}" method="post" name="formuser" enctype="multipart/form-data">
                    @csrf
                    <div class="col-12 mb-3">
                        <label for="">ຊື່ໂຄງການ <span class="text-danger">*</span></label>
                        <input id="project_name" type="text"
                            class="form-control @error('project_name') is-invalid @enderror" name="project_name"
                            value="{{ old('project_name') }}" required autocomplete="project_name">
                        @error('project_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-12 mb-3">
                        <label for="">ເໝາະໂຄງການໃຫ້ພະນັກງານ <span class="text-danger">*</span></label>
                        <select id="asign_to_user" multiple
                            class="form-control @error('asign_to_user') is-invalid @enderror" name="asign_to_user[]"
                            value="{{ old('asign_to_user') }}" required>
                            <option>--ກະລຸນາເລືອກພະນັກງານ--</option>
                            @foreach ($user as $val)
                                <option value="{{ $val->id }}">{{ $val->name }}</option>
                            @endforeach
                        </select>
                        @error('asign_to_user')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-12 mb-3">
                        <label for="">Remark <span class="text-danger"></span></label>
                        <textarea rows="3" id="remark" name="remark" class="form-control" name="remark" autocomplete="remark">{{ old('remark') }}</textarea>
                    </div>

                    <div class="col-12 mt-3">
                        <button type="submit" class="btn btn-primary">ບັນທືກ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
