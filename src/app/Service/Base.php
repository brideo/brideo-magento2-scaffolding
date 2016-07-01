<?php

namespace Brideo\Magento2Scaffolding\Service;

use Brideo\Magento2Scaffolding\Block\File;
use Brideo\Magento2Scaffolding\Block\FileWrite;

abstract class Base implements ServiceInterface
{

    const DIRECTORY_SRC = 'src';
    const DIRECTORY_CONFIG = 'etc';
    const DIRECTORY_TEST = 'Test/Unit';
    const DIRECTORY_RESOURCE_MODEL = 'Model/ResourceModel';

    const FILE_COMPOSER = 'composer.json';
    const FILE_READ_ME = 'README.md';
    const FILE_REGISTRATION = 'registration.php';
    const FILE_MODULE_DEFINITION = 'module.xml';
    const FILE_MODULE_TEST_FILE = 'ModuleTest.php';

    const TEMPLATE_COMPOSER_SOURCE = 'composer.phtml';
    const TEMPLATE_READ_ME_SOURCE = 'README.phtml';
    const TEMPLATE_REGISTRATION_SOURCE = 'src/registration.phtml';
    const TEMPLATE_MODULE_DEFINITION_SOURCE = '/src/etc/module.phtml';
    const TEMPLATE_MODULE_TEST_FILE_SOURCE = 'src/Test/Unit/ModuleTest.phtml';

    /**
     * @var array
     */
    protected $directories;

    /**
     * @var array
     */
    protected $files;

    /**
     * @var array
     */
    protected $data = [];
    /**
     * @var string
     */
    private $directory;

    /**
     * Base constructor.
     *
     * @param string      $namespace
     * @param string      $module
     * @param string      $version
     * @param string|null $directory
     */
    public function __construct(
        string $namespace,
        string $module,
        string $version = '1.0.0',
        string $directory = null
    ) {
        $this->data['namespace'] = $namespace;
        $this->data['module'] = $module;
        $this->data['version'] = $version;
        $this->directory = $directory;

        $this->_construct();
    }

    /**
     * Helper function so you don't have to override the
     * main __construct all the time.
     *
     * Set the base files for module definition, you should
     * override these if you don't want a module to be defined
     * for some reason.
     *
     * @return $this
     */
    protected function _construct()
    {
        $this->setFiles([
            $this->getComposerTemplate()     => $this->getComposerFile(),
            $this->getReadMeTemplate()       => $this->getReadMeFile(),
            $this->getRegistrationTemplate() => $this->getRegistrationFile(),
            $this->getModuleTemplate()       => $this->getModuleDefinitionFile(),
            $this->getModuleTestTemplate()   => $this->getModuleTestFile()
        ]);

        $this->setDirectories([
            $this->getSrcDirectory(),
            $this->getConfigDirectory(),
            $this->getTestDirectory()
        ]);

        $this->addDirectories($this->getAdditionalDirectories());
        $this->addFiles($this->getAdditionalFiles());

        return $this;
    }

    /**
     * Get any additional directories for the generation process;
     *
     * @return array
     */
    abstract public function getAdditionalDirectories() : array;

    /**
     * Get any additional files for the generation process;
     *
     * @return array
     */
    abstract public function getAdditionalFiles() : array;

    /**
     * Generate the files for the current service
     *
     * @return $this
     */
    public function generate()
    {
        foreach ($this->directories as $directory) {
            if (file_exists($this->getModulePath($directory))) {
                continue;
            }

            mkdir($this->getModulePath($directory), 0755, true);
        }

        foreach ($this->files as $templateFile => $moduleFile) {
            $template = $this->getTemplatePath($templateFile);
            $contents = (new File($template, $this->data))->render();
            (new FileWrite($this->getModulePath($moduleFile), $contents))->write();
        }

        return $this;
    }

