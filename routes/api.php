<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticateController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// API Test
Route::get('/test', function () {
    return 'hello, api';
});

// http://localhost/api/auth
Route::group([
    'middleware' => 'api', 'prefix' => 'auth'
], function ($router) {
    // ログイン処理
    Route::post('/login', [AuthenticateController::class, 'login']);
    // アカウント作成処理
    Route::post('/register', [AuthenticateController::class, 'register']);
    // ログアウト処理
    Route::post('/logout', [AuthenticateController::class, 'logout']);
    //リフレッシュトークンの再発行
    Route::post('/refresh', [AuthenticateController::class, 'refresh']);
    // ログインユーザ情報取得
    Route::get('/me', [AuthenticateController::class, 'me']);
});
