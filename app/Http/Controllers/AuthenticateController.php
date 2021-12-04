<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthenticateController extends Controller {

    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'refresh', 'register']]);
    }

    protected function createNewToken($token) {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }

    /**
     * @OA\Post(
     *     path="/login",
     *     operationId="login",
     *     tags={"Authenticate"},
     *     summary="ログインを行う",
     *     description="リクエストをもとにログインを行う",
     *     @OA\Response(
     *         response=200,
     *         description="成功",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 description="メッセージ",
     *                 example="massage"
     *             )
     *         )
     *     )
     * )
     */
    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);
    }

    /**
     * @OA\Post(
     *     path="/logout",
     *     operationId="logout",
     *     tags={"Authenticate"},
     *     summary="ログアウトを行う",
     *     description="ログアウトを行う",
     *     @OA\Response(
     *         response=200,
     *         description="成功",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 description="メッセージ",
     *                 example="massage"
     *             )
     *         )
     *     )
     * )
     */
    public function logout() {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * @OA\Post(
     *     path="/refresh",
     *     operationId="refresh",
     *     tags={"Authenticate"},
     *     summary="トークンをリフレッシュする",
     *     description="トークンをリフレッシュする",
     *     @OA\Response(
     *         response=200,
     *         description="成功",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 description="メッセージ",
     *                 example="massage"
     *             )
     *         )
     *     )
     * )
     */
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }

    /**
     * @OA\Post(
     *     path="/register",
     *     operationId="register",
     *     tags={"Authenticate"},
     *     summary="アカウントを作成する",
     *     description="リクエストをもとにアカウントを作成する",
     *     @OA\Response(
     *         response=200,
     *         description="成功",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 description="メッセージ",
     *                 example="massage"
     *             )
     *         )
     *     )
     * )
     */
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create(
            array_marge(
                $validator->validated(),
                ['password' => bcrypt($request->password)]
            )
        );

        return response()->json([
            'message' => 'Successfully created user',
            'user' => $user
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/me",
     *     operationId="me",
     *     tags={"Authenticate"},
     *     summary="認証アカウント情報",
     *     description="認証したアカウントの認証情報用",
     *     @OA\Response(
     *         response=200,
     *         description="成功",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 description="メッセージ",
     *                 example="massage"
     *             )
     *         )
     *     )
     * )
     */
    public function me() {
        return response()->json(auth()->user());
    }
}