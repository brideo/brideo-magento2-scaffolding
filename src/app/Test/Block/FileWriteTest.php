<?php

namespace Brideo\Magento2Scaffolding\Test\Block;

use Brideo\Magento2Scaffolding\Block\FileWrite;
use PHPUnit_Framework_TestCase;

class FileWriteTest extends PHPUnit_Framework_TestCase
{

    protected $fileName;

    protected function setUp()
    {
        parent::setUp();

        $this->fileName = __DIR__.'/_files/tmp_file.phtml';
    }

    protected function tearDown()
    {
        parent::tearDown();
        unlink($this->fileName);
    }

    /**
     * @test
     */
    public function testFileCreation()
    {
        $fileWrite = new FileWrite($this->fileName, 'Hello world, my name is Nathan McBride');
        $fileWrite->write();
        $this->assertEquals('Hello world, my name is Nathan McBride', file_get_contents($this->fileName));
    }
}
