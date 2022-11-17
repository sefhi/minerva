<?php

declare(strict_types=1);

namespace Auth\Domain\AccessToken;

abstract class CryptKey
{
    private const FILE_PREFIX = 'file://';

    protected function __construct(
        private string $keyPath,
        private readonly string $passPhrase = '',
        private bool $keyPermissionsCheck = true
    ) {
        if (!\str_starts_with($keyPath, self::FILE_PREFIX) && $this->isValidKey($keyPath, $this->passPhrase ?? '')) {
            $this->keyContents = $keyPath;
            $this->keyPath = '';
            // There's no file, so no need for permission check.
            $this->keyPermissionsCheck = false;
        } elseif (\is_file($keyPath)) {
            if (!\str_starts_with($keyPath, self::FILE_PREFIX)) {
                $keyPath = self::FILE_PREFIX.$keyPath;
            }

            if (!\is_readable($keyPath)) {
                throw new \LogicException(\sprintf('Key path "%s" does not exist or is not readable', $keyPath));
            }
            $this->keyContents = \file_get_contents($keyPath);
            $this->keyPath = $keyPath;
            if (!$this->isValidKey($this->keyContents, $this->passPhrase ?? '')) {
                throw new \LogicException('Unable to read key from file '.$keyPath);
            }
        } else {
            throw new \LogicException('Unable to read key from file '.$keyPath);
        }

        if (true === $this->keyPermissionsCheck) {
            // Verify the permissions of the key
            $keyPathPerms = \decoct(\fileperms($this->keyPath) & 0777);
            if (false === \in_array($keyPathPerms, ['400', '440', '600', '640', '660'], true)) {
                \trigger_error(
                    \sprintf(
                        'Key file "%s" permissions are not correct, recommend changing to 600 or 660 instead of %s',
                        $this->keyPath,
                        $keyPathPerms
                    ),
                    E_USER_NOTICE
                );
            }
        }
    }

    abstract public static function create(
        string $keyPath,
        string $passPhrase = '',
        bool $keyPermissionsCheck = true
    ): self;

    /**
     * Get key contents.
     *
     * @return string Key contents
     */
    public function getKeyContents(): string
    {
        return $this->keyContents;
    }

    /**
     * Validate key contents.
     */
    private function isValidKey(string $contents, string $passPhrase): bool
    {
        $pkey = \openssl_pkey_get_private($contents, $passPhrase) ?: \openssl_pkey_get_public($contents);
        if (false === $pkey) {
            return false;
        }
        $details = \openssl_pkey_get_details($pkey);

        return false !== $details && \in_array(
            $details['type'] ?? -1,
            [OPENSSL_KEYTYPE_RSA, OPENSSL_KEYTYPE_EC],
            true
        );
    }

    /**
     * Retrieve key path.
     */
    public function getKeyPath(): string
    {
        return $this->keyPath;
    }

    /**
     * Retrieve key pass phrase.
     */
    public function getPassPhrase(): ?string
    {
        return $this->passPhrase;
    }
}
