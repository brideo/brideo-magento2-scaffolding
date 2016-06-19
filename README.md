# Brideo Magento 2 Scaffolding

This module is still a hack project of mind and is far from completion. The aim of this project is to be able to build a CLI tool to help create boiler plate Magento 2 files with a good amount of test coverage.

## Generate Module

    php src/application.php module:generate Brideo Example 1.0.0 brideo-example

Will create:

    $ ./brideo-example/src
    $ ./brideo-example/src/registration.php
    $ ./brideo-example/src/etc/module.xml
    $ ./brideo-example/composer.json
    $ ./brideo-example/.gitignore
    $ ./brideo-example/README.md
    $ ./brideo-example/Test/Unit/ModuleTest.php


## Generate Admin Route

    php src/application.php module:route:adminhtml Brideo Example Frontname Index 1.0.0 brideo-example

If the brideo-example doesn't exist yet, this will create:

    $ ./brideo-example/src
    $ ./brideo-example/src/registration.php
    $ ./brideo-example/src/etc/module.xml
    $ ./brideo-example/composer.json
    $ ./brideo-example/.gitignore
    $ ./brideo-example/README.md
    $ ./brideo-example/Test/Unit/ModuleTest.php

It will also create:

    $ ./brideo-example/src/etc/acl.xml
    $ ./brideo-example/src/etc/adminhtml/routes.xml
    $ ./brideo-example/src/Controller/Adminhtml/Frontname/Index.php
    $ ./brideo-example/src/view/adminhtml/layout/brideo_example_frontname_index.xml
    $ ./brideo-example/src/view/adminhtml/templates/frontname/index.phtml
    $ ./brideo-example/Test/Unit/Controller/Adminhtml/Frontname/IndexTest.php
    
*Note*: if your `acl.xml` file exists already you will manually need to add your resource at this current time. This cli is still very much in alpha so I haven't got round to injecting nodes as of yet.

## Generate Frontend Route

    php src/application.php module:route:frontend Brideo Example Frontname Index 1.0.0 brideo-example

If the brideo-example doesn't exist yet, this will create:

    $ ./brideo-example/src
    $ ./brideo-example/src/registration.php
    $ ./brideo-example/src/etc/module.xml
    $ ./brideo-example/composer.json
    $ ./brideo-example/.gitignore
    $ ./brideo-example/README.md
    $ ./brideo-example/Test/Unit/ModuleTest.php

It will also create:

    $ ./brideo-example/src/etc/frontend/routes.xml
    $ ./brideo-example/src/Controller/Frontname/Index.php
    $ ./brideo-example/src/view/frontend/layout/brideo_example_frontname_index.xml
    $ ./brideo-example/src/view/frontend/templates/frontname/index.phtml
    $ ./brideo-example/Test/Unit/Controller/Frontname/IndexTest.php
    

## Running Tests
 
    composer install
    vendor/bin/phpunit src/app/Test

## Todo's:

* Add Tests
* Add Interfaces
* Integrate into Magento 2's `bin/magento`
* Add more data like Author
* Remove `$directories` definition and just use files
* Remove dirty helper functions in views.
* Create constants for keys (probably within interfaces)
* Improve directory structure
* Inject ACL resource if `acl.xml` exists already
* Abstract duplicate logic for Admin/Frontend controllers
* Update `composer.json` with dependencies  
