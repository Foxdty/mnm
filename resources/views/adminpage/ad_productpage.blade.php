@extends('ad_master')
@section('ad_content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <a href="{{ url('ad_ProductEditPage') }}"><button type="button" class="btn btn-outline-primary">
                                <i class="fa fa-plus-square-o"></i>&nbsp; New Product</button></a>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Menu</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Product</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Product Infomation</h4>
                            <form method="POST" action="{{ route('tim-kiem-product') }}" class="d-flex">
                                @csrf
                                <input class="form-control" name="search" type="search" placeholder="Search" aria-label="Search">
                                <button type="submit" class="btn btn-outline-primary col-2 px-1 mx-1">
                                    <i class="mdi mdi-magnify"></i>
                                </button>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered verticle-middle table-responsive-sm basic-form">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">IMAGE</th>
                                            <th scope="col">PRODUCT NAME</th>
                                            <th scope="col">DESCRIPTION</th>
                                            <th scope="col">STATUS</th>
                                            <th scope="col">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product_list as $product)
                                            @if ($product->status == '1')
                                                <tr>
                                                    <th>{{ $product->id_product }}</th>
                                                    <style>
                                                        .center-cropped {
                                                            width: 100px;
                                                            height: 100px;
                                                            object-fit: cover;
                                                        }
                                                    </style>
                                                    <td>
                                                        @if ($product->image_product)
                                                            @foreach ($product->image_product as $image_product => $image)
                                                                <img src="images/{{ $image->image }}"
                                                                    class="center-cropped img-thumbnail"
                                                                    id="previewImgavatar0" alt="product-image">
                                                            @break
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td>{{ $product->product_name }}</td>
                                                <td>{{ $product->description }}</td>
                                                <td>{{ $product->status }}</td>
                                                <td>
                                                    <span class="form-inline">
                                                        <form action="{{ url('ad_ProductEditPage') }}" method="post">
                                                            @csrf
                                                            <button type="submit" name="id_product"
                                                                value="{{ $product->id_product }}"
                                                                class="btn btn-outline-primary"><i
                                                                    class="fa fa-pencil color-muted"></i>&nbsp;
                                                                Edit</button>
                                                        </form>
                                                        &emsp;<button id="product_id" data-toggle="modal"
                                                            data-id='{{ $product->id_product }}' data-target="#myModal"
                                                            type="button" class="btn btn-outline-danger">&nbsp;<i
                                                                class="fa fa-close color-danger"></i>&nbsp; Delete
                                                        </button>
                                                    </span>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    <div class="modal fade" id="myModal" role="dialog">
                                        <div class="modal-dialog modal-sm">
                                            <form action="{{ Route('xoa-product') }}" method="post">
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Do you want to delete?</h4>
                                                        <input type=hidden id="id_product" name="id_product"
                                                            value="">
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <button type="submit" class="btn btn-outline-danger">Yes !
                                                            Delete it</button>
                                                        <button type="button" data-dismiss="modal"
                                                            class="btn btn-outline-success">No !
                                                        </button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
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
<script>
    $('[data-id]').each(function() {
        $(this).click(function() {
            $('#id_product').val($(this).data('id'));
        });
    });
</script>
@endsection()
