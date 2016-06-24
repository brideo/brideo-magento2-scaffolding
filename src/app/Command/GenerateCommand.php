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
        list($namespace, $module, $version, $directory) = $this->getBaseArguments($input);

        $generate = new Generate($namespace, $module, $version, $directory);
        $generate->generate();
    }

}
