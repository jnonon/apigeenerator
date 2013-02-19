Apigee Skeleton class generator
================================================

Apigee gives you a complete API platform for the app economy.
This tool generates Stub classes base on existing definitions in Apigee website for existing Api 

### Installing via Composer

The recommended way to install Guzzle is through [Composer](http://getcomposer.org).

1. Add ``jnonon/apigee`` as a dependency in your project's ``composer.json`` file:

        {
            "require": {
                "jnonon/apigee": "*"
            }
        }

    Consider tightening your dependencies to a known version when deploying mission critical applications (e.g. ``2.8.*``).

2. Download and install Composer:

        curl -s http://getcomposer.org/installer | php

3. Install your dependencies:

        php composer.phar install

4. Require Composer's autoloader

    Composer also prepares an autoload file that's capable of autoloading all of the classes in any of the libraries that it downloads. To use it, just add the following line to your code's bootstrap process:

        require 'vendor/autoload.php';

You can find out more on how to install Composer, configure autoloading, and other best-practices for defining dependencies at [getcomposer.org](http://getcomposer.org).

Features
--------

- Generates class files from Api definitions, minimizing the ammount of code to type
- Creates properties based on how often they are used across the API definition 