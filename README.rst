
========
Example:
========


require_once("EventsAPIClient.php");

use Kilometer\EventsAPIClient;

$userId = "splanger";
$initialReferral = "http://google.com";

$eventsApiClient = new Kilometer\EventsAPIClient("rfhj68io87ky8k3a");
$eventsApiClient->addUser($userId, $initialReferral);
$eventsApiClient->addEvent($userId, "test_event", array("some_event_property" => "blahblah"));
$eventsApiClient->updateUserProperties($userId, array("email" => "example@admin.io"));
$eventsApiClient->increaseUserProperty($userId, "age", 1);
$eventsApiClient->decreaseUserProperty($userId, "age", 1);
