<?php declare(strict_types=1);

namespace App\Listeners;

use Illuminate\Support\Facades\Log;

class LogResponseSending
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        if ($event->response->failed()) {
            $status = $event->response->status();
            Log::error("HTTP request returned status code $status. See context", [
                'request' => [
                    'method' => $event->request->method(),
                    'url' => $event->request->url(),
                    'data' => $event->request->data()
                ],
                'response' => [
                    'status' => $status,
                    'message' => $event->response->json()
                ]
            ]);
        }
    }
}
