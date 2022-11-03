<?php

declare(strict_types=1);

namespace Ambimax\File;

interface FileInterface
{
    public function getPath(): string;

    public function getBasename(): string;

    /**
     * @return resource
     */
    public function getFileHandle();

    /**
     * @return false|string
     */
    public function getContent();

    public function rename(string $newPath): bool;

    public function fwrite(string $data, ?int $length = null): int|false;

    public function fread(?int $length = null): string|false;

    public function ftell(): int|false;

    public function fseek(int $offset, int $whence = SEEK_SET): int;
}
