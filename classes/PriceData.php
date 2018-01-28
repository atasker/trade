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

    /**
     * getAllprices
     * Note: returns current price data for all symbols
     * @return array e.g ('ETHBTC' => 0.000213, 'XLMETH' => 0.003345)
     */

    public function getAllPrices() {
        $ticker = $this->api->prices();
        return $ticker;
    }

    /**
     * getCurrentPrice
     * Note: returns current price data for desired symbol
     * @return string e.g (0.003345)
     */

    public function getCurrentPrice($symbol) {
        $ticker = $this->getAllPrices();
        return $ticker[ $symbol ] . PHP_EOL;
    }

    /**
     * candles
     * Note: returns price data for desired timeframe and symbol
     * Note: accepted timeframes (1m,3m,5m,15m,30m,1h,2h,4h,6h,8h,12h,1d,3d,1w,1M)
     * @return array
     */

    public function candles($symbol, $timeframe) {
        $ticks = $this->api->candlesticks($symbol, $timeframe);
        // Removing current candle (hasn't closed yet)
        array_pop($ticks);
        return $ticks;
    }

}