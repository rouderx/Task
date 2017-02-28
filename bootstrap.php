<?php
/**
 * Created by PhpStorm.
 * User: lvask
 * Date: 26.02.2017
 * Time: 10:55
 */

session_start();

require 'core/Form.php';
require 'core/Validator.php';
require 'core/database/Database.php';
require 'core/database/QueryBuilder.php';
require 'forms/NewUserForm.php';
require 'forms/DeleteUserForm.php';
require 'forms/EditUserForm.php';

use App\Core\Database\Database;
use App\Core\Database\QueryBuilder;

$config = require('core/database/cnf.php');

$query = new QueryBuilder(Database::make($config['database']));