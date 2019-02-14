<?php
/**
 * Created by PhpStorm.
 * User: NiL
 * Date: 14.02.2019
 * Time: 18:25
 * WsTrainTravelInfo
 */


require_once "config.php";

require_once (__DIR__ . "/TrainSoapClient.php");

$TrainSoapClient = new TrainSoapClient();
$params = [
    'from' => '2024000',
    'to' => '2000000',
    'day'=> 18,
    'month' => 02,
    'time_dep' => null,
    'time_sw' => null,
    'time_from' => null,
    'time_to' => null
];
try{
    var_dump($TrainSoapClient->handler->trainRoute($TrainSoapClient->auth,'131У', $params));
}
catch (SoapFault $exception){
    var_dump($exception->getMessage());
}
