<?php

use App\Http\Controllers\HomeController;
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
    Route::get('/invoice', 'Backend\DashboardController@invoice');
    Route::resource('roznamchas', 'Backend\RoznamchaController', ['names' => 'admin.roznamchas']);
    Route::delete('/roznamchas/remove/{id}', 'Backend\RoznamchaController@destroy')->name('admin.roznamchas.remove');
    // Route::post('/admin/roznamchas/remove/{id}', [RoznamchasController::class,'remove'])->name('roznamchas.remove');
    Route::resource('khatas', 'Backend\KhataController', ['names' => 'admin.khatas']);
    
    Route::get('khata/personal/{id}', 'Backend\PersonalController@index')->name('admin.khata.personal.index'); 
 
    Route::resource('orders/kharlachi', 'Backend\KharlachiController', ['names' => 'admin.orders.kharlachi']);    
    Route::get('order/kharlachi/invoice/{id}','Backend\KharlachiController@invoice')->name('kharlachi.invoice');
    Route::post('order/kharlachi/selfexpense','Backend\KharlachiController@kselfexpense')->name('admin.order.kselfexpense');
    Route::put('order/kharlachi/selfexpense/{id}','Backend\KharlachiController@updatekselfexpense')->name('admin.order.updatekselfexpense');
    Route::put('order/kharlachi/self/{id}','Backend\KharlachiController@updatekself')->name('admin.order.updatekself');
    Route::post('order/kharlachi/self','Backend\KharlachiController@kself')->name('admin.order.kself');
    // Route::post('order/kharlachi/roznamcha','Backend\KharlachiController@roznamchask')->name('admin.order.roznamchask');
    Route::post('order/kharlachi/roznamcha','Backend\KharlachiController@roznamchask')->name('admin.order.roznamchask');
    Route::post('order/kharlachi/roznamcha','Backend\KharlachiController@updateroznamchask')->name('admin.order.updateroznamchask');
    Route::get('orders/kharlachi/{id}/destroy','Backend\KharlachiController@destroy')->name('admin.orders.kharlachi.destroy1');


    

    Route::resource('orders/ghulamkhan', 'Backend\GhulamkhanController', ['names' => 'admin.orders.ghulamkhan']);
    Route::get('order/ghulamkhan/invoice/{id}','Backend\GhulamkhanController@invoice')->name('ghulamkhan.invoice');
    Route::post('order/ghulamkhan/selfexpense','Backend\GhulamkhanController@gselfexpense')->name('admin.order.gselfexpense');
    Route::put('order/ghulamkhan/selfexpense/{id}','Backend\GhulamkhanController@updatekselfexpense')->name('admin.order.updategselfexpense');
    Route::put('order/ghulamkhan/self/{id}','Backend\GhulamkhanController@updatekself')->name('admin.order.updategself');
    Route::post('order/ghulamkhan/self','Backend\GhulamkhanController@gself')->name('admin.order.gself');
    Route::post('order/ghulamkhan/roznamcha','Backend\GhulamkhanController@roznamchasg')->name('admin.order.roznamchasg');
    Route::put('order/ghulamkhan/roznamcha/{id}','Backend\GhulamkhanController@updateroznamchasg')->name('admin.order.updateroznamchasg');

    Route::get('orders/ghulamkhan/{id}/destroy','Backend\GhulamkhanController@destroy')->name('admin.orders.ghulamkhan.destroy1');



    Route::resource('orders/thorkham', 'Backend\ThorkhamController', ['names' => 'admin.orders.thorkham']);
    Route::get('order/thorkham/invoice/{id}','Backend\ThorkhamController@invoice')->name('thorkham.invoice');
    Route::post('order/thorkham/selfexpense','Backend\ThorkhamController@tselfexpense')->name('admin.order.tselfexpense');
    Route::put('order/thorkham/selfexpense/{id}','Backend\ThorkhamController@updatekselfexpense')->name('admin.order.updatetselfexpense');
    Route::put('order/thorkham/self/{id}','Backend\ThorkhamController@updatekself')->name('admin.order.updatetself');
    Route::post('order/thorkham/self','Backend\ThorkhamController@tself')->name('admin.order.tself');
    Route::post('order/thorkham/roznamcha','Backend\ThorkhamController@roznamchast')->name('admin.order.roznamchast');
    Route::put('order/thorkham/roznamcha/{id}','Backend\ThorkhamController@updateroznamchast')->name('admin.order.updateroznamchast');
    Route::get('orders/thorkham/{id}/destroy','Backend\ThorkhamController@destroy')->name('admin.orders.thorkham.destroy1');


    Route::resource('orders/wana', 'Backend\WanaController', ['names' => 'admin.orders.wana']);
    Route::get('order/wana/invoice/{id}','Backend\WanaController@invoice')->name('wana.invoice');
    Route::post('order/wana/selfexpense','Backend\WanaController@wselfexpense')->name('admin.order.wselfexpense');
    Route::put('order/wana/selfexpense/{id}','Backend\WanaController@updatekselfexpense')->name('admin.order.updatewselfexpense');
    Route::put('order/wana/self/{id}','Backend\WanaController@updatekself')->name('admin.order.updatewself');
    Route::post('order/wana/self','Backend\WanaController@wself')->name('admin.order.wself');
    Route::post('order/wana/roznamcha','Backend\WanaController@roznamchast')->name('admin.order.roznamchasw');
    Route::put('order/wana/roznamcha/{id}','Backend\WanaController@updateroznamchast')->name('admin.order.updateroznamchasw');
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
