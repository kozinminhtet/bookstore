<?php
include('vendor/autoload.php');

use Libs\Database\MySQL;
use Libs\Database\UserTable;

$users = new UserTable(new MySQL());

print_r($users->all());

