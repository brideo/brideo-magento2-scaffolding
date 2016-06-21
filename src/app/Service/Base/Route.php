<?php

namespace Brideo\Magento2Scaffolding\Service\Base;

use Brideo\Magento2Scaffolding\Service\Base;

abstract class Route extends Base
{

    const FILE_ROUTES = 'routes.xml';

    /**
     * Route constructor.
     *
     * @param string $namespace
     * @param string $module
     * @param string $frontName
     * @param string $actionName
     * @param string $version
     * @param string $directory
     */
    public function __construct(
        string $namespace,
        string $module,
        string $frontName,
        string $actionName,
        string $version,
        string $directory
    ) {
        $this->data['front_name'] = $frontName;
        $this->data['action_name'] = $actionName;

        parent::__construct($namespace, $module, $version, $directory);
    }

    /**
     * Get the area which applies.
     *
     * @return string
     */
    abstract public function getArea() : string;

    /**
     * Get the controller directory.
     *
     * @return string
     */
    abstract protected function getControllerDirectory() : string;

    /**
     * Get the controller directory.
     *
     * @return string
     */
    abstract protected function getControllerTestDirectory() : string;

    /**
     * Get the routes template.
     *
     * @return string
     */
    abstract protected function getRoutesTemplate() : string;

    /**
     * Get the controller template.
     *
     * @return string
     */
    abstract protected function getControllerTemplate() : string;

    /**
     * Get the layout template.
     *
     * @return string
     */
    abstract protected function getLayoutTemplate() : string;

    /**
     * Get the template template (dat naming convention).
     *
     * @return string
     */
    abstract protected function getTemplateTemplate() : string;

    /**
     * Get the controller test template.
     *
     * @return string
     */
    abstract protected function getControllerTestTemplate() : string;


    /**
     * Get any additional directories for the generation process;
     *
     * @return array
     */
    public function getAdditionalDirectories() : array
    {
        return [
            $this->getConfigAreaDirectory(),
            $this->getControllerDirectory(),
            $this->getControllerFrontnameDirectory(),
            $this->getLayoutDirectory(),
            $this->getTemplateDirectory(),
            $this->getControllerTestDirectory()
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
            $this->getRoutesTemplate()         => $this->getRoutesFile(),
            $this->getControllerTemplate()     => $this->getControllerFile(),
            $this->getLayoutTemplate()         => $this->getLayoutXmlFile(),
            $this->getTemplateTemplate()       => $this->getTemplateFile(),
            $this->getControllerTestTemplate() => $this->getControllerTestFile()
        ];
    }

    /**
     * Get the layout XML name
     *
     * @return string
     */
    public function getLayoutXmlName() : string
    {
        return strtolower($this->data['namespace'] . '_' . $this->data['module'] . '_' . $this->data['front_name'] . '_' . $this->data['action_name'] . '.xml');
    }


    protected function getTemplateDirectory() : string
    {
        return "src/view/{$this->getArea()}/templates/" . strtolower($this->data['front_name']);
    }

    /**
     * Get the config directory name.
     *
     * @return string
     */
    protected function getConfigAreaDirectory() : string
    {
        return "src/etc/{$this->getArea()}";
    }

    /**
     * Get the controller frontname directory.
     *
     * @return string
     */
    protected function getControllerFrontnameDirectory() : string
    {
        return $this->getControllerDirectory() . DIRECTORY_SEPARATOR . $this->data['front_name'];
    }

    /**
     * Get the layout directory name.
     *
     * @return string
     */
    protected function getLayoutDirectory() : string
    {
        return "src/view/{$this->getArea()}/layout";
    }

    /**
     * Get the `routes.xml` file.
     *
     * @return string
     */
    protected function getRoutesFile() : string
    {
        return $this->getConfigAreaDirectory() . DIRECTORY_SEPARATOR . static::FILE_ROUTES;
    }

    /**
     * Get the controller file based on the action name.
     *
     * @return string
     */
    protected function getControllerFile() : string
    {
        return $this->getControllerFrontnameDirectory() . DIRECTORY_SEPARATOR . $this->data['action_name'] . '.php';
    }

    /**
     * Get the layout xml file.
     *
     * @return string
     */
    protected function getLayoutXmlFile() : string
    {
        return $this->getLayoutDirectory() .DIRECTORY_SEPARATOR . $this->getLayoutXmlName();
    }

    /**
     * Get the template file name.
     *
     * @return string
     */
    protected function getTemplateFile() : string
    {
        return $this->getTemplateDirectory() . DIRECTORY_SEPARATOR . strtolower($this->data['action_name']) . '.phtml';
    }

    /**
     * Get the controller test file
     *
     * @return string
     */
    protected function getControllerTestFile() : string
    {
        return $this->getControllerTestDirectory() . DIRECTORY_SEPARATOR . $this->data['action_name'] . 'Test.php';
    }

}