    /**
     * Allow data to be set.
     *
     * @param $key
     * @param $value
     */
    public function setData($key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * Get the template file path
     *
     * @param $file
     *
     * @return string
     */
    public function getTemplatePath(string $file) : string
    {
        return __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . $file;
    }

    /**
     * Get the module path.
     *
     * @param $file
     *
     * @return string
     */
    public function getModulePath(string $file) : string
    {
        if (!$this->directory) {
            return getcwd() . DIRECTORY_SEPARATOR . $file;
        }

        return getcwd() . DIRECTORY_SEPARATOR . $this->directory . DIRECTORY_SEPARATOR . $file;
    }

    /**
     * Add directories to the existing array.
     *
     * @param array $directories
     *
     * @return $this
     */
    public function addDirectories(array $directories)
    {
        $this->directories = array_merge($directories, $this->directories);

        return $this;
    }

    /**
     * Get the directories
     *
     * @return array
     */
    public function getDirectories() : array
    {
        return $this->directories;
    }

    /**
     * Set the directories.
     *
     * @param array $directories
     *
     * @return $this
     */
    public function setDirectories(array $directories)
    {
        $this->directories = $directories;

        return $this;
    }

    /**
     * Add some files to the array.
     *
     * @param array $files
     *
     * @return $this
     */
    public function addFiles(array $files)
    {
        $this->files = array_merge($files, $this->files);

        return $this;
    }

    /**
     * Get the files.
     *
     * @return array
     */
    public function getFiles() : array
    {
        return $this->files;
    }

    /**
     * Set the files.
     *
     * @param array $files
     *
     * @return $this
     */
    public function setFiles(array $files)
    {
        $this->files = $files;

        return $this;
    }

    /**
     * Get the src directory.
     *
     * @return string
     */
    protected function getSrcDirectory() : string
    {
        return static::DIRECTORY_SRC;
    }

    /**
     * Get the configuration directory.
     *
     * @return string
     */
    protected function getConfigDirectory() : string
    {
        return $this->getSrcDirectory() . DIRECTORY_SEPARATOR . static::DIRECTORY_CONFIG;
    }

    /**
     * Get the test directory
     *
     * @todo: build Test/Unit and Test/Integration
     *
     * @return string
     */
    protected function getTestDirectory() : string
    {
        return $this->getSrcDirectory() . DIRECTORY_SEPARATOR . static::DIRECTORY_TEST;
    }

    /**
     * Get the `composer.json` file.
     *
     * @return string
     */
    protected function getComposerFile() : string
    {
        return static::FILE_COMPOSER;
    }

    /**
     * Get the `README.md` file.
     *
     * @return string
     */
    protected function getReadMeFile() : string
    {
        return static::FILE_READ_ME;
    }

    /**
     * Get the `registration.php` file.
     *
     * @return string
     */
    protected function getRegistrationFile() : string
    {
        return $this->getSrcDirectory() . DIRECTORY_SEPARATOR . static::FILE_REGISTRATION;
    }

    /**
     * Get the `module.xml` file.
     *
     * @return string
     */
    protected function getModuleDefinitionFile() : string
    {
        return $this->getConfigDirectory() . DIRECTORY_SEPARATOR . static::FILE_MODULE_DEFINITION;
    }

    /**
     * Get the `ModuleTest.php` file.
     *
     * @return string
     */
    protected function getModuleTestFile() : string
    {
        return $this->getTestDirectory() . DIRECTORY_SEPARATOR . static::FILE_MODULE_TEST_FILE;
    }

    /**
     * Get the composer template source.
     *
     * @return string
     */
    protected function getComposerTemplate() : string
    {
        return static::TEMPLATE_COMPOSER_SOURCE;
    }

    /**
     * Get the read me template source.
     *
     * @return string
     */
    protected function getReadMeTemplate() : string
    {
        return static::TEMPLATE_READ_ME_SOURCE;
    }

    /**
     * Get the registration file template source.
     *
     * @return string
     */
    protected function getRegistrationTemplate() : string
    {
        return static::TEMPLATE_REGISTRATION_SOURCE;
    }

    /**
     * Get the module definition template source.
     *
     * @return string
     */
    protected function getModuleTemplate() : string
    {
        return static::TEMPLATE_MODULE_DEFINITION_SOURCE;
    }

    /**
     * Get the module test template source
     *
     * @return string
     */
    protected function getModuleTestTemplate() : string
    {
        return static::TEMPLATE_MODULE_TEST_FILE_SOURCE;
    }

    /**
     * Get the resource model directory.
     *
     * @return string
     */
    protected function getResourceModelDirectory() : string
    {
        return $this->getSrcDirectory() . DIRECTORY_SEPARATOR . static::DIRECTORY_RESOURCE_MODEL;
    }
}
