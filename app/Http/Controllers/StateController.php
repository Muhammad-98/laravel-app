<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\City;
use Illuminate\Http\Request;

class StateController extends Controller
{

    public function index()
    {
        $state = State::all();
        return response()->json(["That is a list of all states",$state]);
    }
 
    public function show(Request $request)
    {
        $state = State::find($request->id);
        return response()->json(["This is state number ($request->id)",$state]);
    }

    public function store(Request $request)
    {
        $state = State::where('name', '=', $request->input('name'))->first();
        if (isset($state))
        {
            return response()->json(["State already exists", $state]);
        }
        
        else
        {
            State::create($request->all());
            return response()->json(["State Created Successfully"]);
        }
         
    }

    public function update(Request $request)
    {
        $state = State::find($request->id);
        if (isset($state))
        {
            $state->name=$request->name;
            $state->save();
            return response()->json(["State Updated Succssfully", $state]);
        }
        
        else
        {
            return response()->json("State does not exist !");
        }

    }

    public function delete(Request $request)
    {
        $state = State::find($request->id);
        if (isset($state))
        {
            $StateCities=City::select("state_id")->distinct()->get()->pluck("state_id")->toArray();
               if(in_array($request->id,$StateCities))
               {
                 return response()->json(["Delete operation has been failed,This state has cities",$StateCities]);
               }
               else
               {
                   $state->delete();
                 return response()->json("State deleted Successfully");
               }
        }
        
        else
        {
            return response()->json("State does not exist !");
        }
    }
}