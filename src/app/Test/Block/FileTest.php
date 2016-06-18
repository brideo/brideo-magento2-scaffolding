<?php

namespace Brideo\Magento2Scaffolding\Test\Block;

use Brideo\Magento2Scaffolding\Block\File;
use PHPUnit_Framework_TestCase;

class FileTest extends PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function testTemplateRender()
    {
        $file = new File(__DIR__.'/_files/template.phtml', ['name' => 'Nathan McBride']);
        $this->assertEquals('hello world, my name is Nathan McBride', $file->render());
    }
}
