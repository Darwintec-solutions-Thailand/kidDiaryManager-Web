<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\GrowthAnalystController;
use App\Http\Controllers\KnowLedgeController;
use App\Http\Controllers\KnowLedgeGroupController;
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

$controller_path = 'App\Http\Controllers';

// Main Page Route
Route::get('/', [DashBoardController::class, 'index'])->name('pages-home');

Route::get('/page-2', $controller_path . '\pages\Page2@index')->name('pages-page-2');

//DashBoard
Route::get('/DashBoard', [DashBoardController::class, 'index'])->name('DashBoard.index');


//Route ช่วงอายุ
Route::get('/GrowthAnalyst', [GrowthAnalystController::class, 'index'])->name('GrowthAnalyst.index');
Route::post('/getGrowthAnalyst', [GrowthAnalystController::class, 'getGrowthAnalyst'])->name('GrowthAnalyst.getData');
Route::post('/storeGrowthAnalyst', [GrowthAnalystController::class, 'store'])->name('GrowthAnalyst.store');
Route::post('/destroyGrowthAnalyst', [GrowthAnalystController::class, 'destroy'])->name('GrowthAnalyst.destroy');
Route::post('/getDataEditGrowthAnalyst', [GrowthAnalystController::class, 'getDataById'])->name('GrowthAnalyst.getDataEdit');



Route::get('/KnowLedge', [KnowLedgeController::class, 'index'])->name('KnowLedge.index');
Route::post('/getKnowLedge', [KnowLedgeController::class, 'getKnowLedge'])->name('KnowLedge.getData');
Route::post('/storeKnowLedge', [KnowLedgeController::class, 'store'])->name('KnowLedge.store');
Route::post('/destroyKnowLedge', [KnowLedgeController::class, 'destroy'])->name('KnowLedge.destroy');
Route::post('/getDataEditKnowLedge', [KnowLedgeController::class, 'getDataById'])->name('KnowLedge.getDataEdit');


Route::get('/KnowLedgeGroup', [KnowLedgeGroupController::class, 'index'])->name('KnowLedgeGroup.index');
Route::post('/getKnowLedgeGroup', [KnowLedgeGroupController::class, 'getKnowLedgeGroup'])->name('KnowLedgeGroup.getData');
Route::post('/storeKnowLedgeGroup', [KnowLedgeGroupController::class, 'store'])->name('KnowLedgeGroup.store');
Route::post('/destroyKnowLedgeGroup', [KnowLedgeGroupController::class, 'destroy'])->name('KnowLedgeGroup.destroy');
Route::post('/getDataEditKnowLedgeGroup', [KnowLedgeGroupController::class, 'getDataById'])->name('KnowLedgeGroup.getDataEdit');
