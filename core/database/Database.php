<?php
/**
 * Created by PhpStorm.
 * User: lvask
 * Date: 22.02.2017
 * Time: 20:09
 */
namespace App\Core\Database;

/**
 * Class Database
 * @package App\Core\Database
 * Trieda, ktorá vytvára pripojenie k databáze
 */
class Database{
    /**
     * @param $config Obsahuje údaje potrebné pre pripojenie k databáze
     * @return \PDO Vracia identifikátor pripojenia
     */
    public static function make($config)
    {
        try {
            return new \PDO($config['dbhost'].';dbname='.$config['dbname'],$config['dbuser'],$config['dbpass'],$config['options']);
        }
        catch(\PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }
    }

}

