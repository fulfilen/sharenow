<?php
require __DIR__ . '/init.php';

if (userIsLoggedIn()) Redirect::to('index.php');
exit();

