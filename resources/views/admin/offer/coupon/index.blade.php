@extends('layouts.admin')

@section('admin_content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Coupon</h1>
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
              <h3 class="card-title">Coupon List</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-sm ytable">
                  <thead>
                    <tr>
                      <th>SL</th>
                      <th>Coupon Name</th>
                      <th>Coupon Amount</th>
                      <th>Valid Date</th>
                      <th>Coupon Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  
                  </tbody>
                </table>
                <form id="deleted_form" action="" method="post">
                    @csrf @method('DELETE')
                </form>
              </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- Coupon Insert Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Coupon</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="#" method="Post">
      @csrf
        <div class="modal-body">
            <div class="form-group">
                <label for="coupon_code">Coupon Code</label>
                <input type="text" class="form-control" name="coupon_code" required>
            </div>
            <div class="form-group">
                <label for="coupon_code">Coupon Type</label>
                <select class="form-control" name="type" id="">
                    <option value="1">Fixed</option>
                    <option value="2">Percentage</option>
                </select>
            </div>
            <div class="form-group">
                <label for="coupon_amount">Coupon Amount</label>
                <input type="text" class="form-control" name="coupon_amount" required>
            </div>
            <div class="form-group">
                <label for="valid_date">Valid Date</label>
                <input type="date" class="form-control" name="valid_date" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary"><span class="d-none">Loading...</span> Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Coupon Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Subcategory</h5>
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
    let table = $('.ytable').DataTable({
        processing:true,
        serverSide:true,
        ajax:"{{ route('coupon.index') }}",
        columns:[
            {data:'DT_RowIndex',name:'DT_RowIndex'},
            {data:'coupon_code',name:'coupon_code'},
            {data:'coupon_amount',name:'coupon_amount'},
            {data:'valid_date',name:'valid_date'},
            {data:'status',name:'status'},
            {data:'action',name:'action',orderable:true,searchable:true},
        ]
    });
    
    $(document).ready(function(){
        $(document).on('click', '#delete_coupon', function(e){
            e.preventDefault();
            var url = $(this).attr('href');
            $("#deleted_form").attr('action',url);

            swal({
                title: "Are You Want to Delete?",
                text: "Once Delete, This will be permanently Delete!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $("#deleted_form").submit();
                } else {
                    swal("Your imaginary file is safe!");
                }
            });
        });

        $('#deleted_form').submit(function(e){
            e.preventDefault();
            var url = $(this).attr('action');
            var request =$(this).serialize();
            $.ajax({
                url:url,
                type:'post',
                async:false,
                data:request,
                success:function(data){
                    $('#deleted_form')[0].reset();
                    table.ajax.reload();
                }
            });
        });
    });
</script>
@endsection