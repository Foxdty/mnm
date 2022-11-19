@extends('ad_master')
@section('ad_content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <a href="{{url('ad_usereditpage')}}"> <button type="button" class="btn btn-outline-primary">
                            <i class="fa fa-plus-square-o"></i>&nbsp; New User</button></a>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Menu</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">User List</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->

        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">User Infomation</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered  table-responsive-sm basic-form">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>USERNAME</th>
                                        <th>EMAIL</th>
                                        <th>ADDRESS</th>
                                        <th>PHONE</th>
                                        <th>STATUS</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($list as $user)
                                    <tr>
                                        <td>{{$user->id_user}}</td>
                                        <td>{{$user->user_name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->address}}</td>
                                        <td>{{$user->phone}}</td>
                                        <td>{{$user->status}}</td>
                                        <td>
                                            <span>
                                                <a href="{{Route('chinh-User',$user->id_user)}}"><button type="button"
                                                        class="btn btn-outline-primary">&nbsp;<i
                                                            class="fa fa-pencil color-muted"></i>&nbsp; Edit
                                                    </button>&nbsp;&nbsp; </a>
                                                <!-- <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteModal">&nbsp;<i class="fa fa-close color-danger"></i>&nbsp; Delete </button>&nbsp;&nbsp; -->
                                                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button> -->

                                                <button id="user_id" data-toggle="modal" data-id='{{$user->id_user}}'
                                                    data-target="#myModal" type="button"
                                                    class="btn btn-outline-danger">&nbsp;<i
                                                        class="fa fa-close color-danger"></i>&nbsp; Delete </button>
                                                <!-- <button data-toggle="modal" data-id='{{$user->id}}' data-target="#myModal" type="button" class="btn btn-outline-danger">&nbsp;<i class="fa fa-close color-danger"></i>&nbsp; Delete </button> -->
                                            </span>

                                        </td>
                                    </tr>
                                    <!-- Delete Warning Modal -->



                                    <!-- Modal -->

                                    <div class="modal fade" id="myModal" role="dialog">
                                        <div class="modal-dialog modal-sm">
                                            <form action="{{Route('xoa-user')}}" method="get">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Do you want to delete?</h4>
                                                        <input type=hidden id="id_user" name="id_user" value="">
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


            <!-- end row -->
        </div>
        <!-- <div id="app" class="container">
                    <ul class="page">
                        <li class="page__btn"><span class="material-icons">chevron_left</span></li>
                        <?php
                        // for ($numpage = 1; $numpage <= $totalpage; $numpage++) {
                        //    echo ' <li class="page__numbers"><a class="boiden" href="../view/userpagelist.php?item_inpage=' . $item_in_page . '&page=' . $numpage . '">' . $numpage . '</a></li>';
                        // }
                        ?>
                        <li class="page__dots">...</li>
                        <li class="page__numbers"> 10</li>
                        <li class="page__btn"><span class="material-icons">chevron_right</span></li>
                    </ul>
                </div> -->
    </div>
</div>

<script>
    $('[data-id]').each(function(){
            $(this).click(function(){
                $('#id_user').val($(this).data('id'));
            });
        });                                             
</script>

@endsection()