<?php

use App\Http\Controllers\StateController;
use App\Http\Controllers\CityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
 
Route::get('states',[StateController::class,'index']);
Route::get('states/{id}',[StateController::class,'show']);
Route::post('states',[StateController::class,'store']);
Route::put('states/{id}', [StateController::class,'update']);
Route::delete('states/{id}',[StateController::class,'delete']);

Route::get('cities',[CityController::class,'index']);
Route::get('cities/{id}',[CityController::class,'show']);
Route::post('cities',[CityController::class,'store']);
Route::put('cities/{id}', [CityController::class,'update']);
Route::delete('cities/{id}',[CityController::class,'delete']);

//Route::apiResource('states',StateController::class);
//Route::apiResource('cities',CityController::class);

//Route::get('/state', 'StateController@index');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
