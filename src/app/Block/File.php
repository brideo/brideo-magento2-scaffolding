<?php

namespace Brideo\Magento2Scaffolding\Block;

class File extends DataObject
{

    private $fileName;

    /**
     * File constructor.
     *
     * @param array $fileName
     * @param array $data
     */
    public function __construct(
        $fileName,
        $data = []
    ) {
        $this->fileName = $fileName;

        parent::__construct($data);
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

    /**
     * Helper function mainly used for xml.
     *
     * @param bool $isLower
     *
     * @return string
     */
    public function namespace_module($isLower = true) : string
    {
        $namespaceModule = $this->getData('namespace').'_'.$this->getData('module');
        if($isLower) {
            $namespaceModule = strtolower($namespaceModule);
        }

        return $namespaceModule;
    }

    public function NamespaceModule() : string
    {
        return  $this->getData('namespace') . '\\' . $this->getData('module');
    }

    /**
     * Get the table name
     *
     * @return string
     */
    public function table_name() : string
    {
        if ($this->getData('table_name')) {
            return $this->getData('table_name');
        }

        if ($this->getData('class_name')) {
            return $this->namespace_module() . '_' . strtolower($this->getData('class_name'));
        }

        return $this->namespace_module();
    }

    /**
     * Get the namespace module name.
     *
     * @return string
     */
    public function namespace_module_frontname_action() : string
    {
        return $this->namespace_module().strtolower('_' . $this->getData('front_name') . '_' . $this->getData('action_name'));
    }

    public function template_name() : string
    {
        return $this->namespace_module(false) . '::' . strtolower($this->getData('front_name') . '/' . $this->getData('action_name')) . '.phtml';
    }


}
