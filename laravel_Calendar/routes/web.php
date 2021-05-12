<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\FieldsController;
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
Route::view('form','form');

Route::get('events',[EventsController::class,'index']);

Route::get('teacher',[EventsController::class,'index_teacher']);

Route::post('ajax-update',[EventsController::class, 'ajax_update'])->name('ajax-update');
Route::post('submit',[EventsController::class,'calculate_date']);
// Route::post('submit',[FieldsController::class,'field_add']);
Route::post('ajax-delete',[EventsController::class, 'ajax_delete'])->name('ajax-delete');
