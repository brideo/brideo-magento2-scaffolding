<?php

namespace Brideo\Magento2Scaffolding\Command\Setup;

use Brideo\Magento2Scaffolding\Command\AbstractScaffold;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InstallSchemaCommand extends AbstractScaffold
{
    const NAME = 'module:setup:install';
    const DESCRIPTION = 'Generate a setup install script';

    protected function configure()
    {
        $this->getBaseCommand(static::NAME, static::DESCRIPTION);
        $this->addArgument(
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

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        list($namespace, $module, $version, $directory) = $this->getBaseArguments($input);
        $tableName = $input->getArgument(static::TABLE_NAME);


        $columns = $this->getColumnNamesToArray($input, $output);
        $this->createInstallSchema($namespace, $module, $columns, $version, $directory, $tableName);
    }

}
