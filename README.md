# Brideo Magento 2 Scaffolding

This is just something I am hacking together, I have the original concept up and running however I haven't tested if the module works in Magento yet. I wouldn't recommend this for development use yet.

    php src/application.php module:generate Brideo Example 1.0.0 module

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
* Add more data like Author
