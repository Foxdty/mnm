<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>

<!-- Header Section Begin -->
<header class="header-section">
    <div class="header-top">
        <div class="container">
            <div class="ht-left">
                <div class="mail-service">
                    <i class=" fa fa-envelope"></i>
                    hello.daumoi@gmail.com
                </div>
                <div class="phone-service">
                    <i class=" fa fa-phone"></i>
                    +84 69.420.420
                </div>

            </div>
            <div class="ht-right">
                @if (Auth::check())
                @else
                    <a href="./login" class="login-panel"><i class="fa fa-user"></i>Login</a>
                @endif
                <div class="top-social">
                    <a href="#"><i class="ti-facebook"></i></a>
                    <a href="#"><i class="ti-twitter-alt"></i></a>
                    <a href="#"><i class="ti-linkedin"></i></a>
                    <a href="#"><i class="ti-pinterest"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="inner-header">
            <div class="row">
                <div class="col-lg-2 col-md-2">
                    <div class="logo">
                        <a href="{{ url('/index') }}">
                            <img src="img/logo.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7">
                    {{-- <div class="advanced-search">
                        <button type="button" class="category-btn">All Categories</button>
                        <div class="input-group">
                            <input type="text" placeholder="What do you need?">
                            <button type="button"><i class="ti-search"></i></button>
                        </div>
                    </div> --}}
                </div>
                <div class="col-lg-3 text-right col-md-3">
                    <ul class="nav-right">
                        {{-- <li class="heart-icon"><a href="#">
                                <i class="icon_heart_alt"></i>
                                <span>1</span>
                            </a>
                        </li> --}}
                        <li class="cart-icon"><a href="./cart">
                                <i class="icon_bag_alt"></i>
                                <span id="cartItem">
                                    @if (session()->exists('cart'))
                                        {{ count(session('cart')) }}
                                    @else
                                        0
                                    @endif
                                </span>
                            </a>
                            {{-- <div class="cart-hover">
                                <div class="select-items">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td class="si-pic"><img src="user/img/select-product-1.jpg" alt=""></td>
                                                <td class="si-text">
                                                    <div class="product-selected">
                                                        <p>$60.00 x 1</p>
                                                        <h6>Kabino Bedside Table</h6>
                                                    </div>
                                                </td>
                                                <td class="si-close">
                                                    <i class="ti-close"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="si-pic"><img src="user/img/select-product-2.jpg" alt=""></td>
                                                <td class="si-text">
                                                    <div class="product-selected">
                                                        <p>$60.00 x 1</p>
                                                        <h6>Kabino Bedside Table</h6>
                                                    </div>
                                                </td>
                                                <td class="si-close">
                                                    <i class="ti-close"></i>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="select-total">
                                    <span>total:</span>
                                    <h5>$120.00</h5>
                                </div>
                                <div class="select-button">
                                    <form action="{{url('checkout')}}" method="POST">
                            @csrf
                            <a href="#" class="primary-btn view-card">VIEW CART</a>
                            <input type="text" hidden name="id_user"
                                value="@if (Auth::check()) {{Auth::user()->id_user}} @endif">
                            <input type="submit" class="primary-btn checkout-btn btn-block" value="CHECK OUT">
                            <!-- <a href="{{url('checkout')}}" class="primary-btn checkout-btn">CHECK OUT</a> -->
                            </form>
                </div>
            </div> --}}
                        </li>
                        <li class="cart-icon"><a href="#">
                                <i class="fa fa-qrcode" aria-hidden="true"></i>
                            </a>
                            <div class="cart-hover">
                                <!-- <div class="select-items">
                                    <table>
                                        <tbody>
                                            <div class="qrcode">
                                            </div>
                                        </tbody>
                                    </table>
                                </div> -->
                                <!-- <div class="select-total">
                                    <span>total:</span>
                                    <h5>$120.00</h5>
                                </div>
                                <div class="select-button">
                                    <a href="#" class="primary-btn view-card">VIEW CARD</a>
                                    <a href="#" class="primary-btn checkout-btn">CHECK OUT</a>
                                </div> -->
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="nav-item">
        <div class="container">
            <div class="d-flex justify-content-center">
                <nav class="nav-menu mobile-menu">
                    <ul id="user-menu">
                        <li><a href="./index">Home</a></li>
                        <li><a href="./shop">Shop</a></li>
                        {{-- <li><a href="#">Collection</a>
                            <ul class="dropdown">
                                <li><a href="#">Men's</a></li>
                                <li><a href="#">Women's</a></li>
                                <li><a href="#">Kid's</a></li>
                            </ul>
                        </li> --}}
                        <li><a href="./blog">Blog</a></li>
                        <li><a href="./contact">Contact</a></li>
                        <!-- Check for the roles if They Were Admin Then Show Them The Admin Page -->
                        @if (Auth::check())
                            <li><a href="#"><i class="fa fa-user"></i>&emsp;{{ Auth::user()->user_name }}</a>
                                <ul class="dropdown">
                                    <li><a href="{{ url('userEdit') }}">Edit profile</a></li>
                                    @if (Auth::user()->role != 'user')
                                        <li><a href="{{ url('ad_userpage') }}">Admin page</a></li>
                                    @endif
                                    <li>
                                        <form action="postLogout" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger btn-block">Log
                                                out</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
            <div id="mobile-menu-wrap" class="container-fluid "></div>
        </div>

    </div>
</header>


<!-- Header End -->
