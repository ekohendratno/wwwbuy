<?php
/**
 * @file access.php
 * 
 */
 
//not direct access

defined('_iEXEC') or die();

class access
{ 
	function timer(){
		global $session;			
		$session->set('iexec', (time() + get_option('timeout')));
	}

	function login_out(){
		global $session;
		$session->destroy();
		redirect('?login');
	}
	
	function username_cek($data){
		global $iw,$db;
		$query	= $db->select('users',$data);
		if($query){
			$row 	= $db->fetch_array($query);
			$cek   	= $db->num($query);
			return array('row'=>$row,'num'=>$cek);
		}
	}
	
	function set_login($username, $password){
		$user_login = esc_sql( $username );
		$user_pass  = esc_sql( $password );
		if( !empty($password) )	
		$user_pass  = md5($password);
		else $user_pass  = '';
		
		$userdata = compact('user_login', 'user_pass');
		$this->filter_log($userdata);
	}	
	
	function save_log($data){
		global $iw,$db,$session;
		extract($data, EXTR_SKIP);
		
		if($data['num'] == 0){
			if(!$msg)
			$msg	= 'Invalid username. <a href="?login&go=lostpass">Lost your password?</a>';
		}else{
			$session->set('user_name', $data['user_login']);
			$session->set('user_level', $data['user_level']); 
			$session->set('iexec', 1); 
					
			$this->timer();	
			$user_last_update = date('Y-m-d H:i:s');
			
			$data_user = array('user_login'=>$data['user_login'],'user_level'=>$data['user_level']);
			$db->update( 'users', compact( 'user_last_update' ), $data_user );
			
			if($data['user_level'] == 'admin') redirect('?admin');
			else redirect('?login');
		}
	}
	
	function filter_log($userdata){
		global $iw,$db;
		extract($userdata, EXTR_SKIP);
	
		if( empty( $user_login ) ) 	
			$msg	= 'The username field is empty.';
		if( empty( $user_pass ) ) 	
			$msg	= 'The password field is empty.';
		
		if( empty( $user_login ) && empty( $user_pass ) ) {
			$msg	= ''; 
		}else {
			if( valid_mail($user_login) )
			{
				$user_email = $user_login;
				$row = $this->username_cek( compact('user_email','user_pass') + array('user_status'=>1) );
				
				$data = array('num'=>$row['num'],'user_login'=>$row['row']['user_login'],'user_level'=>$row['row']['user_level']);
				$this->save_log($data);
			}
			else
			{			
				$row = $this->username_cek( $userdata + array('user_status'=>1) );
				
				$data = array('num'=>$row['num'],'user_login'=>$row['row']['user_login'],'user_level'=>$row['row']['user_level']);
				$this->save_log($data);
			}
		}
		
		if( isset($msg)  && !empty($msg)) 
		_e('<div id="error"><strong>ERROR</strong>: '.$msg.' </div>');
	}
	
	function login_level($param){
		global $session;
		if(is_string($param) && !empty($param))
		if( $session->get('user_level') == $param ) {
			return true;
		}else{
			return false;
		}
	}

	function cek_login(){
		global $session;
		$sess = $session->get('user_name');
		if( isset($sess) && !empty ($sess) ){
				if( time() < $session->get('iexec') ){
					$this->timer();
				}else{
					$this->login_out();
				}
			return true;
		}
		else
		{
			return false;
		}
	}

	function create_user($userdata,$more=false){
		header("Cache-Control: no-cache, no-store, must-revalidate");
		extract($userdata, EXTR_SKIP);
		$user_login 	= esc_sql( $username 	);
		$user_email 	= esc_sql( $email    	);
		$user_sex		= esc_sql( $sex		 	);
		$user_author	= esc_sql( $author	 	);
		
		$userdata = compact('user_login', 'user_email','user_author', 'user_sex');
		$this->set_users($userdata,$more);
	}
	
	function update_user($userdata,$more = null){
		extract($userdata, EXTR_SKIP);
		$user_id 		= esc_sql( $user_id 	);
		$user_login 	= esc_sql( $username 	);
		$user_email 	= esc_sql( $email    	);
		$user_sex		= esc_sql( $sex		 	);
		$user_author	= esc_sql( $author	 	);
		
		$userdata = compact('user_login', 'user_email', 'user_sex','user_author', 'user_id');
		$this->set_users($userdata,$more);
	}
	
	function valid_username($input,$pattern = '[^A-Za-z0-9]'){

	  return !ereg($pattern,$input);
	//return preg_match('!^[a-z0-9_~]{1,30}$!i', $param);
	}
	
	function change_password($data,$id){	
		global $iw, $db;	
		$user_last_update	= date('Y-m-d H:i:s');	
		return $db->update( 'users', $data + compact('user_last_update'),$id );	
	}
	
