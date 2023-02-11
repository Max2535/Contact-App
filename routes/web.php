<?php

use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\Settings\AccountController;

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

/*
Route::get('/contracts',[ContractController::class,'index'])->name('contracts.index');

Route::post('/contracts',[ContractController::class,'store'])->name('contracts.store');

Route::get('/contracts/create',[ContractController::class,'create'])->name('contracts.create');
 
Route::get('/contracts/{id}',[ContractController::class,'show'])->name('contracts.show');

Route::put('/contracts/{id}',[ContractController::class,'update'])->name('contracts.update');

Route::delete('/contracts/{id}',[ContractController::class,'destroy'])->name('contracts.destroy');

Route::get('/contracts/{id}/edit',[ContractController::class,'edit'])->name('contracts.edit');
*/

Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/dashboars', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboars');
/*
Route::post('/contracts', [ContractController::class, 'store'])
     ->name('contracts.store')
     ->middleware('auth');
Route::get('/contracts/create', [ContractController::class, 'create'])
     ->name('contracts.create')
     ->middleware('auth');
Route::get('/contracts/{id}', [ContractController::class, 'show'])
     ->name('contracts.show')
     ->middleware('auth');
Route::put('/contracts/{id}', [ContractController::class, 'update'])
     ->name('contracts.update')
     ->middleware('auth');
Route::delete('/contracts/{id}', [ContractController::class, 'destroy'])
     ->name('contracts.destroy')
     ->middleware('auth');
Route::get('/contracts/{id}/edit', [ContractController::class, 'edit'])
     ->name('contracts.edit')
     ->middleware('auth');
*/
//Route::resource('/contract','App\Http\Controllers\CompanyController')->only(['create','store','edit','update','destroy']);
//Route::resource('/contract','App\Http\Controllers\CompanyController')->except(['create','store','edit','update','destroy']);

// Route::resource('/contracts',ContractController::class)->parameters([
//      'contracts'=>'param'
// ]);

// Route::resource('/companies.contracts',ContractController::class)->names([
//      'index'=>'contracts.all',
//      'show'=>'contracts.view'
// ]);

Route::resources([
     '/contracts'=>ContractController::class,
     '/companies'=>CompanyController::class
]);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/contracts', [ContractController::class, 'index'])->name('contracts.index');
    Route::post('/contracts', [ContractController::class, 'store'])->name('contracts.store');
    Route::get('/contracts/create', [ContractController::class, 'create'])->name('contracts.create');
    Route::get('/contracts/{contract}', [ContractController::class, 'show'])->name('contracts.show');
    Route::put('/contracts/{contract}', [ContractController::class, 'update'])->name('contracts.update');
    Route::delete('/contracts/{contract}', [ContractController::class, 'destroy'])->name('contracts.destroy');
    Route::get('/contracts/{contract}/edit', [ContractController::class, 'edit'])->name('contracts.edit');
    Route::get('/settings/account', [AccountController::class, 'index']);
});