@extends('user_master')
@section('user_content')

    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="{{ url('/') }}"><i class="fa fa-home"></i> Home</a>
                        <a href="./shop.html">Shop</a>
                        <span>Check Out</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Shopping Cart Section Begin -->
    <section class="checkout-section spad">
        <div class="container">
            @if (Session::has('error_remaining'))
                <div class="alert alert-danger" style="text-align: center">{{ Session::get('error_remaining') }}</div>
            @endif
            @if (count($errors) > 0)
                <div class="alert alert-danger" style="text-align: center">
                    @foreach ($errors->all() as $err)
                        {{ $err }}
                        <br>
                    @endforeach
                </div>
            @endif
            @if (Auth::check())
                <form action="{{ url('order') }}" class="checkout-form" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <h4>Biiling Details</h4>
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="fir">Name<span>*</span></label>
                                    <input type="text" name="user_name" required value="{{ Auth::user()->user_name }}"
                                        id="fir">
                                </div>
                                <div class="col-lg-12">
                                    <label for="street">Address<span>*</span></label>
                                    <input type="text" name="address" required id="street"
                                        value="{{ Auth::user()->address }}" class="street-first">
                                </div>
                                <div class="col-lg-12">
                                    <label for="phone">Phone<span>*</span></label>
                                    <input type="text" name="phone" required value="{{ Auth::user()->phone }}"
                                        id="phone">
                                </div>
                                <div class="col-lg-12">
                                    <div class="create-item">
                                        {{-- <label for="acc-create">
                                    Create an account?
                                    <input type="checkbox" id="acc-create">
                                    <span class="checkmark"></span>
                                </label> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="checkout-content">
                                <input type="text" name="voucher" id="voucher" placeholder="Enter Your Coupon Code">
                                <div id="voucher_message"></div>
                            </div>
                            <div class="place-order">
                                <h4>Your Order</h4>
                                <div class="order-total">
                                    <ul class="order-table">
                                        <li>Product <span>Total</span></li>
                                        @php
                                            $total = 0;
                                        @endphp
                                        @foreach ($data as $cart)
                                            <li class="fw-normal">
                                                {{ $cart->product_name }}&emsp;{{ $cart->color }}&emsp;{{ $cart->size }}<span>x&ensp;{{ $cart->quantity }}&emsp;{{ number_format($cart->quantity * $cart->price) }}</span>
                                            </li>
                                            @php
                                                $total += $cart->quantity * $cart->price;
                                            @endphp
                                        @endforeach
                                        <li class="fw-normal">Discount: <span id="discount">0</span>
                                        </li>
                                        <li class="total-price">Total: <span
                                                id="total_price">{{ number_format($total) }}</span>
                                        </li>

                                    </ul>
                                    {{-- <div class="payment-check">
                                <div class="pc-item">
                                    <label for="pc-check">
                                        Cheque Payment
                                        <input type="checkbox" id="pc-check">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="pc-item">
                                    <label for="pc-paypal">
                                        Paypal
                                        <input type="checkbox" id="pc-paypal">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div> --}}
                                    <div class="order-btn">
                                        <button type="submit" class="site-btn place-btn">Place Order</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @else
                <form action="{{ url('order') }}" class="checkout-form" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <h4>Biiling Details</h4>
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="fir">Name<span>*</span></label>
                                    <input type="text" name="user_name" required value="" id="fir">
                                </div>
                                <div class="col-lg-12">
                                    <label for="street">Address<span>*</span></label>
                                    <input type="text" name="address" required id="street" value=""
                                        class="street-first">
                                </div>
                                <div class="col-lg-12">
                                    <label for="phone">Phone<span>*</span></label>
                                    <input type="text" name="phone" required value="" id="phone">
                                </div>
                                <div class="col-lg-12">
                                    <div class="create-item">
                                        {{-- <label for="acc-create">
                                    Create an account?
                                    <input type="checkbox" id="acc-create">
                                    <span class="checkmark"></span>
                                </label> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="checkout-content">
                                <input type="text" name="voucher" id="voucher" placeholder="Enter Your Coupon Code">
                                <div id="voucher_message"></div>
                            </div>
                            <div class="place-order">
                                <h4>Your Order</h4>
                                <div class="order-total">
                                    <ul class="order-table">
                                        <li>Product <span>Total</span></li>
                                        @php
                                            $total = 0;
                                        @endphp
                                        @foreach ($data as $cart)
                                            <li class="fw-normal">
                                                {{ $cart->product_name }}&emsp;{{ $cart->color }}&emsp;{{ $cart->size }}<span>x&ensp;{{ $cart->quantity }}&emsp;{{ number_format($cart->quantity * $cart->price) }}</span>
                                            </li>
                                            @php
                                                $total += $cart->quantity * $cart->price;
                                            @endphp
                                        @endforeach
                                        <li class="fw-normal">Discount: <span id="discount">0</span>
                                        </li>
                                        <li class="total-price">Total: <span
                                                id="total_price">{{ number_format($total) }}</span>
                                        </li>

                                    </ul>
                                    {{-- <div class="payment-check">
                                <div class="pc-item">
                                    <label for="pc-check">
                                        Cheque Payment
                                        <input type="checkbox" id="pc-check">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="pc-item">
                                    <label for="pc-paypal">
                                        Paypal
                                        <input type="checkbox" id="pc-paypal">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div> --}}
                                    <div class="order-btn">
                                        <button type="submit" class="site-btn place-btn">Place Order</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </section>
    <!-- Shopping Cart Section End -->

    <script>
        $('#voucher').on('change', function() {
            var voucher_code = $(this).val();
            var totalPrice = {{ $total }};
            $.ajax({
                url: '{{ url('checkVoucher') }}',
                type: 'post',
                data: {
                    '_token': '{{ csrf_token() }}',
                    voucher_code,
                    totalPrice
                },
                success: function(data) {
                    $('#voucher_message').html(data.message);
                    var newPrice = totalPrice - data.discount;
                    $('#discount').html(data.discount);
                    $('#total_price').html(newPrice);
                }
            });
        });
    </script>

@endsection
