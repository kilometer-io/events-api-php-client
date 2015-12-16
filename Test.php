<?php
namespace Test;

require_once("EventsAPIClient.php");

use Kilometer\EventsAPIClient;

$customerAppId = "rfhj68io87ky8k3a";

$eventsApiClient = new EventsAPIClient($customerAppId);
$eventsApiClient->addUser("user_id_example");

