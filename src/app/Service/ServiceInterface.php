<?php

namespace Brideo\Magento2Scaffolding\Service;

interface ServiceInterface
{

    /**
     * Generate the files for the current service
     *
     * @return $this
     */
    public function generate();
}
