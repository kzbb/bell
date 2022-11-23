<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BellController;
use App\Http\Controllers\GroupController;

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

Route::get('/', function () { return view('welcome'); });

Route::get('/dashboard', [GroupController::class, 'index'])->middleware(['auth']);

Route::get('/index', [BellController::class, 'index'])->middleware(['auth']);
Route::post('/create', [BellController::class, 'create'])->middleware(['auth']);
Route::post('/store', [BellController::class, 'store'])->middleware(['auth']);
Route::post('/destroy/{id}', [BellController::class, 'destroy'])->middleware(['auth']);
Route::get('/edit/{id}', [BellController::class, 'edit'])->middleware(['auth']);

Route::get('/group/members/{id}', [GroupController::class, 'showMembers'])->middleware(['auth']);
Route::post('/group/create', [GroupController::class, 'create'])->middleware(['auth']);
Route::post('/group/store', [GroupController::class, 'store'])->middleware(['auth']);
Route::post('/group/destroy/{id}', [GroupController::class, 'destroy'])->middleware(['auth']);
Route::get('/group/edit/{id}', [GroupController::class, 'edit'])->middleware(['auth']);

require __DIR__.'/auth.php';

Route::get('/{id}', function () { return view('onebell'); });
Route::get('/show/{id}', [BellController::class, 'show']);
Route::get('/update/{id}', [BellController::class, 'update']);
Route::get('/{id}/addbell', [GroupController::class, 'addBell']);