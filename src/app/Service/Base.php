<?php

namespace Brideo\Magento2Scaffolding\Service;

use Brideo\Magento2Scaffolding\Block\File;
use Brideo\Magento2Scaffolding\Block\FileWrite;

abstract class Base
{

    protected $directories = [
        'etc'
    ];

    protected $files = [
        'composer.json',
        'README.md',
        'registration.php',
        'etc/module.xml'
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

        foreach ($this->files as $file) {
            $template = $this->getTemplatePath($this->replaceFileExtension($file, 'phtml'));
            $contents = (new File($template, $this->data))->render();
            (new FileWrite($this->getModulePath($file), $contents))->write();
        }
    }

    /**
     * Replace a file extension.
     *
     * @param $file
     * @param $newExtension
     *
     * @return string
     */
    protected function replaceFileExtension($file, $newExtension)
    {
        $info = pathinfo($file);
        return $info['dirname'] . DIRECTORY_SEPARATOR . $info['filename'] . '.' . $newExtension;
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
