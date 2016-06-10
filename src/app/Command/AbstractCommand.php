<?php

namespace Brideo\Magento2Scaffolding\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;

abstract class AbstractCommand extends Command
{

    const MODULE_NAMESPACE = 'namespace';
    const MODULE_NAMESPACE_DESCRIPTION = 'The Namespace of the module';
    const MODULE_NAME = 'module';
    const MODULE_NAME_DESCRIPTION = 'The name of the module';
    const MODULE_VERSION = 'version';
    const MODULE_VERSION_DESCRIPTION = 'The version of the module';
    const MODULE_DIRECTORY = 'directory';
    const MODULE_DIRECTORY_DESCRIPTION = 'The name of the directory you would like the module to install into.';

    /**
     * Helper method to easily create the base command used for
     * module generation.
     *
     * @param $name
     * @param $description
     *
     * @return $this
     */
    public function getBaseCommand($name, $description)
    {
        $this->setName($name)
            ->setDescription($description)
            ->addArgument(
                static::MODULE_NAMESPACE,
                InputArgument::REQUIRED,
                static::MODULE_NAMESPACE_DESCRIPTION
            )
            ->addArgument(
                static::MODULE_NAME,
                InputArgument::REQUIRED,
                static::MODULE_NAME_DESCRIPTION
            )
            ->addArgument(
                static::MODULE_VERSION,
                InputArgument::OPTIONAL,
                static::MODULE_VERSION_DESCRIPTION
            )
            ->addArgument(
                static::MODULE_DIRECTORY,
                InputArgument::OPTIONAL,
                static::MODULE_DIRECTORY_DESCRIPTION
            );

        return $this;
    }
}
