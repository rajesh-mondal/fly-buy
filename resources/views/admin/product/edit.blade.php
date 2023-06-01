@extends('layouts.admin')

@section('admin_content')
<style>
    .bootstrap-tagsinput .tag{
        background: #428bca;
        border: 1px solid white;
        padding: 1px 6px;
        padding-left: 2px;
        margin-right: 2px;
        color: white;
        border-radius: 4px;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>New Product</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Update Product</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-8">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Update Product</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label for="name">Product Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" value="{{ $product->name }}" required>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="code">Product code <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="code" {{ old('code') }} required>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="subcategory_id">Category/Subcategory <span class="text-danger">*</span></label>
                                        <select class="form-control" name="subcategory_id" id="subcategory_id">
                                            <option disabled selected>Choose Category</option>
                                            @foreach ($category as $row)
                                                @php
                                                    $subcategory = DB::table('subcategories')->where('category_id',$row->id)->get();    
                                                @endphp
                                                <option style="color: blue;" disabled>{{ $row->category_name }}</option>
                                                    @foreach ($subcategory as $row)
                                                        <option value="{{ $row->id }}"> -- {{ $row->subcategory_name }}</option>
                                                    @endforeach
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="childcategory_id">Childcategory <span class="text-danger">*</span></label>
                                        <select class="form-control" name="childcategory_id" id="childcategory_id">
                                            
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="brand_id">Brand <span class="text-danger">*</span></label>
                                        <select class="form-control" name="brand_id">
                                            @foreach ($brand as $row)
                                                <option value="{{ $row->id }}">{{ $row->brand_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="pickup_point_id">Pickup Point</label>
                                        <select class="form-control" name="pickup_point_id">
                                            @foreach ($pickup_point as $row)
                                                <option value="{{ $row->id }}">{{ $row->pickup_point_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label for="unit">Unit <span class="text-danger">*</span></label>
                                        <input type="text" name="unit" class="form-control" value="{{ old('unit') }}" required>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="tags">Tags <span class="text-danger">*</span></label><br>
                                        <input type="text" name="tags" class="form-control" value="{{ old('tags') }}" data-role="tagsinput" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-lg-4">
                                        <label for="purchase_price">Purchase Price</label>
                                        <input type="text" name="purchase_price" class="form-control" value="{{ old('purchase_price') }}">
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="selling_price">Selling Price <span class="text-danger">*</span></label>
                                        <input type="text" name="selling_price" class="form-control" value="{{ old('selling_price') }}" required>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="discount_price">Discount Price</label>
                                        <input type="text" name="discount_price" class="form-control" value="{{ old('discount_price') }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label for="warehouse">Warehouse <span class="text-danger">*</span></label>
                                        <select class="form-control" name="warehouse" id="">
                                            @foreach ($warehouse as $row)
                                                <option value="{{ $row->warehouse_name }}">{{ $row->warehouse_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="stock_quantity">Stock</label>
                                        <input type="text" name="stock_quantity" class="form-control" value="{{ old('stock_quantity') }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label for="color">Color</label><br>
                                        <input type="text" name="color" class="form-control" value="{{ old('color') }}" data-role="tagsinput" />
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="size">Size</label><br>
                                        <input type="text" name="size" class="form-control" value="{{ old('size') }}" data-role="tagsinput" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-lg-12">
                                        <label for="description">Product Details</label><br>
                                        <textarea class="form-control textarea" name="description">{{ old('description') }}</textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-lg-12">
                                        <label for="video">Video Embed Code</label><br>
                                        <textarea class="form-control" name="video">{{ old('video') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- right column -->
                    <div class="col-md-4">
                        <!-- Form Element sizes -->
                        <div class="card card-primary">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="thumbnail">Main Thumbnail <span class="text-danger">*</span></label><br>
                                    <input type="file" name="thumbnail" id="" accept="image/*" class="dropify" required>
                                </div><br>
                                <div class="">
                                    <table class="table table-bordered" id="dynamic_field">
                                        <div class="card-header">
                                            <h3 class="card-title">More Images (Click Add For More Images)</h3>
                                        </div>
                                        <tr>
                                            <td>
                                                <input type="file" accept="image/*" name="images[]" class="form-control name_list">
                                            </td>
                                            <td>
                                                <button type="button" name="add" id="add" class="btn btn-sm btn-success">Add</button>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="card p-4">
                                    <h6>Featured Product</h6>
                                    <input type="checkbox" name="featured" value="1" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                </div>
                                <div class="card p-4">
                                    <h6>Today Deal</h6>
                                    <input type="checkbox" name="today_deal" value="1" checked data-bootstrap-switch data-off-color="danger" data-on-color="success" id="">
                                </div>
                                <div class="card p-4">
                                    <h6>Product slider</h6>
                                    <input type="checkbox" name="product_slider" value="1" data-bootstrap-switch data-off-color="danger" data-on-color="success" id="">
                                </div>
                                <div class="card p-4">
                                    <h6>Status</h6>
                                    <input type="checkbox" name="status" value="1" checked data-bootstrap-switch data-off-color="danger" data-on-color="success" id="">
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <button class="btn btn-info ml-2" type="submit">Submit</button>
                </div>
                <!-- /.row -->
            </form>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

@endsection

@section('script')
<script>
    $('.dropify').dropify();

    $("input[data-bootstrap-switch]").each(function(){
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

    // ajax request send for collect childcategory
    $("#subcategory_id").change(function(){
        var id = $(this).val();
        $.ajax({
            url: "{{ url("/get-child-category/") }}/"+id,
            type: 'get',
            success: function(data){
                $('select[name="childcategory_id"]').empty();
                    $.each(data, function(key,data){
                        $('select[name="childcategory_id"]').append('<option value="'+ data.id +'">'+ data.childcategory_name +'</option>');
                    });
            }
        });
    });

    $(document).ready(function(){
        var postURL = "<?php echo url('addmore'); ?>";
        var i =1;

        $('#add').click(function(){
            i++;
            $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="file" accept="image/*" name="images[]" class="form-control name_list"/></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-sm btn-danger btn_remove">X</button></td></tr>');
        });

        $(document).on('click', '.btn_remove', function(){
            var button_id = $(this).attr("id");
            $('#row'+button_id+'').remove();
        });
    });

</script>

@endsection