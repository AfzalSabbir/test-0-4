<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthenticationController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            "name"     => "min:3",
            "email"    => "required|unique:users",
            "password" => "required",
        ]);
        $userBuilder = User::query();
        $user        = $userBuilder->where($request->only(['email']))->first();
        if ($user) {
            $response = ['message' => 'Email'];
        } else {

        }

        return response()->json([
            'message' => 'Logout successful!',
            'data'    => $user->makeVisible(['api_token'])
        ]);
    }

    public function login(Request $request)
    {
        $user = User::query()->where($request->only(['email', 'password']))->firstOrFail();
        if ($user) {
            $user->api_token = Str::random(64);
            $user->save();
        }

        return response()->json([
            'message' => 'Logout successful!',
            'data'    => $user->makeVisible(['api_token'])
        ]);
    }

    public function logout(Request $request)
    {
        $user            = User::query()->where($request->only(['api_token']))->firstOrFail();
        $user->api_token = null;
        $user->save();

        return response()->json(['message' => 'Logout successful!']);
    }
}
