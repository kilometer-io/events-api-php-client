<?php
//namespace Kilometer;
/**
 * Example:
$userId = "splanger";
$initialReferral = "http://google.com";


$eventsApiClient = new EventsAPIClient("abcdefghi1234567890");
$eventsApiClient->addUser($userId, $initialReferral);
$eventsApiClient->addEvent($userId, "test_event", array("some_event_property" => "blahblah"));
$eventsApiClient->updateUserProperties($userId, array("email" => "splanger@gmail.com"));
$eventsApiClient->increaseUserProperty($userId, "age", 1);
$eventsApiClient->decreaseUserProperty($userId, "age", 1);
 */


class EventsAPIClient
{
    private $customerAppId = 'test';

    const EVENTS_API_URL = "http://events.kilometer.io";

    const CLIENT_TYPE = "php";
    const EVENT_TYPE = "identified";

    const HEADER_CLIENT_TYPE = "Client-Type";
    const HEADER_CONTENT_TYPE = "Content-Type";
    const HEADER_TIMESTAMP = "Timestamp";
    const HEADER_CUSTOMER_APP_ID = "Customer-App-Id";


    public function __construct($customerAppId)
    {
        $this->customerAppId = $customerAppId;

    }

    public function addUser($userId, $initialReferral = "") {

        $url = self::EVENTS_API_URL . "/users";

        // Prepare POST JSON data
        $data = array(
            "user_id" => $userId,
            "initial_referral" => $initialReferral
        );
        $data_string = json_encode($data);

        // Prepare and perform request
        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            self::HEADER_CLIENT_TYPE     . ": " . self::CLIENT_TYPE,
            self::HEADER_CONTENT_TYPE    . ": " . "application/json",
            self::HEADER_TIMESTAMP       . ": " . $this->getTimestamp(),
            self::HEADER_CUSTOMER_APP_ID . ": " . $this->customerAppId
        ));
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }

    public function addEvent($userId, $eventName, $eventProperties = array()) {

        $url = self::EVENTS_API_URL . "/events";

        // Prepare POST JSON data
        $data = array(
            "user_id" => $userId,
            "event_name" => $eventName,
            "event_properties" => $eventProperties,
            "event_type" => self::EVENT_TYPE

        );
        $data_string = json_encode($data);

        // Prepare and perform request
        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            self::HEADER_CLIENT_TYPE     . ": " . self::CLIENT_TYPE,
            self::HEADER_CONTENT_TYPE    . ": " . "application/json",
            self::HEADER_TIMESTAMP       . ": " . $this->getTimestamp(),
            self::HEADER_CUSTOMER_APP_ID . ": " . $this->customerAppId
        ));
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }

    public function updateUserProperties($userId, $userProperties = array())
    {
        $url = self::EVENTS_API_URL . "/users/" . $userId . "/properties";

        // Prepare POST JSON data
        $data_string = json_encode($userProperties);

        // Prepare and perform request
        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            self::HEADER_CLIENT_TYPE     . ": " . self::CLIENT_TYPE,
            self::HEADER_CONTENT_TYPE    . ": " . "application/json",
            self::HEADER_TIMESTAMP       . ": " . $this->getTimestamp(),
            self::HEADER_CUSTOMER_APP_ID . ": " . $this->customerAppId
        ));
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }

    public function increaseUserProperty($userId, $propertyName, $amount)
    {
        $url = self::EVENTS_API_URL . "/users/" . $userId . "/properties/" . $propertyName . "/increase/" . $amount;

        // Prepare and perform request
        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            self::HEADER_CLIENT_TYPE     . ": " . self::CLIENT_TYPE,
            self::HEADER_TIMESTAMP       . ": " . $this->getTimestamp(),
            self::HEADER_CUSTOMER_APP_ID . ": " . $this->customerAppId
        ));

        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }

    public function decreaseUserProperty($userId, $propertyName, $amount)
    {
        $url = self::EVENTS_API_URL . "/users/" . $userId . "/properties/" . $propertyName . "/decrease/" . $amount;

        // Prepare and perform request
        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            self::HEADER_CLIENT_TYPE     . ": " . self::CLIENT_TYPE,
            self::HEADER_TIMESTAMP       . ": " . $this->getTimestamp(),
            self::HEADER_CUSTOMER_APP_ID . ": " . $this->customerAppId
        ));

        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }

    private function getTimestamp() {
        $milliseconds = round(microtime(true) * 1000);
        return $milliseconds;
    }
}
