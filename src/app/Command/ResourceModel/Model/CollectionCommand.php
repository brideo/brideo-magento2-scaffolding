<?php

namespace Brideo\Magento2Scaffolding\Command\ResourceModel\Model;

use Brideo\Magento2Scaffolding\Command\AbstractCommand;
use Brideo\Magento2Scaffolding\Service\ResourceModel\Model\Collection;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CollectionCommand extends AbstractCommand
{
    const NAME = 'module:collection';
    const DESCRIPTION = 'Generate a collection.';

    const IS_RESOURCE = true;

    protected function configure()
    {
        $this->getBaseCommand(static::NAME, static::DESCRIPTION)
            ->addArgument(
                static::CLASS_NAME,
                InputArgument::REQUIRED,
                static::CLASS_DESCRIPTION
            );

        $this->addDefaultOptionalArguments();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        list($namespace, $module, $version, $directory) = $this->getBaseArguments($input);
        $className = $input->getArgument(static::CLASS_NAME);

        $collectionService = new Collection($namespace, $module, $className, $version, $directory);
        $collectionService->generate();
    }

}
