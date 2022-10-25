<?php
use App\Http\Controllers\ContactController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware'=>['auth:sanctum']],function () {
    Route::get('/contacts', [ContactController::class,'index']);    
    Route::post('/contacts', [ContactController::class,'store']);
    Route::get('/contacts/{id}', [ContactController::class,'show']);
    Route::put('/contacts/{id}', [ContactController::class,'update']);
    Route::delete('/contacts/{id}', [ContactController::class,'destroy']);    
});
