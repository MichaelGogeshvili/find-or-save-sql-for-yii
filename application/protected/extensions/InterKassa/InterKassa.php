<?php

class InterKassa extends CApplicationComponent {

    /*
    * Shop ID
    */
    public $shopID = '';

    /*
     * Secret Key
     */
    public $secretKey = '';

    /*
     * Routes
     */
    public $routes = array();

    /*
     * Method
     */
    public $method = 'LINK';

    /*
     * Status Method
     */
    public $statusMethod = 'POST';

    /*
     * Payment gateway
     */
    public $paymentGateway = 'http://www.interkassa.com/lib/payment.php';

    /*
     * Get Secret Key
     */

    public function getSecretKey()
    {
        return $this->secretKey;
    }

    /*
     * Get Shop ID
     */

    public function getShopID()
    {
        return $this->shopID;
    }

    /*
     * Get gateway
     */

    public function getGateway()
    {
        return $this->paymentGateway;
    }

    /*
     * Get routes
     */

    public function getRoutes()
    {
        return $this->routes;
    }

    /*
     * Get form data
     */

    public function getFormData($amount, $payment_id, $description = '', $note = '')
    {
        $data = array(
            'amount' => $amount,
            'payment_id' => $payment_id,
            'description' => $description,
            'note' => $note,
        );
        return $this->formData($data);
    }

    /*
     * Generate need data
     */

    public function formData($item = array())
    {
        $data = array(
            'ik_shop_id' => $this->shopID,
            'ik_payment_amount' => $item['amount'],
            'ik_payment_id' => $item['payment_id'],
            'ik_payment_desc' => $item['description'],
            'ik_baggage_fields' => $item['note'],
            'ik_success_url' => $this->fullLink($this->routes['successPage']),
            'ik_success_method' => $this->method,
            'ik_fail_url' => $this->fullLink($this->routes['failPage']),
            'ik_fail_method' => $this->method,
            'ik_status_url' => $this->fullLink($this->routes['statusPage']),
            'ik_status_method' => $this->statusMethod,
        );
        return $data;
    }

    /*
    * Validate received data
    */

    public function validateData($status_data = array())
    {
        if(isset($status_data['ik_sign_hash'])) {
            if($status_data['ik_shop_id'] == $this->shopID) {
                $sing_hash_str = $status_data['ik_shop_id'].':'.
                    $status_data['ik_payment_amount'].':'.
                    $status_data['ik_payment_id'].':'.
                    $status_data['ik_paysystem_alias'].':'.
                    $status_data['ik_baggage_fields'].':'.
                    $status_data['ik_payment_state'].':'.
                    $status_data['ik_trans_id'].':'.
                    $status_data['ik_currency_exch'].':'.
                    $status_data['ik_fees_payer'].':'.
                    $this->secretKey;
                $sign_hash = strtoupper(md5($sing_hash_str));
                if($status_data['ik_sign_hash'] === $sign_hash) {
                    return true;
                }
            }
        }
        return false;
    }

    /*
     * Generate full link
     */

    public function fullLink($url)
    {
        return Yii::app()->createAbsoluteUrl($url);
    }

}