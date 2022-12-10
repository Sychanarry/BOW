@extends('theme.content')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-8">
                        <div class="card-title">ເບີ່ງໂຄງການ</div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="card-title text-end">
                            <a href="{{ route('project.create') }}" class="btn btn-primary btn-sm">ສ້າງໂຄງການໃໝ່</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
