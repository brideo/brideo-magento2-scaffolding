<?php

namespace Brideo\Magento2Scaffolding\Command;

class CommandRepository
{

    /**
     * @var array
     */
    protected $commands = ['generate'];

    /**
     * @return array
     */
    public function getCommands()
    {
        return $this->commands;
    }

    /**
     * @param array $commands
     *
     * @return $this
     */
    public function setCommands($commands)
    {
        $this->commands = $commands;

        return $this;
    }

    /**
     * @param $command
     *
     * @return $this
     */
    public function addCommand($command)
    {
        if (!$this->isExists($command)) {
            $this->commands[] = $command;
        }

        return $this;
    }

    /**
     * @param $command
     *
     * @return bool
     */
    public function isExists($command)
    {
        return boolval(array_search($command, $this->commands));
    }
}
