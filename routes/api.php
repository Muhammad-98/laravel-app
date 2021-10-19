<?php

use App\Http\Controllers\StateController;
use App\Http\Controllers\CityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
 
Route::get('StatesCount',[StateController::class,'count']);
Route::get('states',[StateController::class,'show']);
Route::post('states',[StateController::class,'store']);
Route::put('states', [StateController::class,'update']);
Route::delete('states',[StateController::class,'delete']);

Route::get('CitiesCount',[CityController::class,'list']);
Route::get('cities',[CityController::class,'show']);
Route::get('StateCities',[CityController::class,'count']);
Route::post('cities',[CityController::class,'store']);
Route::put('cities', [CityController::class,'update']);
Route::delete('cities',[CityController::class,'delete']);

//Route::apiResource('states',StateController::class);
//Route::apiResource('cities',CityController::class);

//Route::get('/state', 'StateController@index');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
