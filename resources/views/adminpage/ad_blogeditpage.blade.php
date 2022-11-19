@extends('ad_master')
@section('ad_content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <a href="{{url('ad_blogpage')}}"><button type="button" class="btn btn-outline-primary">
                            <i class="fa fa-undo"></i>&nbsp; Back</button></a>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Blog</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->

        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Blog Information</h4>
                    </div>

                    <div class="card-body">
                        <div class="basic-form">
                            @if(isset($blog_edit))
                            <form action="{{route('update-bai-viet', $blog_edit->id_blog)}}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Blog Name</label>
                                    <div class="col-sm-10">
                                        <input name="blog_name" value="{{$blog_edit->blog_name}}" class="form-control" required="true">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Catalogy Parent</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="cbx_parent_id">
                                        @foreach($list_dropdown_e as $b)
                                        <option @if($b->id_parent==2) selected value="{{$b->id_category}}">{{$b->category_name}}
                                                    @else hidden
                                                @endif
                                            </option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3 fileinputpadding">
                                        <label  for="file-input" class=" form-control-label ">Image</label>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <img width="100%" src = "admin/img/blog/{{$blog_edit->image}}" alt = "">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input  type="file" id="image" name="image" class="form-control-file">
                                    </div>
                                </div>
                                <textarea name="description" id="description">{{$blog_edit->description}}</textarea>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" name="blog_action" value="blog_create" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                            @else
                            <form action="{{route('them-bai-viet')}}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Blog Name</label>
                                    <div class="col-sm-10">
                                        <input name="blog_name" class="form-control" required="true">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Category Parent</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="cbx_parent_id">
                                            @foreach($list_dropdown_b as $parent)
                                            <option @if($parent->type==1) selected value="{{$parent->id_category}}">{{$parent->category_name}}
                                                @else hidden
                                                @endif
                                            </option>
                                            @endforeach
                                        </select>
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
                                <!-- <textarea name="description" id="description">Description</textarea> -->
                                <textarea class="form-control" id="description" name="description"></textarea>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" name="blog_action" value="blog_create" class="btn btn-primary">Create</button>
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
<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
@endsection()