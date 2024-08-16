<?php

namespace core;

use RedBeanPHP\R;

class Db
{
    use TSingleton;

    private function __construct()
    {
        $db = require_once CONFIG . '/db.php';
        R::setup($db['dsn'], $db['username'], $db['password']);
        if (!R::testConnection()) {
            throw new \Exception("No connection to DB", 500);
        }
        R::freeze(true);
        if (DEBUG) {
            R::debug(true, 3);
        }
        R::ext('xdispense', function( $type ){ 
            return R::getRedBean()->dispense( $type ); 
        });
    }
}