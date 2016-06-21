#!/usr/bin/env php
<?php
// application.php

require __DIR__.'/../vendor/autoload.php';

use Brideo\Magento2Scaffolding\Command\Frontend\TemplateBlockCommand as FrontendTemplateBlock;
use Brideo\Magento2Scaffolding\Command\Adminhtml\TemplateBlockCommand as AdminTemplateBlock;
use Brideo\Magento2Scaffolding\Command\GenerateCommand;
use Brideo\Magento2Scaffolding\Command\Adminhtml\RouteCommand as AdminRoute;
use Brideo\Magento2Scaffolding\Command\Frontend\RouteCommand as FrontendRoute;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new GenerateCommand());
$application->add(new AdminRoute());
$application->add(new FrontendRoute());
$application->add(new FrontendTemplateBlock());
$application->add(new AdminTemplateBlock());
$application->run();
