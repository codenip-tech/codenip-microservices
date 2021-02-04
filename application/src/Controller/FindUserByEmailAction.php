<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\FindUserByEmailActionService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class FindUserByEmailAction
{
    private FindUserByEmailActionService $findUserByEmailActionService;

    public function __construct(FindUserByEmailActionService $findUserByEmailActionService)
    {
        $this->findUserByEmailActionService = $findUserByEmailActionService;
    }

    /**
     * @Route("/api/internal/users", methods={"GET"}, name="api_internal_get_users")
     */
    public function __invoke(Request $request): JsonResponse
    {
        if (null === $email = $request->query->get('email')) {
            throw new BadRequestHttpException('Email param is mandatory');
        }

        if (null === $user = $this->findUserByEmailActionService->__invoke($email)) {
            throw new NotFoundHttpException(\sprintf('User with email %s not found', $email));
        }

        return new JsonResponse($user->toArray());
    }
}
