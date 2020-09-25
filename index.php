<?php

require './vendor/autoload.php';
use Jzb\Request;
$request = new Request();
var_dump($request->getDeviceToken());