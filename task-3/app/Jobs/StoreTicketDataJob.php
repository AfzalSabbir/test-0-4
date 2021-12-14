<?php

namespace App\Jobs;

use App\Models\Ticket;
use Exception;

class StoreTicketDataJob extends Job
{
    private $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Ticket::query()->create($this->data);
    }

    /**
     * @throws Exception
     */
    public function failed(Exception $e)
    {
        throw $e;
    }
}
