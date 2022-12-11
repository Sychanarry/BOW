<?php
use App\Models\Listtodo;
$listtododetail=Listtodo::where('todo_id', $val->id)->get();
?>
<div class="container">
    <table class="table">
        <thead>
            <th colspan="2">Todo Title</th>
            <th>status</th>
            <th>Priority</th>
        </thead>
        <tbody id="res{{$val->id}}">
            @foreach($listtododetail as $item)
            <tr>
                <td>
                    <button class="btn btn-sm updatetododetail" id="{{$item->id}}">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                </td>
                <td>
                    <input type="text" class="form-control" id="todo_title_update_{{$item->id}}" value="{{$item->todo_title}}">
                </td>
                <td>
                    <select  class="form-control" name="status_todo{{$item->id}}" id="status_todo_update_{{$item->id}}">
                        <option value="wait" {{$item->status_todo=='wait'?'selected':''}}>wait</option>
                        <option value="inprogress" {{$item->status_todo=='inprogress'?'selected':''}}>inprogress</option>
                        <option value="success" {{$item->status_todo=='success'?'selected':''}}>success</option>
                    </select>
                </td>
                <td>
                    <select class="form-control" name="priority{{$item->id}}" id="priority_update_{{$item->id}}">
                        <option value="high" {{$item->priority=='high'?'selected':''}}>high</option>
                        <option value="medium" {{$item->priority=='medium'?'selected':''}}>medium</option>
                        <option value="low" {{$item->priority=='low'?'selected':''}}>low</option>
                    </select>
                </td>
                {{-- hide this colunm size mobile  --}}
            </tr>
            @endforeach
        </tbody>
            <tfoot>
                <tr>
                    <td>
                        <button class="btn btn-sm addtododetail" id="{{$val->id}}">
                            <i class="bi bi-save"></i>
                        </button>
                    </td>
                    <td>
                        <input type="text" size="20" class="form-control" name="todo_title{{$val->id}}" id="todo_title{{$val->id}}" placeholder="Title">
                    </td>
                    <td>
                        <select  class="form-control" name="status_todo{{$val->id}}" id="status_todo{{$val->id}}">
                            <option value="wait">wait</option>
                            <option value="inprogress">inprogress</option>
                            <option value="success">success</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-control" name="priority{{$val->id}}" id="priority{{$val->id}}">
                            <option value="high">high</option>
                            <option value="medium">medium</option>
                            <option value="low">low</option>
                        </select>
                    </td>
                </tr>
            </tfoot>
        </tbody>
    </table>
</div>

@section('script')
    <script>
        $(document).ready(function() {
            // function add todo detail
            $('.addtododetail').on('click', function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var todoid= this.id;// get todo id
                var todo_title= $("#todo_title"+todoid).val();
                var status_todo= $("#status_todo"+todoid).val();
                var priority= $("#priority"+todoid).val();
                if(todo_title=='' || todo_title.trim()==''){
                    $("#todo_title"+todoid).focus();
                    Swal.fire('Warning!', "please enter title!", 'error');
                    return false;
                }
                $.ajax({
                    url: "{{route('listtodo.store')}}",
                    type: 'post',
                    data: {
                        todo_title: todo_title,
                        status_todo: status_todo,
                        priority: priority,
                        todoid: todoid
                    },
                    success: function(res) {
                        if (res.status) {
                            $("#todo_title"+todoid).val('');
                            Swal.fire('Success!', "add successfully!",
                            'success');
                            $("#res"+todoid).html(res.table);
                        } else {
                            Swal.fire('Warning!', "add failed!", 'error');
                        }
                    }
                });
            });

            // function update todo detail
            $('.updatetododetail').on('click', function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var id= this.id;// get list todo id
                var todo_title= $("#todo_title_update_"+id).val();
                var status_todo= $("#status_todo_update_"+id).val();
                var priority= $("#priority_update_"+id).val();
                if(todo_title=='' || todo_title.trim()==''){
                    Swal.fire('Warning!', "please enter title!", 'error');
                    return false;
                }
                $.ajax({
                    url: "{{route('listtodo.updatetododetail')}}",
                    type: 'post',
                    data: {
                        todo_title: todo_title,
                        status_todo: status_todo,
                        priority: priority,
                        id: id
                    },
                    success: function(res) {
                        if (res.status) {
                            Swal.fire('Success!', "update Successfully!",
                                'success');
                        } else {
                            Swal.fire('Warning!', "update Failed!", 'error');
                        }
                    }
                });
            });
        });
    </script>
@endsection
