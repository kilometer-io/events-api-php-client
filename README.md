
Install Manually
------------
 1. <a href="https://github.com/kilometer-io/kilometer-php/archive/master.zip">Download the Kilometer PHP Library</a>
 2.  Extract the zip file, and add KilometerAPIClient.php file to your project root.
 3.  Now you can start send events:

```php
<?php
// Import Kilometer
require_once("KilometerAPIClient.php");

// Using namespace
use Kilometer\KilometerAPIClient;

// Get the Kilometer class instance, replace with your APP_ID
$kilometer = new KilometerAPIClient("<<<APP_ID>>>");

// Explicitly add a user
// Replace <<<USER-ID>>> with the unique identifier of your user (email or user_name).
$kilometer->addUser("<<<USER-ID>>>", array(
    "user property 1": "some value", 
    "user property 2": "another value"), 
    "http://initial-referral.domain.com");

// Update a user's properties
$kilometer->updateUserProperties("<<<USER-ID>>>", array(
    "user property 1": "some value", 
    "user property 2": "another value"));

// Track an event
$kilometer->addEvent("<<<USER-ID>>>", "event name", array(
    'event property 1' => "property_val",
    'event property 2' => "another_property_val"));

// Increase a user's property by some value (e.g. 10.3)
$kilometer->increaseUserProperty("<<<USER-ID>>>", "property name", 10.3);

// Decrease a user's property by some value (e.g. 5)
$kilometer->decreaseUserProperty("<<<USER-ID>>>", "property name", 5);

// Link a user to group
$kilometer->linkUserToGroup("<<<USER-ID>>>", "<<<GROUP-ID>>>");

// Update group properties
$kilometer->updateGroupProperties("<<<GROUP-ID>>>", array(
    "group property 1": "some value", 
    "group property 2": "another value"));
```

Documentation
-------------
* <a href="https://kilometer.readme.io/" target="_blank">Full API Reference</a>