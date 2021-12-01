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
| セッション、CSRF対策、cookieの暗号化といった機能を提供する web ミドルウェアを経由する。
| stateless, RESTful APIといったアプリケーションを作るならこのファイルだけでルートを定義できる感じ。
*/

Route::get('/', function () {
    return view('welcome');
});
