<?php

namespace App\Http\Controllers;

use App\Repositories\TicketRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StoreTicketDataController extends Controller
{
    /**
     * @var TicketRepository
     */
    private $ticketRepository;

    /**
     * @param TicketRepository $ticketRepository
     */
    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = new $ticketRepository();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        return $this->ticketRepository->store($request);
    }
}
