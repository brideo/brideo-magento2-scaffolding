<?php

namespace Brideo\Magento2Scaffolding\Service\ResourceModel\Model;

use Brideo\Magento2Scaffolding\Service\Base;

/**
 * Class Collection
 *
 * @package  Brideo\Magento2Scaffolding\Service\ResourceModel\Model
 */
class Collection extends Base
{

    const FILE_COLLECTION = 'Collection.php';

    const TEMPLATE_COLLECTION_TEMPLATE_SOURCE = 'src/Model/ResourceModel/Model/Collection.phtml';

    /**
     * Model constructor.
     *
     * @param string      $namespace
     * @param string      $module
     * @param string      $className
     * @param string      $version
     * @param string|null $directory
     */
    public function __construct(
        string $namespace,
        string $module,
        string $className,
        string $version = '1.0.0',
        string $directory = null
    )
    {
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
        return [$this->getCollectionDirectory()];
    }

    /**
     * Get any additional files for the generation process.
     *
     * @return array
     */
    public function getAdditionalFiles() : array
    {
        return [
            $this->getCollectionTemplate() => $this->getCollectionFile(),
        ];
    }

    /**
     * Get the collection directory.
     *
     * @return string
     */
    protected function getCollectionDirectory() : string
    {
        return $this->getCollectionFile() . DIRECTORY_SEPARATOR . $this->data['class_name'];
    }

    /**
     * Get the collection file.
     *
     * @return string
     */
    protected function getCollectionFile() : string
    {
        return $this->getResourceModelDirectory(). DIRECTORY_SEPARATOR . static::FILE_COLLECTION;
    }


    /**
     * Get the collection template file.
     *
     * @return string
     */
    protected function getCollectionTemplate() : string
    {
        return static::TEMPLATE_COLLECTION_TEMPLATE_SOURCE;
    }

}
