<?php
/**
 * Created by PhpStorm.
 * User: lvask
 * Date: 24.02.2017
 * Time: 13:20
 */

require '../bootstrap.php';

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $form = new \App\Web\EditUserForm($query);
    if ($form->save())
    {
        $_SESSION['succ'] = "User with ID : {$_GET['id']} successfully changed.";
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

require '../views/edit.view.php';