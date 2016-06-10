<?php

namespace Brideo\Magento2Scaffolding\Block;

class File extends DataObject
{

    private $fileName;

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
}
