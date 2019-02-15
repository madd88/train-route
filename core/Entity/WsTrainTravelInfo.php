<?php

namespace core\Entity;

class WsTrainTravelInfo
{

    function __construct($from, $to, $day, $month)
    {
        $this->from      = $from;
        $this->to        = $to;
        $this->day       = (int)$day;
        $this->month     = (int)$month;
        $this->time_dep  = null;
        $this->time_sw   = null;
        $this->time_from = null;
        $this->time_to   = null;
    }


}