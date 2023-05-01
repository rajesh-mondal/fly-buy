<form action="{{ route('coupon.update') }}" method="Post" id="edit_form">
    @csrf
      <div class="modal-body">
          <div class="form-group">
              <label for="coupon_code">Coupon Code</label>
              <input type="text" class="form-control" name="coupon_code" value="{{ $data->coupon_code }}" required>
              <input type="hidden" name="id" value="{{ $data->id }}">
          </div>
          <div class="form-group">
              <label for="type">Coupon Type</label>
              <select class="form-control" name="type" id="" required>
                  <option value="1" @if($data->type==1) selected @endif>Fixed</option>
                  <option value="2" @if($data->type==2) selected @endif>Percentage</option>
              </select>
          </div>
          <div class="form-group">
              <label for="coupon_amount">Coupon Amount</label>
              <input type="text" class="form-control" name="coupon_amount" value="{{ $data->coupon_amount }}" required>
          </div>
          <div class="form-group">
              <label for="valid_date">Valid Date</label>
              <input type="date" class="form-control" name="valid_date" value="{{ $data->valid_date }}" required>
          </div>
          <div class="form-group">
            <label for="status">Coupon Status</label>
            <select class="form-control" name="status" id="" required>
                <option value="Active" @if($data->type=="Active") selected @endif>Active</option>
                <option value="Inactive" @if($data->type=="Inactive") selected @endif>Inactive</option>
            </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
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