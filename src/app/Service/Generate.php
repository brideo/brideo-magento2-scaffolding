<?php

namespace Brideo\Magento2Scaffolding\Service;

class Generate extends Base
{
    protected function _construct()
    {
        parent::_construct();
    }

    /**
     * Get any additional directories for the generation process;
     *
     * @return array
     */
    public function getAdditionalDirectories() : array
    {
        return [];
    }

    /**
     * Get any additional files for the generation process;
     *
     * @return array
     */
    public function getAdditionalFiles() : array
    {
        return [];
    }
}
