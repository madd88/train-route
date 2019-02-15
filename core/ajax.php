<?php

require_once "config.php";

$TrainSoapClient = new core\Classes\TrainSoapClient();

switch ($_REQUEST['action']){
    case 'getCities':
        echo json_encode($TrainSoapClient->getCities($_REQUEST['term']));
        break;
    case 'getRoute':

        $params = new \core\Entity\WsTrainTravelInfo(
            $_REQUEST['city_from_id'],
            $_REQUEST['city_ti_id'],
            date("d", strtotime($_REQUEST['date'])),
            date("m", strtotime($_REQUEST['date']))
        );

        echo json_encode($TrainSoapClient->getRoute($_REQUEST['train'],$params));
        break;
    default:
        echo json_encode(['oops']);
}