<?php

namespace core\Entity;


class WsAuth
{
    function __construct($login, $psw, $terminal, $represent_id) {

        $this->login        = $login;
        $this->psw          = $psw;
        $this->terminal     = $terminal;
        $this->represent_id = $represent_id;

    }

}