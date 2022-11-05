<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductDetail;
class ProductDetailController extends Controller
{
    public function getPrice(Request $request, $id)
    {
        $product = ProductDetail::where([
            'id_product' => $id,
            'color' => $request->color,
            'size' => $request->size
        ])->first();
        $data = $product->price;
        $img = $product->image;
        $remaining = $product->remaining;
        return response([
            'data' => number_format($data),
            'img' => $img,
            'remaining' => $remaining,
        ]);
    }
}
