<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $user = User::query()->get();
        return response()->json($user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return bool|int
     */
    public function store(Request $request)
    {
        return User::query()->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $user = User::query()->find($id);
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return void
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return bool|int
     */
    public function update(Request $request, $id)
    {
        return User::query()->findOrFail($id)->update($request->except(['api_token']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return bool|mixed|null
     */
    public function destroy($id)
    {
        return User::query()->find($id)->delete();
    }
}
