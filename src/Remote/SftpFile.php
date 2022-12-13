<?php

declare(strict_types=1);

namespace Ambimax\File\Remote;

use Ambimax\File\File;
use Ambimax\File\FileMode;
use phpseclib3\Net\SFTP;
use phpseclib3\Net\SFTP\Stream;

class SftpFile extends File
{
    protected string $hostname;
    protected string $username;
    protected string $password;
    protected SFTP $sftp;

    public function __construct(string $hostname, string $username, string $password, string $filePath, FileMode $mode)
    {
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->sftp = new SFTP($hostname);
        $this->sftp->login($username, $password);
        parent::__construct($filePath, $mode);
    }

    protected function openStream(string $filePath, FileMode $mode): void
    {
        Stream::register();

        parent::openStream(
            sprintf(
                'sftp://%s:%s@%s:22/%s',
                $this->username,
                $this->password,
                $this->hostname,
                $filePath
            ),
            $mode
        );
    }

    public function rename(string $newPath): bool
    {
        $newPath = $this->ensureAbsolutePath($newPath);

        fclose($this->fileHandle);

        $success = $this->sftp->rename($this->filePath, $newPath);
        $this->openStream($newPath, $this->mode);

        return $success;
    }
}
