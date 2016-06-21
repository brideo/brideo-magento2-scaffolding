<?php

namespace Brideo\Magento2Scaffolding\Service\Base;

use Brideo\Magento2Scaffolding\Service\Base;

abstract class Block extends Base
{

    /**
     * Block constructor.
     *
     * @param string      $namespace
     * @param string      $module
     * @param string      $version
     * @param string|null $directory
     * @param string      $blockName
     */
    public function __construct(
        string $namespace,
        string $module,
        string $version = '1.0.0',
        string $directory = null,
        string $blockName
    ) {
        $this->data['block_name'] = $blockName;
        parent::__construct($namespace, $module, $version, $directory);
    }

    /**
     * Get the block directory.
     *
     * @return string
     */
    abstract protected function getBlockDirectory() : string;

    /**
     * Get the block template file.
     *
     * @return string
     */
    abstract protected function getBlockTemplate() : string;

    /**
     * Get any additional directories for the generation process;
     *
     * @return array
     */
    public function getAdditionalDirectories() : array
    {
        return [
            $this->getBlockDirectory()
        ];
    }

    /**
     * Get any additional files for the generation process;
     *
     * @return array
     */
    public function getAdditionalFiles() : array
    {
        return [
            $this->getBlockTemplate() => $this->getBlockFile()
        ];
    }

    /**
     * Get the block file name
     *
     * @return string
     */
    protected function getBlockFile() : string
    {
        return $this->getBlockDirectory() . DIRECTORY_SEPARATOR . $this->data['block_name'] . '.php';
    }
}
