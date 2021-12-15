<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthRepository implements AuthRepositoryInterface
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        Validator::make($request->all(), [
            "name"     => "min:3",
            "email"    => "required|unique:users",
            "password" => "required",
        ]);

        $data             = $request->all();
        $data['password'] = Hash::make($data['password']);

        User::query()->create($data);

        return $this->login($request, true);
    }

    /**
     * @param Request $request
     * @param bool $register
     * @return JsonResponse
     */
    public function login(Request $request, bool $register = false): JsonResponse
    {
        $user = User::query()->where('email', $request->only('email'))->firstOrFail();

        if (Hash::check($request->password, $user->password)) {
            $user->api_token = Str::random(64);
            $user->save();

            $response = [
                'message' => ($register
                        ? 'Register'
                        : 'Login') . ' successful!',
                'data'    => $user->makeHidden('id')->makeVisible(['api_token'])
            ];
        } else {
            $response = [
                'message' => 'Wrong username or password',
                'data'    => []
            ];
        }

        return response()->json($response);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $user            = User::query()->where($request->only(['api_token']))->firstOrFail();
        $user->api_token = null;
        $user->save();

        return response()->json(['message' => 'Logout successful!']);
    }

}
