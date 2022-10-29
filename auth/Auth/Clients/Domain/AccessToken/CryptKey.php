<?php

declare(strict_types=1);

namespace Auth\Clients\Domain\AccessToken;

use LogicException;

use function decoct;
use function file_get_contents;
use function fileperms;
use function in_array;
use function is_file;
use function is_readable;
use function openssl_pkey_get_details;
use function openssl_pkey_get_private;
use function openssl_pkey_get_public;
use function sprintf;
use function str_starts_with;
use function trigger_error;

final class CryptKey
{

    private const FILE_PREFIX = 'file://';


    /**
     * @param string $keyPath
     * @param string $passPhrase
     * @param bool $keyPermissionsCheck
     */
    private function __construct(
        private string $keyPath,
        private readonly string $passPhrase = '',
        private bool $keyPermissionsCheck = true
    ) {
        if (!str_starts_with($keyPath, self::FILE_PREFIX) && $this->isValidKey($keyPath, $this->passPhrase ?? '')) {
            $this->keyContents = $keyPath;
            $this->keyPath = '';
            // There's no file, so no need for permission check.
            $this->keyPermissionsCheck = false;
        } elseif (is_file($keyPath)) {
            if (!str_starts_with($keyPath, self::FILE_PREFIX)) {
                $keyPath = self::FILE_PREFIX . $keyPath;
            }

            if (!is_readable($keyPath)) {
                throw new LogicException(sprintf('Key path "%s" does not exist or is not readable', $keyPath));
            }
            $this->keyContents = file_get_contents($keyPath);
            $this->keyPath = $keyPath;
            if (!$this->isValidKey($this->keyContents, $this->passPhrase ?? '')) {
                throw new LogicException('Unable to read key from file ' . $keyPath);
            }
        } else {
            throw new LogicException('Unable to read key from file ' . $keyPath);
        }

        if ($this->keyPermissionsCheck === true) {
            // Verify the permissions of the key
            $keyPathPerms = decoct(fileperms($this->keyPath) & 0777);
            if (in_array($keyPathPerms, ['400', '440', '600', '640', '660'], true) === false) {
                trigger_error(
                    sprintf(
                        'Key file "%s" permissions are not correct, recommend changing to 600 or 660 instead of %s',
                        $this->keyPath,
                        $keyPathPerms
                    ),
                    E_USER_NOTICE
                );
            }
        }
    }

    public static function create(
        string $keyPath,
        string $passPhrase = '',
        bool $keyPermissionsCheck = true
    ): self {
        return new self($keyPath, $passPhrase, $keyPermissionsCheck);
    }

    /**
     * Get key contents
     *
     * @return string Key contents
     */
    public function getKeyContents(): string
    {
        return $this->keyContents;
    }

    /**
     * Validate key contents.
     *
     * @param string $contents
     * @param string $passPhrase
     *
     * @return bool
     */
    private function isValidKey(string $contents, string $passPhrase): bool
    {
        $pkey = openssl_pkey_get_private($contents, $passPhrase) ?: openssl_pkey_get_public($contents);
        if ($pkey === false) {
            return false;
        }
        $details = openssl_pkey_get_details($pkey);

        return $details !== false && in_array(
                $details['type'] ?? -1,
                [OPENSSL_KEYTYPE_RSA, OPENSSL_KEYTYPE_EC],
                true
            );
    }

    /**
     * Retrieve key path.
     *
     * @return string
     */
    public function getKeyPath(): string
    {
        return $this->keyPath;
    }

    /**
     * Retrieve key pass phrase.
     *
     * @return null|string
     */
    public function getPassPhrase(): ?string
    {
        return $this->passPhrase;
    }
}
