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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

// 入力画面へ遷移
Route::get('/input', 'InputController@input')->name('input')->middleware('auth');

// 出力画面へ遷移
Route::get('/output', 'OutputController@output')->name('output')->middleware('auth');

// ユーザー画面へ遷移
Route::get('/user', 'UserController@user')->name('user')->middleware('auth');

// 通貨ペア管理画面へ遷移
Route::get('/currency', 'CurrencyController@currency')->name('currency')->middleware('auth');

// 管理者ログイン画面（未設定）
Route::get('/admin/pages', 'TotallingController@totalling')->name('totalling')->middleware('auth');

// 入力データ書き込み
Route::post('/input_add', 'InputController@input_add')->name('input_add')->middleware('auth');

// ユーザー設定変更
Route::post('/user_change', 'UserController@user_change')->name('user_change')->middleware('auth');

// data_change
Route::post('/currency_change', 'CurrencyController@currency_change')->name('currency_change')->middleware('auth');

// 投稿情報変更
Route::post('/input_change/{id}', 'OutputController@input_change')->name('input_change')->middleware('auth');

// 投稿削除
Route::get('/data_delete/{id}', 'OutputController@delete');

// 投稿編集画面へ遷移
Route::get('/output_change/{id}', 'OutputController@change');

// 通貨非表示
Route::get('/currency_del/{id}', 'CurrencyController@delete');

// 通貨表示
Route::get('/currency_act/{id}', 'CurrencyController@active');

// 管理者ログイン
Route::prefix('admin')->group(function () {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login');
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::get('/', 'Auth\AdminController@index')->name('admin.index');
});

// ログアウト
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout'); 