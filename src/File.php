<?php

declare(strict_types=1);

namespace Ambimax\File;

use RuntimeException;

class File implements FileInterface
{
    /**
     * @var resource
     */
    protected $fileHandle;

    protected string $filePath;

    public function __construct(string $filePath, string $mode)
    {
        $this->openStream($filePath, $mode);
        $this->filePath = $filePath;
    }

    protected function openStream(string $filePath, string $mode): void
    {
        if (!file_exists($filePath)) {
            throw new RuntimeException("File '$filePath' does not exist.");
        }

        $tmpFileHandle = fopen($filePath, $mode);
        if (false === $tmpFileHandle) {
            throw new RuntimeException("Could not open file '$filePath'.");
        }

        $this->fileHandle = $tmpFileHandle;
        $this->filePath = $filePath;
    }

    public function __destruct()
    {
        if (is_resource($this->fileHandle)) {
            fclose($this->fileHandle);
        }
    }

    public function getPath(): string
    {
        return $this->filePath;
    }

    public function getBasename(): string
    {
        return basename($this->filePath);
    }

    /**
     * @return false|string
     */
    public function getContent()
    {
        return stream_get_contents($this->fileHandle);
    }

    /**
     * @return resource
     */
    public function getFileHandle()
    {
        return $this->fileHandle;
    }
}
