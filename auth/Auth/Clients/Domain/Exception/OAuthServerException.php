<?php

declare(strict_types=1);

namespace Auth\Clients\Domain\Exception;

use Exception;
use Throwable;

final class OAuthServerException extends Exception
{
    /**
     * @var string[]
     */
    private array $payload;

    /**
     * Throw a new exception.
     *
     * @param string $message Error message
     * @param int $code Error code
     * @param string $errorType Error type
     * @param int $httpStatusCode HTTP status code to send (default = 400)
     * @param null $hint A helper hint
     * @param Throwable|null $previous Previous exception
     */
    public function __construct(
        protected $message,
        protected $code,
        protected string $errorType,
        protected int $httpStatusCode = 400,
        protected mixed $hint = null,
        Throwable $previous = null
    )
    {
        parent::__construct($message, $code, $previous);
        $this->payload = [
            'error'             => $errorType,
            'error_description' => $message,
        ];
        if ($hint !== null) {
            $this->payload['hint'] = $hint;
        }
    }

    /**
     * @return array
     */
    public function getPayload(): array
    {
        return $this->payload;
    }

    /**
     * @return string
     */
    public function getErrorType(): string
    {
        return $this->errorType;
    }

    /**
     * @return int
     */
    public function getHttpStatusCode(): int
    {
        return $this->httpStatusCode;
    }

    /**
     * @return mixed
     */
    public function getHint(): mixed
    {
        return $this->hint;
    }

}