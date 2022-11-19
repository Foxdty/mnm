@extends('ad_master')
@section('ad_content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <a href="{{url('ad_categoryeditpage')}}"><button type="button" class="btn btn-outline-primary">
                            <i class="fa fa-plus-square-o"></i>&nbsp; New Catalogy</button></a>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Menu</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Catalogy</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->

        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Catalogy Infomation</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered verticle-middle table-responsive-sm basic-form">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">ID PARENT</th>
                                        <th scope="col">NAME</th>
                                        <th scope="col">STATUS</th>
                                        <th scope="col">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($list_cat as $cat)
                                    <tr>
                                        <td>{{$cat->id_category}}</td>
                                        <td>{{$cat->id_parent}}</td>
                                        <td>{{$cat->category_name}}</td>
                                        <td>{{$cat->status}}</td>
                                        <td>
                                            <span>
                                                <a href="{{route('chinh-danh-muc', $cat->id_category)}}"><button type="button" class="btn btn-outline-primary">&nbsp;<i class="fa fa-pencil color-muted"></i>&nbsp; Edit
                                                    </button>&nbsp;&nbsp; </a>
                                                <!-- <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteModal">&nbsp;<i class="fa fa-close color-danger"></i>&nbsp; Delete </button>&nbsp;&nbsp; -->
                                                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button> -->
                                                <button data-toggle="modal" data-id='{{$cat->id_category}}'
                                                    data-target="#myModal" type="button"
                                                    class="btn btn-outline-danger">&nbsp;<i
                                                        class="fa fa-close color-danger"></i>&nbsp; Delete </button>
                                                <!-- <button data-toggle="modal" data-id='{{$cat->id}}' data-target="#myModal" type="button" class="btn btn-outline-danger">&nbsp;<i class="fa fa-close color-danger"></i>&nbsp; Delete </button> -->
                                            </span>
                                        </td>
                                    </tr>
                                    <!-- Modal -->

                                    <div class="modal fade" id="myModal" role="dialog">
                                        <div class="modal-dialog modal-sm">
                                            <form action="{{Route('xoa-danh-muc')}}" method="get">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Do you want to delete?</h4>
                                                        <input type=hidden id="id_category" name="id_category" value="">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <button type="submit" class="btn btn-outline-danger">Yes !
                                                            Delete it</button>
                                                        <button type="button" data-dismiss="modal" class="btn btn-outline-success">No !
                                                            </button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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

            <!-- end row -->
        </div>
    </div>
</div>
<script>
    $('[data-id]').each(function(){
            $(this).click(function(){
                $('#id_category').val($(this).data('id'));
            });
        });                                             
</script>
@endsection()