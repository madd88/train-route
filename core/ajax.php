<?php

require_once "config.php";

$TrainSoapClient = new core\Classes\TrainSoapClient();

switch ($_REQUEST['action']){
    case 'getCities':
        echo json_encode($TrainSoapClient->getCities($_REQUEST['term']));
        break;
    case 'getRoute':
        $params = [
            'from' => $_REQUEST['city_from_id'],
            'to' => $_REQUEST['city_ti_id'],
            'day'=> date("d", strtotime($_REQUEST['date'])),
            'month' => date("m", strtotime($_REQUEST['date'])),
            'time_dep' => null,
            'time_sw' => null,
            'time_from' => null,
            'time_to' => null
        ];
        echo json_encode($TrainSoapClient->getRoute($_REQUEST['train'],$params));
        break;
    default:
        echo json_encode(['oops']);
}