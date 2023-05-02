<form action="{{ route('pickup.point.update') }}" method="Post" id="edit_form">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="pickup_point_name">Pickup Point Name <span class="text-danger">*</span> </label>
            <input type="text" class="form-control" name="pickup_point_name" value="{{ $data->pickup_point_name }}" required>
            <input type="hidden" name="id" value="{{ $data->id }}">
        </div>
        <div class="form-group">
            <label for="pickup_point_address">Address <span class="text-danger">*</span> </label>
            <input type="text" class="form-control" name="pickup_point_address" value="{{ $data->pickup_point_address }}" required>
        </div>
        <div class="form-group">
            <label for="pickup_point_phone">Phone <span class="text-danger">*</span> </label>
            <input type="text" class="form-control" name="pickup_point_phone" value="{{ $data->pickup_point_phone }}" required>
        </div>
        <div class="form-group">
            <label for="pickup_point_phone_two">Another Phone</label>
            <input type="text" class="form-control" name="pickup_point_phone_two" value="{{ $data->pickup_point_phone_two }}" required>
        </div>
    </div>
    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>

<script>
    //store coupon ajax call
    $('#edit_form').submit(function(e){
        e.preventDefault();
        $('.loading').removeClass('d-none');
        var url = $(this).attr('action');
        var request =$(this).serialize();
        $.ajax({
            url:url,
            type:'post',
            async:false,
            data:request,
            success:function(data){
                toastr.success(data);
                $('#edit_form')[0].reset();
                $('#editModal').modal('hide');
                table.ajax.reload();
            }
        });
    });
</script>