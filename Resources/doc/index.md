Porter Stemmer Bundle
============

Installation
------------

1. Add this bundle to your project in composer.json:

    PublishBundle uses composer (http://www.getcomposer.org) to organize dependencies:

    ```json
    {
        "require": {
            "manhattan/publish-bundle": "dev-master",
        }
    }
    ```

2. Add this bundle to your app/AppKernel.php:

    ``` php
    // application/ApplicationKernel.php
    public function registerBundles()
    {
        return array(
            // ...
            new Manhattan\PublishBundle(),
            // ...
        );
    }
    ```

Documentation
-------------

