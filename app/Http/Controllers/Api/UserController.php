<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends ApiController
{
    public function getToken(Request $request)
    {
        $request->validate([
            'name'     => 'required|min:1|max:255',
            'password' => 'required|min:6|max:255'
        ]);
        if (!$token = JWTAuth::attempt($request->all())) {
            return response(['error' => 'Account or password error.'], 400);
        }

        return $this->setAuthenticationHeader($token);
    }

    public function me(Request $request)
    {
        $user = $request->user();

        return $this->success($user);
    }

    protected function setAuthenticationHeader($token = null)
    {
        $token = $token ?: $this->auth->refresh();
        return response()->json(['success' => true], 200)->header('Authorization', 'Bearer ' . $token);//注意'Bearer '这里有一个空格

    }

}
