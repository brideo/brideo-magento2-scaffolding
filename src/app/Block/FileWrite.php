<?php

namespace Brideo\Magento2Scaffolding\Block;

class FileWrite
{

    private $fileName;
    private $contents;

    public function __construct($fileName, $contents)
    {
        $this->fileName = $fileName;
        $this->contents = $contents;
    }

    public function write()
    {
        if (!file_exists($this->fileName)) {
            $newFile = fopen($this->fileName, "w");
            fwrite($newFile, $this->contents);
            fclose($newFile);
        }
    }
}
