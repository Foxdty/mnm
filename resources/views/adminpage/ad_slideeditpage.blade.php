@extends('ad_master')
@section('ad_content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <a href="{{url('ad_slidepage')}}"><button type="button" class="btn btn-outline-primary">
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

                    <div class="card-body">
                        <div class="basic-form">
                            @if(isset($slide_edit))
                            <form action="{{url('update_slide', $slide_edit->id_slide)}}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Slide Name</label>
                                    <div class="col-sm-10">
                                        <input name="slide_name" value="{{$slide_edit->slide_name}}" class="form-control" required="true">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3 fileinputpadding">
                                        <label  for="file-input" class=" form-control-label ">Image</label>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <img width="100%" src = "admin/img/{{$slide_edit->image}}" alt = "">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input  type="file" id="image" name="image" class="form-control-file">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" name="slide_action" value="slide_update" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                            @else
                            <form action="{{route('them-slide')}}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Slide Name</label>
                                    <div class="col-sm-10">
                                        <input name="slide_name" class="form-control" required="true">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3 fileinputpadding">
                                        <label for="file-input" class=" form-control-label ">Image</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="file" id="image" name="image" class="form-control-file">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" name="slide_action" value="slide_create" class="btn btn-primary">Create</button>
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

@endsection()