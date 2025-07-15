<?php

declare(strict_types=1);

namespace App\Core\Http\Data\Transporter;

use Illuminate\Http\JsonResponse;
use App\Core\Http\Contract\Data\Transporter\ApiResponseInterface;

final class ApiResponse extends JsonResponse implements ApiResponseInterface
{
    /**
     * @inheritDoc
     */
    public function statusCode(int $statusCode): static
    {
        $this->setStatusCode($statusCode);
        return $this;
    }
}
