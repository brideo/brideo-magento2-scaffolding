<?php

namespace Brideo\Magento2Scaffolding\Test\Service;

use Brideo\Magento2Scaffolding\Service\Observer;
use Brideo\Magento2Scaffolding\Service\ServiceInterface;

class ObserverTest extends AbstractBaseTest
{

    /**
     * @var Observer
     */
    protected $service;

    /**
     * Get the service class
     *
     * @return ServiceInterface|Observer
     */
    protected function getService() : ServiceInterface
    {
        if(!$this->service) {
            $this->service = new Observer('Brideo', 'Test','AddHandles','layout_load_before', '1.0.0', $this->getModuleDirectory());
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
