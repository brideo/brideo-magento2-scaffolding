<?php

namespace Brideo\Magento2Scaffolding\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;

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

    const CLASS_NAME = 'class_name';
    const CLASS_DESCRIPTION = 'The name of the class to generate.';

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
            );

        return $this;
    }

    public function addDefaultOptionalArguments()
    {
        $this->addArgument(
            static::MODULE_VERSION,
            InputArgument::OPTIONAL,
            static::MODULE_VERSION_DESCRIPTION
        )->addArgument(
            static::MODULE_DIRECTORY,
            InputArgument::OPTIONAL,
            static::MODULE_DIRECTORY_DESCRIPTION
        );

        return $this;
    }

    protected function getVersion(InputInterface $input)
    {
        $version = $input->getArgument(static::MODULE_VERSION);
        if (!$version) {
            $version = '1.0.0';
        }

        return $version;
    }

    protected function getModuleDirectory(InputInterface $input)
    {
        $directory = $input->getArgument(static::MODULE_DIRECTORY);
        if (!$directory) {
            $directory = false;
        }

        return $directory;
    }

    /**
     * Get the base arguments.
     *
     * @param InputInterface $input
     *
     * @return array
     */
    protected function getBaseArguments(InputInterface $input)
    {
        $namespace = $input->getArgument(static::MODULE_NAMESPACE);
        $module = $input->getArgument(static::MODULE_NAME);
        $version = $this->getVersion($input);
        $directory = $this->getModuleDirectory($input);

        return array($namespace, $module, $version, $directory);
    }
}
