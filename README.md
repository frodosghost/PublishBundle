PublishBundle
=============

Add Publish operations to entities within the Manhattan Console. It easily adds Publish specific fields to Entities to allow easy to publish.

## How
1. Add this bundle to the composer file:

        {
            "require": {
                ...
                "manhattan/publish-bundle": "dev-master"
            }
        }

2. Add this bundle to your app kernel:

        // app/AppKernel.php
        public function registerBundles()
        {
            return array(
                // ...
                new Manhattan\PublishBundle\ManhattanPublishBundle(),
                // ...
            );
        }
