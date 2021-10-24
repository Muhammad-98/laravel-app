<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function list()
    {
        $address = Address::all();
        $AddressesCount = Address::count();
        return response()->json(["message" => "Number of Addresses is ($AddressesCount), and this is a list of all addresses","data" => $address], 200);   
    }

    public function count(Request $request)
    {
        if($request->validate(['area_id' => 'required|exists:areas,id']))

           {
            $AreaId = $request->get('area_id');
            $count = Address::where('area_id', $AreaId)->count();
            return response()->json(["message" =>"This is number of addresses linked to area no. ($AreaId)","data" => $count],200);
           }
            return response()->json(['message' => 'This Area does not exist'], 405);
    }
}