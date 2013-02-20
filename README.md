Apigee Skeleton class generator
================================================

Apigee gives you a complete API platform for the app economy.
This tool generates Stub classes base on existing definitions in Apigee website for existing Api 

### Installing via Composer
0. Clone this repository:
        git clone git@github.com:jnonon/apigee.git

1. Download and install Composer:

        curl -s http://getcomposer.org/installer | php

2. Install your dependencies:

        php composer.phar install

3. Require Composer's autoloader

    Composer also prepares an autoload file that's capable of autoloading all of the classes in any of the libraries that it downloads. To use it, just add the following line to your code's bootstrap process:

        require 'vendor/autoload.php';

You can find out more on how to install Composer, configure autoloading, and other best-practices for defining dependencies at [getcomposer.org](http://getcomposer.org).

## Usage Example
        include_once __DIR__.'/../vendor/autoload.php';
        
        use Jnonon\Tools\Apigee\Client\ApiGenerator;
        
        $url = 'https://apigee.com/v1/consoles/reddit/apidescription?format=internal';
        
        $apigee = new ApiGenerator('RedditApi');
        
        $apigee->setApigeeSourceUrl($url);
        
        $endpoints = $apigee->getEndpoints();
        
        //Write to a path, overriding if exists
        //$apigee->generateClassForEndpoint($endpoints[0])->write('/desirable/path', true);
        
        echo $apigee->generateClassForEndpoint($endpoints[0])->toString();
        
        //php Examples/redditApiGenerator.php

Features
--------

- Generates class files from Api definitions, minimizing the ammount of code to type
- Creates properties based on how often they are used across the API definition
- Adds phpDoc entries on each api method, if documentation exists
