<?php

namespace Brideo\Magento2Scaffolding\Service;

use Brideo\Magento2Scaffolding\Block\File;
use Brideo\Magento2Scaffolding\Block\FileWrite;

abstract class Base
{

    protected $directories = [
        'src',
        'src/etc',
        'src/Test/Unit'
    ];

    protected $files = [
        'composer.phtml' => 'composer.json',
        'README.phtml' => 'README.md',
        'src/registration.phtml' => 'src/registration.php',
        'src/etc/module.phtml' => 'src/etc/module.xml',
        'src/Test/Unit/ModuleTest.phtml' => 'src/Test/Unit/ModuleTest.php'
    ];

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
     * @param             $namespace
     * @param             $module
     * @param string      $version
     * @param string|bool $directory
     */
    public function __construct($namespace, $module, $version = '1.0.0', $directory = false)
    {
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
     * @return void
     */
    protected function _construct()
    {
    }

    public function generate()
    {
        foreach ($this->directories as $directory) {
            if (!file_exists($this->getModulePath($directory))) {
                mkdir($this->getModulePath($directory), 0755, true);
            }
        }

        foreach ($this->files as $templateFile => $moduleFile) {
            $template = $this->getTemplatePath($templateFile);
            $contents = (new File($template, $this->data))->render();
            (new FileWrite($this->getModulePath($moduleFile), $contents))->write();
        }
    }

    /**
     * Get the template file path
     *
     * @param $file
     *
     * @return string
     */
    public function getTemplatePath($file)
    {

        return __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . $file;
    }

    /**
     * @param $file
     *
     * @return string
     */
    public function getModulePath($file)
    {
        if(!$this->directory) {
            return getcwd() . DIRECTORY_SEPARATOR . $file;
        }

        return getcwd() . DIRECTORY_SEPARATOR . $this->directory . DIRECTORY_SEPARATOR . $file;
    }
}
