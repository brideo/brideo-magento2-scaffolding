<?php

namespace Brideo\Magento2Scaffolding\Block;

require_once __DIR__.'/../Command/CommandRepository.php';

use Brideo\Magento2Scaffolding\Command\CommandRepository;

class File
{

    /**
     * @var string
     */
    protected $namespace;

    /**
     * @var string
     */
    protected $module;

    /**
     * @var string
     */
    protected $version;

    /**
     * @var string
     */
    protected $fileType;

    /**
     * @var array
     */
    protected $commandsApplicable = [];

    /**
     * @var CommandRepository
     */
    protected $commandRepository;
    private $fileName;

    /**
     * File constructor.
     *
     * @param                   $fileName
     * @param string            $namespace
     * @param string            $module
     * @param string            $version
     * @param CommandRepository $commandRepository
     */
    public function __construct(
        $fileName,
        $namespace,
        $module,
        $version = '1.0.0',
        CommandRepository $commandRepository = null
    ) {
        if (!$commandRepository) {
            $commandRepository = new CommandRepository();
        }

        $this->namespace = $namespace;
        $this->module = $module;
        $this->version = $version;
        $this->commandRepository = $commandRepository;
        $this->fileName = $fileName;
    }

    /**
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * @param string $namespace
     *
     * @return $this
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;

        return $this;
    }

    /**
     * @return string
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * @param string $module
     *
     * @return $this
     */
    public function setModule($module)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param string $version
     *
     * @return $this
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @return string
     */
    public function getFileType()
    {
        return $this->fileType;
    }

    /**
     * @param string $fileType
     *
     * @return $this
     */
    public function setFileType($fileType)
    {
        $this->fileType = $fileType;

        return $this;
    }

    /**
     * @param $commands
     *
     * @return $this
     */
    public function setApplicableCommands($commands)
    {
        foreach ($commands as $command) {
            if ($this->commandRepository->isExists($command)) {
                $this->commandsApplicable[] = $command;
            }
        }

        return $this;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function render()
    {
        ob_start();
        $block = $this;
        try {
            include $this->fileName;
        } catch (\Exception $exception) {
            ob_end_clean();
            throw $exception;
        }

        return ob_get_clean();
    }
}
