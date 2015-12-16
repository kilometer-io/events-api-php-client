
Install Manually
------------
 1. <a href="https://github.com/kilometer-io/events-api-php-client/archive/master.zip">Download the Kilometer PHP Library</a>
 2.  Extract the zip file, and add EventsAPIClient.php file to your project root
 3.  Now you can start send events:

```php
<?php
// Import Kilometer
require_once("KilometerAPIClient.php");
use Kilometer\KilometerAPIClient;

// Replace with your APP_ID
$kilometerApiClient = new Kilometer\KilometerAPIClient("<<<APP_ID>>>");

// track an event
$kilometerApiClient->addEvent("<<<USER-ID>>>", "event_name",array(
    "event_property" => "value",
    "event_property_2" => "value_2"
));

// Set or Update user property 
$kilometerApiClient->updateUserProperties("<<<USER-ID>>>", array(
    "property_1" => "value",
    "property_2" => "value"
));

// Increase user property
$kilometerApiClient->increaseUserProperty("<<<USER-ID>>>", "property","value");

// Decrease user property
$kilometerApiClient->decreaseUserProperty("<<<USER-ID>>>", "property","value");
```

Documentation
-------------
* <a href="https://kilometer.readme.io/" target="_blank">Full API Reference</a>