<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Area;
use Illuminate\Http\Request;

class CityController extends Controller
{

    public function index()
    {
        $city = City::all();
        return response()->json(["That are all cities",$city]);
    }
 
    public function show(Request $request)
    {
        $city = City::find($request->id);
        return response()->json(["This is city number ($request->id)",$city]);
    }

    public function store(Request $request)
    {
        $city = City::where('name', '=', $request->input('name'))->first();
        if (isset($city))
        {
            return response()->json(["City already exists", $city]);
        }
        
        else
        {
            $city = City::create($request->all());
            return response()->json(["City Created Successfully", $city]);
        }    
    }

    public function update(Request $request)
    {
        $city = City::find($request->id);
        if (isset($city))
        {
            $city->name=$request->name;
            $city->save();
            return response()->json(["City Updated Succssfully",$city]);
        }
        
        else
        {
            return response()->json("City does not exist !");
        }

    }

    public function delete(Request $request)
    {
        $city = City::find($request->id);
        if (isset($city))
        {
            $CityAreas=Area::select("city_id")->distinct()->get()->pluck("city_id")->toArray();
               if(in_array($request->id,$CityAreas))
               {
                 return response()->json(["Delete operation has been failed,This city has areas",$CityAreas]);
               }
               else
               {
                   $city->delete();
                 return response()->json("City deleted Successfully");
               }
        }
        
        else
        {
            return response()->json("City does not exist !");
        }
    }
}
