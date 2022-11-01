@if ($cart_list_item != null)
    <div class="col-lg-12">
        <div class="cart-table">
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th class="p-name">Product Name</th>
                        <th>Color</th>
                        <th>Size</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th><i class="ti-close"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart_list_item as $item)
                        <tr>
                            <td class="cart-pic first-row"><img src="images/{{ $item->image }}" width="150"
                                    height="150" alt="imgProduct" style="object-fit: cover" class="img-thumbnail"></td>
                            <td class="cart-title first-row">
                                <h5>{{ $item->product_name }}</h5>
                            </td>
                            <td class="total-price first-row">{{ $item->color }}</td>
                            <td class="total-price first-row">{{ $item->size }}</td>
                            <td class="p-price first-row" id="price{{ $item->id_product_detail }}">
                                {{ number_format($item->price) }}
                            </td>
                            <td class="qua-col first-row">
                                <div class="quantity">
                                    <div class="">
                                        <input type="number" id="{{ $item->id_product_detail }}"
                                            name="quantity{{ $item->id_product_detail }}"
                                            value="{{ $cart_list[$item->id_product_detail] }}" min="1"
                                            max="10">
                                    </div>
                                </div>
                            </td>
                            <td class="total-price first-row totalSingle" id="{{ $item->id_product_detail }}">
                                {{ number_format($item->price * $cart_list[$item->id_product_detail]) }}
                            </td>
                            <td class="close-td first-row"><button class="btn btn-outline-danger"
                                    onclick="delFromCart({{ $item->id_product_detail }})"><i
                                        class=" fa fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-lg-4">
                {{-- <div class="cart-buttons">
                <a href="#" class="primary-btn continue-shop">Continue shopping</a>
            </div> --}}
                {{-- <div class="discount-coupon">
                <h6>Discount Codes</h6>
                <form action="#" class="coupon-form">
                    <input type="text" placeholder="Enter your codes">
                    <button type="submit" class="site-btn coupon-btn">Apply</button>
                </form>
            </div> --}}
            </div>
            <div class="col-lg-4 offset-lg-4">
                <div class="proceed-checkout">
                    <ul>
                        {{-- <li class="subtotal">Subtotal <span>$240.00</span></li> --}}
                        <li class="cart-total">Total <span id="cart_total">0</span></li>
                    </ul>
                    <a href="{{ url('checkout') }}" class="proceed-btn">PROCEED TO CHECK OUT</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var total = 0;
            $('.totalSingle').each(function() {
                totalSingle = $(this).html();
                totalSingle = totalSingle.replace(/,/g, '');
                total = total + parseFloat(totalSingle);
            })
            $('#cart_total').html(total.toLocaleString('en-US'));
        });
    </script>
@else
    <div class="col text-center">
        <a href="{{ url('shop') }}" class="primary-btn continue-shop">Continue shopping</a>
    </div>
@endif
