<?php

namespace App\Http\Controllers;

use App\Jobs\StoreTicketDataJob;
use App\Models\Ticket;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Queue;

class StoreTicketDataController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $data            = $request->except('api_token');
        $data['user_id'] = Auth::user()->id;

        Queue::push(new StoreTicketDataJob($data));

        return response()->json(['message' => 'Success!']);
    }
}
