<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $user = User::query()->get();
        return response()->json($user);
    }

    /**
     * @param Request $request
     * @return Builder|Model
     */
    public function store(Request $request)
    {
        return User::query()->create($request->all());
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $user = User::query()->find($id);
        return response()->json($user);
    }

    /**
     * @param Request $request
     * @param $id
     * @return bool|int
     */
    public function update(Request $request, $id)
    {
        return User::query()->findOrFail($id)->update($request->except(['api_token']));
    }

    /**
     * @param $id
     * @return bool|mixed|null
     */
    public function delete($id)
    {
        return User::query()->find($id)->delete();
    }
}
