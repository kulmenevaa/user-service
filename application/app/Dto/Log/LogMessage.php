<?php declare(strict_types=1);

namespace App\Dto\Log;

class LogMessage
{
    private string $levelName;

    private int $level;

    private ?string $message;

    private ?array $context;

    private string $method;

    private string $path;

    private string $time;

    public function __construct(array $data)
    {
        $this->levelName = $data['level_name'];
        $this->level     = $data['level'];
        $this->message   = isset($data['message']) ? $data['message'] : null;
        $this->context   = isset($data['context']) ? $data['context'] : null;
        $this->method    = request()->getMethod();
        $this->path      = request()->getRequestUri();
        $this->time      = now()->toDateTimeString();
    }

    public function transform(): array
    {
        return [
            'log' => [
                'level' => $this->level,
                'levelName' => $this->levelName,
                'message' => $this->message,
                'event' => [
                    'method' => $this->method,
                    'path' => $this->path
                ],
                'context' => $this->context
            ],
            'time' => $this->time
        ];
    }
}

