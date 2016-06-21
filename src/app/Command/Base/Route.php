<?php

namespace Brideo\Magento2Scaffolding\Command\Base;

use Brideo\Magento2Scaffolding\Command\AbstractCommand;
use Brideo\Magento2Scaffolding\Service\AdminhtmlRoute;
use Brideo\Magento2Scaffolding\Service\ServiceInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class Route extends AbstractCommand
{
    const FRONT_NAME = 'front_name';
    const FRONT_NAME_DESCRIPTION = 'The front name of the route';
    const ACTION_NAME = 'action_name';
    const ACTION_NAME_DESCRIPTION = 'The action name of the controller';

    /**
     * @return string
     */
    abstract protected function getCommandName() : string;

    /**
     * @return string
     */
    abstract protected function getCommandDescription() : string;

    /**
     * Return the service to generate.
     *
     * @param string $namespace
     * @param string $module
     * @param string $frontName
     * @param string $actionName
     * @param string $version
     * @param string $directory
     *
     * @return ServiceInterface
     */
    abstract protected function getService(
        string $namespace,
        string $module,
        string $frontName,
        string $actionName,
        string $version,
        string $directory
    ) : ServiceInterface;

    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this->getBaseCommand($this->getCommandName(),$this->getCommandDescription())
            ->addArgument(
                static::FRONT_NAME,
                InputArgument::REQUIRED,
                static::FRONT_NAME_DESCRIPTION
            )
            ->addArgument(
                static::ACTION_NAME,
                InputArgument::REQUIRED,
                static::ACTION_NAME_DESCRIPTION
            );

        $this->addDefaultOptionalArguments();
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $namespace = $input->getArgument(static::MODULE_NAMESPACE);
        $module = $input->getArgument(static::MODULE_NAME);
        $frontName = $input->getArgument(static::FRONT_NAME);
        $actionName = $input->getArgument(static::ACTION_NAME);
        $version = $this->getVersion($input);
        $directory = $this->getModuleDirectory($input);

        $service = $this->getService($namespace, $module, $frontName, $actionName, $version, $directory);
        $service->generate();
    }
}
