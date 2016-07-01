<?php

namespace Brideo\Magento2Scaffolding\Command;


use Brideo\Magento2Scaffolding\Service\Model;
use Brideo\Magento2Scaffolding\Service\ResourceModel\Model as ResourceModel;
use Brideo\Magento2Scaffolding\Service\ResourceModel\Model\Collection;
use Brideo\Magento2Scaffolding\Service\Setup\InstallSchema;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class AbstractScaffold extends AbstractCommand
{


    const TABLE_NAME = 'table_name';
    const TABLE_NAME_DESCRIPTION = 'The name of the table you would like to create';

    const COLUMN_NAMES = 'column_names';
    const COLUMN_NAMES_DESCRIPTION = 'The columns you would like to generate escaped in quotes: "name:string title:string content:text foreign_key:int"';

    /**
     * Create a resource model.
     *
     * @param string $namespace
     * @param string $module
     * @param string $className
     * @param string $version
     * @param string $directory
     */
    protected function createResourceModel(
        string $namespace,
        string $module,
        string $className,
        string $version,
        string $directory
    )
    {
        $resourceModelService = new ResourceModel($namespace, $module, $className, $version, $directory);
        $resourceModelService->generate();
    }

    /**
     * Create a collection.
     *
     * @param string $namespace
     * @param string $module
     * @param string $className
     * @param string $version
     * @param string $directory
     */
    protected function createCollection(
        string $namespace,
        string $module,
        string $className,
        string $version,
        string $directory
    )
    {
        $collectionService = new Collection($namespace, $module, $className, $version, $directory);
        $collectionService->generate();
    }

    /**
     * Create a model.
     *
     * @param string $namespace
     * @param string $module
     * @param string $className
     * @param string $version
     * @param string $directory
     */
    protected function createModel(
        string $namespace,
        string $module,
        string $className,
        string $version,
        string $directory
    )
    {
        $modelService = new Model($namespace, $module, $className, static::IS_RESOURCE, $version, $directory);
        $modelService->generate();
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

    /**
     * Create Install Schema.
     *
     * @param $namespace
     * @param $module
     * @param $columns
     * @param $version
     * @param $directory
     */
    protected function createInstallSchema($namespace, $module, $columns, $version, $directory)
    {
        $schemaService = new InstallSchema($namespace, $module, $columns, $version, $directory);
        $schemaService->generate();
    }
}
