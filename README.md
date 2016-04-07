
Install Manually
------------
 1. <a href="https://github.com/kilometer-io/kilometer-php/archive/master.zip">Download the Kilometer PHP Library</a>
 2.  Extract the zip file, and add KilometerAPIClient.php file to your project root.
 3.  Now you can start send events:

```php
<?php
// import Kilometer
require_once("KilometerAPIClient.php");

// using namespace
use Kilometer\KilometerAPIClient;

// Get the Kilometer class instance, replace with your APP_ID
$kilometer = new KilometerAPIClient("<<<APP_ID>>>");

// Track an event
// Replace <<<USER-ID>>> with the unique identifier of your user (email or user_name).
$kilometer->addUser("<<<USER-ID>>>", "http://initial-referral.domain.com");

// Send event for user id example@example.com
$kilometer->addEvent("example@example.com", "event name", array(
    'some_propert_key'      => "property_val",
    'another_propert_key'   => "another_property_val"
));
```

Documentation
-------------
* <a href="https://kilometer.readme.io/" target="_blank">Full API Reference</a>