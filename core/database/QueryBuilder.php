<?php

/**
 * Created by PhpStorm.
 * User: lvask
 * Date: 23.02.2017
 * Time: 19:38
 */
namespace App\Core\Database;

/**
 * Class QueryBuilder
 * @package App\Core\Database
 * Trieda, ktorá vykonáva operácie spojené s databázou
 */
class QueryBuilder
{
    protected $conn;

    /**
     * QueryBuilder constructor.
     * @param $pdo
     */
    public function __construct($pdo)
    {
        $this->conn = $pdo;
    }

    /**
     * Metóda, ktorá vráti všetky riadky zo zadanej tabuľky
     * @param $table Obsahuje názov tabuľky
     * @return mixed Vracia nájdené riadky z tabuľky
     */
    public function selectAll($table)
    {
        try
        {
            $sth = $this->conn->prepare("SELECT * FROM {$table}");
            $sth->execute();
            return $sth->fetchAll(\PDO::FETCH_CLASS);
        }
        catch (\PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }

    }

    /**
     * Metóda, ktorá hľadá používateľa so zadaným ID
     * @param $id Id hľadaného používateľa
     * @return mixed Vracia nájdeného používateľa, alebo null ak nenašlo žiadneho
     */
    public function selectUserById($id)
    {
        try {
            $sth = $this->conn->prepare("SELECT * FROM users WHERE id = :id");
            $sth->bindParam(':id',$id);
            $sth->execute();
            return $sth->fetchAll(\PDO::FETCH_CLASS);
        }
        catch (\PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
    }

    /**
     * Metóda, ktorá vkladá údaje do tabuľky
     * @param $table Tabuľka do ktorej budem vkladať
     * @param $param Pole údajov, ktoré chcem vložiť do tabuľky
     */
    public function insert($table,$param)
    {
        try {
            $sql = sprintf("INSERT INTO %s (%s) VALUES (:%s)",
                $table,
                implode(",",array_keys($param)),
                implode(",:",array_keys($param)));
            $sth = $this->conn->prepare($sql);
            $sth->execute($param);
        }
        catch (\PDOException $e)
        {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    /**
     * Metóda, ktorá odstraňuje používateľov z tabuľky
     * @param $id Id používateľa
     */
    public function removeUserById($id)
    {
        try
        {
            $sql = "DELETE FROM users WHERE id = :id";
            $sth = $this->conn->prepare($sql);
            $sth->bindParam('id',$id);
            $sth->execute();
        }
        catch (\PDOException $e)
        {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    /**
     * Metóda, ktorá upravuje údaje používateľov
     * @param $data Pole údajov, ktoré majú byť upravené.
     * @param $id ID používateľa, ktorý bude upravený.
     */
    public function updateUserById($data,$id)
    {
        $pom = "";
        $numItems = count($data);
        $i = 0;
        foreach ($data as $key => $val)
        {
            $pom .= "{$key}='{$val}'";

            if(++$i !== $numItems) {
                $pom .= ",";
            }

        }

        try
        {
            $sql = "UPDATE users SET {$pom} WHERE id=:id";
            $sth = $this->conn->prepare($sql);
            $sth->bindParam('id',$id);
            $sth->execute();
        }
        catch (\PDOException $e)
        {
            echo $sql . "<br>" . $e->getMessage();
        }
    }
}