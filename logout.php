<?php
require __DIR__ . '/init.php';

if (userIsLoggedIn()):
	Session::delete();
	Session::destroy();
	Redirect::to('index.php');
 else: 
	Redirect::to('index.php');
endif;
