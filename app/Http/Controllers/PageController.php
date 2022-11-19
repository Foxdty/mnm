<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Comment;
use App\Models\ImageProduct;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\Slide;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Http\Request;

class PageController extends Controller
{
    //----------------ADMINPAGE--------------------------------------------
    public function getUserList()
    {
        $list = User::all();
        return view('adminpage.ad_userpage', compact('list'));
    }
    public function getCategoryList()
    {
        $list_cat = Category::all();
        return view('adminpage.ad_categorypage', compact('list_cat'));
    }

    public function getBlogList()
    {
        $list_blog = Blog::all();
        return view('adminpage.ad_blogpage', compact('list_blog'));
    }

    public function getVoucherList()
    {
        $list_voucher = Voucher::all();
        return view('adminpage.ad_voucherpage', compact('list_voucher'));
    }

    public function getSlideList()
    {
        $list_slide = Slide::all();
        return view('adminpage.ad_slidepage', compact('list_slide'));
    }

    public function getCommentList()
    {
        $list_comment = Comment::all();
        return view('adminpage.ad_commentpage', compact('list_comment'));
    }

    public function ad_getAllProduct()
    {
        $product_list = Product::with('image_product')->get();
        return view('adminpage.ad_productpage', compact('product_list'));
    }

    public function getProductEditPage(Request $request)
    {
        $list_dropdown = Category::where(['type' => 0])->get();
        $manufacturers = Manufacturer::all();
        if ($request->isMethod('post')) {
            $imageProducts = ImageProduct::where(['id_product' => $request->id_product])->get();
            $product = Product::find($request->id_product);
            $product_detail = Product::find($request->id_product)->product_detail;
            return view('adminpage.ad_producteditpage', compact('list_dropdown', 'product', 'product_detail', 'manufacturers', 'imageProducts'));
        }
        return view('adminpage.ad_producteditpage', compact('list_dropdown', 'manufacturers'));
    }

    //----------------USERPAGE--------------------------------------------

    public function getBlogListUserPage()
    {
        $list_blog = Blog::all();
        $category = Category::all();
        return view('userpage.user_blog', compact('list_blog', 'category'));
    }

    public function getSlideListUserPage()
    {
        $list_slide = Slide::all();
        return view('userpage.user_home', compact('list_slide'));
    }

    public function getShop()
    {
        $list_product = Product::with('image_product')->where('status', '<>', 0)->get();
        $categories = Category::where(['type' => 0])->get();
        $manufacturers = Manufacturer::all();
        return view('userpage.user_shop', compact('list_product', 'categories','manufacturers'));
    }
}
