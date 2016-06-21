<?php

namespace Brideo\Magento2Scaffolding\Test\Service;

use Brideo\Magento2Scaffolding\Service\ServiceInterface;
use PHPUnit_Framework_TestCase;

abstract class AbstractBaseTest extends PHPUnit_Framework_TestCase
{

    /**
     * Get the service class
     *
     * @return ServiceInterface
     */
    abstract protected function getService() : ServiceInterface;

    /**
     * Get all the files which should be created.
     *
     * @return array
     */
    abstract protected function getFiles() : array;

    /**
     * Get all the directories which should be deleted.
     *
     * @return array
     */
    abstract protected function getDirectories() : array;

    /**
     * Get the module dir.
     *
     * @return string
     */
    abstract protected function getModuleDirectory() : string;

    /**
     * Create all the files for the desired service.
     *
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();
        chdir(__DIR__);

        $this->getService()->generate();
    }

    /**
     * Delete all the files for the desired service.
     *
     * @inheritdoc
     */
    protected function tearDown()
    {
        parent::tearDown();

        $this->deleteTree($this->getModuleDirectory());
        $this->service = null;
    }

    /**
     * Test all the files exist
     *
     * @test
     */
    public function testFilesGenerated()
    {
        foreach($this->getFiles() as $file) {
            $this->assertFileExists($this->getModuleDirectory(). DIRECTORY_SEPARATOR .$file);
        }
    }

    /**
     * Delete the dir tree
     */
    protected function deleteTree($dir)
    {
        foreach (glob($dir . '/*') as $file) {
            if (is_dir($file)) {
                $this->deleteTree($file);
            } else {
                unlink($file);
            }
        }

        rmdir($dir);
    }
}
