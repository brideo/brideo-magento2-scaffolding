# Brideo Magento 2 Scaffolding

This is just something I am hacking together, I have the original concept up and running however I haven't tested if the module works in Magento yet. I wouldn't recommend this for development use yet.

    php src/run.php Brideo Example

Should create:

    * `./module/src`
    * `./module/src/registration.php`
    * `./module/src/etc/module.xml`
    * `./module/composer.json`
    * `./module/.gitignore`
    * `./module/README.md`


Todo's:

* Add Tests
* Add Interfaces
* Integrate into Magento 2's `bin/magento`
* Use a Symfony Console
* Register the template files in the CommandsRepository rather than doing a big dirty glob and replace
* Add more data like Author
* Add auto-loader
