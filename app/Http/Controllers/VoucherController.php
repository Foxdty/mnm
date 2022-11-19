<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function postInsertVoucher(Request $req)
    {
        $this->validate(
            $req,
            [
                'voucher_code' => 'required|max:50',
                'condition_price' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
                'price_sale' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
                'begin_date' => 'date',
                'expiration_date' => 'date|after:begin_date',
            ],
            [
                'voucher_code.required' => 'Please type your voucher !',
                'condition_price.required' => 'Please type your condition !',
                'condition_price.regex' => 'Please type numeric characters condition price !',
                'price_sale.required' => 'Please type your price price sale !',
                'begin_date.required' => 'Please choose begin date !',
                'expiration_date.after' => 'Please choose expiration date after the begin date!'
            ]
        );

        try {
            $v = new Voucher();
            //dd($req->input());

            // $begin = date('Y-m-d H:i:s');
            // $begin = $req->begin_datepicker;
            // date('Y-m-d H:i:s', strtotime($begin));
            $begin_date = Carbon::parse($req->begin_datepicker);
            $begin_time = Carbon::parse($req->begin_timepicker);
            $v->begin_date = $begin_date->format('Y-m-d') . " " . $begin_time->format('H:i:s');

            $expiration_date = Carbon::parse($req->expiration_datepicker);
            $expiration_time = Carbon::parse($req->expiration_timepicker);
            $v->expiration_date = $expiration_date->format('Y-m-d') . " " . $expiration_time->format('H:i:s');

            $v->voucher_code = $req->voucher_code;
            $v->condition_price = $req->condition_price;
            $v->price_sale = $req->price_sale;
            $v->status = 1;

            $v->save();
            return redirect('ad_voucherpage');
            //return redirect()->back()->with('success', 'your message,here');   
        } catch (ModelNotFoundException $exception) {
            return redirect()->back()->with('voucher_status', 'Register Success');
        }
    }

    public function getEditVoucher(Request $req)
    {
        $voucher_edit = Voucher::where('id_voucher', $req->id_voucher)->first();
        //cắt ngày, giờ của begin_date
        $splitTime_begin = (strtotime($voucher_edit->begin_date));
        $begin_date_split = date('Y-m-d', $splitTime_begin);
        $begin_time_split = date('H:i:s', $splitTime_begin);
        //cắt ngày, giờ của expiration_date
        $splitTime_expiration = (strtotime($voucher_edit->expiration_date));
        $expiration_date_split = date('Y-m-d', $splitTime_expiration);
        $expiration_time_split = date('H:i:s', $splitTime_expiration);
        return view('adminpage.ad_vouchereditpage', compact('voucher_edit', 'begin_date_split', 'begin_time_split', 'expiration_date_split', 'expiration_time_split'));
    }

    public function postUpdateVoucher(Request $req)
    {

        $begin_date = Carbon::parse($req->begin_datepicker);
        $begin_time = Carbon::parse($req->begin_timepicker);
        $begin_dot = $begin_date->format('Y-m-d') . " " . $begin_time->format('H:i:s');

        $expiration_date = Carbon::parse($req->expiration_datepicker);
        $expiration_time = Carbon::parse($req->expiration_timepicker);
        $expiration_dot = $expiration_date->format('Y-m-d') . " " . $expiration_time->format('H:i:s');

        $voucher = [
            'voucher_code' => $req->voucher_code,
            'condition_price' => $req->condition_price,
            'price_sale' => $req->price_sale,
            'begin_date' => $begin_dot,
            'expiration_date' => $expiration_dot
        ];
        //dd($req->input($begin));
        Voucher::where('id_voucher', $req->id_voucher)->update($voucher);
        return redirect('ad_voucherpage');
    }

    public function getDeleteVoucher(Request $req)
    {
        $v = Voucher::findOrFail($req->id_voucher);
        $v->delete();
        return redirect('ad_voucherpage');
    }
    
}
