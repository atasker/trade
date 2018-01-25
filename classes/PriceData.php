<?php
/**
 * Created by PhpStorm.
 * User: ATasker
 * Date: 1/21/18
 * Time: 12:39 PM
 */

require 'vendor/autoload.php';

class PriceData extends \Binance\API {

    protected $api;

    public function __construct($api) {
        $this->api = $api;
    }

    public function getAllPrices() {
        $ticker = $this->api->prices();
        return $ticker;
    }

    public function getCurrentPrice($symbol) {
        $ticker = $this->getAllPrices();
        return $ticker[ $symbol ] . PHP_EOL;
    }

    //Periods: 1m,3m,5m,15m,30m,1h,2h,4h,6h,8h,12h,1d,3d,1w,1M
    public function candles($symbol, $timeframe) {
        $ticks = $this->api->candlesticks($symbol, $timeframe);
        return $ticks;
    }

}