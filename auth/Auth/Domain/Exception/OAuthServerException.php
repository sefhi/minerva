<?php

declare(strict_types=1);

namespace Auth\Domain\Exception;

use Exception;
use Throwable;

use function htmlspecialchars;
use function sprintf;

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
     * Unsupported grant type error.
     *
     * @return static
     */
    public static function unsupportedGrantType() : self
    {
        $errorMessage = 'The authorization grant type is not supported by the authorization server.';
        $hint = 'Check that all required parameters have been provided';

        return new self($errorMessage, 2, 'unsupported_grant_type', 400, $hint);
    }

    /**
     * Invalid request error.
     *
     * @param string $parameter The invalid parameter
     * @param null $hint
     * @param Throwable|null $previous Previous exception
     *
     * @return static
     */
    public static function invalidRequest(string $parameter, $hint = null, Throwable $previous = null) : self
    {
        $errorMessage = 'The request is missing a required parameter, includes an invalid parameter value, ' .
            'includes a parameter more than once, or is otherwise malformed.';
        $hint = $hint ?? sprintf('Check the `%s` parameter', $parameter);

        return new self($errorMessage, 3, 'invalid_request', 400, $hint, null, $previous);
    }

    /**
     * Invalid client error.
     *
     * @return static
     */
    public static function invalidClient(): self
    {
        return new self('Client authentication failed', 4, 'invalid_client', 401);
    }

    /**
     * Invalid scope error.
     *
     * @param string $scope       The bad scope
     * @param string|null $redirectUri A HTTP URI to redirect the user back to
     *
     * @return static
     */
    public static function invalidScope(string $scope, string $redirectUri = null) : self
    {
        $errorMessage = 'The requested scope is invalid, unknown, or malformed';

        if (empty($scope)) {
            $hint = 'Specify a scope in the request or set a default scope';
        } else {
            $hint = sprintf(
                'Check the `%s` scope',
                htmlspecialchars($scope, ENT_QUOTES, 'UTF-8', false)
            );
        }

        return new self($errorMessage, 5, 'invalid_scope', 400, $hint, $redirectUri);
    }

    /**
     * Invalid credentials error.
     *
     * @return static
     */
    public static function invalidCredentials() : self
    {
        return new self('The user credentials were incorrect.', 6, 'invalid_grant', 400);
    }

    /**
     * Invalid refresh token.
     *
     * @param null $hint
     * @param Throwable|null $previous
     *
     * @return static
     */
    public static function invalidRefreshToken($hint = null, Throwable $previous = null) : self
    {
        return new self('The refresh token is invalid.', 8, 'invalid_request', 401, $hint, null, $previous);
    }

    /**
     * Access denied.
     *
     * @param null $hint
     * @param null $redirectUri
     * @param Throwable|null $previous
     *
     * @return static
     */
    public static function accessDenied($hint = null, $redirectUri = null, Throwable $previous = null) : self
    {
        return new self(
            'The resource owner or authorization server denied the request.',
            9,
            'access_denied',
            401,
            $hint,
            $redirectUri,
            $previous
        );
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