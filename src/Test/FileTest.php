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
        file_put_contents($this->root->url().'/test.txt', 'testContent');
        $this->readableFile = new File($this->root->url().'/test.txt', 'r');
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
        $this->assertEquals('test.txt', $this->readableFile->getBasename());
    }

    public function testGetContent(): void
    {
        $this->assertEquals('testContent', $this->readableFile->getContent());
    }

    public function testGetPath(): void
    {
        $this->assertEquals($this->root->url().'/test.txt', $this->readableFile->getPath());
    }    
    
    public function testGetExtension(): void
    {
        $this->assertEquals('txt', $this->readableFile->getExtension());
    }
    
    public function testGetFilenameWithoutExtension(): void
    {
        $this->assertEquals(
            'test',
            $this->readableFile->getFilenameWithoutExtension()
        );
    }

    public function testToString(): void
    {
        $this->assertEquals($this->root->url().'/test.txt', (string)$this->readableFile);
    }

    public function testGetFileHandle(): void
    {
        $this->assertIsResource($this->readableFile->getFileHandle());
        $this->assertIsNotClosedResource($this->readableFile->getFileHandle());
    }

    public function testRename(): void
    {
        $oldFileHandle = $this->readableFile->getFileHandle();

        $this->readableFile->rename('newtest');
        $this->assertSame($this->root->url().'/newtest', $this->readableFile->getPath());

        $newFileHandle = $this->readableFile->getFileHandle();
        $this->assertSame('testContent', stream_get_contents($newFileHandle));

        $this->assertIsClosedResource($oldFileHandle);
    }

    public function testMoveToDifferentFolderAbsolutePath(): void
    {
        $oldFileHandle = $this->readableFile->getFileHandle();

        mkdir($this->root->url().'/testFolder');
        $this->readableFile->rename($this->root->url().'/testFolder/');
        $this->assertSame($this->root->url().'/testFolder/test.txt', $this->readableFile->getPath());
        $this->assertFileExists($this->root->url().'/testFolder/test.txt');

        $this->readableFile->rename('../testFile.txt');
        $this->assertSame($this->root->url().'/testFile.txt', $this->readableFile->getPath());
        $this->assertFileExists($this->root->url().'/testFile.txt');

        $newFileHandle = $this->readableFile->getFileHandle();
        $this->assertSame('testContent', stream_get_contents($newFileHandle));

        $this->assertIsClosedResource($oldFileHandle);
    }
}
