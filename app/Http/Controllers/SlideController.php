<?php

namespace App\Http\Controllers;

use App\Models\ImageUpload;
use App\Models\Slide;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    public function postInsertSlide(Request $req){
        $this->validate(
            $req,
            [
                'slide_name' => 'required',
                'image' => 'required'
            ]
        );

        $s = new Slide();
        //dd($req->input());
        $s->slide_name = $req->slide_name;
        // $s->image = $req->image;


       // $image = ImageUpload::imageUploadPost();
       // $s->image = $req->image;

       $image1 = $req->image;
       $image = ImageUpload::imageUploadPost($image1);
        
        $s->image = $image;

        $s->save();
       // return redirect('ad_slidepage');
    }
    public function getEditSlide(Request $req){
        $slide_edit = Slide::where('id_slide', $req->id_slide)->first();
        return view('adminpage.ad_slideeditpage', compact('slide_edit'));
    }

    public function postUpdateSlide(Request $req){
        $slide = [
            'slide_name' =>$req->slide_name,
            'image' =>$req->image
        ];
        // if($req->image == ''){
        //     $req->image = $s->image;
        // }

        //dd($req->input());
        Slide::where('id_slide', $req->id_slide)->update($slide);
        return redirect('ad_slidepage');
    }
    public function getDeleteSlide(Request $req){
        $s = Slide::findOrFail($req->id_slide);
        $s->delete();
        return redirect('ad_slidepage');
    }
}
