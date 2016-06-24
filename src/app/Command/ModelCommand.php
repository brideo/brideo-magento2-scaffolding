<?php

namespace Brideo\Magento2Scaffolding\Command;

use Brideo\Magento2Scaffolding\Service\Model;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ModelCommand extends AbstractCommand
{
    const NAME = 'module:model';
    const DESCRIPTION = 'Generate a model.';

    const IS_RESOURCE = true;

    protected function configure()
    {
        $this->getBaseCommand(static::NAME, static::DESCRIPTION)
            ->addArgument(
                static::CLASS_NAME,
                InputArgument::REQUIRED,
                static::CLASS_DESCRIPTION
            );

        $this->addDefaultOptionalArguments();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        list($namespace, $module, $version, $directory) = $this->getBaseArguments($input);
        $className = $input->getArgument(static::CLASS_NAME);

        $modelService = new Model($namespace, $module, $className, static::IS_RESOURCE, $version, $directory);
        $modelService->generate();
    }

}
