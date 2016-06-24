<?php

namespace Brideo\Magento2Scaffolding\Service;

/**
 * Class Model
 *
 * @package Brideo\Magento2Scaffolding\Service
 */
class Model extends Base
{

    const DIRECTORY_MODEL = 'Model';

    const TEMPLATE_MODEL_TEMPLATE_SOURCE = 'src/Model/Model.phtml';

    /**
     * Model constructor.
     *
     * @param string      $namespace
     * @param string      $module
     * @param string      $className
     * @param bool        $isResource
     * @param string      $version
     * @param string|null $directory
     */
    public function __construct(
        string $namespace,
        string $module,
        string $className,
        bool $isResource = false,
        string $version = '1.0.0',
        string $directory = null
    )
    {
        $this->data['class_name'] = $className;
        $this->data['is_resource'] = $isResource;
        parent::__construct($namespace, $module, $version, $directory);
    }

    /**
     * Get any additional directories for the generation process;
     *
     * @return array
     */
    public function getAdditionalDirectories() : array
    {
        return [$this->getModelDirectory()];
    }

    /**
     * Get any additional files for the generation process;
     *
     * @return array
     */
    public function getAdditionalFiles() : array
    {
        return [
            $this->getModelTemplate() => $this->getModelFile(),
        ];
    }

    /**
     * Get the observer directory.
     *
     * @return string
     */
    protected function getModelDirectory() : string
    {
        return $this->getSrcDirectory() . DIRECTORY_SEPARATOR . static::DIRECTORY_MODEL;
    }

    /**
     * Get the observer file.
     *
     * @return string
     */
    protected function getModelFile() : string
    {
        return $this->getModelDirectory(). DIRECTORY_SEPARATOR . $this->data['class_name'] .'.php';
    }


    /**
     * Get the observer Template Directory.
     *
     * @return string
     */
    protected function getModelTemplate() : string
    {
        return static::TEMPLATE_MODEL_TEMPLATE_SOURCE;
    }

}
