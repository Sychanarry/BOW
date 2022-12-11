
{{-- Modal form add List Todo --}}

<div class="modal fade" id="largeModal{{$val->id}}" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title">Form Add Todo</h6>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="col-12 mb-2">
                <label for="">Todo Title</label>
                <input type="text" class="form-control" id="todo_title_{{$val->id}}" name="todo_title" placeholder="Doto Title">
            </div>
            <div class="col-12 mb-2">
                <label for="">Status Todo</label>
                <select type="text" class="form-control" id="todo_status_{{$val->id}}" name="todo_status" >
                    <option value="">--Select--</option>
                    <option value="wait">Waiting</option>
                    <option value="inprogress">Inprogress</option>
                    <option value="success">Successfully</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary savelisttodo" id="{{$val->id}}">Save</button>
        </div>
      </div>
    </div>
  </div><!-- End Modal list todo -->

@section('script')
<script>
    $(document).ready(function() {
        $('.savelisttodo').on('click', function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var id = this.id;
            var todo_title = $("#todo_title_"+id).val();
            if(todo_title==''){
                $("#todo_title_"+id).focus();
                return false;
            }

            var todo_status = $("#todo_status_"+id).val();
            if(todo_status==''){
                $("#todo_status_"+id).focus();
                return false;
            }
                    $.ajax({
                        url: "todo",
                        type: 'post',
                        data: {
                            todo_title: todo_title,
                            id: id,
                            todo_status: todo_status
                        },
                        success: function(res) {
                            console.log(res);
                            // return false;
                            if (res.status) {
                                $("#getcounttodo_"+id).html(res.count);
                                Swal.fire('Success!', "Add Todo Successfully!",
                                'success');
                                setTimeout(function(){
                                   window.location.reload();
                                }, 1500);//wait 2 seconds
                            } else {
                                Swal.fire('Warning!', "Add Doto Failed!", 'error');
                            }
                            // Swal.Close();
                        }
                    });
                });
    });
</script>
@endsection
