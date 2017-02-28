<?php
/**
 * Created by PhpStorm.
 * User: lvask
 * Date: 24.02.2017
 * Time: 13:20
 */

require '../bootstrap.php';

use App\Web\DeleteUserForm;

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $form = new DeleteUserForm($query);

    if ($form->save())
    {
        $_SESSION['succ'] = "Používateľ s ID : {$_GET['id']} bol úspešne odstránený.";
        header('Location: ../administration.php');
        die();
    }
}

$result = $query->selectUserById($_GET['id']);

if(empty($result))
{
    header("Location: ../administration.php");
    die("empty");
}

require '../views/delete.view.php';

unset($_SESSION['errors']);