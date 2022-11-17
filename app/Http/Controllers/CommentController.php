<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function getCommentList(){
        $list_comment = Comment::all();

        // $data = DB::table('order_details')
        //     ->join('product_details', 'order_details.id_product_detail', '=', 'product_details.id_product_detail',)
        //     ->join('products', 'product_details.id_product', '=', 'products.id_product')
        //     ->where('id_order', '=', $id_order)
        //     ->select('order_details.*', 'products.product_name','product_details.size', 'product_details.color', 'product_details.material')
        //     ->get();

        $data = DB::table('user')
            ->join('comment', 'user.id_user' ,'=', 'comment.id_user')
            ->join('product', 'comment.id_product', '=', 'product.id_product')
            ->select('comment.*', 'user.user_name', 'product.product_name')
            ->get();
        return view('adminpage.ad_commentpage', compact('list_comment','data'));
    }

    public function postReplyComment(Request $req){
        $comment =[
            'id_comment' => $req->id_comment,
            'reply_comment' => $req->reply_comment
        ];
        //dd($req->input());
        Comment::where('id_comment', $req->id_comment)->update($comment);
        return redirect('ad_commentpage');
    }

    public function getDeteleComment(Request $req){
        $c = Comment::findOrFail($req->id_comment);
        $c->delete();
        return redirect('ad_commentpage');
    }

    //------------------------ User page ------------------------------------------//


    public function getProductDetailAndComment($id)
    {
        $product = Product::with('image_product','manufacturer')->find($id);
        $product_detail = Product::find($id)->product_detail;
        $color_size_price = []; //Tạo ra mảng 3 chiều với các tham số $varName[color][size][price]=remaing;
        foreach ($product_detail as $detail) {
            $color_size_price[$detail->color][$detail->size][$detail->price] = $detail->remaining;
        }
        $data = DB::table('user')
            ->join('comment', 'user.id_user' ,'=', 'comment.id_user')
            ->join('product', 'comment.id_product', '=', 'product.id_product')
            ->where('comment.id_product', $id)
            ->select('comment.comment', 'user.user_name')
            ->get();
        
        return view('userpage.user_product', compact('product','product_detail', 'color_size_price', 'data'));
    }

    public function postInsertComment(Request $req){
        $this->validate(
            $req,
            [
                'comment' => 'required'
            ]
        );
        $c = new Comment();
        //dd($req->input());

        $c->id_user = $req->id_user;
        $c->id_product = $req->id;
        $c->comment = $req->comment;
        $c->save();
        return redirect()->route('chi-tiet-san-pham-va-binh-luan', $req->id);
    }
}
