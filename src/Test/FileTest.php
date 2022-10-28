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

    public function setUp(): void
    {
        $this->root = vfsStream::setup(self::TEST_PATH);
        file_put_contents($this->root->url().'/test', 'testContent');
    }

    public function testConstruct(): void
    {
        $file = new File($this->root->url().'/test', 'r');
        $this->assertInstanceOf(File::class, $file);
    }

    public function testDestruct(): void
    {
        $file = new File($this->root->url().'/test', 'r');

        $fileHandle = $file->getFileHandle();
        $this->assertIsNotClosedResource($fileHandle);

        unset($file);
        $this->assertIsClosedResource($fileHandle);
    }

    public function testGetBasename(): void
    {
        $file = new File($this->root->url().'/test', 'r');
        $this->assertEquals('test', $file->getBasename());
    }

    public function testGetContent(): void
    {
        $file = new File($this->root->url().'/test', 'r');
        $this->assertEquals('testContent', $file->getContent());
    }

    public function testGetPath(): void
    {
        $file = new File($this->root->url().'/test', 'r');
        $this->assertEquals($this->root->url().'/test', $file->getPath());
    }

    public function testGetFileHandle(): void
    {
        $file = new File($this->root->url().'/test', 'r');
        $this->assertIsResource($file->getFileHandle());
        $this->assertIsNotClosedResource($file->getFileHandle());
    }
}
