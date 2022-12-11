{{-- dispay on page listtodo only --}}
<?php
use App\Models\Listtodo;
$listtododetail=Listtodo::join('todo','todo.id','list_todo.todo_id')
->where('list_todo.todo_id',$itemtodo->id)
->select('list_todo.*')
->get();
?>

<div class="row">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>anything todo</th>
                <th>progress</th>
                <th>priority</th>
            </tr>
        </thead>
        <tbody>
            @foreach($listtododetail as $keylisttodo=>$tododetail)
            <tr>
                <td>
                    <strong>{{$keylisttodo+1}}. </strong>
                    {{$tododetail->todo_title}}
                </td>

                <td>
                    @if($tododetail->status_todo=='success')
                    <span class="badge bg-success">{{$tododetail->status_todo}}</span>
                    @elseif($tododetail->status_todo=='inprogress')
                        <span class="badge bg-warning">{{$tododetail->status_todo}}</span>
                    @elseif($tododetail->status_todo=='wait')
                        <span class="badge bg-secondary">{{$tododetail->status_todo}}</span>
                    @endif
                </td>

                <td>
                    @if($tododetail->priority=='high')
                    <span class="badge bg-danger">{{$tododetail->priority}}</span>
                    @elseif($tododetail->priority=='medium')
                        <span class="badge bg-warning">{{$tododetail->priority}}</span>
                    @elseif($tododetail->priority=='low')
                        <span class="badge bg-info">{{$tododetail->priority}}</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
</table>
</div>
