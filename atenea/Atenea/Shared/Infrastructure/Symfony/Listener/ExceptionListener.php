<?php

declare(strict_types=1);

namespace Atenea\Shared\Infrastructure\Symfony\Listener;

use Atenea\Shared\Infrastructure\Exceptions\ExceptionsHttpStatusCodeMapping;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionListener
{
    public function __construct(private readonly ExceptionsHttpStatusCodeMapping $exceptionMapping)
    {
    }

    public function onException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        $event->setResponse(
            new JsonResponse(
                [
                    'error' => [
                        'message' => $exception->getMessage(),
                    ],
                ],
                $this->exceptionMapping->statusCodeFor(get_class($exception))
            )
        );
    }

//    private function exceptionCodeFor(\Throwable $error): string
//    {
//        $domainErrorClass = DomainError::class;
//
//        return $error instanceof $domainErrorClass
//            ? $error->errorCode()
//            : Utils::toSnakeCase(Utils::extractClassName($error));
//    }
}
