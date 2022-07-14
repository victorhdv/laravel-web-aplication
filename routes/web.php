<?php

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
// caso estivesse sendo seguido o padrão de nomenclatura da documentação para o Controller
//Route::resource('/series',SeriesController::class);

Route::controller(SeriesController::class)->group(function (){
    Route::get('/series', 'index');
    Route::get('/series/criar', 'create');
    route::post('/series/salvar', 'store');

});
