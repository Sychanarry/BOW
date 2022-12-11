{{-- dispay when add listdetail on page listtododetail only --}}

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
