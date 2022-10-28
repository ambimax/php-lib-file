<?php

namespace Ambimax\File\Test;

use Ambimax\File\File;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use PHPUnit\Framework\TestCase;

class FileTest extends TestCase
{
    public const TEST_PATH = '/tmp/unitTest';

    protected vfsStreamDirectory $root;

    protected File $readableFile;

    public function setUp(): void
    {
        $this->root = vfsStream::setup(self::TEST_PATH);
        file_put_contents($this->root->url().'/test', 'testContent');
        $this->readableFile = new File($this->root->url().'/test', 'r');
    }

    public function testConstruct(): void
    {
        $this->assertInstanceOf(File::class, $this->readableFile);
    }

    public function testDestruct(): void
    {
        $fileHandle = $this->readableFile->getFileHandle();
        $this->assertIsNotClosedResource($fileHandle);

        unset($this->readableFile);
        $this->assertIsClosedResource($fileHandle);
    }

    public function testGetBasename(): void
    {
        $this->assertEquals('test', $this->readableFile->getBasename());
    }

    public function testGetContent(): void
    {
        $this->assertEquals('testContent', $this->readableFile->getContent());
    }

    public function testGetPath(): void
    {
        $this->assertEquals($this->root->url().'/test', $this->readableFile->getPath());
    }

    public function testGetFileHandle(): void
    {
        $this->assertIsResource($this->readableFile->getFileHandle());
        $this->assertIsNotClosedResource($this->readableFile->getFileHandle());
    }
}
