<?php
use App\Models\Listtodo;
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
                 <!-- Accordion without outline borders -->
                 <div class="accordion accordion-flush" id="accordionFlushExample">
                    @foreach($listtodo as $key=>$val)
                    <?php
                    // get count all tododetail
                    $countlisttododetail=Listtodo::where('todo_id', $val->id)->get()->count();
                    ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne{{ $val->id }}" aria-expanded="false"
                                    aria-controls="flush-collapseOne{{ $val->id }}">
                                    <strong>{{$key+1}}. </strong>&nbsp; {{ $val->title }}
                                    &nbsp;&nbsp;|&nbsp;&nbsp;
                                    {{-- count list todo detail --}}
                                    <span class="badge bg-info text-white">{{$countlisttododetail}}</span>
                                    &nbsp;&nbsp;|&nbsp;&nbsp;
                                    {{-- count status todo title --}}
                                    @if($val->status=='wait')
                                    <span class="badge bg-secondary">{{$val->status}}</span>
                                    @elseif($val->status=='inprogress')
                                    <span class="badge bg-warning">{{$val->status}}</span>
                                    @elseif($val->status=='success')
                                    <span class="badge bg-success">{{$val->status}}</span>
                                    @endif
                                </button>
                            </h2>
                            <div id="flush-collapseOne{{$val->id }}" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample"
                                style="">
                                <div class="accordion-body">
                                    {{-- include listtododetail by project --}}
                                    @include("page.listtodo.listtododetail")
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div><!-- End Accordion without outline borders -->
            </div>
        </div>
    </div>
@endsection
