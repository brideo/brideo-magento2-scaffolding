<?php

namespace Brideo\Magento2Scaffolding\Service\Setup;

use Brideo\Magento2Scaffolding\Service\Base;

class InstallSchema extends Base
{

    const DIRECTORY_SETUP = 'Setup';

    const FILE_INSTALL_SCHEMA = 'InstallSchema.php';

    const TEMPLATE_SETUP_SOURCE = 'src/Setup/InstallSchema.phtml';

    /**
     * Base constructor.
     *
     * @param string      $namespace
     * @param string      $module
     * @param array       $columns
     * @param string      $version
     * @param string|null $directory
     */
    public function __construct(
        string $namespace,
        string $module,
        array $columns,
        string $version = '1.0.0',
        string $directory = null
    ) {
        $this->data['columns'] = $columns;
        parent::__construct($namespace, $module, $version, $directory);
    }

    /**
     * Get any additional directories for the generation process;
     *
     * @return array
     */
    public function getAdditionalDirectories() : array
    {
        return [$this->getSetupDirectory()];
    }

    /**
     * Get any additional files for the generation process;
     *
     * @return array
     */
    public function getAdditionalFiles() : array
    {
        return [
            $this->getSetupTemplate() => $this->getSetupFile()
        ];
    }

    /**
     * Get the setup directory.
     *
     * @return string
     */
    protected function getSetupDirectory() : string
    {
        return $this->getSrcDirectory() . DIRECTORY_SEPARATOR . static::DIRECTORY_SETUP;
    }

    /**
     * Get the setup file.
     *
     * @return string
     */
    protected function getSetupFile() : string
    {
        return $this->getSetupDirectory(). DIRECTORY_SEPARATOR . static::FILE_INSTALL_SCHEMA;
    }

    /**
     * Get the setup template source.
     *
     * @return string
     */
    protected function getSetupTemplate() : string
    {
        return static::TEMPLATE_SETUP_SOURCE;
    }
}
