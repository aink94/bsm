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

//Authentication
Route::group(['middleware'=>'web'], function () {
    //halaman-login
    Route::get('login', [
        'uses'=> 'AuthenticationController@getLogin',
        'as'  => 'login',
    ]);
    //ajax-login
    Route::post('login', [
        'uses'=> 'AuthenticationController@postLogin',
        'as'  => 'post-login',
    ]);
    //halaman logout
    Route::get('logout', [
        'uses'=> 'AuthenticationController@logout',
        'as'  => 'logout',
    ]);
});

//Menu-Utama
Route::group(['middleware'=>'auth'], function () {
    //halaman-Utama
    Route::get('/', [
        'uses'=> 'MainController@index',
        'as'  => 'dashboard',
    ]);
});

//menu nasabah
Route::group(['prefix' => 'nasabah', 'middleware'=>'auth'], function () {
    //halaman-nasabah
    Route::get('/', [
        'uses'=> 'NasabahController@index',
        'as'  => 'nasabah',
    ]);
    //ajax - data nasabah
    Route::get('data-nasabah', [
        'uses'=> 'NasabahController@getAllNasabah',
        'as'  => 'data-nasabah',
    ]);
    //ajax-tambah
    Route::post('tambah', [
        'uses' => 'NasabahController@tambah',
        'as'   => 'tambah-nasabah',
    ]);
});

//menu transaksi
Route::group(['prefix' => 'transaksi', 'middleware'=>'auth'], function () {
    //halamn utama
    Route::get('/', [
        'uses'=> 'TransaksiController@index',
        'as'  => 'transaksi',
    ]);
    Route::get('get-data-per-day', 'TransaksiController@getAllTransaksiPerDay');
    //pengambilan
    Route::post('/simpan', [
        'uses'=> 'TransaksiController@simpan',
        'as'  => 'simpan',
    ]);
    //Penyimpanan
    Route::post('/ambil', [
        'uses'=> 'TransaksiController@ambil',
        'as'  => 'ambil',
    ]);
});

//menu koperasi
Route::group(['prefix' => 'koperasi', 'middleware'=>'auth'], function () {
    //halaman-koprasi
    Route::get('/', [
        'uses'=> 'KoperasiController@index',
        'as'  => 'koperasi',
    ]);
    //data-koperasi
    Route::get('/data-koperasi', [
        'uses'=> 'KoperasiController@getAllKoperasi',
        'as'  => 'data-koperasi',
    ]);
    //tambah
    Route::post('/tambah', [
        'uses'=> 'KoperasiController@tambah',
        'as'  => 'tambah-koperasi',
    ]);
    //ubah
    Route::post('/ubah', [
        'uses'=> 'KoperasiController@ubah',
        'as'  => 'ubah-koperasi',
    ]);
    //hapus
    Route::post('/hapus', [
        'uses'=> 'KoperasiController@hapus',
        'as'  => 'hapus-koperasi',
    ]);
});

//menu pegawai
Route::group(['prefix' => 'pegawai', 'middleware'=>'auth'], function () {
    //halaman-koprasi
    Route::get('/', [
        'uses'=> 'PegawaiController@index',
        'as'  => 'pegawai',
    ]);
    //data-pegawai
    Route::get('/data-pegawai', [
        'uses'=> 'PegawaiController@getAllPegawai',
        'as'  => 'data-pegawai',
    ]);
    //tambah
    Route::post('/tambah', [
        'uses'=> 'PegawaiController@tambah',
        'as'  => 'tambah-pegawai',
    ]);
    //ubah
    Route::post('/ubah', [
        'uses'=> 'PegawaiController@ubah',
        'as'  => 'ubah-pegawai',
    ]);
    //hapus
    Route::post('/hapus', [
        'uses'=> 'PegawaiController@hapus',
        'as'  => 'hapus-pegawai',
    ]);
});

//menu laporan
Route::group(['prefix' => 'laporan', 'middleware'=>'auth'], function () {
    //Halaman-Laporan
    Route::get('/', [
        'uses'=> 'LaporanController@index',
        'as'  => 'laporan',
    ]);
});

Route::get('rfid', function () {
    //$data = null;
    $data = [
        'title'  => 'Success',
        'message'=> 'Selamat 10112671 ',
        'data'   => ['uid'=>'10112671', 'nama'=>'faisal', 'kartu'=>'GOLD'],
        ];
    if ($data) {
        return response()->json($data);
    } else {
        return response()->json([
            'errors' => 'RFID KOSONG',
            'message'=> 'SCAN KEMBALI',
        ], 400);
    }
});
