@extends('user_master')
@section('user_content')

    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="#"><i class="fa fa-home"></i> Home</a>
                        <span>Edit Profile</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Form Section Begin -->

    <!-- Register Section Begin -->
    <div class="register-login-section spad">
        <div>
            <h1 class="text-center">Edit Profile</h1>
            <br>
        </div>
        <div class="container ">
            <div class="row justify-content-center">
                <div class="col col-lg-4">
                    <style>
                        .center-cropped {
                            width: 300px;
                            height: 300px;
                            object-fit: cover;
                        }
                    </style>
                    <div class="row justify-content-center">
                        <img src="images/{{ Auth::user()->avatar }}" class="center-cropped img-fluid img-thumbnail"
                            id="previewImg" alt="Avatar image">
                    </div>
                    <script>
                        function previewFile(input) {
                            var file = $("input[type=file]").get(0).files[0];
                            if (file) {
                                var reader = new FileReader();
                                reader.onload = function() {
                                    $("#previewImg").attr("src", reader.result);
                                }
                                reader.readAsDataURL(file);
                            }
                        }
                    </script>
                    <div class="row justify-content-center mt-1">
                        <label for="avatar" class="btn btn-outline-info btn-sm text-center">
                            <i class="fa fa-image"></i>&ensp; Upload image
                            <input type="file" onchange="previewFile(this)" name="image" form="formUser" id="avatar"
                                style="display: none">
                        </label>
                    </div>
                </div>
                <div class="col col-lg-6">
                    <div class="register-form">
                        @if (Session::has('userEdit_status'))
                            <div class="alert alert-success" style="text-align: center">
                                {{ Session::get('userEdit_status') }}
                            </div>
                        @endif
                        @if (count($errors) > 0)
                            <div class="alert alert-danger" style="text-align: center">
                                @foreach ($errors->all() as $err)
                                    {{ $err }}
                                    <br>
                                @endforeach
                            </div>
                        @endif
                        @if (Auth::check())
                            <form action="{{ route('userEdit', Auth::user()->id_user) }}" enctype="multipart/form-data"
                                id="formUser" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="group-input">
                                    <label for="username">Username</label>
                                    <input class="form-control" value="{{ Auth::user()->user_name }}" name="name"
                                        required="true">
                                </div>
                                <div class="group-input">
                                    <label for="username">Email address</label>
                                    <input readonly type="email" value="{{ Auth::user()->email }}" class="form-control"
                                        name="email" required="true">
                                </div>
                                <div class="group-input">
                                    <label for="con-pass">Address</label>
                                    <input id="con-pass" value="{{ Auth::user()->address }}" name="address"
                                        required="true">
                                </div>
                                <div class="group-input">
                                    <label for="con-pass">Phone</label>
                                    <input id="con-pass" value="{{ Auth::user()->phone }}" name="phone" required="true">
                                </div>
                                <div class="group-input">
                                    <label for="con-pass">Gender</label>
                                </div>
                                <label class="lbsRadio">
                                    <input type="radio" name="rd_gioitinh" value="male"
                                        @if (Auth::user()->gender == 'male') checked @endif> Male</label>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <label class="lbsRadio">
                                    <input type="radio" name="rd_gioitinh" value="female"
                                        @if (Auth::user()->gender == 'female') checked @endif> Female</label>
                                <button type="submit" class="site-btn register-btn">EDIT</button>
                            </form>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Register Form Section End -->

@endsection
