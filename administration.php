<?php
/**
 * Created by PhpStorm.
 * User: lvask
 * Date: 22.02.2017
 * Time: 22:38
 */
    require 'bootstrap.php';

    $result = $query->selectAll('users');

    require 'views/administration.view.php';

    unset($_SESSION['succ']);