@extends('layouts.admin')

@section('admin_content')
<!-- Dropify CSS -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Campaign</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <button class="btn btn-primary" data-toggle="modal" data-target="#addModal"> + Add New</button>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">All Campaign List</h3>
            </div>
            <div class="card-body">
                <table id="" class="table table-bordered table-striped table-sm ytable">
                  <thead>
                    <tr>
                      <th>Start Date</th>
                      <th>Title</th>
                      <th>Image</th>
                      <th>Discount(%)</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- Campaign Insert Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Campaign</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('campaign.store') }}" method="Post" enctype="multipart/form-data" id="add-form">
      @csrf
        <div class="modal-body">           
            <div class="form-group">
                <label for="title">Campaign Name/Title<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="title" required>
                <small id="emailHelp" class="form-text text-muted">This is your campaign title/name</small>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="start_date">Start Date<span class="text-danger">*</span></label>
                  <input type="date" class="form-control" name="start_date" required>
              </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="end_date">End Date<span class="text-danger">*</span></label>
                  <input type="date" class="form-control" name="end_date" required>
              </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="status">Status<span class="text-danger">*</span></label>
                  <select class="form-control" name="status" id="">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                  </select>
              </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="discount">Discount (%)<span class="text-danger">*</span></label>
                  <input type="number" class="form-control" name="discount" required>
                  <small id="emailHelp" class="form-text text-danger">Discount percentage are apply for all product selling price</small>
              </div>
              </div>
            </div>
            <div class="form-group">
                <label for="image">Campaign Banner<span class="text-danger">*</span></label>
                <input type="file" class="dropify" data-height="140" id="input-file-now" name="image" required>
                <small id="emailHelp" class="form-text text-muted">This is your Campaign Banner</small>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary"><span class="d-none"> Loading.... </span> Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Campaign Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Campaign</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="modal_body">

      </div>
    </div>
  </div>
</div>

@endsection

@section('script')

<script>
    $('.dropify').dropify({
        messages: {
            'default': 'Drag and drop a file here or click',
            'replace': 'Drag and drop or click to replace',
            'remove':  'Remove',
            'error':   'Ooops, something wrong happended.'
        }
    });
</script>

<script type="text/javascript">
  $(function campaign(){
    var table=$('.ytable').DataTable({
        processing:true,
        serverSide:true,
        ajax:"{{ route('campaign.index') }}",
        columns:[
            {data:'start_date',name:'start_date'},
            {data:'title',name:'title'},
            {data:'image',name:'image', render: function(data, type, full, meta){
              return "<img src=\"" +data+ "\" height=\"30\" />"
            }},
            {data:'discount',name:'discount'},
            {data:'status',name:'status'},
            {data:'action',name:'action',orderable:true,searchable:true},
        ]
    });
  });

  $('body').on('click','.edit',function(){
    let id=$(this).data('id');
    $.get("brand/edit/"+id, function(data){
      $("#modal_body").html(data);
    });
  });
</script>
@endsection