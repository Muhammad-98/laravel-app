<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Area;
use App\Models\State;
use Illuminate\Http\Request;

class CityController extends Controller
{

    public function index()
    {
        $city = City::all();
        $CityCount = City::count();
        return response()->json(["message" => "Number of Cities is ($CityCount), and this is a list of all cities","data" => $city], 200);   
    }

    public function count(Request $request)
    {
        $StateCities = City::where('state_id',$request->id)->get();
        $state = State::where('id','=',$request->id)->first();
        $count = City::where('state_id',$request->id)->count();
        if(isset($state))
        {
            if($count != 0)
            {
                 return response()->json(array(["message" =>"This is number of cities linked to state no. ($request->id)","data" => $count],["message" => "These cities are", "data"=> $StateCities]),200);
            }

            else
            {
                return response()->json(["message" => "State has no cities"], 404);
            }
        }
        
        else
        {
            return response()->json(["message" => "State is not exist"], 404);
        }
    }

    public function store(Request $request)
    {
        $request->validate(['name'=> 'required|unique:cities']);
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
        $city = City::find($request->id);
        if (isset($city))
        {
            $request->validate(['name'=> 'required|unique:cities']);
            $city->name=$request->name;
            $city->save();
            return response()->json(["message" => "City Updated Succssfully","data" => $city], 200);
        }
        
        else
        {
            return response()->json(["message" => "City does not exist !"], 404);
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
