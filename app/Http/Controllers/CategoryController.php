<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function postInsertCategory(Request $req){
        $this->validate(
            $req,
            [
                'category_name' => 'required',
            ]
        );

        $c = new Category();
       // dd($req->input());
        $c->id_parent = $req->cbx_parent_id;
        $c->category_name = $req->category_name;
        if($req->cbx_parent_id==1){
            $c->type = 0;
        }else{
            $c->type = 1;
        }
        $c->status = 1;
        //dd($req->input());
        $c->save();
        return redirect('ad_categorypage');
    }
    public function postInsertCategoryParent(Request $req){
        $this->validate(
            $req,
            [
                'category_name' => 'required',
            ]
        );
        $c = new Category();
        //dd($req->input());
        $c->id_parent = $req->id_parent;
        $c->category_name = $req->category_name;
        $c->type = $req->cbx_type;
        $c->status = 1;

        //dd($req->input());
        $c->save();
        return redirect('ad_categorypage');
    }
    public function getEditCategory(Request $req){
        $list_dropdown = Category::all();
        
        $category_edit = Category::where('id_category', $req->id_category)->first();
        return view('adminpage.ad_categoryeditpage', compact('category_edit','list_dropdown',));
    }

    public function getCategoryDropdown(){
        $list_dropdown = Category::all();
        return view('adminpage.ad_categoryeditpage', compact('list_dropdown'));
    }

    public function postUpdateCategory(Request $req){
        $category = [
            'id_parent' => $req->cbx_parent_id,
            'category_name' =>$req->category_name
        ];
        if($req->cbx_parent_id==1){
            $req->type = 0;
        }else{
            $req->type = 1;
        }
       // dd($req->input());
        Category::where('id_category', $req->id_category)->update($category,$req->type);
        return redirect('ad_categorypage');
    }
    public function getDeleteCategory(Request $req){
        $u = Category::findOrFail($req->id_category);
        $u->delete();
        return redirect('ad_categorypage');
    }
}
