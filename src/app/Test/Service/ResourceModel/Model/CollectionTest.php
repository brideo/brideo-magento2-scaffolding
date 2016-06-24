<?php

namespace Brideo\Magento2Scaffolding\Test\Service\ResourceModel\Model;

use Brideo\Magento2Scaffolding\Service\ResourceModel\Model\Collection;
use Brideo\Magento2Scaffolding\Service\ServiceInterface;
use Brideo\Magento2Scaffolding\Test\Service\AbstractBaseTest;

class CollectionTest extends AbstractBaseTest
{

    /**
     * @var Collection
     */
    protected $service;

    /**
     * Get the service class
     *
     * @return ServiceInterface|Collection
     */
    protected function getService() : ServiceInterface
    {
        if(!$this->service) {
            $this->service = new Collection('Brideo', 'Test','MyModel', '1.0.0', $this->getModuleDirectory());
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
