<?php

class dataBase {
    public static function connect($host = 'localhost', $user = 'root', $pwd = '12345', $db = 'RESTAURANTE', $port = '3307') {
        $con = new mysqli($host, $user, $pwd, $db, $port);
        if ($con == false) {
            die('DATABASE ERROR');
        } else {
            return $con;
        }
    }
}
