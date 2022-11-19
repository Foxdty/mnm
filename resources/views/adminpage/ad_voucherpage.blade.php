@extends('ad_master')
@section('ad_content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <a href="{{url('ad_vouchereditpage')}}"> <button type="button" class="btn btn-outline-primary">
                            <i class="fa fa-plus-square-o"></i>&nbsp; New Voucher</button></a>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Menu</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Voucher</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Voucher Infomation</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered verticle-middle table-responsive-sm basic-form">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">VOUCHER CODE</th>
                                        <th scope="col">PRICE SALE</th>
                                        <th scope="col">BEGIN DATE</th>
                                        <th scope="col">EXPIRATION DATE</th>
                                        <th scope="col">ACTION</th>
                                </thead>
                                <tbody>
                                    @foreach($list_voucher as $voucher)
                                    <tr>
                                        <td>{{$voucher->id_voucher}}</td>
                                        <td>{{$voucher->voucher_code}}</td>
                                        <td>{{$voucher->price_sale}}</td>
                                        <td>{{$voucher->begin_date}}</td>
                                        <td>{{$voucher->expiration_date}}</td>
                                        <td>
                                            <span>
                                                <a href="{{url('ad_vouchereditpage', $voucher->id_voucher)}}"><button type="button" class="btn btn-outline-primary">&nbsp;<i class="fa fa-pencil color-muted"></i>&nbsp; Edit
                                                    </button>&nbsp;&nbsp; </a>
                                                
                                                <button id="id_voucher" data-toggle="modal" data-id='{{$voucher->id_voucher}}'
                                                    data-target="#myModal" type="button"
                                                    class="btn btn-outline-danger">&nbsp;<i
                                                        class="fa fa-close color-danger"></i>&nbsp; Delete </button>
                                            </span>
                                        </td>
                                    </tr>
                                     <!-- Modal -->
                                     <div class="modal fade" id="myModal" role="dialog">
                                        <div class="modal-dialog modal-sm">
                                            <form action="{{Route('xoa-voucher')}}" method="get">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Do you want to delete?</h4>
                                                        <input type=hidden id="id_voucher" name="id_voucher" value="">
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <button type="submit" class="btn btn-outline-danger">Yes !
                                                            Delete it</button>
                                                        <button type="button" data-dismiss="modal" class="btn btn-outline-success">No !
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
                                    <!-- Modal -->
                                    <!-- End Delete Modal -->
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </form>
            <!-- end row -->
        </div>
    </div>
</div>
<script>
    $('[data-id]').each(function(){
            $(this).click(function(){
                $('#id_voucher').val($(this).data('id'));
            });
        });                                             
</script>
@endsection()