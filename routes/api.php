<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
| api ミドルウェアを経由し、ステートレス（状態を保持しないシステムやプログラムのことらしい）なルートである。
| なのでトークンを経由する認証や、セッションにアクセスする必要のないものがここを通る。
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
