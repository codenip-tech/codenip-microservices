<?php

declare(strict_types=1);

namespace App\Controller;

use App\Http\DTO\RegisterRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class RegisterAction
{
    /**
     * @Route("api/register", methods={"POST"}, name="api_register")
     */
    public function __invoke(RegisterRequest $registerRequest): JsonResponse
    {
        return new JsonResponse();
    }
}
