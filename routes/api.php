<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiDemo;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); 
Route::get("DummtAPI",[ApiDemo::class,'Testing']);
Route::get("GetAllList",[ApiDemo::class,'List']);

Route::get("GetDataByID/{id?}",[ApiDemo::class,'GetByID']); // Get Data By ID
Route::post("AddAPI",[ApiDemo::class,'AddAPI']); // Get Data By ID


