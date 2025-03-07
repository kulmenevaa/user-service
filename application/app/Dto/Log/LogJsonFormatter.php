<?php declare(strict_types=1);

namespace App\Dto\Log;

use Monolog\LogRecord;
use Monolog\Formatter\JsonFormatter;
use Illuminate\Support\Facades\Route;

class LogJsonFormatter extends JsonFormatter
{
    public function format(LogRecord $record): string
    {
        $log = $this->normalize($record)->toArray();

        if ($route = Route::currentRouteAction()) {
            $parseRoute = explode('@', $route);
            $controller = preg_replace('/.*\\\/', '', $parseRoute[0]);
            $method = isset($parseRoute[1]) ? "($parseRoute[1]) " : '';
            $log['message'] = "$controller $method| " . $log['message'];
        }

        $logModel = new LogMessage($log);
        return $this->toJson($logModel->transform(), true) . ($this->appendNewline ? "\n" : '');
    }
}
