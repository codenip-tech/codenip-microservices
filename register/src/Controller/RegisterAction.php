<?php

declare(strict_types=1);

namespace App\Controller;

use App\Http\DTO\RegisterRequest;
use App\Service\RegisterActionService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class RegisterAction
{
    private RegisterActionService $registerActionService;

    public function __construct(RegisterActionService $registerActionService)
    {
        $this->registerActionService = $registerActionService;
    }

    /**
     * @Route("api/register", methods={"POST"}, name="api_register")
     */
    public function __invoke(RegisterRequest $registerRequest): JsonResponse
    {
        $this->registerActionService->__invoke($registerRequest->getName(), $registerRequest->getEmail());

        return new JsonResponse();
    }
}
