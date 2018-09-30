<?php

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

Auth::routes();
Route::get('/', 'CandidatesController@index')->name('home');
Route::get('submit-cv', 'CandidatesController@create')->name('submitcv');
Route::post('submit-cv', 'CandidatesController@store')->name('submitcv');
Route::get('manage-cv', 'CandidatesController@index')->name('managecv');
Route::get('manage-cv/{id}/edit', 'CandidatesController@edit')->name('editcv');
Route::post('manage-cv/{id}/edit', 'CandidatesController@update')->name('editcv');
Route::get('manage-cv/{id}/delete', 'CandidatesController@destroy')->name('deletecv');