<?php

namespace App\Listeners;

use App\Events\LogEvent;
use App\Models\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogListener
{
    /**
     * Handle the event.
     */
    public function handle(LogEvent $event): void
    {
        Log::create([
            'user_id' => $event->user_id,
            'action_id' => $event->action_id,
            'action' => $event->action,
        ]);
    }
}
