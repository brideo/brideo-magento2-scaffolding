<?php

namespace Brideo\Magento2Scaffolding;

use Brideo\Magento2Scaffolding\Command\Frontend\TemplateBlockCommand as FrontendTemplateBlock;
use Brideo\Magento2Scaffolding\Command\Adminhtml\TemplateBlockCommand as AdminTemplateBlock;
use Brideo\Magento2Scaffolding\Command\GenerateCommand;
use Brideo\Magento2Scaffolding\Command\Adminhtml\RouteCommand as AdminRoute;
use Brideo\Magento2Scaffolding\Command\Frontend\RouteCommand as FrontendRoute;
use Brideo\Magento2Scaffolding\Command\ModelCommand;
use Brideo\Magento2Scaffolding\Command\ObserverCommand;
use Symfony\Component\Console\Application as SymfonyApplication;

class Application
{

    /**
     * @var SymfonyApplication
     */
    protected $application;

    /**
     * Application constructor.
     *
     * @param SymfonyApplication $application
     */
    public function __construct(SymfonyApplication $application = null)
    {
        $this->application = $application ?: new SymfonyApplication();
        $this->addCommandsToApplication();
    }

    /**
     * Run the application
     *
     * @throws \Exception
     */
    public function run()
    {
        $this->application->run();
    }

    /**
     * @return $this
     */
    protected function addCommandsToApplication()
    {
        $this->application->add(new GenerateCommand());
        $this->application->add(new AdminRoute());
        $this->application->add(new FrontendRoute());
        $this->application->add(new FrontendTemplateBlock());
        $this->application->add(new AdminTemplateBlock());
        $this->application->add(new ObserverCommand());
        $this->application->add(new ModelCommand());

        return $this;
    }
}
