<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;


class ManufacturerController extends BaseController
{
    public function getAll()
    {
        $manufacturers = Manufacturer::all();
        return view('adminpage.ad_manufacturer', compact('manufacturers'));
    }

    public function postInsert(Request $request)
    {
        $manufacturer = [
            'manufacturer' =>  $request->manufacturer
        ];
        Manufacturer::insert($manufacturer);
        return redirect(url('ad_Manufacturer'));
    }

    public function postDelete(Request $request)
    {
        Manufacturer::find($request->id_manufaturer)->delete();
        return redirect(url('ad_Manufacturer'));
    }

    public function getEdit($id)
    {
        $manufacturer = Manufacturer::find($id);
        return view('adminpage.ad_manufactureeditpage', compact('manufacturer'));
    }

    public function postUpdate($id, Request $request)
    {
        $manufacturer = [
            'manufacturer' =>  $request->manufacturer
        ];
        Manufacturer::find($id)->update($manufacturer);
        return redirect(url('ad_Manufacturer'));
    }
}
