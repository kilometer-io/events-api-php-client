
Install Manually
------------
 1. <a href="https://github.com/kilometer-io/events-api-php-client/archive/master.zip">Download the Kilometer PHP Library</a>
 2.  Extract the zip file, and add EventsAPIClient.php file to your project root
 3.  Now you can start send events:

```php
<?php
// import Kilometer
require_once("EventsAPIClient.php");

// using namespace
use Kilometer\EventsAPIClient;

// get the Kilometer class instance, replace with your APP_ID
$kilometerApiClient = new Kilometer\EventsAPIClient("<<<APP_ID>>>");

// track an event
// Replace <<<USER-ID>>> with the unique identifier of your user (email or user_name).
$kilometerApiClient->addUser(<<<USER-ID>>>, "initial referral");

// send event for user id example@example.com
$kilometerApiClient->addEvent("example@example.com", "event name", array(
    'some_propert_key'      => "property_val",
    'another_propert_key'   => "another_property_val"
));
```

Documentation
-------------
* <a href="https://kilometer.readme.io/" target="_blank">Full API Reference</a>