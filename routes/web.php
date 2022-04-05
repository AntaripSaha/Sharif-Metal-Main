<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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

// Cache Clear Route
Route::get('/cache', function (){
   Artisan::call('vendor:publish --tag=laravel-errors');
//   Artisan::call('migrate');
   return "Success";
});


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/db-download', function () {
    $username = "sharifmetalbd_sharifmetal";
    $password = "sharifmetalbd_sharifmetal";
    $db_name = "sharifmetalbd_sharifmetal";
    $name = 'export_'.time().'.sql';
    $upload_path = public_path('database/');
    $full_path = $upload_path.$name;
    exec("mysqldump -u$username -p$password $db_name > $full_path");
    return back();
});

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');
Route::get('country-code/{country_code}','BaseController@ajaxGetCountryCode')->name('ajaxGetCountryCode');
Route::get('/dashboard/db-download','HomeController@createDbBackup')->name('db.download');
