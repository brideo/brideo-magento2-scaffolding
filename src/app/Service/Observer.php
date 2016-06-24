<?php

namespace Brideo\Magento2Scaffolding\Service;

/**
 * Class Observer
 *
 * @package Brideo\Magento2Scaffolding\Service
 */
class Observer extends Base
{

    const DIRECTORY_OBSERVER = 'Observer';

    const FILE_EVENTS_DEFINITION = 'events.xml';

    const TEMPLATE_OBSERVER_TEMPLATE_SOURCE = 'src/Observer/Observer.phtml';
    const TEMPLATE_EVENTS_TEMPLATE_SOURCE = 'src/etc/events.phtml';

    public function __construct(
        string $namespace,
        string $module,
        string $className,
        string $eventName,
        string $version = '1.0.0',
        string $directory = null
    )
    {
        $this->data['class_name'] = $className;
        $this->data['event_name'] = $eventName;
        parent::__construct($namespace, $module, $version, $directory);
    }

    /**
     * Get any additional directories for the generation process;
     *
     * @return array
     */
    public function getAdditionalDirectories() : array
    {
        return [$this->getObserverDirectory()];
    }

    /**
     * Get any additional files for the generation process;
     *
     * @return array
     */
    public function getAdditionalFiles() : array
    {
        return [
            $this->getObserverTemplate()   => $this->getObserverFile(),
            $this->getEventDefinitionTemplate()   => $this->getEventDefinitionFile()
        ];
    }

    /**
     * Get the observer directory.
     *
     * @return string
     */
    protected function getObserverDirectory() : string
    {
        return $this->getSrcDirectory() . DIRECTORY_SEPARATOR . static::DIRECTORY_OBSERVER;
    }

    /**
     * Get the observer file.
     *
     * @return string
     */
    protected function getObserverFile() : string
    {
        return $this->getObserverDirectory(). DIRECTORY_SEPARATOR . $this->data['class_name'] .'.php';
    }

    /**
     * Get the observer file.
     *
     * @return string
     */
    protected function getEventDefinitionFile() : string
    {
        return $this->getConfigDirectory(). DIRECTORY_SEPARATOR . static::FILE_EVENTS_DEFINITION;
    }

    /**
     * Get the observer Template Directory.
     *
     * @return string
     */
    protected function getObserverTemplate() : string
    {
        return static::TEMPLATE_OBSERVER_TEMPLATE_SOURCE;
    }

    /**
     * Get the event.xml Template Directory.
     *
     * @return string
     */
    protected function getEventDefinitionTemplate() : string
    {
        return static::TEMPLATE_EVENTS_TEMPLATE_SOURCE;
    }
}
