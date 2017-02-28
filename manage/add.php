<?php
/**
 * Created by PhpStorm.
 * User: lvask
 * Date: 23.02.2017
 * Time: 21:00
 */

require '../bootstrap.php';

use App\Web\NewUserForm;

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $form = new NewUserForm($query);

    if($form->save())
    {
        $_SESSION['succ'] = "Používateľ úspešne pridaný.";
        header('Location: ../administration.php');
        die();
    }
}

require '../views/add.view.php';

unset($_SESSION['errors']);



