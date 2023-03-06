<?php

namespace Ambimax\File\Remote;

use Ambimax\File\File;
use Ambimax\File\FileMode;

class FtpFile extends File
{
    public function __construct(
        protected readonly string $hostname,
        protected readonly ?string $username,
        protected readonly ?string $password,
        string $filePath,
        FileMode $mode,
        protected bool $overwrite = false,
    ) {
        $ftpFilePath = 'ftp://';
        if (!(is_null($this->username) || is_null($this->password))) {
            $ftpFilePath .= "{$this->username}:{$this->password}@";
        }
        $ftpFilePath .= "{$this->hostname}/{$filePath}";

        parent::__construct($ftpFilePath, $mode);
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

        $context = stream_context_create(['ftp' => ['overwrite' => $this->overwrite]]);
        $tmpFileHandle = fopen($filePath, $mode->value, context: $context);
        if (false === $tmpFileHandle) {
            throw new \RuntimeException("Could not open file '$filePath'.");
        }

        $this->fileHandle = $tmpFileHandle;
        $this->filePath = $filePath;
        $this->mode = $mode;
    }

    /*
     * The file won't be opened after renaming it since FTP isn't able to write a file without deleting its previous content
     */
    public function rename(string $newPath): bool
    {
        $newPath = $this->ensureAbsolutePath($newPath);

        fclose($this->fileHandle);

        $success = rename($this->filePath, $newPath);

        return $success;
    }

    /**
     * @return false|string
     */
    public function getContent(): bool|string
    {
        $pointerLocation = ftell($this->fileHandle);
        if (false === $pointerLocation) {
            throw new \RuntimeException('unable to get current location of the file pointer. exception thrown to prevent unpredictable pointer jumping');
        }

        $this->openStream($this->filePath, $this->mode);

        $content = stream_get_contents($this->fileHandle);

        $this->openStream($this->filePath, $this->mode);

        if ($pointerLocation > 0) {
            $this->fread($pointerLocation);
        }

        return $content;
    }
}
