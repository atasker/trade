<?php

require 'vendor/autoload.php';
require 'classes/API.php';
require 'classes/PriceData.php';
require 'classes/Oscillator.php';

error_reporting(E_ALL);

$api = new API();
$api->activate();

$priceData = new PriceData($api);

$allPrices = $priceData->getAllPrices();

$candles = $priceData->candles('ETHBTC', "1d");
$oscillator = new Oscillator();
$rsi = $oscillator->RSI($candles, 14);
echo $rsi;

//foreach ($allPrices as $symbol => $price) {
//    $candles = $priceData->candles($symbol, "1d");
//    $oscillator = new Oscillator();
//    $oscillator->SMA($candles, 20);
//    $rsi = $oscillator->RSI($candles, 14);
//    echo $symbol . " RSI = " . $rsi . PHP_EOL;
//}

//eval(\Psy\sh());

//echo $priceData->getCurrentPrice('XLMETH');