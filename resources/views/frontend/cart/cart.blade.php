@extends('layouts.app')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/cart_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/cart_responsive.css') }}">

    @include('layouts.front_partial.collaps_nav')

    <div class="cart_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cart_container">
                        <div class="cart_title">Shopping Cart</div>
                        <div class="cart_items">
                            <ul class="cart_list">
                                @foreach ($content as $row)
                                <li class="cart_item clearfix">
                                    <div class="cart_item_image"><img src="images/shopping_cart.jpg" alt=""></div>
                                    <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                        <div class="cart_item_name cart_info_col">
                                            <div class="cart_item_text">MacBook Air 13</div>
                                        </div>
                                        <div class="cart_item_color cart_info_col">
                                            <div class="cart_item_text">
                                                <select class="custom-select form-control-sm" name="color" style="min-width: 120px; margin-left: -4px;">
                                                    <option value="1">32</option>
                                                    <option value="1">33</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="cart_item_color cart_info_col">
                                            <div class="cart_item_text">
                                                <select class="custom-select form-control-sm" name="size" style="min-width: 120px; margin-left: -4px;">
                                                    <option value="1">32</option>
                                                    <option value="1">33</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="cart_item_quantity cart_info_col">
                                            <div class="cart_item_text">
                                                <input type="number" class="form-control-sm" min="1" max="100" name="qty" value="1" style="min-width: 120px; margin-left: -4px;">
                                            </div>
                                        </div>
                                        <div class="cart_item_price cart_info_col">
                                            <div class="cart_item_text">$2000</div>
                                        </div>
                                        <div class="cart_item_total cart_info_col">
                                            <div class="cart_item_text">$2000</div>
                                        </div>
                                        <div class="cart_item_total cart_info_col">
                                            <div class="cart_item_text"><a href="#" class="text-danger"> X</a></div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="order_total">
                            <div class="order_total_content text-md-right">
                                <div class="order_total_title">Order Total:</div>
                                <div class="order_total_amount">$2000</div>
                            </div>
                        </div>
                        <div class="cart_buttons">
                            <button type="button" class="button cart_button_clear">Clear Cart</button>
                            <button type="button" class="button cart_button_checkout">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="newsletter">
        <div class="container">
          <div class="row">
            <div class="col">
              <div
                class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
                <div class="newsletter_title_container">
                  <div class="newsletter_icon"><img src="images/send.png" alt=""></div>
                  <div class="newsletter_title">Sign up for Newsletter</div>
                  <div class="newsletter_text">
                    <p>...and receive %20 coupon for first shopping.</p>
                  </div>
                </div>
                <div class="newsletter_content clearfix">
                  <form action="#" class="newsletter_form">
                    <input type="email" class="newsletter_input" required="required"
                      placeholder="Enter your email address">
                    <button class="newsletter_button">Subscribe</button>
                  </form>
                  <div class="newsletter_unsubscribe_link"><a href="#">unsubscribe</a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection
