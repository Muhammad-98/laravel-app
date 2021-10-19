<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\City;
use Illuminate\Http\Request;

class StateController extends Controller
{

    public function count()
    {
        $state = State::all();
        $StatesCount = State::count();
        return response()->json(array(["message" => "Number of States is ($StatesCount), and this is a list of all states","data" => $state]), 200);
    }
 
    public function show(Request $request)
    {
        if($request->validate(['id' => 'exists:states,id']))
        {
        $stateId = $request->get('id');
        $state = State::find($stateId);
        return response()->json(["message" => "This is state number ($stateId)","data" =>$state], 200);
        }
        return response()->json(["message" => "State not found"], 404);
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
        if($request->validate(['id' => 'required|exists:states,id','name'=> 'required|unique:states']))
        {
            $stateId = $request->get('id');
            $state = State::find($stateId);
            $state->name=$request->get('name');
            $state->save();
            return response()->json(["message" => "State Updated Succssfully","data" => $state], 200);
        }
            return response()->json(["message" => "State does not exist !"], 404);
    }

    public function delete(Request $request)
    {
        $request->validate(['id' => 'exists:states,id']);
        $stateId=$request->get('id');
        $state = State::find($stateId);
        if (isset($state))
        {
            $StateCities=City::select("state_id")->distinct()->get()->pluck('state_id')->toArray();
               if(in_array($stateId,$StateCities))
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