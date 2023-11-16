<?php

declare(strict_types=1);

namespace Ambimax\File;

use Symfony\Component\Filesystem\Path;

class File implements FileInterface
{
    /**
     * @var resource
     */
    protected $fileHandle;

    public function __construct(
        protected string $filePath,
        protected FileMode $mode)
    {
        $this->openStream($filePath, $mode);
    }

    protected function openStream(string $filePath, FileMode $mode): void
    {
        if (
            in_array($mode, [
                FileMode::R,
                FileMode::R_PLUS,
            ], true) && !file_exists($filePath)
        ) {
            throw new \RuntimeException("File '$filePath' does not exist.");
        }

        $tmpFileHandle = fopen($filePath, $mode->value);
        if (false === $tmpFileHandle) {
            throw new \RuntimeException("Could not open file '$filePath'.");
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

    public function getFilenameWithoutExtension(): string
    {
        return pathinfo($this->getPath(), PATHINFO_FILENAME);
    }

    public function getExtension(): string
    {
        return pathinfo($this->getPath(), PATHINFO_EXTENSION);
    }

    public function __toString(): string
    {
        return $this->getPath();
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
        if (false === $pointerLocation) {
            throw new \RuntimeException('unable to get current location of the file pointer. exception thrown to prevent unpredictable pointer jumping');
        }
        rewind($this->fileHandle);

        $content = stream_get_contents($this->fileHandle);
        fseek($this->fileHandle, $pointerLocation);

        return $content;
    }

    /**
     * Changes relative path to an absolut path relative to the current file location.
     * This is to prevent confusion of e.g. rename() where the path would be relative to the php working directory.
     * If the path is already absolute or has a protocol defined the path won't be affected by this.
     *
     * If the path ends with the directory separator ("/") the current file name will get appended
     */
    protected function ensureAbsolutePath(string $path): string
    {
        if (
            true === Path::isLocal($path)
            && false === Path::isAbsolute($path)
        ) {
            $path = Path::join(dirname($this->filePath), $path);
        }

        if (DIRECTORY_SEPARATOR === $path[-1]) {
            $path = Path::join($path, $this->getBasename());
        }

        return $path;
    }

    public function rename(string $newPath): bool
    {
        $newPath = $this->ensureAbsolutePath($newPath);

        fclose($this->fileHandle);

        $success = rename($this->filePath, $newPath);
        $this->openStream($newPath, $this->mode);

        return $success;
    }

    public function move(string $newPath): bool
    {
        return $this->rename($newPath);
    }

    /**
     * @param int<0, max>|null $length
     */
    public function fwrite(string $data, int $length = null): int|false
    {
        return fwrite($this->fileHandle, $data, $length);
    }

    /**
     * @param int<0, max>|null $length
     */
    public function fread(int $length = null): string|false
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
