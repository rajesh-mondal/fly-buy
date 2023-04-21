<form action="{{ route('brand.update') }}" method="Post" enctype="multipart/form-data" id="add-form">
    @csrf
      <div class="modal-body">           
          <div class="form-group">
              <label for="brand_name">Brand Name</label>
              <input type="text" class="form-control" name="brand_name" value="{{ $data->brand_name }}" required>
              <small id="emailHelp" class="form-text text-muted">This is your Brand</small>
          </div>
          <input type="hidden" name="id" value="{{ $data->id }}">
          <div class="form-group">
              <label for="brand_logo">Brand Logo</label>
              <input type="file" class="dropify" data-height="140" id="input-file-now" name="brand_logo">
              <input type="hidden" name="old_logo" value="{{ $data->brand_logo }}">
              <small id="emailHelp" class="form-text text-muted">This is your Brand Logo</small>
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary"><span class="d-none"> Loading.... </span> Update</button>
      </div>
    </form>