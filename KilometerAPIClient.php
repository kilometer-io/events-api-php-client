<?php
namespace Kilometer;

class KilometerAPIClient {

    private $customerAppId;

    const EVENTS_API_URL = "http://events.kilometer.io";

    const CLIENT_TYPE = "php";
    const EVENT_TYPE = "identified";

    const HEADER_CLIENT_TYPE = "Client-Type";
    const HEADER_CONTENT_TYPE = "Content-Type";
    const HEADER_TIMESTAMP = "Timestamp";
    const HEADER_CUSTOMER_APP_ID = "Customer-App-Id";


    public function __construct($customerAppId) {
        $this->customerAppId = $customerAppId;

    }

    public function addUser($userId, $customProperties = null, $initialReferral = null,
                            $endpointUrl = null, $customerAppId = null) {

        $endpointUrl = $endpointUrl ? $endpointUrl : self::EVENTS_API_URL;
        $customerAppId = $customerAppId ? $customerAppId : $this->customerAppId;

        $url = $endpointUrl . "/users";

        // Prepare POST JSON data
        $data = array(
            "user_id" => $userId
        );

        if ($initialReferral != null) {
            $data["context"] = array("initial_referral" => $initialReferral);
        }

        if ($customProperties != null) {
            $customProperties = $this->arraysToString($customProperties);
            $data["user_properties"] = $customProperties;
        }

        $data_string = json_encode($data);

        // Prepare and perform request
        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            self::HEADER_CLIENT_TYPE     . ": " . self::CLIENT_TYPE,
            self::HEADER_CONTENT_TYPE    . ": " . "application/json",
            self::HEADER_TIMESTAMP       . ": " . $this->getTimestamp(),
            self::HEADER_CUSTOMER_APP_ID . ": " . $customerAppId
        ));
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }

    public function addEvent($userId, $eventName, $eventProperties = array(),
                             $endpointUrl = null, $customerAppId = null) {

        $endpointUrl = $endpointUrl ? $endpointUrl : self::EVENTS_API_URL;
        $customerAppId = $customerAppId ? $customerAppId : $this->customerAppId;

        $url = $endpointUrl . "/users/" . rawurlencode($userId) . "/events";

        // Check if $eventProperties key have value as array or associate array and encoded it as string
        $eventProperties = $this->arraysToString($eventProperties);

        // Prepare POST JSON data
        $data = array(
            "event_name" => $eventName,
            "custom_properties" => $eventProperties
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
            self::HEADER_CUSTOMER_APP_ID . ": " . $customerAppId
        ));
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }

    public function updateUserProperties($userId, $userProperties = array(),
                                         $endpointUrl = null, $customerAppId = null) {

        $endpointUrl = $endpointUrl ? $endpointUrl : self::EVENTS_API_URL;
        $customerAppId = $customerAppId ? $customerAppId : $this->customerAppId;

        $url = $endpointUrl . "/users/" . rawurlencode($userId) . "/properties";

        // Check if $eventProperties key have value as array or associate array and encoded it as string
        $userProperties = $this->arraysToString($userProperties);

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
            self::HEADER_CUSTOMER_APP_ID . ": " . $customerAppId
        ));
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }

    public function increaseUserProperty($userId, $propertyName, $amount, $endpointUrl = null, $customerAppId = null) {

        $endpointUrl = $endpointUrl ? $endpointUrl : self::EVENTS_API_URL;
        $customerAppId = $customerAppId ? $customerAppId : $this->customerAppId;

        $url = $endpointUrl . "/users/" . rawurlencode($userId) . "/properties/" . rawurlencode($propertyName) . "/increase/" . $amount;

        // Prepare and perform request
        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            self::HEADER_CLIENT_TYPE     . ": " . self::CLIENT_TYPE,
            self::HEADER_TIMESTAMP       . ": " . $this->getTimestamp(),
            self::HEADER_CUSTOMER_APP_ID . ": " . $customerAppId
        ));

        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }

    public function decreaseUserProperty($userId, $propertyName, $amount, $endpointUrl = null, $customerAppId = null) {

        $endpointUrl = $endpointUrl ? $endpointUrl : self::EVENTS_API_URL;
        $customerAppId = $customerAppId ? $customerAppId : $this->customerAppId;

        $url = $endpointUrl . "/users/" . rawurlencode($userId) . "/properties/" . rawurlencode($propertyName) . "/decrease/" . $amount;

        // Prepare and perform request
        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            self::HEADER_CLIENT_TYPE     . ": " . self::CLIENT_TYPE,
            self::HEADER_TIMESTAMP       . ": " . $this->getTimestamp(),
            self::HEADER_CUSTOMER_APP_ID . ": " . $customerAppId
        ));

        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }

    public function linkUserToGroup($userId, $groupId, $endpointUrl = null, $customerAppId = null) {

        $endpointUrl = $endpointUrl ? $endpointUrl : self::EVENTS_API_URL;
        $customerAppId = $customerAppId ? $customerAppId : $this->customerAppId;

        $url = $endpointUrl . "/groups/" . rawurlencode($groupId) . "/link/" . rawurlencode($userId);

        // Prepare and perform request
        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            self::HEADER_CLIENT_TYPE     . ": " . self::CLIENT_TYPE,
            self::HEADER_TIMESTAMP       . ": " . $this->getTimestamp(),
            self::HEADER_CUSTOMER_APP_ID . ": " . $customerAppId
        ));

        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }

    public function updateGroupProperties($groupId, $groupProperties = array(),
                                          $endpointUrl = null, $customerAppId = null) {

        $endpointUrl = $endpointUrl ? $endpointUrl : self::EVENTS_API_URL;
        $customerAppId = $customerAppId ? $customerAppId : $this->customerAppId;

        $url = $endpointUrl . "/groups/" . rawurlencode($groupId) . "/properties";

        // Check if $eventProperties key have value as array or associate array and encoded it as string
        $groupProperties = $this->arraysToString($groupProperties);

        // Prepare POST JSON data
        $data_string = json_encode($groupProperties);

        // Prepare and perform request
        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            self::HEADER_CLIENT_TYPE     . ": " . self::CLIENT_TYPE,
            self::HEADER_CONTENT_TYPE    . ": " . "application/json",
            self::HEADER_TIMESTAMP       . ": " . $this->getTimestamp(),
            self::HEADER_CUSTOMER_APP_ID . ": " . $customerAppId
        ));
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }

    private function getTimestamp() {
        $milliseconds = round(microtime(true) * 1000);
        return $milliseconds;
    }

    /**
     * Gets an associated array and converts all "array" values to strings.
     *
     * @param associated array $data
     * @return array $data
     */
    private function arraysToString($data) {

        foreach ($data as $key => $val) {
            if (is_array($val)) {
                $data[$key] = json_encode($val);
            }
        }

        return $data;
    }
}