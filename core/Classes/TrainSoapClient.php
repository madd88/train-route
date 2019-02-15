<?php

namespace core\Classes;

use core\Entity\WsAuth;
use core\Entity\WsTrainTravelInfo;

class TrainSoapClient
{
    public $handler = null;

    public $wsdl = "https://api.starliner.ru/Api/connect/TrainAPI?wsdl";

    private $auth;

    public function __construct()
    {
        $this->auth = new WsAuth(LOGIN, PASSWD, TERMINAL, REPRESENT);
        $this->handler = new \SoapClient($this->wsdl);
    }

    /**
     * Получаем список гороодов по названию
     *
     * @param string $filter - имя города. Не зависит от регистра
     *
     * @return array - массив городов id=>value
     */

    public function getCities($filter = "")
    {

        $cityList = $this->handler->getCities($this->auth, $filter);

        return $cityList->list;

    }

    public function getRoute($train, WsTrainTravelInfo $params){

        try{
            $result = $this->handler->trainRoute($this->auth, $train, $params);
        }

        catch (\SoapFault $exception){
            $result = ['error' => $exception->getMessage()];
        }

        return $result;
    }

}