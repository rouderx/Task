<?php
/**
 * Created by PhpStorm.
 * User: vasko
 * Date: 27.02.2017
 * Time: 16:32
 */
namespace App\Web;

use App\Core\Form;

/**
 * Class NewUserForm ktorá slúži na pridanie nového používateľa
 * @package App\Web
 */
class NewUserForm extends Form
{
    protected $rules = [
        'name' => 'required',
        'surname' => 'required',
        'pass' => 'required|min:6',
        'age' => 'required|numeric',
        'city' => 'required|max:30',
        'security' => 'required|secure'
    ];

    /**
     * Funkcia, ktorá zavolá funckiu insert od QueryBuilder na pridanie nového používateľa do tabuľky
     */
    public function persist()
    {
        $age = str_replace(['-','+','.'],"",$this->request['age']);
        $name = filter_var($this->request['name'],FILTER_SANITIZE_SPECIAL_CHARS);
        $surname = filter_var($this->request['surname'],FILTER_SANITIZE_SPECIAL_CHARS);
        $city = filter_var($this->request['city'],FILTER_SANITIZE_SPECIAL_CHARS);
        $pass = password_hash($this->request['pass'],PASSWORD_DEFAULT);

        $this->query->insert('users',['name'=>$name,'surname'=>$surname,'pass'=>$pass,'age'=>$age,'city'=>$city]);
    }

}