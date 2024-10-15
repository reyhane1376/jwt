<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\JwtService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'errors' => $validator->errors()
            ], 401);
        }

        $credentials = $request->only('email', 'password');

        if(!Auth::attempt($credentials))
        {
            return response()->json([
                'errors' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();

        $jwtService = new JwtService();
        $token = $jwtService->generateToken();

        return response()->json(['token' => $token], 200);

    }
}
