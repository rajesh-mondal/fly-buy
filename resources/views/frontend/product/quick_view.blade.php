@php
    $colors = explode(',',$product->color);
    $sizes = explode(',',$product->size);
@endphp
<div class="modal-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="">
                    <img src="{{ asset('files/product/'.$product->thumbnail) }}" alt="" height="100%" width="100%">
                </div>
            </div>
            <div class="col-lg-8">
                <h3>{{ $product->name }}</h3>
                <p>{{ $product->category->category_name }} > {{ $product->subcategory->subcategory_name }}</p>
                <p>Brand: {{ $product->brand->brand_name }}</p>
                <p>stock: @if($product->stock_quantity<1) <span class="badge badge-danger">Stock Out</span> @else <span class="badge badge-success">Stock Available</span> @endif </p>
                <div class="">
                    @if($product->discount_price==NULL)
                        <div class="product_price" style="margin-top: 0px;">Price: {{ $setting->currency }}{{ $product->selling_price }}</div>
                    @else
                        <div class="product_price" style="margin-top: 0px;">Price: <del class="text-danger h6">{{ $setting->currency }}{{ $product->selling_price }}</del>{{ $setting->currency }}{{ $product->discount_price }}</div>
                    @endif
                </div>
                <br>
                <div class="order-info d-flex flex-row">
                    <form action="{{ route('add.to.cart.quickview') }}" method="post" id="add_cart_form">
                        @csrf
                        @method('PUT')
                        {{-- Add to Cart Details --}}
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        @if($product->discount_price==NULL)
                            <input type="hidden" name="price" value="{{ $product->selling_price }}">
                        @else
                            <input type="hidden" name="price" value="{{ $product->discount_price }}">
                        @endif
                        <div class="form-group">
                            <div class="row">
                                @isset( $product->size )
                                    <div class="col-lg-6">
                                        <label>Size: </label><br>
                                        <select class="custom-select form-control-sm" name="size" style="min-width: 120px; margin-left: -4px;">
                                            @foreach ($sizes as $size)
                                                <option value="{{ $size }}">{{ $size }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endisset()

                                @isset( $product->color )
                                    <div class="col-lg-6">
                                        <label class="ml-2">Color: </label><br>
                                        <select class="custom-select form-control-sm" name="color" style="min-width: 120px;">
                                            @foreach ($colors as $color)
                                                <option value="{{ $color }}">{{ $color }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endisset
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label class="mt-2">Quantity: </label><br>
                                    <input type="number" class="form-control-sm" min="1" max="100" name="qty" value="1" style="min-width: 120px; margin-left: -4px;">
                                </div>
                            </div>
                        </div>
                        <div class="button-container">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    @if($product->stock_quantity<1)
                                    <span class="text-danger">Stock Out</span>
                                    @else
                                    <button class="btn btn-sm btn-outline-info" type="submit"><span class="loading d-none">...</span> Add to Cart</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    $('#add_cart_form').submit(function(e){
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
                    $('#add_cart_form')[0].reset();
                    $('.loading').addClass('d-none');
                    cart();
                }
            });
        });
</script>