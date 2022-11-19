<?php

namespace App\Http\Controllers;

use App\Models\ImageUpload;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    ///////////// Đăng ký ///////////////////////
    public function postRegister(Request $req)
    {
        $this->validate(
            $req,
            [
                'email' => 'required|email|unique:user,email',
                'password' => 'required|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
                'name' => 'required|max:100',
                'address' => 'required',
                'phone' => 'required',
                're_password' => 'required|same:password'
            ],
            [
                'email.required' => 'Please type your email !',
                'address.required' => 'Please type your address !',
                'phone.required' => 'Please type your phone number !',
                'email.email' => 'Incorrect email format !',
                'email.unique' => 'Email already in use !',
                'password.required' => 'Please type your password !',
                'password.regex' => 'Password must have at least 8 characters, uppercase, lowercase and special characters !',
                're_password.same' => 'Re Password not match !'
            ]
        );

        $u = new User();

        $u->user_name = $req->name;
        $u->address = $req->address;
        $u->phone = $req->phone;
        $u->email = $req->email;
        $u->password = Hash::make($req->password);
        $u->gender = $req->rd_gioitinh;
        if ($u->gender == 'male') {
            $u->avatar = 'male-default.jpg';
        } else {
            $u->avatar = 'female-default.jpg';
        }
        $u->role = 'user';
        $u->status = 1;
        $u->save();


        // DB::table('users')->insert(
        //     [
        //         'user_name' =>  $req->name,
        //         'address' =>  $req->address,
        //         'phone' =>  $req->phone,
        //         'email' =>  $req->email,
        //         'password' =>  Hash::make($req->password),
        //         'avatar' =>  'UNDONE',
        //         'gender' => $req->rd_gioitinh,
        //         'role' =>  'user',
        //         'status' => 1
        //     ]
        // );



        return redirect()->back()->with('register_status', 'Register Success');
        // $user->email = $request->email;
        // $user->password = $request->password;

        // $user->save();
        // return redirect()->route('login')->with('success','dang ky thanh cong');


    }

    /////////////// Đăng nhập //////////////////////////
    public function getLogin()
    {
        return view('userpage.user_login');
    }

    public function postLogin(Request $request)
    {
        $this->validate(
            $request,
            [
                'email' => 'required|email',
                'passWord' => 'required'
            ],
            [
                'email.required' => 'Please type your email !',
                'email.email' => 'Incorrect email format!',
                'password.required' => 'Please type your password !'
            ]
        );

        $data = [
            'email' => $request->email,
            'password' => $request->passWord,
        ];

        if (Auth::attempt($data)) {
            $user = User::where('email', $request->email)->first();
            Auth::login($user);

            //Lấy giỏ hàng của user
            if (!session()->exists('cart')) {
                $cart = [];
                session()->put('cart', $cart);
            }
            $cart = session()->get('cart');
            $cart_list = json_decode(User::find(Auth::user()->id_user)->cart);
            if ($cart_list != null) {
                foreach ($cart_list as $cart_item) {
                    $cart[$cart_item->id_product_detail] = $cart_item->pivot->quantity;
                }
            }
            session()->put('cart', $cart);
            //end getUserCart
            return redirect('/index');
        }
        return redirect()->back()->with('login_status', 'Wrong email or password!');
    }

    //////////////////////////Đăng xuất///////////////////////////
    public function postLogout()
    {
        Auth::logout();
        return redirect('/index');
    }

    /////////////////////////Thêm User bên admin//////////////////
    public function postInsertUser(Request $req)
    {
        $this->validate(
            $req,
            [
                'email' => 'required|email|unique:user,email',
                'password' => 'required',
                'name' => 'required',
                'address' => 'required',
                'phone' => 'required',
                're_password' => 'required|same:password'
            ],
            [
                'email.required' => 'Please type your email !',
                'address.required' => 'Please type your address !',
                'phone.required' => 'Please type your phone number !',
                'email.email' => 'Incorrect email format !',
                'email.unique' => 'Email already in use !',
                'password.required' => 'Please type your password !',
                're_password.same' => 'Re Password not match !'
            ]
        );

        $u = new User();

        $u->user_name = $req->name;
        $u->address = $req->address;
        $u->phone = $req->phone;
        $u->email = $req->email;
        $u->password = Hash::make($req->password);
        $avatar = $req->file_avatar;
        if ($avatar == '') {
            $avatar = 'UNDONE';
        }
        $u->avatar = $avatar;
        $u->gender = $req->rd_gioitinh;
        $u->role = $req->cbx_role;
        $u->status = 1;


        $u->save();
        return redirect('/ad_userpage');
    }

    /////////////////////////Xóa User bên admin//////////////////
    public function getDeleteUser(Request $req)
    {
        $u = User::findOrFail($req->id_user);
        $u->delete();
        return redirect()->back()->with('ad_userpage', 'Data Deleted');
    }

    public function editUser(Request $request)
    {
        $user = User::where('id_user', $request->id)->first();
        return view('adminpage.ad_usereditpage', compact('user'));
    }

    public function updateUser(Request $req)
    {
        $avatar = $req->file_avatar;
        if ($avatar == '') {
            $avatar = 'UNDONE';
        }

        $user = [
            'user_name' => $req->name,
            'address' => $req->address,
            'phone' => $req->phone,
            'avatar' => $avatar,
            'gender' => $req->rd_gioitinh,
            //'role' => $req->cbx_role,
        ];
        User::where('id_user', $req->id)->update($user);
        return redirect('/ad_userpage');
    }

    public function userEdit(Request $req)
    {
        $image = $req->image;
        if ($image == '') {
            $image = 'UNDONE';
        } else {
            // dd(gettype($avatar));
            $image = ImageUpload::imageUploadPost($image);
        }
        $this->validate(
            $req,
            [
                'name' => 'required',
                'address' => 'required',
                'phone' => 'required',

            ],
            [
                'address.required' => 'Please type your address !',
                'phone.required' => 'Please type your phone number !',
                'name' => 'Please type your UserName!',
            ]
        );

        $user = [
            'user_name' => $req->name,
            'address' => $req->address,
            'phone' => $req->phone,
            'gender' => $req->rd_gioitinh,
            'avatar' => $image
        ];
        User::where('id_user', $req->id)->update($user);

        return redirect()->back()->with('userEdit_status', 'Data Update');
    }
}
