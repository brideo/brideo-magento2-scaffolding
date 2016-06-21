<?php

namespace Brideo\Magento2Scaffolding\Test\Service\Frontend;

use Brideo\Magento2Scaffolding\Service\Frontend\Route;
use Brideo\Magento2Scaffolding\Service\ServiceInterface;
use Brideo\Magento2Scaffolding\Test\Service\AbstractBaseTest;

class RouteTest extends AbstractBaseTest
{

    /**
     * @var Route
     */
    protected $service;

    /**
     * Get the service class
     *
     * @return ServiceInterface|Route
     */
    protected function getService() : ServiceInterface
    {
        if(!$this->service) {
            $this->service = new Route('Brideo', 'Test', 'Frontname', 'Index', '1.0.0', $this->getModuleDirectory());
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
