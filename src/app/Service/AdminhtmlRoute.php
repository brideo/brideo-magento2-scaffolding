<?php

namespace Brideo\Magento2Scaffolding\Service;

class AdminhtmlRoute extends Base
{

    public function __construct($namespace, $module, $frontName, $actionName, $version, $directory)
    {
        $this->data['front_name'] = $frontName;
        $this->data['action_name'] = $actionName;

        parent::__construct($namespace, $module, $version, $directory);
    }

    protected function _construct()
    {
        parent::_construct();
        $directories = [
            'src/etc/adminhtml',
            'src/Controller/Adminhtml',
            $this->getControllerDirectoryName(),
            'src/view/adminhtml/layout',
            $this->getTemplateDirectory(),
            'src/Test/Controller/Adminhtml',
            $this->getControllerTestDirectoryName()
        ];

        $files = [
            'src/etc/acl.phtml' => 'src/etc/acl.xml',
            'src/etc/adminhtml/routes.phtml' => 'src/etc/adminhtml/routes.xml',
            'src/Controller/Adminhtml/IndexController.phtml' => $this->getControllerFileName(),
            'src/view/adminhtml/layout/module_layout_index.phtml' => 'src/view/adminhtml/layout/'. $this->getLayoutXmlName(),
            'src/view/adminhtml/templates/template.phtml' => $this->getTemplateFileName(),
            'src/Test/Controller/Adminhtml/IndexControllerTest.phtml' => $this->getControllerTestFileName()
        ];

        $this->directories = array_merge($this->directories, $directories);
        $this->files = array_merge($this->files, $files);

    }

    /**
     * @return string
     */
    protected function getControllerFileName()
    {
        return $this->getControllerDirectoryName() . DIRECTORY_SEPARATOR . $this->data['action_name'] . '.php';
    }

    /**
     * @return string
     */
    protected function getControllerDirectoryName()
    {
        return 'src/Controller/Adminhtml/' . $this->data['front_name'];
    }

    /**
     * @return string
     */
    protected function getControllerTestFileName()
    {
        return $this->getControllerTestDirectoryName() . DIRECTORY_SEPARATOR . $this->data['action_name'] . 'Test.php';
    }

    /**
     * @return string
     */
    protected function getControllerTestDirectoryName()
    {
        return 'src/Test/Controller/Adminhtml/' . $this->data['front_name'];
    }

    /**
     * @return string
     */
    protected function getLayoutXmlName()
    {
        return strtolower($this->data['namespace'] . '_' . $this->data['module'] . '_' . $this->data['front_name'] . '_' . $this->data['action_name'] .'.xml');
    }

    protected function getTemplateDirectory()
    {
        return 'src/view/adminhtml/templates/'.strtolower($this->data['front_name']);
    }
    
    protected function getTemplateFileName()
    {
        return  $this->getTemplateDirectory() . DIRECTORY_SEPARATOR . strtolower($this->data['action_name']) .'.phtml';
    }

}
