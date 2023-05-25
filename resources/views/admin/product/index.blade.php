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
$(function childcategory(){
    var table=$('.ytable').DataTable({
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

</script>
@endsection