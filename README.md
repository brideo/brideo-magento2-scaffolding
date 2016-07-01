# Brideo Magento 2 Scaffolding

[![Build Status](https://travis-ci.org/brideo/brideo-magento2-scaffolding.svg?branch=master)](https://travis-ci.org/brideo/brideo-magento2-scaffolding)

This module is still a hack project of mind and is far from completion. The aim of this project is to be able to build a CLI tool to help create boiler plate Magento 2 files with a good amount of test coverage.

## Requirements

Sorry to make PHP 7 a requirement, I will add a docker environment for people running older versions of PHP.

I recommend upgrading to PHP 7 if possible though.

* PHP 7
* Composer

## Installation

    wget http://www.brideo.co.uk/brideo-magento2-scaffolding.phar
    chmod +x brideo-magento2-scaffolding.phar
    mv brideo-magento2-scaffolding.phar /usr/local/bin/brideo-magento2-scaffolding
    
## Generate Module

    brideo-magento2-scaffolding module:generate Brideo Example 1.0.0 brideo-example

Will create:

    $ ./brideo-example/src
    $ ./brideo-example/src/registration.php
    $ ./brideo-example/src/etc/module.xml
    $ ./brideo-example/composer.json
    $ ./brideo-example/.gitignore
    $ ./brideo-example/README.md
    $ ./brideo-example/Test/Unit/ModuleTest.php


## Generate Admin Route

    brideo-magento2-scaffolding module:adminhtml:route Brideo Example Frontname Index 1.0.0 brideo-example

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

    brideo-magento2-scaffolding module:frontend:route Brideo Example Frontname Index 1.0.0 brideo-example

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

## Generate Frontend Template Block

    brideo-magento2-scaffolding module:frontend:block:template Brideo Example SomeBlock 1.0.0 brideo-example

If the brideo-example doesn't exist yet, this will create:

    $ ./brideo-example/src
    $ ./brideo-example/src/registration.php
    $ ./brideo-example/src/etc/module.xml
    $ ./brideo-example/composer.json
    $ ./brideo-example/.gitignore
    $ ./brideo-example/README.md
    $ ./brideo-example/Test/Unit/ModuleTest.php

It will also create:

    $ ./brideo-example/src/Block/SomeBlock.php

## Generate Adminhtml Template Block

    brideo-magento2-scaffolding module:adminhtml:block:template Brideo Example SomeBlock 1.0.0 brideo-example

If the brideo-example doesn't exist yet, this will create:

    $ ./brideo-example/src
    $ ./brideo-example/src/registration.php
    $ ./brideo-example/src/etc/module.xml
    $ ./brideo-example/composer.json
    $ ./brideo-example/.gitignore
    $ ./brideo-example/README.md
    $ ./brideo-example/Test/Unit/ModuleTest.php

It will also create:

    $ ./brideo-example/src/Block/Adminhtml/SomeBlock.php

## Generate an observer

    brideo-magento2-scaffolding module:observer Brideo Example AddHandles layout_load_before 1.0.0 brideo-example
    
If the brideo-example doesn't exist yet, this will create:

    $ ./brideo-example/src
    $ ./brideo-example/src/registration.php
    $ ./brideo-example/src/etc/module.xml
    $ ./brideo-example/composer.json
    $ ./brideo-example/.gitignore
    $ ./brideo-example/README.md
    $ ./brideo-example/Test/Unit/ModuleTest.php

It will also create:

    $ ./brideo-example/src/Observer/AddHandles.php
    $ ./brideo-example/src/etc/events.xml

## Generate a Model

    brideo-magento2-scaffolding module:model Brideo Example MyModel 1.0.0 brideo-example
    
If the brideo-example doesn't exist yet, this will create:

    $ ./brideo-example/src
    $ ./brideo-example/src/registration.php
    $ ./brideo-example/src/etc/module.xml
    $ ./brideo-example/composer.json
    $ ./brideo-example/.gitignore
    $ ./brideo-example/README.md
    $ ./brideo-example/Test/Unit/ModuleTest.php

It will also create:

    $ ./brideo-example/src/Model/MyModel.php
    
## Generate a Resource Model

    brideo-magento2-scaffolding module:resource-model Brideo Example MyModel 1.0.0 brideo-example
    
If the brideo-example doesn't exist yet, this will create:

    $ ./brideo-example/src
    $ ./brideo-example/src/registration.php
    $ ./brideo-example/src/etc/module.xml
    $ ./brideo-example/composer.json
    $ ./brideo-example/.gitignore
    $ ./brideo-example/README.md
    $ ./brideo-example/Test/Unit/ModuleTest.php

It will also create:

    $ ./brideo-example/src/Model/ResourceModel/MyModel.php
    

## Generate a Collection

    brideo-magento2-scaffolding module:collection Brideo Example MyModel 1.0.0 brideo-example

If you don't have a resource model and model yet, this command will generate those for you.

If the brideo-example doesn't exist yet, this will create:

    $ ./brideo-example/src
    $ ./brideo-example/src/registration.php
    $ ./brideo-example/src/etc/module.xml
    $ ./brideo-example/composer.json
    $ ./brideo-example/.gitignore
    $ ./brideo-example/README.md
    $ ./brideo-example/Test/Unit/ModuleTest.php
    $ ./brideo-example/src/Model/MyModel.php
    $ ./brideo-example/src/Model/ResourceModel/MyModel.php

It will also create:

    $ ./brideo-example/src/Model/ResourceModel/MyModel/Collection.php

## Generate a Setup Script

    brideo-magento2-scaffolding module:setup:install Brideo Example brideo_example "name:string title:string content:text foreign:int" 1.0.0 brideo-example

If you don't have a resource model and model yet, this command will generate those for you.

If the brideo-example doesn't exist yet, this will create:

    $ ./brideo-example/src
    $ ./brideo-example/src/registration.php
    $ ./brideo-example/src/etc/module.xml
    $ ./brideo-example/composer.json
    $ ./brideo-example/.gitignore
    $ ./brideo-example/README.md

It will also create:

    $ ./brideo-example/src/Model/Setup/InstallSchema.php

We will also have a table called `brideo_example` which looks like this.

    +-----------+-------------+------+-----+---------+----------------+
    | Field     | Type        | Null | Key | Default | Extra          |
    +-----------+-------------+------+-----+---------+----------------+
    | entity_id | smallint(6) | NO   | PRI | NULL    | auto_increment |
    | name      | text        | YES  |     | NULL    |                |
    | title     | text        | YES  |     | NULL    |                |
    | content   | text        | YES  |     | NULL    |                |
    | foreign   | int(11)     | YES  |     | NULL    |                |
    +-----------+-------------+------+-----+---------+----------------+

## Scaffold Command


    brideo-magento2-scaffolding module:scaffold Brideo Example Blog brideo_blog "title:string description:string author:string" 1.0.0 brideo-example

Often we need to create entities in Magento, like the rails scaffold cli command I am attempting to make a module which builds the boiler plate Magento files so you can get up and running quickly.

This command will create and link:

* Module definition including `composer.json`
* Models
* Resource Models
* Collections
* Setup scripts 
* Blocks
* Config XML
* Admin Routes
* Admin XML
* ACL XML
* Unit Tests
* Admin template file (Not adminhtml yet)
* Frontend Routes
* Frontend layout XML 
* Frontend template (Outputting entities)


The files this command will create are (this command will never overwrite existing files):

	$ ./brideo-example/README.md
	$ ./brideo-example/composer.json
	$ ./brideo-example/src/Adminhtml/Block/Blog.php
	$ ./brideo-example/src/Block/Blog.php
	$ ./brideo-example/src/Controller/Adminhtml/Blog/Index.php
	$ ./brideo-example/src/Controller/Blog/Index.php
	$ ./brideo-example/src/Model/Blog.php
	$ ./brideo-example/src/Model/ResourceModel/Blog.php
	$ ./brideo-example/src/Model/ResourceModel/Blog/Collection.php
	$ ./brideo-example/src/Setup/InstallSchema.php
	$ ./brideo-example/src/Test/Unit/Controller/Adminhtml/IndexTest.php
	$ ./brideo-example/src/Test/Unit/Controller/IndexTest.php
	$ ./brideo-example/src/Test/Unit/ModuleTest.php
	$ ./brideo-example/src/etc/acl.xml
	$ ./brideo-example/src/etc/adminhtml/routes.xml
	$ ./brideo-example/src/etc/frontend/routes.xml
	$ ./brideo-example/src/etc/module.xml
	$ ./brideo-example/src/registration.php
	$ ./brideo-example/src/view/adminhtml/layout/brideo_example_blog_index.xml
	$ ./brideo-example/src/view/adminhtml/templates/blog/index.phtml
	$ ./brideo-example/src/view/frontend/layout/brideo_example_blog_index.xml
	$ ./brideo-example/src/view/frontend/templates/blog/index.phtml

This command will also create a table like this:

    +-------------+-------------+------+-----+---------+----------------+
    | Field       | Type        | Null | Key | Default | Extra          |
    +-------------+-------------+------+-----+---------+----------------+
    | entity_id   | smallint(6) | NO   | PRI | NULL    | auto_increment |
    | title       | text        | YES  |     | NULL    |                |
    | description | text        | YES  |     | NULL    |                |
    | author      | text        | YES  |     | NULL    |                |
    +-------------+-------------+------+-----+---------+----------------+

This command is still in development, if you're interested in contributing the things I am going to achieve are:

* adminhtml for the entity created
* injection of nodes in pre-existing XML files
* tests for every php file created (can even be blank)

## Running Tests
 
    composer install
    vendor/bin/phpunit src/app/Test

