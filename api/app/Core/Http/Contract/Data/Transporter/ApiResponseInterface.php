<?php

declare(strict_types=1);

namespace App\Core\Http\Contract\Data\Transporter;

interface ApiResponseInterface
{
    public const string JSON_ITEMS = 'items';

    /**
     * @param int $statusCode
     *
     * @return static
     */
    public function statusCode(int $statusCode): static;
}
