<?php
/**
 * @file import.php
 * 
 */
 
//not direct access
defined('_iEXEC') or die();

class session
{
    var $name = 'default';
	
    function __constructor($name)
    {
        $this->name = $name;
    }
	
	function __destruct() {
		unset($this);
	}
	
    function set($setting,$value)
    {
        $_SESSION[$this->name][$setting] = $value;
    }
	
    function get($setting,$default='')
    {
        if(isset($_SESSION[$this->name][$setting]) && !empty($_SESSION[$this->name][$setting]))
            return $_SESSION[$this->name][$setting];
        else
            return $default;
    }
	
    function del($setting)
    {
        unset($_SESSION[$this->name][$setting]);
    }
	
	function destroy(){
		
		if(ini_get('session.use_cookies'))
		{
		  $params = session_get_cookie_params();
		  setcookie(session_name(), '', time() - 42000,
			$params['path'], $params['domain'],
			$params['secure'], $params['httponly']
		  );
		}
	 
		session_destroy();
	}
   
}

global $session;
if(class_exists('session'))
$session = new session;

/*
// Contoh Penggunaan:
include('classes/session.php');

$session = new session('Script');

// set & save data
$session->set('user','username');
$session->set('pass','********');

// panggil data
$user = $session->get('user');

// Clean retrieving of the data, with a default value.

$user = $session->get('user','username'); 

*/