<?php

namespace Brideo\Magento2Scaffolding\Tests\Service\Adminhtml;

use Brideo\Magento2Scaffolding\Service\Adminhtml\TemplateBlock;
use Brideo\Magento2Scaffolding\Service\ServiceInterface;
use Brideo\Magento2Scaffolding\Tests\Service\AbstractBaseTest;

class TemplateBlockTest extends AbstractBaseTest
{

    /**
     * @var TemplateBlock
     */
    protected $service;

    /**
     * Get the service class
     *
     * @return ServiceInterface|TemplateBlock
     */
    protected function getService() : ServiceInterface
    {
        if(!$this->service) {
            $this->service = new TemplateBlock('Brideo', 'Test', '1.0.0', $this->getModuleDirectory(), 'SomeBlock');
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
