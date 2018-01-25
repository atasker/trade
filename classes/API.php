<?php
/**
 * Created by PhpStorm.
 * User: ATasker
 * Date: 1/21/18
 * Time: 3:36 AM
 */

require 'vendor/autoload.php';

class API extends \Binance\API {

    protected $api_key;
    protected $api_secret;

    public function __construct() {
        $this->api_key = '';
        $this->api_secret = '';
    }

    public function activate() {
        $api = new Binance\API($this->api_key,$this->api_secret);
        return $api;
    }

}