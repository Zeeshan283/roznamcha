<?php

use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@redirectAdmin')->name('index');
Route::get('/home', 'HomeController@index')->name('home');

/**
 * Admin routes
 */
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'Backend\DashboardController@index')->name('admin.dashboard');
    Route::resource('roznamchas', 'Backend\RoznamchaController', ['names' => 'admin.roznamchas']);
    Route::delete('/roznamchas/remove/{id}', 'Backend\RoznamchaController@destroy')->name('admin.roznamchas.remove');
    // Route::post('/admin/roznamchas/remove/{id}', [RoznamchasController::class,'remove'])->name('roznamchas.remove');
    Route::resource('khatas', 'Backend\KhataController', ['names' => 'admin.khatas']);
    
    Route::get('khata/personal/{id}', 'Backend\PersonalController@index')->name('admin.khata.personal.index');  

    Route::resource('orders/kharlachi', 'Backend\KharlachiController', ['names' => 'admin.orders.kharlachi']);    
    Route::post('order/kharlachi','Backend\KharlachiController@selfdata')->name('admin.order.selfdata');
    Route::post('order/other_kharlachi','Backend\KharlachiController@other_expense')->name('admin.order.other_expense');
    Route::get('orders/kharlachi/{id}/destroy','Backend\KharlachiController@destroy')->name('admin.orders.kharlachi.destroy1');

    

    Route::resource('orders/ghulamkhan', 'Backend\GhulamkhanController', ['names' => 'admin.orders.ghulamkhan']);
    Route::post('order/ghulamkhan','Backend\GhulamkhanController@selfdata')->name('admin.order.gselfdata');
    Route::post('order/other_ghulamkhan','Backend\GhulamkhanController@other_expense')->name('admin.order.gother_expense');
    Route::get('orders/ghulamkhan/{id}/destroy','Backend\GhulamkhanController@destroy')->name('admin.orders.ghulamkhan.destroy1');



    Route::resource('orders/thorkham', 'Backend\ThorkhamController', ['names' => 'admin.orders.thorkham']);
    Route::post('order/thorkham','Backend\ThorkhamController@selfdata')->name('admin.order.tselfdata');
    Route::get('orders/thorkham/{id}/destroy','Backend\ThorkhamController@destroy')->name('admin.orders.thorkham.destroy1');



    Route::resource('orders/wana', 'Backend\WanaController', ['names' => 'admin.orders.wana']);
    Route::post('order/wana','Backend\WanaController@selfdata')->name('admin.order.wselfdata');
    Route::post('order/other_wana','Backend\WanaController@other_expense')->name('admin.order.wother_expense');
    Route::get('orders/wana/{id}/destroy','Backend\WanaController@destroy')->name('admin.orders.wana.destroy1');



    Route::resource('roles', 'Backend\RolesController', ['names' => 'admin.roles']);
    Route::resource('admins', 'Backend\AdminsController', ['names' => 'admin.admins']);




    // Login Routes
    Route::get('/login', 'Backend\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login/submit', 'Backend\Auth\LoginController@login')->name('admin.login.submit');

    // Logout Routes
    Route::post('/logout/submit', 'Backend\Auth\LoginController@logout')->name('admin.logout.submit');

    // Forget Password Routes
    Route::get('/password/reset', 'Backend\Auth\ForgetPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset/submit', 'Backend\Auth\ForgetPasswordController@reset')->name('admin.password.update');
});
