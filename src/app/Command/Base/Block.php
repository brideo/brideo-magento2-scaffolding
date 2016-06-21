<?php

namespace Brideo\Magento2Scaffolding\Command\Base;

use Brideo\Magento2Scaffolding\Command\AbstractCommand;
use Brideo\Magento2Scaffolding\Service\ServiceInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class Block extends AbstractCommand
{
    const BLOCK_NAME = 'block_name';
    const BLOCK_DESCRIPTION = 'The name of the block you would like to create.';

    /**
     * @return string
     */
    abstract protected function getCommandName() : string;

    /**
     * @return string
     */
    abstract protected function getCommandDescription() : string;

    /**
     * Return the service to generate.
     *
     * @param string $namespace
     * @param string $module
     * @param string $blockName
     * @param string $version
     * @param string $directory
     *
     * @return ServiceInterface
     */
    abstract protected function getService(
        string $namespace,
        string $module,
        string $blockName,
        string $version,
        string $directory
    ) : ServiceInterface;

    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this->getBaseCommand($this->getCommandName(),$this->getCommandDescription())
            ->addArgument(
                static::BLOCK_NAME,
                InputArgument::REQUIRED,
                static::BLOCK_DESCRIPTION
            );

        $this->addDefaultOptionalArguments();
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $namespace = $input->getArgument(static::MODULE_NAMESPACE);
        $module = $input->getArgument(static::MODULE_NAME);
        $blockName = $input->getArgument(static::BLOCK_NAME);
        $version = $this->getVersion($input);
        $directory = $this->getModuleDirectory($input);

        $service = $this->getService($namespace, $module, $blockName, $version, $directory);
        $service->generate();
    }
}
