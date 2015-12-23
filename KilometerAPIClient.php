<?php
namespace Kilometer;

class KilometerAPIClient
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

        // Check if $eventProperties key have value as array or associate array
        // and encoded it as string
        $eventProperties = $this->checkForArray($eventProperties);

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

        // Check if userProperties key have value as array or associate array
        // and encoded it as string
        $userProperties = $this->checkForArray($userProperties);

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

    /**
     * Check if associate array key have value as array or associate array
     * if exist so need to convert and update that array to string, if not do nothing.
     * @param associate array $data
     * @return associate array $data
     */
    private function checkForArray($data) {

        foreach ($data as $key => $val) {
            if (is_array($val)) {
                $data[$key] = json_encode($val);
            }
        }

        return $data;
    }

}
