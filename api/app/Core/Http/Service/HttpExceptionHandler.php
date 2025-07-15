<?php

declare(strict_types=1);

namespace App\Core\Http\Service;

use Illuminate\Support\Facades\App;
use Illuminate\Validation\ValidationException;
use App\Core\Http\Data\Transporter\ApiResponse;
use Illuminate\Foundation\Configuration\Exceptions;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Core\Http\Contract\Data\Transporter\ApiResponseInterface;

final readonly class HttpExceptionHandler
{
    /**
     * @param \Illuminate\Foundation\Configuration\Exceptions $exceptions
     */
    public function __construct(
        private Exceptions $exceptions,
    ) {
    }

    public function register(): void
    {
        $this->exceptions->render(static fn (ValidationException $exception): ApiResponseInterface => new ApiResponse(
            [
                'message' => $exception->getMessage(),
                'errors' => $exception->errors(),
            ],
            422,
        ));

        $this->exceptions->render(static fn (HttpException $exception): ApiResponseInterface => new ApiResponse(
            [
                'message' => $exception->getMessage(),
            ],
            $exception->getStatusCode(),
            $exception->getHeaders(),
        ));

        $this->exceptions->renderable(static function (\Throwable $e): ApiResponse {
            $data = [
                'message' => $e->getMessage(),
            ];

            if (App::hasDebugModeEnabled()) {
                $data = [
                    ...$data,
                    'type' => $e::class,
                    'trace' => \array_map(
                        static fn (array $stackItem): array => [
                            'in' => (\str_replace(App::basePath() . '/', '', $stackItem['file'] ?? ''))
                                . ':' . ($stackItem['line'] ?? null),
                            'call' => ($stackItem['class'] ?? null) . ($stackItem['type'] ?? '/') . ($stackItem['function']),
                        ],
                        $e->getTrace()
                    ),
                ];
            }

            return new ApiResponse(
                $data,
                500,
            );
        });
    }
}
