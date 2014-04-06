<?php
/**
 * Author: Elmar Abdurayimov
 * Author email: e.abdurayimov@gmail.com
 * Date: 11/1/13
 * Time: 1:57 PM
 */

/**
 * Class Google cloud messaging
 */
class Helper_GCM
{

    /**
     * Send push message to @@@
     *
     * @param       $registrationIds
     * @param array $message
     *
     * @return mixed
     */
    public static function sendPush($registrationIds, $message = array())    {
        // Set POST variables

        $fields = array(
            'registration_ids' => $registrationIds,
            'data' => $message,
        );

        $headers = array(
            'Authorization: key=' . Yii::app()->params['GCM_KEY'],
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, Yii::app()->params['GCM_URL']);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);
        return $result;
    }
}
