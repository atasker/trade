<?php
/**
 * Created by PhpStorm.
 * User: ATasker
 * Date: 1/27/18
 * Time: 1:23 PM
 */

require 'vendor/autoload.php';
require_once 'PriceData.php';

class Seed extends API {

    protected $api;

    public function __construct($api) {
        $this->api = $api;
    }

    /**
     * seedDaily
     * INSERT symbol, date, open, high, low, close, volume to daily table
     * Note: for all historic records, and for all symbols
     */

    public function seedDaily() {
        $conn = new DB();
        $priceData = new PriceData($this->api);
        $allPrices = $priceData->getAllPrices();
        foreach ($allPrices as $symbol => $price) {
            if (!ctype_digit($symbol)) {
                $dailyCandles = $priceData->candles($symbol, '1d');
                foreach ($dailyCandles as $date => $data) {
                    $unix_to_date = date("Y-m-d", $date / 1000);
                    $open = $data['open'];
                    $high = $data['high'];
                    $low = $data['low'];
                    $close = $data['close'];
                    $volume = $data['volume'];
                    $stmt = $conn->db->query("INSERT INTO daily (symbol, date, open, high, low, close, volume) VALUES ('$symbol', '$unix_to_date', '$open', '$high', '$low', '$close', '$volume')");
                    if ($stmt) {
                        echo "Successful INSERT of $symbol => $date, $open, $high, $close, $volume" . PHP_EOL;
                    }
                }
            }
        }
    }

    /**
     * nightlyUpdate
     * INSERT symbol, date, open, high, low, close, volume to daily table
     * Note: inserts yesterdays daily data for all symbols
     */

    public function nightlyUpdate() {

    }

}