	function set_users($userdata,$more=false){
		global $iw,$db;
		extract($userdata, EXTR_SKIP);
		if ( isset($user_id) ) {
			$ID 	= (int) $user_id;
			$update = true;
		} else {
			$update = false;
		}	
		
		$msg = array();
		if( empty( $user_login ) ){
			$msg[] = '<strong>ERROR</strong>: The username field is empty.';
		}else{
			$field = $this->username_cek( compact('user_login') );
			if($field['num'] > 0 && !$update) $msg[] = '<strong>ERROR</strong>: Invalid username. silahkan ganti username "'.$user_login.'" dengan yang lain</a>';
		}
		
		if ( $update ) 
		if( empty($user_author) ) $msg[] = '<strong>ERROR</strong>: The author name is empty';
		
		if( !$this->valid_username($user_login) ) $msg[] = '<strong>ERROR</strong>: The username not valid';
		
		if( empty( $user_email ) ){
			$msg[] = '<strong>ERROR</strong>: The email field is empty.';
		}else{
		if( !valid_mail( $user_email ) ){	
			$msg[] = '<strong>ERROR</strong>: The email not valid.';
		}else{
			$field = $this->username_cek( compact('user_email') );
			if($field['num'] > 0 && !$update) $msg[] = '<strong>ERROR</strong>: Invalid email. email sudah pernah melakukkan registrasi</a>';
		}}
		if( empty($user_sex) ) $msg[] = '<strong>ERROR</strong>: The sex field not select.';
		if( $user_sex == 1 ) $user_sex = 0;
		elseif( $user_sex == 2 ) $user_sex = 1;
			
		$send_insert = true;
		if( is_array($msg))	{
			foreach($msg as $val){
				$send_insert = false;
				_e('<div id="error">'.$val.' </div>');
			}
		}
		
		if(empty($msg)){
		if ( $update ) {
			extract($more, EXTR_SKIP);
			$user_country 	= esc_sql($country);
			$user_province 	= esc_sql($province);
				
			if(!empty($level))		
			$user_level 	= esc_sql($level);	
			else
			$user_level 	= 'user';	
					
			$user_status	= esc_sql($status);
			if( $user_status == 1 ) $user_status = 0;
			elseif( $user_status == 2 ) $user_status = 1;
			
			$user_last_update	= date('Y-m-d H:i:s');
			
			$data = compact('user_login','user_email','user_author','user_sex','user_last_update','user_status','user_country','user_province','user_level');
			
			$userupdate = $db->update( 'users', $data, compact( 'ID' ) );
			if($userupdate) _e('<div id="success">The Account success to edit</div>');
			
		} else {
			if($send_insert){
			$user_activation_key 	= random_password(20, false);
			$user_registered 		= date('Y-m-d H:i:s');
			$user_last_update 		= $user_registered;
			$user_level 			= 'user';
			
			if(!$more){
				$data = compact('user_login','user_author','user_email','user_sex','user_registered','user_last_update','user_level','user_activation_key');			
				$userinsert = $db->insert( 'users', $data );
				if($userinsert){
					$user_data = compact('user_email','user_activation_key');
					$this->message_activation($user_data);
				}
			}else{
				extract($more, EXTR_SKIP);
				$user_pass 		= esc_sql($pass);
				$user_level 	= esc_sql($level);
				$user_country 	= esc_sql($country);
				$user_status 	= esc_sql($status);
				
				if( $user_status == 1 ) $user_status = 0;
				elseif( $user_status == 2 ) $user_status = 1;
				
				$data 		= compact('user_login','user_author','user_email','user_pass','user_sex','user_registered','user_last_update','user_status','user_login','user_country','user_activation_key');	
				$userinsert = $db->insert( 'users', $data );	
				if($userinsert){
					$user_data = compact('user_email','user_activation_key');
					$this->message_activation($user_data);
				}
			}
				if($userinsert) _e('<div id="success">The Account success to add</div>');
			}
		}}
			
	}
	
	function message_activation($data){	
		global $iw;
		extract($data, EXTR_SKIP);	
				
		$head  = 'Activation Registration<br><br>';
		$send .= '<b>'.$head.'</b><br>';
		$send .= 'Seseorang telah mendaftarkan akun email anda di <a href="'.$iw->base_url.'">'.$iw->base_url.'</a><br><br>';
		$send .= sprintf('Your Email: %s', $user_email) . "<br>";
		$send .= sprintf('Activation Code: %s', $user_activation_key) . "<br>";
		$send .= 'Tautan aktivasi : <a target="_blank" href="'.$iw->base_url.'index.php?login&go=activation&keys='.$user_activation_key.'">'.$iw->base_url.'index.php?login&go=activation&keys='.$user_activation_key.'"</a><br><br>';
		$send .= 'Ini adalah email otomatis, diharapkan tidak membalas email ini<br>';
		
		if(mail_send($user_email, $head, $send))
		_e('<p class="message">Link aktivasi telah dikirim ke email anda, silahkan melakukan aktivasi</p>');
		else _e('<div id="error"><strong>ERROR</strong>: There are some glitches in the process of sending a message.</div>');
	}
	
