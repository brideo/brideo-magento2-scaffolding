<?php

namespace Brideo\Magento2Scaffolding\Service\Frontend;

use Brideo\Magento2Scaffolding\Service\Base\Route as BaseRoute;

class Route extends BaseRoute
{

    const AREA = 'frontend';

    const DIRECTORY_CONTROLLER = 'Controller';

    const TEMPLATE_ROUTES_SOURCE = 'src/etc/frontend/routes.phtml';
    const TEMPLATE_CONTROLLER_SOURCE = 'src/Controller/IndexController.phtml';
    const TEMPLATE_LAYOUT_SOURCE = 'src/view/frontend/layout/module_layout_index.phtml';
    const TEMPLATE_TEMPLATE_SOURCE = 'src/view/frontend/templates/template.phtml';
    const TEMPLATE_CONTROLLER_TEST_SOURCE = 'src/Test/Controller/IndexControllerTest.phtml';

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
