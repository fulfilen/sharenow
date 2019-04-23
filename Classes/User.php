<?php

namespace Classes\Model;

use Classes\Core\Config;
use Classes\Core\Session;
use Classes\Core\Cookie;
use Classes\Core\Hash;
use Exception;


class User 
{
    private $_dbh,
            $_data,
            $_session_name,
            $_cookie_name,
            $_isLoggedIn;

    public function __construct($user = null) 
    {
        $this->_dbh = Database::instance();

        if(is_null($user)) {

            if(Session::has(Config::get('user/id'))){

                $user = Session::get(Config::get('user/id'));

                if($this->find(Session::get(Config::get('user/id')))) {

                    $this->_isLoggedIn = true;
                } else {

                    //Logout
                }
            }
        } else {

            $this->find($user);
        }

        return $this;
    }

    public function createNew(array $fields) 
    {
        if(! $this->_dbh->insert('users', $fields)) {

            throw new Exception('System Error:: There was a problem creating your account!!!');
        } 
        return true;
    }

    public function update(array $fields, $id = '') 
    {
        if(! $id && $this->isLoggedIn()) {
            $id = $this->data()->id;
        }

        if(! $this->_dbh->update('user', $id, $fields)) {
            throw new Exception('System Error:: There was a problem updating your account');
        }
    }

    public function find($user = null) 
    {
        $field = (is_numeric($user)) ? 'user_id' : 'user_username';

        $data = $this->_dbh->get('users', array($field, '=', $user));

        if($data->rowCount()) {

            $this->_data = $data->result();
            return true;
        }
        return false;
    }

   public function login($username, $password, bool $remember = false) 
   {
        if(! $username && !$password && User::exists()) {

            Session::put(Config::get('user/id'), User::data()->id);
        } else {

            $user = User::find($username);
            if ($user) {

                if (Hash::verify($password, User::data()->password)) {

                    Session::put(Config::get('user/username'),  User::data()->username);
                    Session::put(Config::get('user/id'),    User::data()->id);

                    if ($remember) {
                        
                        $hash_check = $this->_dbh->get('session', array('user_id', '=', User::data()->id));

                        if (! $hash_check->rowCount()) {

                            $this->_dbh->insert('session', array('user_id' => User::data()->id,'hash' => Hash::generateRandToken()));
                        } else {

                            $hash = $hash_check->result()->hash;
                        }    
                        Cookie::put(Config::get('cookie/name'), $hash, Config::get('cookie/expiry')); 
                    }

                    return true;
                }
            }
        }
        return false;
    }

    public function hasPermission($key) 
    {
        $group = $this->_dbh->get('group', array('id', '=', User::data()->group_id));
        if ($group->rowCount())
        {
            $permissions = json_decode($group->data()->permissions, true);

            return !empty($permissions[$key]);
        }

        return false;
    }

    public function exists() 
    {
        return (!empty($this->_data)) ? true : false;
    }

    public function isAdmin()
    {
        if (userIsLoggedIn()) {
            return $this->data()->role > 0;
        }
        
    }

    public function logout() 
    {
        Session::delete(Config::get('user/id'));
        Session::delete(Config::get('user/username'));

        Cookie::delete(Config::get('cookie/name'));
        //$this->_dbh->delete('session', array('user_id', '=', $this->data()->id));
    }

    public function data()
    {
        return $this->_data;
    }

    public function isLoggedIn() 

    {
        return $this->_isLoggedIn;
    }

    public function info($field, $column, $data) 

    {
        return $this->_dbh->query('SELECT $field FROM users WHERE $column = ?', array($data));
    }

    
}