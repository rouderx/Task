<?php
/**
 * Created by PhpStorm.
 * User: lvask
 * Date: 27.02.2017
 * Time: 20:18
 */

namespace App\Web;

use App\Core\Form;

/**
 * Class EditUserForm ktorá slúži na úpravu používateľov
 * @package App\Web
 */
class EditUserForm extends Form
{
    protected $rules = [
        'name' => 'required',
        'surname' => 'required',
        'age' => 'required|numeric',
        'city' => 'required|max:30',
        'security' => 'required|secure'
        ];

    private $contain = false;

    /**
     * EditUserForm constructor v ktorom sa okrem dedeného konštruktora skontroluje, či bolo zmenené heslo používateľa
     * @param \App\Core\Identifikátor $query - objekt QueryBuilder
     * @param null $request - pole údajov
     */
    public function __construct($query, $request = null)
    {
        parent::__construct($query, $request);
        if (!empty($this->request['pass']))
        {
            $this->rules += ['pass' => 'required|min:6'];
            $this->contain = true;
        }
    }

    /**
     * Funkcia, ktorá zavolá funkciu updateUserById od QueryBuilder na aktualizovanie používateľa s ID
     */
    public function persist()
    {
        if (!$this->contain)
        {
            $this->request['pass'] = $this->query->selectUserById($this->request['id'])[0]->pass;
        }
        else
        {
            $this->request['pass'] = password_hash($this->request['pass'],PASSWORD_DEFAULT);
        }

        $this->request['age'] = str_replace(['-','+','.'],"",$this->request['age']);
        $this->request['name'] = filter_var($this->request['name'],FILTER_SANITIZE_SPECIAL_CHARS);
        $this->request['surname'] = filter_var($this->request['surname'],FILTER_SANITIZE_SPECIAL_CHARS);
        $this->request['city'] = filter_var($this->request['city'],FILTER_SANITIZE_SPECIAL_CHARS);

        unset($this->request['id'],$this->request['security'],$this->request['submit']);
        $this->query->updateUserById($this->request,$_POST['id']);
    }
}