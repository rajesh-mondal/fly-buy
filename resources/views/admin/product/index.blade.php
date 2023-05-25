@extends('layouts.admin')

@section('admin_content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Products</h1>
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
              <h3 class="card-title">All Product List</h3>
            </div>
            <br>
            <div class="row p-2">
                <div class="form-group col-3">
                    <label>Category</label>
                    <select class="form-control submitable" name="category_id">
                        <option value="">All</option>
                        @foreach ($category as $row)
                            <option value="{{$row->id}}">{{ $row->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-3">
                    <label>Brand</label>
                    <select class="form-control submitable" name="brand_id">
                        <option value="">All</option>
                        @foreach ($brand as $row)
                            <option value="{{$row->id}}">{{ $row->brand_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-3">
                    <label>Warehouse</label>
                    <select class="form-control submitable" name="warehouse_id">
                        <option value="">All</option>
                        @foreach ($warehouse as $row)
                            <option value="{{$row->id}}">{{ $row->warehouse_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-3">
                    <label>Status</label>
                    <select class="form-control submitable" name="status">
                        <option value="">All</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="card-body">
                <table id="" class="table table-bordered table-striped table-sm ytable">
                  <thead>
                    <tr>
                      <th>SL</th>
                      <th>Thumbnail</th>
                      <th>Name</th>
                      <th>Code</th>
                      <th>Category</th>
                      <th>Subcategory</th>
                      <th>Brand</th>
                      <th>Featured</th>
                      <th>Today Deal</th>
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

@endsection

@section('script')

<script type="text/javascript">
$(function product(){
    table=$('.ytable').DataTable({
        processing:true,
        serverSide:true,
        ajax:"{{ route('product.index') }}",
        columns:[
            {data:'DT_RowIndex',name:'DT_RowIndex'},
            {data:'thumbnail',name:'thumbnail'},
            {data:'name',name:'name'},
            {data:'code',name:'code'},
            {data:'category_name',name:'category_name'},
            {data:'subcategory_name',name:'subcategory_name'},
            {data:'brand_name',name:'brand_name'},
            {data:'featured',name:'featured'},
            {data:'today_deal',name:'today_deal'},
            {data:'status',name:'status'},
            {data:'action',name:'action',orderable:true,searchable:true},
        ]
    });
});

//deactive featured
$('body').on('click','.deactive_featured',function(){
    var id=$(this).data('id');
    var url = "{{ url('product/not-featured') }}/"+id;
    $.ajax({
        url: url,
        type: 'get',
        success:function(data){
            toastr.success(data);
            table.ajax.reload();
        }
    });
});

//active featured
$('body').on('click','.active_featured',function(){
    var id=$(this).data('id');
    var url = "{{ url('product/active-featured') }}/"+id;
    $.ajax({
        url: url,
        type: 'get',
        success:function(data){
            toastr.success(data);
            table.ajax.reload();
        }
    });
});

//deactive deal
$('body').on('click','.deactive_deal',function(){
    var id=$(this).data('id');
    var url = "{{ url('product/not-deal') }}/"+id;
    $.ajax({
        url: url,
        type: 'get',
        success:function(data){
            toastr.success(data);
            table.ajax.reload();
        }
    });
});

//active deal
$('body').on('click','.active_deal',function(){
    var id=$(this).data('id');
    var url = "{{ url('product/active-deal') }}/"+id;
    $.ajax({
        url: url,
        type: 'get',
        success:function(data){
            toastr.success(data);
            table.ajax.reload();
        }
    });
});

//suitable class call for every change
$(document).on('change','.submitable',function(){
    $('.ytable').DataTable().ajax.reload();
})

</script>
@endsection