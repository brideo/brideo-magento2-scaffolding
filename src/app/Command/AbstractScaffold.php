<?php

namespace Brideo\Magento2Scaffolding\Command;


use Brideo\Magento2Scaffolding\Helper\TypeMapping;
use Brideo\Magento2Scaffolding\Service\Adminhtml\TemplateBlock as AdminBlock;
use Brideo\Magento2Scaffolding\Service\Scaffold\Frontend\Route as FrontendRoute;
use Brideo\Magento2Scaffolding\Service\Adminhtml\Route as AdminRoute;
use Brideo\Magento2Scaffolding\Service\Scaffold\Frontend\TemplateBlock as FrontendBlock;
use Brideo\Magento2Scaffolding\Service\Model;
use Brideo\Magento2Scaffolding\Service\ResourceModel\Model as ResourceModel;
use Brideo\Magento2Scaffolding\Service\ResourceModel\Model\Collection;
use Brideo\Magento2Scaffolding\Service\Setup\InstallSchema;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class AbstractScaffold extends AbstractCommand
{

    const IS_RESOURCE = true;

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
     * @param string $tableName
     */
    protected function createResourceModel(
        string $namespace,
        string $module,
        string $className,
        string $version,
        string $directory,
        string $tableName = null
    )
    {
        $resourceModelService = new ResourceModel($namespace, $module, $className, $version, $directory, $tableName);
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
     * Create install schema
     *
     * @param string      $namespace
     * @param string      $module
     * @param array       $columns
     * @param string      $version
     * @param string|null $directory
     * @param string|null $tableName
     */
    protected function createInstallSchema(
        string $namespace,
        string $module,
        array $columns,
        string $version = '1.0.0',
        string $directory = null,
        string $tableName = null
    )
    {
        $schemaService = new InstallSchema($namespace, $module, $columns, $version, $directory, $tableName);
        $schemaService->generate();
    }

    /**
     * @param string      $namespace
     * @param string      $module
     * @param string      $version
     * @param string|null $directory
     * @param string      $blockName
     */
    protected function createBlocks(
        string $namespace,
        string $module,
        string $version = '1.0.0',
        string $directory = null,
        string $blockName
    )
    {
        $adminBlockService = new AdminBlock($namespace, $module, $version, $directory, $blockName);
        $adminBlockService->generate();

        $frontendBlockService = new FrontendBlock($namespace, $module, $version, $directory, $blockName);
        $frontendBlockService->generate();
    }

    /**
     * @param string      $namespace
     * @param string      $module
     * @param string      $frontName
     * @param string      $actionName
     * @param string      $version
     * @param string|null $directory
     */
    protected function createControllers(
        string $namespace,
        string $module,
        string $frontName,
        string $actionName,
        string $version = '1.0.0',
        string $directory = null
    )
    {
        $adminRoute = new AdminRoute($namespace, $module, $frontName, $actionName, $version, $directory);
        $adminRoute->setData('block_class', $namespace.'\\'.$module.'\\Block\\Adminhtml\\'.$frontName);
        $adminRoute->generate();

        $frontendRoute = new FrontendRoute($namespace, $module, $frontName, $actionName, $version, $directory);
        $frontendRoute->setData('block_class', $namespace.'\\'.$module.'\\Block\\'.$frontName);
        $frontendRoute->generate();
    }
}
