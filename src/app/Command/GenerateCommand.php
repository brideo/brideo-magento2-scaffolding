<?php

namespace Brideo\Magento2Scaffolding\Command;

use Brideo\Magento2Scaffolding\Service\Generate;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateCommand extends AbstractCommand
{
    const NAME = 'module:generate';
    const DESCRIPTION = 'Generate a module.';

    protected function configure()
    {
        $this->getBaseCommand(static::NAME, static::DESCRIPTION)->addDefaultOptionalArguments();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $namespace = $input->getArgument(static::MODULE_NAMESPACE);
        $module = $input->getArgument(static::MODULE_NAME);
        $version = $this->getVersion($input);
        $directory = $this->getModuleDirectory($input);

        $generate = new Generate($namespace, $module, $version, $directory);
        $generate->generate();
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
}
