@extends('ad_master')
@section('ad_content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <a href="{{url('ad_voucherpage')}}"><button type="button" class="btn btn-outline-primary">
                            <i class="fa fa-undo"></i>&nbsp; Back</button></a>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Voucher</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->

        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Voucher Information</h4>
                    </div>
                    @if (Session::has('voucher_status'))
                    <div class="alert alert-success" style="text-align: center">{{ Session::get('register_status') }}</div>
                    @endif

                    @if (count($errors) > 0)
                    <div class="alert alert-danger" style="text-align: center">
                        @foreach ($errors->all() as $err)
                        {{ $err }}
                        <br>
                        @endforeach
                    </div>
                    @endif
                    <div class="card-body">
                        <div class="basic-form">
                            @if(isset($voucher_edit))
                            <form action="{{url('update_voucher', $voucher_edit->id_voucher)}}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Voucher Code</label>
                                    <div class="col-sm-10">
                                        <input name="voucher_code" value="{{$voucher_edit->voucher_code}}" class="form-control" required="true">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Condition Price</label>
                                    <div class="col-sm-10">
                                        <input name="condition_price" value="{{$voucher_edit->condition_price}}" class="form-control" required="true">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Price Sale</label>
                                    <div class="col-sm-10">
                                        <input name="price_sale" value="{{$voucher_edit->price_sale}}" class="form-control" required="true">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Begin Date</label>
                                    <div class="col-sm-7">
                                        <input name="begin_datepicker" value="{{$begin_date_split}}" class="datepicker-default form-control">
                                    </div>
                                    <div class="col-sm-3 input-group clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">
                                        <input type="text" value="{{$begin_time_split}}" class="form-control" name="begin_timepicker"> <span class="input-group-append"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Expiration Date</label>
                                    <div class="col-sm-7">
                                        <input name="expiration_datepicker" value="{{$expiration_date_split}}" class="datepicker-default form-control">
                                    </div>
                                    <div class="col-sm-3 input-group clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">
                                        <input type="text" value="{{$expiration_time_split}}" class="form-control" name="expiration_timepicker"> <span class="input-group-append"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" name="voucher_action" value="voucher_update" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                            @else
                            <form action="{{route('them-voucher')}}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Type Condition</label>
                                    <div class="col-sm-10">
                                        <select onchange="myFunction(event)" class="form-control" name="cbx_parent_id">
                                            <option value="0.0">Percent</option>
                                            <option value="0">Total</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Voucher Code</label>
                                    <div class="col-sm-10">
                                        <input name="voucher_code" class="form-control" placeholder="Voucher Code" required="true">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Condition Price</label>
                                    <div class="col-sm-10">
                                        <input name="condition_price" id="Change_Type" placeholder="Condition Price" class="form-control" required="true">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Price Sale</label>
                                    <div class="col-sm-10">
                                        <input name="price_sale" placeholder="Price Sale" class="form-control" required="true">
                                    </div>
                                </div>
                                <!-- <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Date range</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control input-daterange-timepicker" name="daterange" value="01/01/2015 1:30 PM - 01/01/2015 2:00 PM">
                                    </div>
                                </div> -->
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Begin Date</label>
                                    <div class="col-sm-7">
                                        <input name="begin_datepicker" value="<?php echo date("Y-m-d"); ?>" class="datepicker-default form-control">
                                    </div>
                                    <div class="col-sm-3 input-group clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">
                                        <input type="text" value="00:00" class="form-control" name="begin_timepicker"> <span class="input-group-append"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Expiration Date</label>
                                    <div class="col-sm-7">
                                        <input name="expiration_datepicker" value="<?php echo (new DateTime('tomorrow'))->format('Y-m-d'); ?>" class="datepicker-default form-control">
                                    </div>
                                    <div class="col-sm-3 input-group clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">
                                        <input type="text" value="00:00" class="form-control" name="expiration_timepicker"> <span class="input-group-append"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" name="voucher_action" value="voucher_create" class="btn btn-primary">Create</button>
                                    </div>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- end row -->
            </div>
        </div>

    </div>
</div>
<script>
    function myFunction(e) {
        document.getElementById("Change_Type").value = e.target.value
    }

</script>
<script src="./admin/vendor/global/global.min.js"></script>
<script src="./admin/js/quixnav-init.js"></script>

<script src="./admin/js/custom.min.js"></script>

<!-- Daterangepicker -->
<!-- momment js is must -->
<script src="./admin/vendor/moment/moment.min.js"></script>
<script src="./admin/vendor/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- clockpicker -->
<script src="./admin/vendor/clockpicker/js/bootstrap-clockpicker.min.js"></script>

<!-- asColorPicker -->
<script src="./admin/vendor/jquery-asColor/jquery-asColor.min.js"></script>

<script src="./admin/vendor/jquery-asGradient/jquery-asGradient.min.js"></script>

<script src="./admin/vendor/jquery-asColorPicker/js/jquery-asColorPicker.min.js"></script>

<!-- Material color picker -->
<script src="./admin/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

<!-- pickdate -->
<script src="./admin/vendor/pickadate/picker.js"></script>
<script src="./admin/vendor/pickadate/picker.time.js"></script>
<script src="./admin/vendor/pickadate/picker.date.js"></script>



<!-- Daterangepicker -->
<script src="./admin/js/plugins-init/bs-daterange-picker-init.js"></script>

<!-- Clockpicker init -->
<script src="./admin/js/plugins-init/clock-picker-init.js"></script>

<!-- asColorPicker init -->
<script src="./admin/js/plugins-init/jquery-asColorPicker.init.js"></script>

<!-- Material color picker init -->
<script src="./admin/js/plugins-init/material-date-picker-init.js"></script>

<!-- Pickdate -->
<script src="./admin/js/plugins-init/pickadate-init.js"></script>



@endsection()