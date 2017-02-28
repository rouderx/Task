<?php
/**
 * Created by PhpStorm.
 * User: lvask
 * Date: 27.02.2017
 * Time: 19:06
 */

namespace App\Web;


use App\Core\Form;

/**
 * Class DeleteUserForm ktorá slúži na vymazanie zadaného používateľa
 * @package App\Web
 */
class DeleteUserForm extends Form
{
    protected $rules = [
        'security' => 'required|secure'
    ];

    /**
     * Funkcia, ktorá zavolá funkciu removeUserById od QueryBuilder na vymazanie používateľa s ID
     */
    public function persist()
    {
        $this->query->removeUserById($_GET['id']);
    }
}