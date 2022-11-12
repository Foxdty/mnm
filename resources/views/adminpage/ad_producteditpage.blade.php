@extends('ad_master')
@section('ad_content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <a href="{{ url('ad_Product') }}"><button type="button" class="btn btn-outline-primary">
                                <i class="fa fa-undo"></i>&nbsp; Back</button></a>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">DashBoard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Product</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Product Information</h4>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (isset($product))
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="{{ url('editProduct/' . $product->id_product) }}"
                                        enctype="multipart/form-data" method="post">
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Product Name</label>
                                            <div class="col-sm-5">
                                                <input name="name" class="form-control"
                                                    value="{{ $product->product_name }}" required="true">
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Category</label>
                                            <div class="col-sm-5">
                                                <select class="form-control" name="category">
                                                    @foreach ($list_dropdown as $cat)
                                                        <option value="{{ $cat->id_category }}"
                                                            @if ($product->id_category == $cat->id_category) selected @endif>
                                                            {{ $cat->category_name }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Manufacturer</label>
                                            <div class="col-sm-5">
                                                <select class="form-control" name="id_manufacturer">
                                                    @foreach ($manufacturers as $manufacturer)
                                                        <option value="{{ $manufacturer->id_manufacturer }}"
                                                            @if ($product->id_manufacturer == $manufacturer->id_manufacturer) selected @endif>
                                                            {{ $manufacturer->manufacturer }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Material</label>
                                            <div class="col-sm-5">
                                                <input name="material" class="form-control" value="{{ $product->material }}"
                                                    required="true">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Description</label>
                                            <div class="col-sm-5">
                                                <input name="descrip" value="{{ $product->description }}"
                                                    class="form-control" required="true">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Color</label>
                                            <div class="col-sm-5">
                                                <div class="row">
                                                    <div class="col-sm-8">
                                                        @php
                                                            $list_color = [];
                                                            $list_size = [];
                                                            foreach ($product_detail as $prd) {
                                                                if (!in_array($prd->size, $list_size)) {
                                                                    $list_size[] = $prd->size;
                                                                }
                                                                if (!in_array($prd->color, $list_color)) {
                                                                    $list_color[$prd->id_product_detail] = $prd->color;
                                                                }
                                                            }
                                                        @endphp
                                                        @foreach ($list_color as $id_detail => $color)
                                                            <input name="color[{{ $id_detail }}]"
                                                                value="{{ $color }}" placeholder="red, blue, ..."
                                                                class="form-control" required="true">
                                                        @endforeach

                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="row" id="rowColor">


                                                            {{-- <div class="col-sm-8"><input name="color" class="form-control"
                                                            class="trashItem" required="true">
                                                    </div>
                                                    <div class="col"><button id="trash"
                                                            class="btn btn-outline-danger btn-sm"><i
                                                                class="fa fa-trash"></i></button></div> --}}

                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <button class="mt-1 btn btn-outline-info btn-sm btn-block"
                                                            id="addColor"><i class="fa fa-plus"></i> Add color</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-2 col-form-label">Size</div>
                                            <div class="col-sm-5">
                                                <div class="row ml-2">
                                                    @foreach ($list_size as $size)
                                                        <input type="hidden" name="size[{{ $size }}]"
                                                            value="{{ $size }}">
                                                    @endforeach
                                                    <div class="col">
                                                        <input class="form-check-input"
                                                            @if (in_array('S', $list_size)) checked
                                                    disabled @endif
                                                            type="checkbox" name="size[S]" value="S" id="S">
                                                        <label class="form-check-label" for="S">S</label>
                                                    </div>
                                                    <div class="col">
                                                        <input class="form-check-input"
                                                            @if (in_array('M', $list_size)) checked
                                                    disabled @endif
                                                            type="checkbox" name="size[M]" value="M" id="M">
                                                        <label class="form-check-label" for="M">M</label>
                                                    </div>
                                                    <div class="col">
                                                        <input class="form-check-input"
                                                            @if (in_array('L', $list_size)) checked
                                                    disabled @endif
                                                            type="checkbox" name="size[L]" value="L"
                                                            id="L">
                                                        <label class="form-check-label" for="L">L</label>
                                                    </div>
                                                    <div class="col">
                                                        <input class="form-check-input"
                                                            @if (in_array('XL', $list_size)) checked
                                                    disabled @endif
                                                            type="checkbox" name="size[XL]" value="XL"
                                                            id="XL">
                                                        <label class="form-check-label" for="XL">XL</label>
                                                    </div>
                                                    <div class="col">
                                                        <input class="form-check-input"
                                                            @if (in_array('XXL', $list_size)) checked disabled @endif
                                                            type="checkbox" name="size[XXL]" value="XXL"
                                                            id="XXL">
                                                        <label class="form-check-label" for="XXL">XXL</label>
                                                    </div>
                                                    <div class="col">
                                                        <input class="form-check-input"
                                                            @if (in_array('3XL', $list_size)) checked disabled @endif
                                                            type="checkbox" name="size[3XL]" value="3XL"
                                                            id="3XL">
                                                        <label class="form-check-label" for="3XL">3XL</label>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <div class="col-sm-2 col-form-label">Product list</div>
                                            <div class="col">
                                                @foreach ($list_color as $id_detail => $color)
                                                    <table class="table table-bordered" id="0">
                                                        <tbody data-table="{{ $id_detail }}">

                                                            <tr class="productList" id="{{ $id_detail }}">
                                                                <th rowspan="{{ count($list_size) + 1 }}"
                                                                    data-color="color[{{ $id_detail }}]"
                                                                    class="colorTable col-sm-2">
                                                                    {{ $color }}</th>
                                                            </tr>
                                                            @foreach ($list_size as $size)
                                                                @foreach ($product_detail as $prd)
                                                                    @if ($prd->color == $color && $prd->size == $size)
                                                                        <tr class="row{{ $id_detail }}">
                                                                            <td scope="">{{ $size }}
                                                                                </th>
                                                                            <td id="{{ $size }}"><input
                                                                                    type="number"
                                                                                    name="price[{{ $id_detail . $size }}]"
                                                                                    placeholder="Price"
                                                                                    value="{{ $prd->price }}" required
                                                                                    min="0" class="form-control">
                                                                            </td>
                                                                            <td id="{{ $size }}"><input
                                                                                    placeholder="Remaining"
                                                                                    name="remaining[{{ $id_detail . $size }}]"
                                                                                    required type="number" min="0"
                                                                                    value="{{ $prd->remaining }}"
                                                                                    class="form-control"></td>
                                                                        </tr>
                                                                    @endif
                                                                @endforeach
                                                            @endforeach

                                                        </tbody>
                                                    </table>
                                                @endforeach
                                            </div>
                                        </div>


                                        <div class="row form-group d-flex">
                                            <div class="col col-md-3 fileinputpadding">
                                                Image product
                                            </div>
                                            {{-- <div class="col-12 col-md-9">
                                        <div class="row" id="imgList">
                                            <div class="col-sm-10">
                                                <label for="img[0]" class="btn btn-outline-primary"><i
                                                        class="fa fa-picture-o" data-color="color[0]"></i></label>
                                                <input hidden type="file" id="img[0]" name="img[0]"
                                                    class="form-control-file">
                                            </div>

                                        </div>
                                    </div> --}}
                                            <style>
                                                .center-cropped {
                                                    width: 100px;
                                                    height: 100px;
                                                    object-fit: cover;
                                                }
                                            </style>

                                            <div id="product-image" class="row">
                                                @php
                                                    $i = 0;
                                                @endphp
                                                @foreach ($imageProducts as $imgProduct)
                                                    <label for="avatar{{ $imgProduct->id_image_product }}"
                                                        class="btn btn-outline-info btn-sm text-center m-1">
                                                        <img src="images/{{ $imgProduct->image }}"
                                                            class="center-cropped img-fluid img-thumbnail"
                                                            id="previewImgavatar{{ $imgProduct->id_image_product }}"
                                                            alt="product-image">
                                                        <input type="file" onchange="previewFile(this)"
                                                            name="image[{{ $imgProduct->id_image_product }}]"
                                                            id="avatar{{ $imgProduct->id_image_product }}"
                                                            style="display: none">
                                                    </label>
                                                    @php
                                                        $i++;
                                                        $id_last_img_product = $imgProduct->id_image_product;
                                                    @endphp
                                                @endforeach
                                                @for ($i; $i < 4; $i++)
                                                    <label for="avatar{{ $id_last_img_product + 200 + $i }}"
                                                        class="btn btn-outline-info btn-sm text-center m-1">
                                                        <img src="images/upload-default.png"
                                                            class="center-cropped img-fluid img-thumbnail"
                                                            id="previewImgavatar{{ $id_last_img_product + 200 + $i }}"
                                                            alt="product-image">
                                                        <input type="file" onchange="previewFile(this)"
                                                            name="image[{{ $id_last_img_product + 200 + $i }}]"
                                                            id="avatar{{ $id_last_img_product + 200 + $i }}"
                                                            style="display: none">
                                                    </label>
                                                @endfor
                                                {{-- <div class="row">
                                                    <button class="btn btn-outline-danger mx-auto"><i
                                                            class="fa fa-times"></i></button>
                                                </div> --}}
                                                {{-- <div>
                                                    <button id="img-add" class="btn btn-outline-success"><i
                                                            class="fa fa-plus"></i></button>
                                                </div> --}}
                                            </div>

                                            {{-- <script>
                                                idImage = 1;
                                                $('#img-add').click(function() {
                                                    idImage++;
                                                    productImageHTML =
                                                        ' <label for="avatar' + idImage +
                                                        '" class="btn btn-outline-info btn-sm text-center m-1"> <img src="images/upload-default.png" class="center-cropped img-fluid img-thumbnail" id="previewImgavatar' +
                                                        idImage +
                                                        '" alt="product-image"> <input type="file" onchange="previewFile(this)" name="image[' + idImage +
                                                        ']" id="avatar' + idImage +
                                                        '" style="display: none"> </label> <div class="row"> <button class="btn btn-outline-danger"><i class="fa fa-times"></i></button> </div>';
                                                    $('#product-image').append(productImageHTML);
                                                });
                                            </script> --}}
                                            {{-- <div>
                                                <label for="avatar1" class="btn btn-outline-info btn-sm text-center m-1">
                                                    <img src="images/upload-default.png"
                                                        class="center-cropped img-fluid img-thumbnail"
                                                        id="previewImgavatar1" alt="product-image">
                                                    <input type="file" onchange="previewFile(this)" name="image[1]"
                                                        id="avatar1" style="display: none">
                                                </label>
                                                <div class="row">
                                                    <button class="btn btn-outline-danger mx-auto"><i
                                                            class="fa fa-times"></i></button>
                                                </div>
                                            </div> --}}
                                        </div>
                                        <div class="form-group row">
                                            <div class="col col-md-3 fileinputpadding">
                                                Image product detail
                                            </div>
                                            @php
                                                $preColor = [];
                                            @endphp
                                            @foreach ($product_detail as $product)
                                                @if (!in_array($product->color, $preColor))
                                                    <div id="imgList">
                                                        <div class="col-sm-10">
                                                            <label for="img[{{ $product->id_product_detail }}]"
                                                                class="btn btn-outline-primary">
                                                                <img src="images/{{ $product->image }}"
                                                                    class="center-cropped img-fluid img-thumbnail"
                                                                    id="previewImgimg{{ $product->id_product_detail }}"
                                                                    alt="product-image">
                                                                <i class="fa fa-picture-o"
                                                                    data-color="color[{{ $product->id_product_detail }}]">&ensp;{{ $product->color }}</i>
                                                            </label>
                                                            <input hidden type="file"
                                                                id="img[{{ $product->id_product_detail }}]"
                                                                name="img[{{ $product->id_product_detail }}]"
                                                                class="form-control-file" onchange="previewFile(this)">
                                                        </div>
                                                    </div>
                                                    @php
                                                       // var_dump($preColor);
                                                        $preColor[] = $product->color;
                                                    @endphp
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <button type="submit" name="product_action" value="product_create"
                                                    class="btn btn-primary">Edit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @else
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="{{ url('insertProduct') }}" enctype="multipart/form-data"
                                        method="post">
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Product Name</label>
                                            <div class="col-sm-5">
                                                <input name="name" class="form-control" required="true">
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Category</label>
                                            <div class="col-sm-5">
                                                <select class="form-control" name="category">
                                                    @foreach ($list_dropdown as $cat)
                                                        <option value="{{ $cat->id_category }}">
                                                            {{ $cat->category_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Manufacturer</label>
                                            <div class="col-sm-5">
                                                <select class="form-control" name="id_manufacturer">
                                                    @foreach ($manufacturers as $manufacturer)
                                                        <option value="{{ $manufacturer->id_manufacturer }}">
                                                            {{ $manufacturer->manufacturer }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Material</label>
                                            <div class="col-sm-5">
                                                <input name="material" class="form-control" required="true">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Description</label>
                                            <div class="col-sm-5">
                                                <input name="descrip" class="form-control" required="true">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Color</label>
                                            <div class="col-sm-5">
                                                <div class="row">
                                                    <div class="col-sm-8">
                                                        <input name="color[0]" placeholder="red, blue, ..."
                                                            class="form-control" required="true">
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="row" id="rowColor">

                                                            {{-- <div class="col-sm-8"><input name="color" class="form-control"
                                                            class="trashItem" required="true">
                                                    </div>
                                                    <div class="col"><button id="trash"
                                                            class="btn btn-outline-danger btn-sm"><i
                                                                class="fa fa-trash"></i></button></div> --}}

                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <button class="mt-1 btn btn-outline-info btn-sm btn-block"
                                                            id="addColor"><i class="fa fa-plus"></i> Add color</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-2 col-form-label">Size</div>
                                            <div class="col-sm-5">
                                                <div class="row ml-2">
                                                    <div class="col">
                                                        <input class="form-check-input" type="checkbox" name="size[S]"
                                                            value="S" id="S">
                                                        <label class="form-check-label" for="S">S</label>
                                                    </div>
                                                    <div class="col">
                                                        <input class="form-check-input" type="checkbox" name="size[M]"
                                                            value="M" id="M">
                                                        <label class="form-check-label" for="M">M</label>
                                                    </div>
                                                    <div class="col">
                                                        <input class="form-check-input" type="checkbox" name="size[L]"
                                                            value="L" id="L">
                                                        <label class="form-check-label" for="L">L</label>
                                                    </div>
                                                    <div class="col">
                                                        <input class="form-check-input" type="checkbox" name="size[XL]"
                                                            value="XL" id="XL">
                                                        <label class="form-check-label" for="XL">XL</label>
                                                    </div>
                                                    <div class="col">
                                                        <input class="form-check-input" type="checkbox" name="size[XXL]"
                                                            value="XXL" id="XXL">
                                                        <label class="form-check-label" for="XXL">XXL</label>
                                                    </div>
                                                    <div class="col">
                                                        <input class="form-check-input" type="checkbox" name="size[3XL]"
                                                            value="3XL" id="3XL">
                                                        <label class="form-check-label" for="3XL">3XL</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <div class="col-sm-2 col-form-label">Product list</div>
                                            <div class="col">
                                                <table class="table table-bordered" id="0">
                                                    <tbody data-table="0">
                                                        <tr class="productList" id="0">
                                                            <th rowspan="" data-color="color[0]"
                                                                class="colorTable col-sm-2">
                                                                Color</th>
                                                            {{-- <td class="firstRowColor"></td>
                                                    <td><input type="number" required min="0" class="form-control">
                                                    </td>
                                                    <td><input required type="number" min="0" class="form-control">
                                                    </td> --}}

                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>


                                        <div class="row form-group d-flex">
                                            <div class="col col-md-3 fileinputpadding">
                                                Image product
                                            </div>
                                            {{-- <div class="col-12 col-md-9">
                                        <div class="row" id="imgList">
                                            <div class="col-sm-10">
                                                <label for="img[0]" class="btn btn-outline-primary"><i
                                                        class="fa fa-picture-o" data-color="color[0]"></i></label>
                                                <input hidden type="file" id="img[0]" name="img[0]"
                                                    class="form-control-file">
                                            </div>

                                        </div>
                                    </div> --}}
                                            <style>
                                                .center-cropped {
                                                    width: 100px;
                                                    height: 100px;
                                                    object-fit: cover;
                                                }
                                            </style>

                                            <div id="product-image" class="row">
                                                <label for="avatar0" class="btn btn-outline-info btn-sm text-center m-1">
                                                    <img src="images/upload-default.png"
                                                        class="center-cropped img-fluid img-thumbnail"
                                                        id="previewImgavatar0" alt="product-image">
                                                    <input type="file" onchange="previewFile(this)" name="image[0]"
                                                        id="avatar0" style="display: none">
                                                </label>
                                                <label for="avatar1" class="btn btn-outline-info btn-sm text-center m-1">
                                                    <img src="images/upload-default.png"
                                                        class="center-cropped img-fluid img-thumbnail"
                                                        id="previewImgavatar1" alt="product-image">
                                                    <input type="file" onchange="previewFile(this)" name="image[1]"
                                                        id="avatar1" style="display: none">
                                                </label>
                                                <label for="avatar2" class="btn btn-outline-info btn-sm text-center m-1">
                                                    <img src="images/upload-default.png"
                                                        class="center-cropped img-fluid img-thumbnail"
                                                        id="previewImgavatar2" alt="product-image">
                                                    <input type="file" onchange="previewFile(this)" name="image[2]"
                                                        id="avatar2" style="display: none">
                                                </label>
                                                <label for="avatar3" class="btn btn-outline-info btn-sm text-center m-1">
                                                    <img src="images/upload-default.png"
                                                        class="center-cropped img-fluid img-thumbnail"
                                                        id="previewImgavatar3" alt="product-image">
                                                    <input type="file" onchange="previewFile(this)" name="image[3]"
                                                        id="avatar3" style="display: none">
                                                </label>
                                                {{-- <div class="row">
                                                    <button class="btn btn-outline-danger mx-auto"><i
                                                            class="fa fa-times"></i></button>
                                                </div> --}}
                                                {{-- <div>
                                                    <button id="img-add" class="btn btn-outline-success"><i
                                                            class="fa fa-plus"></i></button>
                                                </div> --}}
                                            </div>

                                            {{-- <script>
                                                idImage = 1;
                                                $('#img-add').click(function() {
                                                    idImage++;
                                                    productImageHTML =
                                                        ' <label for="avatar' + idImage +
                                                        '" class="btn btn-outline-info btn-sm text-center m-1"> <img src="images/upload-default.png" class="center-cropped img-fluid img-thumbnail" id="previewImgavatar' +
                                                        idImage +
                                                        '" alt="product-image"> <input type="file" onchange="previewFile(this)" name="image[' + idImage +
                                                        ']" id="avatar' + idImage +
                                                        '" style="display: none"> </label> <div class="row"> <button class="btn btn-outline-danger"><i class="fa fa-times"></i></button> </div>';
                                                    $('#product-image').append(productImageHTML);
                                                });
                                            </script> --}}
                                            {{-- <div>
                                                <label for="avatar1" class="btn btn-outline-info btn-sm text-center m-1">
                                                    <img src="images/upload-default.png"
                                                        class="center-cropped img-fluid img-thumbnail"
                                                        id="previewImgavatar1" alt="product-image">
                                                    <input type="file" onchange="previewFile(this)" name="image[1]"
                                                        id="avatar1" style="display: none">
                                                </label>
                                                <div class="row">
                                                    <button class="btn btn-outline-danger mx-auto"><i
                                                            class="fa fa-times"></i></button>
                                                </div>
                                            </div> --}}
                                        </div>
                                        <div class="form-group row">
                                            <div class="col col-md-3 fileinputpadding">
                                                Image product detail
                                            </div>
                                            <div id="imgList">
                                                <div class="col-sm-10">
                                                    <label for="img[0]" class="btn btn-outline-primary">
                                                        <img src="images/upload-default.png"
                                                            class="center-cropped img-fluid img-thumbnail"
                                                            id="previewImgimg0" alt="product-image">
                                                        <i class="fa fa-picture-o" data-color="color[0]"></i>
                                                    </label>
                                                    <input hidden type="file" id="img[0]" name="img[0]"
                                                        class="form-control-file" onchange="previewFile(this)" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <button type="submit" name="product_action" value="product_create"
                                                    class="btn btn-primary">Create</button>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- end row -->
                </div>
            </div>
        </div>
        <!--**********************************
                                                                                                                                                                                                                                                                                                                                                            Content body end
                                                                                                                                                                                                                                                                                                                                                        ***********************************-->
        <!--**********************************
                                                                                                                                                                                                                                                                                                                                                            Footer start
                                                                                                                                                                                                                                                                                                                                                        ***********************************-->

        <!--**********************************
                                                                                                                                                                                                                                                                                                                                                            Footer end
                                                                                                                                                                                                                                                                                                                                                        ***********************************-->
        <script>
            var id =
                @if (isset($list_color))
                    {{ array_key_last($list_color) + 200 }}
                @else
                    1
                @endif ;
            $('#addColor').click(function() {
                var html = '<div id="1trash' + id + '" class="col-sm-8"><input name="color[' + id +
                    ']" class="form-control" class="trashItem" required="true"></div><div class="col"><button id="trash' +
                    id + '" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></button></div>';
                $('#rowColor').append(html);

                var tableHtml = $('.table.table-bordered#0').clone();
                tableHtml.find('.colorTable').attr('data-color', 'color[' + id + ']');
                tableHtml.find('tbody').attr('data-table', id);
                tableHtml.find('.colorTable').html('Color');
                tableHtml.find('.productList').attr('id', id);
                tableHtml.find('[name^=price]').each(function() {
                    var size = $(this).parent().prop('id');
                    $(this).attr('name', 'price[' + id + size + ']')
                })
                tableHtml.find('[name^=remaining]').each(function() {
                    var size = $(this).parent().prop('id');
                    $(this).attr('name', 'remaining[' + id + size + ']')
                })
                $('.table.table-bordered').parent().append(tableHtml);

                var imgHtml = '<div class="col-sm-10" ><label for="img[' + id +
                    ']" class="btn btn-outline-primary" > <img src="images/upload-default.png" class="center-cropped img-fluid img-thumbnail" id="previewImgimg' +
                    id + '" alt="product-image"><i class="fa fa-picture-o" data-color="color[' + id +
                    ']"></i></label><input hidden type="file" id="img[' + id + ']" name="img[' + id +
                    ']" class="form-control-file" onchange="previewFile(this)"></div>'
                $('#imgList').append(imgHtml);

                var del = '#1trash' + id;
                var tableId = id;
                $(document).on('click', '#trash' + id + '', function() {
                    $('tbody').each(function() {
                        if ($(this).data('table') == tableId) {
                            $(this).parent().remove();
                        }
                    });
                    $('label.btn.btn-outline-primary i').each(function() {
                        var dataColor = $(this).attr('data-color');
                        if (dataColor == ('color[' + tableId + ']'))
                            $(this).parent().remove();
                    })
                    $(del).remove();
                    $(this).parent().remove();
                })
                id++;
            });
            var rowSpan =
                @if (isset($list_size))
                    {{ count($list_size) + 1 }}
                @else
                    1
                @endif ;
            $('[name^="size"]').click(function() {
                if ($(this).prop('checked')) {
                    $('.colorTable').attr('rowSpan', ++rowSpan);
                    var rowValue = $(this).val();
                    var sizeId = $(this).attr('id');
                    var colorId = $(this).attr('id');
                    $('.productList').each(function() {
                        var colorId = $(this).attr('id');
                        var html = '<tr class="row' + rowValue + '"> <td scope="">' + rowValue +
                            '</th><td id="' + rowValue + '"><input type="number" name="price[' + colorId +
                            sizeId +
                            ']" placeholder="Price" required min="0" class="form-control"></td><td id="' +
                            rowValue + '"><input placeholder="Remaining" name="remaining[' + colorId + sizeId +
                            ']" required type="number" min="0" class="form-control"></td></tr>';
                        $(this).parent().append(html);
                    })
                } else {
                    $('.row' + $(this).val()).each(function() {
                        $(this).remove();
                    });
                    $('.colorTable').attr('rowSpan', --rowSpan);
                }
            });

            $(document).on('input', '[name^="color"]', function() {
                var value = $(this).val();
                var colorName = $(this).prop('name');
                $('.colorTable').each(function() {
                    if ($(this).data('color') == colorName)
                        $(this).html(value);
                })
                $('.fa.fa-picture-o').each(function() {
                    if ($(this).data('color') == colorName)
                        $(this).html('&ensp;' + value);
                })
            })

            function previewFile(input) {
                var data = (input);
                var file = data.files[0];
                var id = input.id;
                id = id.replace(/[.*+?^${}()|[\]\\]/g, '');
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function() {
                        $("#previewImg" + id).attr("src", reader.result);
                    }
                    reader.readAsDataURL(file);
                }
            }
        </script>
    </div>
@endsection()
