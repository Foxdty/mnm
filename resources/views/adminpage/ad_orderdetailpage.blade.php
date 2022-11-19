@extends('ad_master')
@section('ad_content')


<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <a href="{{url('ad_orderpage')}}"><button type="button" class="btn btn-outline-primary">
                            <i class="fa fa-undo"></i>&nbsp;Back</button></a>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Menu</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Order</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->

        <div class="row">
            <?php
            //  $madonhang = $_GET['id'];
            //  include '../utils/MySQLUtils.php';
            //  $dbCon = new MySQLUtils();
            //  $query = "select * from chitietdonhang
            //   inner join sanpham on chitietdonhang.masanpham = sanpham.masanpham
            //   inner join donhang on donhang.madonhang = chitietdonhang.madonhang
            //   inner join khachhang on donhang.mauser = khachhang.mauser 
            //   where donhang.madonhang=:madonhang";
            //  $param = array(":madonhang"=>$madonhang);
            //  $orders = $dbCon->getData($query,$param);
            //  $tmp = null;
            ?>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Order Details Infomation</h4>
                    </div>
                    <div class="card-header">
                        <h4 class="card-title">
                            USER NAME: {{$order_info->user_name}} <br><br>
                            ADDRESS: {{$order_info->address}} <br><br>
                            PHONE: {{$order_info->phone}} <br><br>
                            PRICE TOTAL: {{$order_info->price_total}} <br>
                        </h4>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered verticle-middle table-responsive-sm basic-form">
                                <thead>
                                    <tr>
                                        <th scope="col">ID ORDER</th>
                                        <th scope="col">PRODUCT</th>
                                        <th scope="col">SIZE</th>
                                        <th scope="col">COLOR</th>
                                        {{-- <th scope="col">MATERIAl</th> --}}
                                        <th scope="col">PRICE SALE</th>
                                        <th scope="col">QUANTITY</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                    @foreach($data as $order_detail)
                                    <tr>
                                        <td>{{$order_detail->id_order}}</td>
                                        <td>{{$order_detail->product_name}}</td>
                                        <td>{{$order_detail->size}}</td>
                                        <td>{{$order_detail->color}}</td>
                                        {{-- <td>{{$order_detail->material}}</td> --}}
                                        <td>{{$order_detail->price_sale}}</td>
                                        <td>{{$order_detail->quantity}}</td>
                                    </tr>
                                    @endforeach
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <!-- end row -->
        </div>
    </div>
</div>

@endsection()