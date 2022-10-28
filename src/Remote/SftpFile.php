<?php

declare(strict_types=1);

namespace Ambimax\File\Remote;

use Ambimax\File\File;
use phpseclib3\Net\SFTP\Stream;
use RuntimeException;

class SftpFile extends File
{
    protected string $hostname;
    protected string $username;
    protected string $password;

    public function __construct(string $hostname, string $username, string $password, string $filePath, string $mode)
    {
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        parent::__construct($filePath, $mode);
    }

    protected function openStream(string $filePath, string $mode): void
    {
        Stream::register();

        $tmpFileHandle = fopen(sprintf('sftp://%s:%s@%s:22/%s',
            $this->username,
            $this->password,
            $this->hostname,
            $filePath),
            $mode);

        if (false === $tmpFileHandle) {
            throw new RuntimeException(sprintf('Could not open file \'%s\'.', $filePath));
        }

        $this->fileHandle = $tmpFileHandle;
    }
}
