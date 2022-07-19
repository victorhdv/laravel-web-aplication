<?php

use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\SeriesController;
use Illuminate\Support\Facades\Route;

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
    return redirect('/series');
});
// Sendo seguido o padrão de nomenclatura da documentação para o Controller
Route::resource('/series',SeriesController::class)
    ->except('show');

Route::get('/series/{series}/seasons', [SeasonsController::class,'index'])->name('seasons.index');

/*
utilizando post pois o html não suporta delete
Route::post('series/destroy/{serie}',[SeriesController::class,'destroy'])
    ->name('series.destroy');
Com a utilização do @ Method no html foi possivel utilizar o delete e apenas indexar no route resource
Route::delete('series/destroy/{serie}',[SeriesController::class,'destroy'])
    ->name('series.destroy');

    caso não fosse seguida a documentação do laravel
    Route::controller(SeriesController::class)->group(function (){
    Route::get('/series', 'index')->name('series.index');
    Route::get('/series/criar', 'create')->name('series.create');
    route::post('/series/salvar', 'store')->name('series.store');

})*/

