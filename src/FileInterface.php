<?php

declare(strict_types=1);

namespace Ambimax\File;

interface FileInterface
{
    /**
     * @return false|string
     */
    public function getContent();

    public function getPath(): string;

    public function getBasename(): string;

    /**
     * @return resource
     */
    public function getFileHandle();
}
