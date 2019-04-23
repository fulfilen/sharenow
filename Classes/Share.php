<?php

class Share{

    public static function allFiles() {
        return  $db->get('file')->resetSet();
    }

    public static function registerUser(array $fields){

    	return $db->insert('users', $fields);
    }

}