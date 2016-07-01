<?php

namespace Brideo\Magento2Scaffolding\Command\ResourceModel\Model;

use Brideo\Magento2Scaffolding\Command\AbstractCommand;
use Brideo\Magento2Scaffolding\Command\AbstractScaffold;
use Brideo\Magento2Scaffolding\Service\Model;
use Brideo\Magento2Scaffolding\Service\ResourceModel\Model as ResourceModel;
use Brideo\Magento2Scaffolding\Service\ResourceModel\Model\Collection;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CollectionCommand extends AbstractScaffold
{
    const NAME = 'module:scaffold';
    const DESCRIPTION = 'Generate a collection, model, resource model and an install script.';

    const IS_RESOURCE = true;

    /**
     * Configure the command.
     *
     * @return void
     */
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

    /**
     * Execute the command.
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        list($namespace, $module, $version, $directory) = $this->getBaseArguments($input);
        $className = $input->getArgument(static::CLASS_NAME);

        $this->createModel($namespace, $module, $className, $version, $directory);
        $this->createResourceModel($namespace, $module, $className, $version, $directory);
        $this->createCollection($namespace, $module, $className, $version, $directory);
    }

}
