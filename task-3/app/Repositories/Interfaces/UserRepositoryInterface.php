<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface UserRepositoryInterface
{
    /**
     * @return mixed
     */
    public function index(): JsonResponse;

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request);

    /**
     * @param $id
     * @return mixed
     */
    public function show($id): JsonResponse;

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);
}
