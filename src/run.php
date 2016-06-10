<?php

require_once __DIR__ . '/app/functions.php';
require_once __DIR__ . '/app/Block/File.php';

// THIS WHOLE FILE IS A HACK (PROOF OF CONCEPT)

$files = glob_recursive(__DIR__ . '/templates/*.phtml');

if (!isset($argv[1]) || !isset($argv[2])) {
    throw new Exception("Set the parameters yo");
}

foreach ($files as $file) {

    $newFilePath = str_replace('templates', '../module', $file);

    if (!file_exists($newFilePath)) {
        $block = (new \Brideo\Magento2Scaffolding\Block\File($file, $argv[1], $argv[2]));
        $content = $block->render();
        $newFilePath = str_replace('phtml', $block->getFileType(), $newFilePath);

        $parts = explode('/', $newFilePath);
        $directory = str_replace(end($parts), '', $newFilePath);


        $newFile = fopen($newFilePath, "w");
        fwrite($newFile, $content);
        fclose($newFile);
    }

}
