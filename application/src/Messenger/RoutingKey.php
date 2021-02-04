<?php

declare(strict_types=1);

namespace App\Messenger;

abstract class RoutingKey
{
    public const REGISTER_APPLICATION_QUEUE = 'register_application_queue';
    public const APPLICATION_MAILER_QUEUE = 'application_mailer_queue';
}
