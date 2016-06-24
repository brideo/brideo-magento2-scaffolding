<?php

namespace Brideo\Magento2Scaffolding\Command;

use Brideo\Magento2Scaffolding\Service\Observer;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ObserverCommand extends AbstractCommand
{
    const NAME = 'module:observer';
    const DESCRIPTION = 'Generate an observer.';
    const CLASS_NAME = 'class_name';
    const CLASS_DESCRIPTION = 'The name of the class to generate.';
    const EVENT_NAME = 'event_name';
    const EVENT_DESCRIPTION = 'The name of the event to observe.';

    protected function configure()
    {
        $this->getBaseCommand(static::NAME, static::DESCRIPTION)
            ->addArgument(
                static::CLASS_NAME,
                InputArgument::REQUIRED,
                static::CLASS_DESCRIPTION
            )
            ->addArgument(
                static::EVENT_NAME,
                InputArgument::REQUIRED,
                static::EVENT_DESCRIPTION
            );

        $this->addDefaultOptionalArguments();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        list($namespace, $module, $version, $directory) = $this->getBaseArguments($input);
        $className = $input->getArgument(static::CLASS_NAME);
        $eventName = $input->getArgument(static::EVENT_NAME);

        $observerService = new Observer($namespace, $module,$className, $eventName, $version, $directory);
        $observerService->generate();
    }
}
