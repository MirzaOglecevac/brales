<?php

namespace Brales\Core\Database;

use PDO;

class PDOCompat extends PDO
{

    public function __construct()
    {
        // TODO
    }

    /**
     * COnnect to database
     * @param $config
     * @return PDO|string
     */
    public function connect($config)
    {
        try{
            $connection = new PDO('mysql:host='.$config['db_host'].';dbname='.$config['db_name'],$config['db_user'],$config['db_password']);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false );
        }catch(PDOException $e) {
            return $e->getMessage();
        }
        return $connection;
    }

}