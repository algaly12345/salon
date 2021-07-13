<?php


namespace App\Http\Services\SMSGateways;


use GuzzleHttp\Client;


class VictoryLinkSms
{
    public $client;

    public function __construct()
    {
        if (! $this->client) {
            $this->client = new Client();
        }
    }

    public function sendSms($phone, $message, $language = 'en', $model = null)
    {
        $params = [
            'UserName' => '966532295510',
            'Password' => 'Mhsg1966',
            'SMSText' => $message,
            'SMSLang' => $language == 'ar' ? 'A' : 'E',
            'SMSSender' => 'RIEAYA',
            'SMSReceiver' => $phone,
        ];

        try {
            $smsURL = "https://www.hisms.ws/api.php";

            $response = $this->client->post($smsURL, ['form_params' => $params ]);
            $content = $response->getBody();

            $xml = (array) simplexml_load_string($content);

            if ($xml[0] == '0') {
                return true;
            } else {

                info("VictoryLink error status!");  // log
                return false;
            }
        } catch (\Exception $e) {
            info("VictoryLink has been trying to send sms to $phone but operation failed !");
            return false;
        }
    }

    /**
     * SET YOUR CLIENT TO MOVE FORWARD TO SEND A NEW SMS.
     *
     * @param Client $client
     *
     * @return $this
     */
    public function setClient(Client $client)
    {
        $this->client = $client;

        return $this;
    }
}
