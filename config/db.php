<?php

/**
 * @author Chetan Patel <cpjeslot@gmail.com>>
*/

$servername = 'localhhost';
$port = '3600';
$databse = 'database_name';
$username = 'username';
$password = 'password';

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host='.$servername.';port='.$port.';dbname=' . $databse,
    'username' => $username,
    'password' => $password,
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
