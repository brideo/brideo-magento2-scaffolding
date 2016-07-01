<?php

namespace Brideo\Magento2Scaffolding\Command;

use Brideo\Magento2Scaffolding\Command\AbstractCommand;
use Brideo\Magento2Scaffolding\Command\AbstractScaffold;
use Brideo\Magento2Scaffolding\Service\Model;
use Brideo\Magento2Scaffolding\Service\ResourceModel\Model as ResourceModel;
use Brideo\Magento2Scaffolding\Service\ResourceModel\Model\Collection;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ScaffoldCommand extends AbstractScaffold
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
            )
            ->addArgument(
                static::TABLE_NAME,
                InputArgument::REQUIRED,
                static::TABLE_NAME_DESCRIPTION
            );

        $this->addArgument(
            static::COLUMN_NAMES,
            InputArgument::OPTIONAL,
            static::COLUMN_NAMES_DESCRIPTION
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

        $tableName = $input->getArgument(static::TABLE_NAME);
        $className = $input->getArgument(static::CLASS_NAME);
        $columns = $this->getColumnNamesToArray($input, $output);

        $this->createModel($namespace, $module, $className, $version, $directory);
        $this->createResourceModel($namespace, $module, $className, $version, $directory, $tableName);
        $this->createCollection($namespace, $module, $className, $version, $directory);
        $this->createBlocks($namespace, $module, $version, $directory, $className);
        $this->createInstallSchema($namespace, $module, $columns, $version, $directory, $tableName);
        $this->createControllers($namespace, $module, $className, 'Index', $version, $directory);
    }

}
