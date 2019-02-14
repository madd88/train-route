<?php

class TrainSoapClient extends SoapClient
{
    public $handler = null;

    public $wsdl = "https://api.starliner.ru/Api/connect/TrainAPI?wsdl";

    public $auth = [
        'login'        => 'test',
        'psw'          => 'bYKoDO2it',
        'terminal'     => 'htk_test',
        'represent_id' => '22400'
    ];

    public function __construct()
    {
        $this->handler = new SoapClient($this->wsdl, $this->auth);

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

    public function getRoute($train,$params){

        try{
            $result = $this->handler->trainRoute($this->auth, $train, $params);
        }

        catch (SoapFault $exception){
            $result = ['error' => $exception->getMessage()];
        }

        return $result;
    }

}