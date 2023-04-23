@extends('layouts.admin')

@section('admin_content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Admin Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
              <li class="breadcrumb-item active">Page Create</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Create a New Page</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('page.store') }}" method="Post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="page_position">Page Position</label>
                                <select class="form-control" name="page_position" id="page_position">
                                    <option value="1">Line One</option>
                                    <option value="2">Line Two</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="page_name">Page Name</label>
                                <input type="text" class="form-control" name="page_name" id="page_name" placeholder="Page Name">
                            </div>
                            <div class="form-group">
                                <label for="page_title">Page Title</label>
                                <input type="text" class="form-control" name="page_title" id="page_title" placeholder="Page Title">
                            </div>
                            <div class="form-group">
                                <label for="page_description">Page Description</label>
                                <textarea class="form-control textarea"></textarea>
                                <small>This data will show on your webpage</small>
                            </div>
                        </div>
                        <!-- /.card-body -->
        
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
