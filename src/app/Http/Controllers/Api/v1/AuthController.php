<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\User;
use App\DataTransferObjects\User\UserData;
use App\DataTransferObjects\User\UserLoginData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Actions\User\UpsertUserAction;
use App\Actions\User\GetByEmailUserAction;

class AuthController extends Controller
{
    public function register(UserData $data) {

        try {
            $user = UpsertUserAction::execute($data);

            $token = $user->createToken('auth_token')->plainTextToken;

            $cookie = cookie('token', $token, 60 * 24);

            return response()->json([
                'user' => $user->toArray(),
            ])->withCookie($cookie);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function login(UserLoginData $data) {
        try {

            if (Auth::attempt($data->toArray())) {

                $user = GetByEmailUserAction::execute($data->email);

                $token = $user->createToken('auth_token')->plainTextToken;

                $cookie = cookie('token', $token, 60 * 24);

                return response()->json([
                        'user' => $user->toArray(),
                    ])->withCookie($cookie);
            } else {
                return response()->json([
                    'message' => 'Email or password is incorrect!'
                ], 401);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }        
    }

    public function logout(Request $request) {

        try {

            $request->user()->currentAccessToken()->delete();

            $cookie = cookie()->forget('token');

            return response()->json([
                'message' => 'Logged out successfully!'
            ])->withCookie($cookie);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }     

    }

     public function user() {

        return response()->json(auth()->user());
    }

}
