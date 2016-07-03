<?php

namespace Brideo\Magento2Scaffolding\Tests\Service;

use Brideo\Magento2Scaffolding\Service\Model;
use Brideo\Magento2Scaffolding\Service\ServiceInterface;

class ModelTest extends AbstractBaseTest
{

    /**
     * @var Model
     */
    protected $service;

    /**
     * Get the service class
     *
     * @return ServiceInterface|Model
     */
    protected function getService() : ServiceInterface
    {
        if(!$this->service) {
            $this->service = new Model('Brideo', 'Test','MyModel', true, '1.0.0', $this->getModuleDirectory());
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
