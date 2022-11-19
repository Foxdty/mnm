@extends('ad_master')
@section('ad_content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <a href="{{ url('ad_Manufacturer') }}"><button type="button" class="btn btn-outline-primary">
                                <i class="fa fa-undo"></i>&nbsp; Back</button></a>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home </a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Manufacturer</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Manufacturer Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                @if (isset($manufacturer))
                                    <form action="{{ route('update-Manufacturer', $manufacturer->id_manufacturer) }}"
                                        method="post">
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Manufaturer name</label>
                                            <div class="col-sm-10">
                                                <input type="manufaturer" name="manufacturer" class="form-control"
                                                    value="{{ $manufacturer->manufacturer }}"
                                                    placeholder="Manufaturer name" required="true">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <button type="submit" name="user_action" value="user_create"
                                                    class="btn btn-primary">Edit</button>
                                            </div>
                                        </div>
                                    </form>
                                @else
                                    <form action="{{ url('ad_manufacturer') }}" method="post">
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Manufaturer name</label>
                                            <div class="col-sm-10">
                                                <input type="manufaturer" name="manufacturer" class="form-control"
                                                    placeholder="Manufaturer name" required="true">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <button type="submit" name="user_action" value="user_create"
                                                    class="btn btn-primary">Create</button>
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
        <!--**********************************
                                                Content body end
                                            ***********************************-->
        <!--**********************************
                                                Footer start
                                            ***********************************-->

        <!--**********************************
                                                Footer end
                                            ***********************************-->

        <!--**********************************
                                               Support ticket button start
                                            ***********************************-->

        <!--**********************************
                                               Support ticket button end
                                            ***********************************-->
    </div>
@endsection()
