<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function postInsertBlog(Request $req){
        $this->validate(
            $req,
            [
                'blog_name' => 'required',
                'image' => 'required',
            ]
        );
        $b = new Blog();
        //dd($req->input());
        $b->id_category = $req->cbx_parent_id;
        $b->blog_name = $req->blog_name;
        $b->image = $req->image;
        $b->description = $req->description;
        $b->save();
        return redirect('ad_blogpage');
    }

    public function getDropdownBlog(){
        $list_dropdown_b = Category::all();
        return view('adminpage.ad_blogeditpage', compact('list_dropdown_b'));
    }

    public function getEditBlog(Request $req){
        $list_dropdown_e = Category::all();
        
        $blog_edit = Blog::where('id_blog', $req->id_blog)->first();
        return view('adminpage.ad_blogeditpage', compact('blog_edit','list_dropdown_e',));
    }

    public function postUpdateBlog(Request $req){
        $blog = [
            'id_category' => $req->cbx_parent_id,
            'blog_name' => $req->blog_name,
            'image' => $req->image,
            'description' => $req->description
        ];
       // dd($req->input());
        Blog::where('id_blog', $req->id_blog)->update($blog);
        return redirect('ad_blogpage');
    }
    public function getDeleteBlog(Request $req){
        $b = Blog::findOrFail($req->id_blog);
        $b->delete();
        return redirect('ad_blogpage');
    }

//--------------------------------------USERPAGE------------------------------------------------

    public function getBlogDetailUserPage(Request $req){

        $blog_detail = Blog::where('id_blog', $req->id_blog)->first();
        return view('userpage.user_blog_details', compact('blog_detail'));
    }
}
