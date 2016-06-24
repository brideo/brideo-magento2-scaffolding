<?php

namespace Brideo\Magento2Scaffolding\Command\ResourceModel;

use Brideo\Magento2Scaffolding\Command\AbstractCommand;
use Brideo\Magento2Scaffolding\Service\ResourceModel\Model;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ModelCommand extends AbstractCommand
{
    const NAME = 'module:resource-model';
    const DESCRIPTION = 'Generate a resource model.';

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

        $modelService = new Model($namespace, $module, $className, $version, $directory);
        $modelService->generate();
    }

}
