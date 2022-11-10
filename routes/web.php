<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExtensionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[ExtensionController::class,'extensions']);

Route::view('/extensionForm','ExtensionForm');
Route::post('/addExtension',[ExtensionController::class,'addExtension']);
Route::post('/searchExtension',[ExtensionController::class,'searchExtension']);
Route::get('/deleteExtension/{id}',[ExtensionController::class,'deleteExtension']);
Route::get('/editExtension/{id}',[ExtensionController::class,'getExtension']);
Route::post('/updateExtension',[ExtensionController::class,'updateExtension']);
Route::post('/filterExtension',[ExtensionController::class,'filterExtension']);
Route::get('/viewUpdates/{id}',[ExtensionController::class,'viewUpdates']);
Route::post('/extensionUpdate',[ExtensionController::class,'extensionUpdate']);
Route::get('/deleteUpdates/{id}',[ExtensionController::class,'deleteUpdates']);