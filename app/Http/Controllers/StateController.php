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
        $StateCount = State::count();
        return response()->json(array(["message" => "Number of States is ($StateCount), and this is a list of all states","data" => $state]), 200);
    }
 
    public function show(Request $request)
    {
        $request->validate(['state_id' => 'exists:states,id']);
        $state = State::find($request->id);
        return response()->json(["message" => "This is state number ($request->id)","data" =>$state], 200);
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:states']);
        $state = State::where('name', '=', $request->input('name'))->first();
        if (isset($state))
        {
            return response()->json(["message" => "State already exists","data" => $state], 403);
        }
        
        else
        {
            State::create($request->all());
            return response()->json(["message" => "State Created Successfully"], 200);
        }
         
    }

    public function update(Request $request)
    {
        $state = State::find($request->id);
        if (isset($state))
        {
            $request->validate(['name'=> 'required|unique:states']);
            $state->name=$request->name;
            $state->save();
            return response()->json(["message" => "State Updated Succssfully","data" => $state], 200);
        }
        
        else
        {
            return response()->json(["message" => "State does not exist !"], 404);
        }

    }

    public function delete(Request $request)
    {
        $request->validate(['id' => 'exists:states,id']);
        $state = State::find($request->id);
        if (isset($state))
        {
            $StateCities=City::select("state_id")->distinct()->get()->pluck('state_id')->toArray();
               if(in_array($request->id,$StateCities))
               {
                 return response()->json(["message" => "Delete operation has been failed,This state has cities","data" => $StateCities], 409);
               }
               else
               {
                   $state->delete();
                 return response()->json(["message" => "State deleted Successfully"], 200);
               }
        }
        
        else
        {
            return response()->json(["message" => "State does not exist !"], 404);
        }
    }
}