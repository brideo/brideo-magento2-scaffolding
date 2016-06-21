<?php

namespace Brideo\Magento2Scaffolding\Command\Adminhtml;

use Brideo\Magento2Scaffolding\Command\Base\Route;
use Brideo\Magento2Scaffolding\Service\AdminhtmlRoute;
use Brideo\Magento2Scaffolding\Service\ServiceInterface;

class RouteCommand extends Route
{

    const NAME = 'module:adminhtml:route';
    const DESCRIPTION = 'Generate an admin route for a module.';

    /**
     * @return string
     */
    protected function getCommandName() : string
    {
        return static::NAME;
    }

    /**
     * @return string
     */
    protected function getCommandDescription() : string
    {
        return static::DESCRIPTION;
    }

    /**
     * Return the service to generate.
     *
     * @param string $namespace
     * @param string $module
     * @param string $frontName
     * @param string $actionName
     * @param string $version
     * @param string $directory
     *
     * @return ServiceInterface
     */
    protected function getService(
        string $namespace,
        string $module,
        string $frontName,
        string $actionName,
        string $version,
        string $directory
    ) : ServiceInterface
    {
        return new AdminhtmlRoute($namespace, $module, $frontName, $actionName, $version, $directory);
    }
}
