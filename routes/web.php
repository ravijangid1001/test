<?php

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

Route::get('admin','AdminController@index')->name('admin');
Route::post('login','AdminController@checklogin')->name('login');

//List Routes
Route::get('company/list','AdminController@list')->name('list');

//Recods Insert in Table Routes
Route::get('company/add','AdminController@store')->name('company.add');
Route::post('insert','AdminController@alldata')->name('add');
//Recods Update Routes
Route::get('company/edit/{id}','AdminController@edit')->name('company.edit');
Route::post('company/update/{id}','AdminController@update')->name('company.update');
Route::get('company/delete/{id}','AdminController@delete')->name('company.delete');



//::get('employe/list','AdminController@employeList')->name('employe.list');
Route::get('employe/add/','AdminController@employestore')->name('employe.add');
Route::post('employe/insert','AdminController@employedata')->name('post.add');
Route::get('employe/list','AdminController@employelist')->name('employe.list');
Route::get('edit/{id}','AdminController@employeedit')->name('employe.edit');
Route::post('update/{id}','AdminController@employeupdate')->name('update');
Route::get('delete/{id}','AdminController@employedelete')->name('employe.delete');
