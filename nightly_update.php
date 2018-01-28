<?php
/**
 * Created by PhpStorm.
 * User: ATasker
 * Date: 1/27/18
 * Time: 2:55 PM
 */

include 'inc.php';

$api = new API();
$api->activate();

$seed = new Seed($api);
print_r($seed->seedDaily());