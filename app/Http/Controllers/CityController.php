<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Area;
use Illuminate\Http\Request;

class CityController extends Controller
{

    public function list()
    {
        $city = City::all();
        $CityCount = City::count();
        return response()->json(["message" => "Number of Cities is ($CityCount), and this is a list of all cities","data" => $city], 200);   
    }

    public function show(Request $request)
    {
        if($request->validate(['id' => 'exists:cities,id']))
        {
        $cityId = $request->get('id');
        $city = City::find($cityId);
        return response()->json(["This is city number ($cityId)",$city]);
        }
        return response()->json(["City not found", 400]);
    }

    public function count(Request $request)
    {
        if($request->validate(['state_id' => 'exists:cities,state_id']))

           {
            $stateId = $request->get('state_id');
            $count = City::where('state_id', $stateId)->count();
            return response()->json(["message" =>"This is number of cities linked to state no. ($stateId)","data" => $count],200);
           }
            return response()->json(['message' => 'This State does not exist'], 405);
    }

    public function store(Request $request)
    {
        $request->validate(['name'=> 'required','state_id' => 'required|exists:states,id']);
        
             $city = City::where('name', '=', $request->input('name'))->first();
             if (isset($city))
                {
                 return response()->json(["message" => "City already exists","data" => $city], 403);
                }
        
             else
                {
                 $city = City::create($request->all());
                 return response()->json(["message" => "City Created Successfully","data" => $city], 200);
                 }        
          
    }

    public function update(Request $request)
    {
        $request->validate(['id'=> 'required|exists:cities,id','name'=> 'nullable|unique:cities','state_id' =>'nullable|exists:states,id']);
        $city = City::find($request->get('id'));
        if (isset($city))
        {
            $city->name=$request->get('name');
            $city->state_id=$request->get('state_id');
            $city->save();
            return response()->json(["message" => "City Updated Succssfully","data" => $city], 200);
        }
            return response()->json(["message" => "City does not exist !"], 404);
    }

    public function delete(Request $request)
    {
        $cityId=$request->get('id');
        $city = City::find($cityId);
        if (isset($city))
        {
            $CityAreas=Area::select("city_id")->distinct()->get()->pluck("city_id")->toArray();
               if(in_array($cityId,$CityAreas))
               {
                 return response()->json(["message" => "Delete operation has been failed,This city has areas","data" => $CityAreas], 409);
               }
               else
               {
                   $city->delete();
                 return response()->json(["message" => "City deleted Successfully"], 200);
               }
        }
        
        else
        {
            return response()->json(["message" => "City does not exist !"], 404);
        }
    }
}
