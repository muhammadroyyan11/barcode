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

Route::get('/', function () {
    return view('welcome');
});


//tes cetak label
Route::get('tes-cetak-label','TController@tes_cetak_label');
Route::get('cari_produk','TController@searchProduk');

Route::get('tes-cetak-tag','TController@tes_cetak_tag');
Route::get('get_produk','TController@getProduk');



