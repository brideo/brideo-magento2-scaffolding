<?php

namespace Brideo\Magento2Scaffolding\Command\Route;

use Brideo\Magento2Scaffolding\Command\AbstractCommand;
use Brideo\Magento2Scaffolding\Service\FrontendRoute;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FrontendCommand extends AbstractCommand
{

    const NAME = 'module:route:frontend';
    const DESCRIPTION = 'Generate a route for a module.';

    const FRONT_NAME = 'front_name';
    const FRONT_NAME_DESCRIPTION = 'The front name of the route';
    const ACTION_NAME = 'action_name';
    const ACTION_NAME_DESCRIPTION = 'The action name of the controller';

    protected function configure()
    {
        $this->getBaseCommand(static::NAME, static::DESCRIPTION)
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

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $namespace = $input->getArgument(static::MODULE_NAMESPACE);
        $module = $input->getArgument(static::MODULE_NAME);
        $frontName = $input->getArgument(static::FRONT_NAME);
        $actionName = $input->getArgument(static::ACTION_NAME);
        $version = $this->getVersion($input);
        $directory = $this->getModuleDirectory($input);

        $route = new FrontendRoute($namespace, $module, $frontName, $actionName, $version, $directory);
        $route->generate();
    }
}
