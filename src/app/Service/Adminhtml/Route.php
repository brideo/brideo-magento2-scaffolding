<?php

namespace Brideo\Magento2Scaffolding\Service\Adminhtml;

use Brideo\Magento2Scaffolding\Service\Base\Route as BaseRoute;

class Route extends BaseRoute
{

    const AREA = 'adminhtml';

    const DIRECTORY_CONTROLLER = 'Controller/Adminhtml';

    const FILE_ACL = 'acl.xml';

    const TEMPLATE_ACL_SOURCE = 'src/etc/acl.phtml';
    const TEMPLATE_ROUTES_SOURCE = 'src/etc/adminhtml/routes.phtml';
    const TEMPLATE_CONTROLLER_SOURCE = 'src/Controller/Adminhtml/IndexController.phtml';
    const TEMPLATE_LAYOUT_SOURCE = 'src/view/adminhtml/layout/module_layout_index.phtml';
    const TEMPLATE_TEMPLATE_SOURCE = 'src/view/adminhtml/templates/template.phtml';
    const TEMPLATE_CONTROLLER_TEST_SOURCE = 'src/Test/Controller/Adminhtml/IndexControllerTest.phtml';

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        parent::_construct();

        $this->addFiles([
            $this->getAclTemplate() => $this->getAclFile()
        ]);

        return $this;
    }

    /**
     * Get the acl file.
     *
     * @return string
     */
    protected function getAclFile() : string
    {
        return $this->getConfigDirectory() . DIRECTORY_SEPARATOR . static::FILE_ACL;
    }

    /**
     * Get the acl template file.
     *
     * @return string
     */
    protected function getAclTemplate() : string
    {
        return static::TEMPLATE_ACL_SOURCE;
    }

    /**
     * Get the area which applies.
     *
     * @return string
     */
    public function getArea() : string
    {
        return static::AREA;
    }

    /**
     * Get the controller directory.
     *
     * @return string
     */
    protected function getControllerDirectory() : string
    {
        return $this->getSrcDirectory() . DIRECTORY_SEPARATOR . static::DIRECTORY_CONTROLLER;
    }

    /**
     * Get the controller directory.
     *
     * @return string
     */
    protected function getControllerTestDirectory() : string
    {
        return $this->getTestDirectory() . DIRECTORY_SEPARATOR . static::DIRECTORY_CONTROLLER;
    }

    /**
     * Get the routes template.
     *
     * @return string
     */
    protected function getRoutesTemplate() : string
    {
        return static::TEMPLATE_ROUTES_SOURCE;
    }

    /**
     * Get the controller template.
     *
     * @return string
     */
    protected function getControllerTemplate() : string
    {
        return static::TEMPLATE_CONTROLLER_SOURCE;
    }

    /**
     * Get the layout template.
     *
     * @return string
     */
    protected function getLayoutTemplate() : string
    {
        return static::TEMPLATE_LAYOUT_SOURCE;
    }

    /**
     * Get the template template (dat naming convention).
     *
     * @return string
     */
    protected function getTemplateTemplate() : string
    {
        return static::TEMPLATE_TEMPLATE_SOURCE;
    }

    /**
     * Get the controller test template.
     *
     * @return string
     */
    protected function getControllerTestTemplate() : string
    {
        return static::TEMPLATE_CONTROLLER_TEST_SOURCE;
    }
}
