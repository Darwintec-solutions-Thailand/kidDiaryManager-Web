<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\GrowthAnalystController;
use App\Http\Controllers\KnowLedgeController;
use App\Http\Controllers\KnowLedgeGroupController;
use App\Http\Controllers\AnalysisGrowthChartSrcController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\NewsController;
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


Route::get('/AnalysisGrowthChartSrc', [AnalysisGrowthChartSrcController::class, 'index'])->name('AnalysisGrowthChartSrc.index');
Route::post('/getAnalysisGrowthChartSrc', [AnalysisGrowthChartSrcController::class, 'getAnalysisGrowthChartSrc'])->name('AnalysisGrowthChartSrc.getData');
Route::post('/storeAnalysisGrowthChartSrc', [AnalysisGrowthChartSrcController::class, 'store'])->name('AnalysisGrowthChartSrc.store');
Route::post('/destroyAnalysisGrowthChartSrc', [AnalysisGrowthChartSrcController::class, 'destroy'])->name('AnalysisGrowthChartSrc.destroy');
Route::post('/getDataEditAnalysisGrowthChartSrc', [AnalysisGrowthChartSrcController::class, 'getDataById'])->name('AnalysisGrowthChartSrc.getDataEdit');

Route::get('/Hospital', [HospitalController::class, 'index'])->name('Hospital.index');
Route::post('/getHospital', [HospitalController::class, 'getHospital'])->name('Hospital.getData');
Route::post('/storeHospital', [HospitalController::class, 'store'])->name('Hospital.store');
Route::post('/destroyHospital', [HospitalController::class, 'destroy'])->name('Hospital.destroy');
Route::post('/getDataEditHospital', [HospitalController::class, 'getDataById'])->name('Hospital.getDataEdit');


Route::get('/News', [NewsController::class, 'index'])->name('News.index');
Route::get('/showNews', [NewsController::class, 'showNews'])->name('News.showNews');
Route::get('/showNews/{id}', [NewsController::class, 'showNewsById'])->name('News.showNewsById');
Route::post('/getNews', [NewsController::class, 'getNews'])->name('News.getData');
Route::post('/storeNews', [NewsController::class, 'store'])->name('News.store');
Route::post('/destroyNews', [NewsController::class, 'destroy'])->name('News.destroy');
Route::post('/getDataEditNews', [NewsController::class, 'getDataById'])->name('News.getDataEdit');

