<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContractController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/contracts',[ContractController::class,'index'])->name('contracts.index');

Route::get('/contracts/create',[ContractController::class,'create'])->name('contracts.create');
 
Route::get('/contracts/{id}',[ContractController::class,'show'])->name('contracts.show');