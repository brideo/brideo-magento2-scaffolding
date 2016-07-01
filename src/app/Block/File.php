<?php

namespace Brideo\Magento2Scaffolding\Block;

use Brideo\Magento2Scaffolding\Helper\TypeMapping;

class File extends DataObject
{

    private $fileName;

    /**
     * @var TypeMapping
     */
    protected $typeMapping;

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

    /**
     * @param $type
     *
     * @return string
     */
    public function TableType($type) : string
    {
        try {
            return $this->getTypeMapping()->getStaticBinding($type);
        }  catch (\Exception $e) {
            // Should log here.
        }

        return "'".$type."'";
    }

    /**
     * @return TypeMapping
     */
    public function getTypeMapping()
    {
        if (!$this->typeMapping) {
            $this->typeMapping = new TypeMapping();
        }

        return $this->typeMapping;
    }

    public function blockClass($default)
    {
        if($this->getData('block_class')) {
            return $this->getData('block_class');
        }

        return $default;
    }

}
