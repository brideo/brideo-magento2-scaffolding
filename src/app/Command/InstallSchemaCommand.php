<?php

namespace Brideo\Magento2Scaffolding\Command;

use Brideo\Magento2Scaffolding\Helper\TypeMapping;

use Brideo\Magento2Scaffolding\Service\Setup\InstallSchema;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InstallSchemaCommand extends AbstractCommand
{
    const NAME = 'module:setup:install';
    const DESCRIPTION = 'Generate a setup install script';

    const TABLE_NAME = 'table_name';
    const TABLE_NAME_DESCRIPTION = 'The name of the table you would like to create';

    const COLUMN_NAMES = 'column_names';
    const COLUMN_NAMES_DESCRIPTION = 'The columns you would like to generate escaped in quotes: "name:string title:string content:text foreign_key:int"';

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


        $columns = $this->getColumnNamesToArray($input, $output);
        $schemaService = new InstallSchema($namespace, $module, $columns, $version, $directory);
        $schemaService->generate();
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return array
     */
    protected function getColumnNamesToArray(InputInterface $input, OutputInterface $output) : array
    {
        $columnsString = $input->getArgument(static::COLUMN_NAMES);
        if (!$columnsString) {
            return [];
        }

        $columns = array();
        parse_str(str_replace(':', '=', str_replace(' ', '&', $columnsString)), $columns);

        return $this->validateTypes($output, $columns);
    }

    /**
     * Validate the types
     *
     * @param OutputInterface $output
     * @param array           $columns
     *
     * @return array
     */
    protected function validateTypes(OutputInterface $output, array $columns)
    {
        $typeMapping = new TypeMapping();

        foreach ($columns as $tableName => $type) {
            if (!$newType = $typeMapping->getInput($type)) {
                $availableTypes = implode(", ", array_keys($typeMapping->getTypes()));
                $output->write("The type: '{$type}' doesn't exist. Available types are {$availableTypes} \n\n");
                $output->write("This could also be caused by a badly input.");
                exit;
            }

            $columns[$tableName] = $newType;
        }

        return $columns;
    }

}
