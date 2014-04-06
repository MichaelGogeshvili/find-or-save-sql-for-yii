<?php

class Util {
    public static function jsonResponse($data, $return = false) {
        header('Content-type: application/json');

        $response = CJSON::encode($data);

        if ($return) {
            return $response;
        }

        echo $response;
        Yii::app()->end();
    }

    public static function sendMailMessage($data) {
    	$email 		= $data['email'];
    	$subject 	= $data['subject'];
    	$message 	= $data['message'];

    	$headers  	 = 'MIME-Version: 1.0' . "\r\n";
        $headers 	.= 'Content-type: text/html; charset=utf8' . "\r\n";

        return mail($email, $subject, $message, $headers);
    }
} 