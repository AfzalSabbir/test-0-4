<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface AuthRepositoryInterface
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse;
}
