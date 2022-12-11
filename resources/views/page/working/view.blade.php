<?php
use App\Models\User;
use App\Models\Todo;
$todo=Todo::join('asign','asign.project_id','todo.project_id')
->where('asign.asign_to_id',$mytodo->asign_to_id)
->select('todo.title','todo.id','todo.status')
->get();
?>
@extends('theme.content')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card-title">ໂຄງການ</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <img class="img-fluid rounded-circle me-2" width="45px"
                        src="{{ asset('assets/profile') }}/{{ $mytodo->profile }}" alt=""
                        srcset="">
                        <strong>project: </strong>&nbsp; {{ $mytodo->project_name }}
                    </div>
                </div>

                <!-- Accordion without outline borders -->
                <div class="accordion accordion-flush" id="accordionFlushExample}">
                @foreach($todo as $keytodo=>$itemtodo)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne{{ $itemtodo->id }}" aria-expanded="false"
                                    aria-controls="flush-collapseOne{{ $itemtodo->id }}">
                                    <strong>{{$keytodo+1}}. &nbsp;&nbsp;</strong>

                                    &nbsp;&nbsp;|&nbsp;&nbsp;

                                    {{-- count status todo title --}}
                                    @if($itemtodo->status=='wait')
                                    <span class="badge bg-secondary">{{$itemtodo->status}}</span>
                                    @elseif($itemtodo->status=='inprogress')
                                    <span class="badge bg-warning">{{$itemtodo->status}}</span>
                                    @elseif($itemtodo->status=='success')
                                    <span class="badge bg-success">{{$itemtodo->status}}</span>
                                    @endif

                                    &nbsp;&nbsp;|&nbsp;&nbsp;

                                    {{$itemtodo->title}}
                                </button>
                            </h2>
                            <div id="flush-collapseOne{{$itemtodo->id}}" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample"
                                style="">
                                <div class="accordion-body">
                                   @include('page.working.listtododetail')
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- End Accordion without outline borders -->
            </div>
        </div>
    </div>
@endsection
