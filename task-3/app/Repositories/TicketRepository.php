<?php

namespace App\Repositories;

use App\Jobs\StoreTicketDataJob;
use App\Repositories\Interfaces\TicketRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Queue;

class TicketRepository implements TicketRepositoryInterface
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $user_id = Auth::user()->id;
        $tickets = $request->json()->all();

        if ($tickets[0] ?? false) {
            foreach ($tickets as $ticket) {
                $ticket['user_id'] = $user_id;
                Queue::push(new StoreTicketDataJob($ticket));
            }
        } else {
            $tickets['user_id'] = $user_id;
            Queue::push(new StoreTicketDataJob($tickets));
        }

        return response()->json(['message' => 'Success!']);
    }
}