	function message_reg($data){	
		global $iw;
		extract($data, EXTR_SKIP);	
		
		$head  = 'Account Data Registration<br><br>';
		$send .= '<b>'.$head.'</b><br>';
		$send .= 'Akun anda sudah diaktifkan berikut data datanya<br><br>';
		$send .= sprintf('Email: %s', $email) . "<br>";
		$send .= sprintf('User Name: %s', $login) . "<br>";
		$send .= sprintf('Password: %s', $new_pass) . "<br>";
		$send .= sprintf('Jenis Kelamin: %s', $user_sex) . "<br>";
		$send .= 'Country: Unknow (please change)<br>';
		$send .= 'Province: Unknow (please change)<br><br>';
		$send .= 'Silahkan kunjungi website : <a target="_blank" href="'.$iw->base_url.'">'.$iw->base_url.'"</a> dan ubah profile kamu<br><br>' ;
		$send .= 'Ini adalah email otomatis, diharapkan tidak membalas email ini<br>';
		
		if(mail_send($email, $head, $send))
		_e('<p class="message">Akun dan Sandi telah dikirim ke email anda, silahkan login</p>');
		else _e('<div id="error"><strong>ERROR</strong>: There are some glitches in the process of sending a message.</div>');
	}
	
	function message_lost($data){	
		global $iw;
		extract($data, EXTR_SKIP);	
				
		$head  = 'Your Account Data<br><br>';
				
		$send .= '<b>'.$head.'</b><br>';
		$send .= 'Ini data akun anda<br><br>';
		$send .= sprintf('Email: %s', $email) . "<br>";
		$send .= sprintf('User Name: %s', $login) . "<br>";
		$send .= sprintf('Password: %s', $new_pass) . "<br>";
		$send .= 'Silahkan kunjungi website : <a target="_blank" href="'.$iw->base_url.'">'.$iw->base_url.'"</a> dan ubah profile kamu<br><br>' ;
		$send .= 'Ini adalah email otomatis, diharapkan tidak membalas email ini<br>';
		
		if(mail_send($email, $head, $send))
		_e('<p class="message">Akun dan Sandi telah dikirim ke email anda, silahkan login</p>');
		else _e('<div id="error"><strong>ERROR</strong>: There are some glitches in the process of sending a message.</div>');
	}

	function activation($codeaktivasi){
		$key = esc_sql( $codeaktivasi );
		$this->filter_activation($key);
	}
	
	function filter_activation($key){
		global $iw,$db;
		$msg = array();
		if( empty( $key ) ) 	
			$msg[] = '<strong>ERROR</strong>: The code activation field is empty.';
			
		$field = $this->username_cek( array('user_activation_key'=>$key) );
		
		if( $field['num'] == 0 ){ 	
			$msg[] = '<strong>ERROR</strong>: The code activation not valid.';
		}else{
			if(empty($msg)){
			$new_pass			= random_password();
			$user_pass			= has_password($new_pass);
			$user_last_update 	= date('Y-m-d H:i:s');
			$user_status	 	= 1;
			
			$data = compact('user_pass','user_last_update','user_status');			
			$userupdate = $db->update( 'users', $data + array('user_activation_key'=>''), array('user_activation_key'=>$key) );
			if($userupdate){
				$login = $field['row']['user_login'];
				$email = $field['row']['user_email'];
				$sex   = $field['row']['user_sex'];
				
				if($sex == 0) $user_sex = 'Perempuan';
				else $user_sex = 'Laki - laki';
				
				$user_data = compact('login','email','user_sex','new_pass');
				$this->message_reg($user_data);
			}}
		}
		if( is_array($msg))	{
			foreach($msg as $val){
			_e('<div id="error">'.$val.' </div>');
			}
		}
	}

	function lost_password($email,$securecode){
		$user_email = esc_sql( $email    	);
		$secure_code= esc_sql( $securecode 	);
		
		$userdata = compact('user_email','secure_code');
		$this->filter_lost_password($userdata);
	}
	
	function filter_lost_password($userdata){
		global $iw,$db;
		extract($userdata, EXTR_SKIP);
	
		if( empty( $user_email ) )
			$msg[] = '<strong>ERROR</strong>: The email field is empty.';
		else
		if( !valid_mail( $user_email ) ) 	
			$msg[] = '<strong>ERROR</strong>: The email not valid.';
			
		if( empty( $secure_code ) )
			$msg[] = '<strong>ERROR</strong>: The anti spam field is empty.';
		else
		if( $secure_code != $_SESSION['Var_session'] )
			$msg[] = '<strong>ERROR</strong>: The anti spam not valid.';
			
		$field = $this->username_cek( compact('user_email') );
		
		if( $field['num'] == 0 ):	
			$msg[] = '<strong>ERROR</strong>: The email not registration.';
		else:
			if(empty($msg)):
			$user_activation_key 	= random_password(20, false);
			$user_last_update 		= date('Y-m-d H:i:s');
			
			$data = compact('user_last_update','user_activation_key') + array('user_status' => 0);			
			$userupdate = $db->update( 'users', $data, compact('user_email') );
			if($userupdate):
				
				$user_data = compact('user_email','user_activation_key');
				$this->message_activation($user_data);
				
			endif;
			endif;
		endif;
		
		if( is_array($msg))	{
			foreach($msg as $val){
			_e('<div id="error">'.$val.' </div>');
			}
		}
	}

}

global $access;
if(class_exists('access'))
$access = new access;
