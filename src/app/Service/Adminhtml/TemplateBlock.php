<?php

namespace Brideo\Magento2Scaffolding\Service\Adminhtml;

use Brideo\Magento2Scaffolding\Service\Base\Block;

class TemplateBlock extends Block
{
    const DIRECTORY_BLOCK = 'Adminhtml/Block';
    const TEMPLATE_BLOCK_TEMPLATE_SOURCE = 'src/Block/Adminhtml/Template.phtml';

    /**
     * Get the block directory.
     *
     * @return string
     */
    protected function getBlockDirectory() : string
    {
        return $this->getSrcDirectory() . DIRECTORY_SEPARATOR . static::DIRECTORY_BLOCK;
    }

    /**
     * Get the block template file.
     *
     * @return string
     */
    protected function getBlockTemplate() : string
    {
        return static::TEMPLATE_BLOCK_TEMPLATE_SOURCE;
    }
}
