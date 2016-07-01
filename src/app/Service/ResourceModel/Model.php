<?php

namespace Brideo\Magento2Scaffolding\Service\ResourceModel;

use Brideo\Magento2Scaffolding\Service\Base;

/**
 * Class Model
 *
 * @package Brideo\Magento2Scaffolding\Service\ResourceModel
 */
class Model extends Base
{

    const TEMPLATE_RESOURCE_MODEL_TEMPLATE_SOURCE = 'src/Model/ResourceModel/Model.phtml';

    /**
     * Model constructor.
     *
     * @param string      $namespace
     * @param string      $module
     * @param string      $className
     * @param string      $version
     * @param string|null $directory
     * @param string      $tableName
     */
    public function __construct(
        string $namespace,
        string $module,
        string $className,
        string $version = '1.0.0',
        string $directory = null,
        string $tableName = null
    )
    {
        if($tableName) {
            $this->data['table_name'] = $tableName;
        }

        $this->data['class_name'] = $className;
        parent::__construct($namespace, $module, $version, $directory);
    }

    /**
     * Get any additional directories for the generation process;
     *
     * @return array
     */
    public function getAdditionalDirectories() : array
    {
        return [$this->getResourceModelDirectory()];
    }

    /**
     * Get any additional files for the generation process;
     *
     * @return array
     */
    public function getAdditionalFiles() : array
    {
        return [
            $this->getResourceModelTemplate() => $this->getResourceModelFile(),
        ];
    }

    /**
     * Get the resource model file.
     *
     * @return string
     */
    protected function getResourceModelFile() : string
    {
        return $this->getResourceModelDirectory(). DIRECTORY_SEPARATOR . $this->data['class_name'] .'.php';
    }


    /**
     * Get the resource model Template Directory.
     *
     * @return string
     */
    protected function getResourceModelTemplate() : string
    {
        return static::TEMPLATE_RESOURCE_MODEL_TEMPLATE_SOURCE;
    }

}
