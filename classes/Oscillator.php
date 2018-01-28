<?php
/**
 * Created by PhpStorm.
 * User: ATasker
 * Date: 1/21/18
 * Time: 1:24 PM
 */

require 'vendor/autoload.php';

class Oscillator {

    /**
     * SMA Simple Moving Average
     * @param array $candles open, high, low, close, volume
     * @param int $timeframe
     * @return float
     */

    //TODO: modify RSI to return rounded numbers, check binance for what they use

    public function SMA($candles, $timeframe) {
        if (count($candles) < $timeframe) {
            echo "Not enough available data for the " . $timeframe . " SMA, using max available: " . count($candles) . PHP_EOL;
            $timeframe = count($candles);
        }
        $adjusted_timeframe = $timeframe + 1;
        // reducing the array to the user requested time period
        $subset = array_slice($candles, -$adjusted_timeframe);
        // removing current candle from array (as we don't have closing data on this yet)
        array_pop($subset);
        $closing_prices = [];
        foreach ($subset as $index => $data) {
            array_push($closing_prices, $data['close']);
        }
        $closing_prices_sum = array_sum($closing_prices);
        $s_m_a = $closing_prices_sum / $timeframe;
        return round($s_m_a, 4);
    }

    /**
     * MACD Moving average convergence divergence
     * Trend following momentum indicator that shows the relationship between two moving averages of prices
     * @param array $candles open, high, low, close, volume
     * @return undefined
     */

    public function MACD($candles) {
        return "this is the MACD";
    }

    /**
     * RSI Relative Strength Index
     * Formula to predict if an asset is overbought or oversold
     * @param array $candles open, high, low, close, volume
     * @param int $timeframe Unit of time
     * @return int
     */

    //TODO: RSI function returning substantially different values to Binance calculations

    public function RSI($candles, $timeframe) {
        if (count($candles) < $timeframe) {
            echo "Not enough available data for the " . $timeframe . " RSI, using max available: " . count($candles) . PHP_EOL;
            $timeframe = count($candles);
        }
        $adjusted_timeframe = $timeframe + 2;
        // reducing the array to the user requested time period
        $subset = array_slice($candles, -$adjusted_timeframe);
        // removing current candle from array (as we don't have closing data on this yet)
        array_pop($subset);
        $gains = $this->getGains($subset);
        $losses = $this->getLosses($subset);
        $avg_up = ($gains > 0 ? $gains / $timeframe : 0);
        $avg_down = ($losses > 0 ? $losses / $timeframe : 0);
        $relative_strength = ($avg_up > 0 && $avg_down > 0 ? $avg_up / $avg_down : 0);
        if ($relative_strength != 0) {
            $r_s_i = 100 - 100 / (1 + $relative_strength);
        } else {
            $r_s_i = 0;
        }
        return round($r_s_i);
    }

    /**
     * getGains
     * Given a number of candles, return number of times a candle closed higher than the last
     * @param array $prices open, high, low, close, volume
     * @return int
     */

    private function getGains($prices) {
        $ups = 0;
        foreach ($prices as $index => $data) {
            if ($index != 0) {
                if ($data['close'] > $prices[$index - 1]['close']) {
                    $ups = $ups + 1;
                }
            }
        }
        return $ups;
    }

    /**
     * getLosses
     * Given a number of candles, return number of times a candle closed lower than the last
     * @param array $prices open, high, low, close, volume
     * @return int
     */

    private function getLosses($prices) {
        $downs = 0;
        foreach ($prices as $index => $data) {
            if ($index != 0) {
                if ($data['close'] < $prices[$index - 1]['close']) {
                    $downs = $downs + 1;
                }
            }
        }
        return $downs;
    }

}