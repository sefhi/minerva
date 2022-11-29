<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Atenea\Shared\Infrastructure\Exceptions\ExceptionsHttpStatusCodeMapping;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use function Lambdish\Phunctional\each;

abstract class BaseController extends AbstractController
{
    public function __construct(ExceptionsHttpStatusCodeMapping $exceptionMapping)
    {
        each(
            fn (int $httpCode, string $exceptionClass) => $exceptionMapping->register($exceptionClass, $httpCode),
            $this->exceptions()
        );
    }

    abstract protected function exceptions(): array;
}
