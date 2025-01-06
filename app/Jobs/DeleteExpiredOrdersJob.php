<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class DeleteExpiredOrdersJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        /**
         * Delete all pending orders that are older than 30 days.
         */
        Order::where('created_at', '<', now()->subDays(30))
            ->where('status', 'pending')
            ->delete();
            
    }
}
