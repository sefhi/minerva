<?php

declare(strict_types=1);

namespace Minerva\Posts\Infrastructure;

use Minerva\Shared\Domain\Exceptions\HttpClientException;

final class GuzzleHttpClientException extends HttpClientException
{
}