<?php

require_once("../KilometerAPIClient.php");

const CUSTOMER_APP_ID = "abcdefghi1234567890";
const ENDPOINT_URL = "http://172.31.32.100:9000";

$client = new \Kilometer\KilometerAPIClient(CUSTOMER_APP_ID);

echo("Initialized the Events API client" . PHP_EOL);

$client->addUser("jeka pupkin",
    array(
        "age" => 25,
        "birthday_date" => "1988-08-22T05:30:00.000Z",
        "is_active" => true,
        "name" => "Jevgen",
        "colors" => array("red", "green", "blue"),
        "strength_level" => 10,
        "weight" => 100.5),
    null,
    ENDPOINT_URL
);

echo("Performed addUser call" . PHP_EOL);
sleep(1);

$client->addEvent("jeka pupkin", "workout",
    array(
        "repetitions" => 5,
        "day" => "2005-01-04T06:25:02.023Z",
        "feel_good" => true,
        "exercise" => "Push-Up",
        "colors" => array("red", "green", "blue")),
    ENDPOINT_URL
);

echo("Performed addEvent call" . PHP_EOL);
sleep(1);

 $client->updateUserProperties("jeka", array("strong" => true), ENDPOINT_URL);
//$client->updateUserProperties("jeka pupkin", array(
//    "age" => 25,
//    "birthday_date" => "1988-08-22T05:30:00.000Z",
//    "is_active" => true,
//    "name" => "Jevgen",
//    "colors" => array("red", "green", "blue"),
//    "strength_level" => 10,
//    "weight" => 100.5),
//    ENDPOINT_URL
//);

echo("Performed updateUserProperties call" . PHP_EOL);
sleep(1);

$client->increaseUserProperty("jeka pupkin", "strength_level", 1, ENDPOINT_URL);

echo("Performed increaseUserProperty call" . PHP_EOL);
sleep(1);

$client->decreaseUserProperty("jeka pupkin", "weight", 10, ENDPOINT_URL);

echo("Performed decreaseUserProperty call" . PHP_EOL);
sleep(1);

$client->linkUserToGroup("jeka pupkin", "Public GYM", ENDPOINT_URL);

echo("Performed linkUserToGroup call" . PHP_EOL);
sleep(1);

$client->updateGroupProperties("Public GYM", array(
    "days_of_trial" => 15,
    "licensed_until" => "2015-01-04T06:25:02.023Z",
    "receive_credit_card" => true,
    "director" => "George Hummerton",
    "colors" => array("red", "green", "blue")), ENDPOINT_URL);

echo("Performed updateGroupProperties call" . PHP_EOL);