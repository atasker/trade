<?php

include 'inc.php';

$api = new API();
$api->activate();

//while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//    echo $row['open'].' '.$row['high'];
//}

$priceData = new PriceData($api);

//$allPrices = $priceData->getAllPrices();

$candles = $priceData->candles('ETHBTC', "1d");
//print_r($candles);
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