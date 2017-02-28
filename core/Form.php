<?php
/**
 * Created by PhpStorm.
 * User: lvask
 * Date: 27.02.2017
 * Time: 16:32
 */
namespace App\Core;

/**
 * Class Form
 * @package App\Core
 * Abstraktná trieda, ktorá slúži na prácu s formulármi
 */
abstract class Form
{
    protected $request;
    protected $query;
    protected $rules = [];

    /**
     * Form constructor.
     * @param $query Identifikátor queryBuilder
     * @param null $request Pole zadaných údajov z formulára
     */
    public function __construct($query,$request = null)
    {
        $this->request = $request ?: $_POST;
        $this->query = $query;
    }

    /**
     * @return mixed
     * Abstraktná funkcia na prácu s databázou
     */
    abstract public function persist();

    /**
     * @return bool
     * Funkcia, ktorá skontroluje či je input valídny a následne zavolá metódu persist()
     */
    public function save()
    {
        if($this->isValid())
        {
            $this->persist();
            return true;
        }
        return false;
    }

    /**
     * @return bool Vráti či je input valídny.
     */
    protected function isValid()
    {
        return Validator::required($this->request,$this->rules);
    }
}