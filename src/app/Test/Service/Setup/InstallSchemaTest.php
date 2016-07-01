<?php

namespace Brideo\Magento2Scaffolding\Test\Service\Setup;

use Brideo\Magento2Scaffolding\Service\ServiceInterface;
use Brideo\Magento2Scaffolding\Service\Setup\InstallSchema;
use Brideo\Magento2Scaffolding\Test\Service\AbstractBaseTest;

class InstallSchemaTest extends AbstractBaseTest
{

    /**
     * @var InstallSchema
     */
    protected $service;

    /**
     * Get the service class
     *
     * @return ServiceInterface|InstallSchema
     */
    protected function getService() : ServiceInterface
    {
        if(!$this->service) {
            $array = [
                'name' => 'text',
                'title' => 'text',
                'content' => 'text',
                'foreign' => 'integer',
            ];

            $this->service = new InstallSchema('Brideo', 'Test', $array, '1.0.0', $this->getModuleDirectory());
        }

        return $this->service;
    }

    /**
     * Get all the files which should be created.
     *
     * @return array
     */
    protected function getFiles() : array
    {
        return $this->getService()->getFiles();
    }

    /**
     * Get all the directories which should be deleted.
     *
     * @return array
     */
    protected function getDirectories() : array
    {
        return $this->getService()->getDirectories();
    }

    /**
     * Get the module dir.
     *
     * @return string
     */
    protected function getModuleDirectory() : string
    {
        return '_files/tmp';
    }
}
