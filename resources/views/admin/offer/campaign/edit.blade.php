<form action="{{ route('campaign.update') }}" method="Post" enctype="multipart/form-data" id="add-form">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="title">Campaign Name</label>
            <input type="text" class="form-control" name="title" value="{{ $data->title }}" required>
        </div>
        <input type="hidden" name="id" value="{{ $data->id }}">
        <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="start_date">Start Date<span class="text-danger">*</span></label>
                <input type="date" class="form-control" value="{{ $data->start_date }}" name="start_date" required>
            </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="end_date">End Date<span class="text-danger">*</span></label>
                <input type="date" class="form-control" value="{{ $data->end_date }}" name="end_date" required>
            </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="status">Status<span class="text-danger">*</span></label>
                <select class="form-control" name="status" id="">
                  <option value="1" @if($data->status==1) selected @endif>Active</option>
                  <option value="0" @if($data->status==0) selected @endif>Inactive</option>
                </select>
            </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="discount">Discount (%)<span class="text-danger">*</span></label>
                <input type="number" class="form-control" value="{{ $data->discount }}" name="discount" required>
                <small id="emailHelp" class="form-text text-danger">Discount percentage are apply for all product selling price</small>
            </div>
            </div>
          </div>
        <div class="form-group">
            <label for="image">Campaign Banner</label>
            <input type="file" class="dropify" data-height="140" id="input-file-now" name="image">
            <input type="hidden" name="old_image" value="{{ $data->image }}">
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary"><span class="d-none"> Loading.... </span> Update</button>
    </div>
</form>
