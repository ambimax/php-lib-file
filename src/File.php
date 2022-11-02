<?php

declare(strict_types=1);

namespace Ambimax\File;

use RuntimeException;

class File implements FileInterface
{
    public const MODE_READ = 'r';
    public const MODE_READ_PLUS = 'r+';
    public const MODE_WRITE = 'w';
    public const MODE_WRITE_PLUS = 'w+';
    /**
     * @var resource
     */
    protected $fileHandle;

    protected string $filePath;
    protected string $mode;

    /**
     * @param self::MODE_* $mode
     */
    public function __construct(string $filePath, string $mode)
    {
        $this->openStream($filePath, $mode);
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
        $this->mode = $mode;
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
     * @return resource
     */
    public function getFileHandle()
    {
        return $this->fileHandle;
    }

    /**
     * @return false|string
     */
    public function getContent()
    {
        $pointerLocation = ftell($this->fileHandle);
        if (!$pointerLocation){
            throw new RuntimeException("unable to get current location of the file pointer. exception thrown to prevent unpredictable pointer jumping");
        }
        rewind($this->fileHandle);

        $content = stream_get_contents($this->fileHandle);
        fseek($this->fileHandle, $pointerLocation);

        return $content;
    }

    public function rename(string $newPath): bool
    {
        if ('/' !== $newPath[0]) {
            $newPath = dirname($this->filePath).'/'.$newPath;
        }

        fclose($this->fileHandle);

        $success = rename($this->filePath, $newPath);
        $this->openStream($newPath, $this->mode);

        return $success;
    }

    /**
     * @param int<0, max>|null $length
     */
    public function fwrite(string $data, ?int $length = null): int|false
    {
        return fwrite($this->fileHandle, $data, $length);
    }

    public function fread(?int $length = null): string|false
    {
        return fread($this->fileHandle, $length);
    }

    public function ftell(): int|false
    {
        return ftell($this->fileHandle);
    }

    public function fseek(int $offset, int $whence = SEEK_SET): int
    {
        return fseek($this->fileHandle, $offset, $whence);
    }
}
