<?php
/**
 * membuat koneksi kedatabase
 *
 * @package id
 */
//dilarang mengakses
defined('_iEXEC') or die();

class mysql
{
	var $connect;
	
	var $real_escape = false;
	
	var $error = true;
	
	var $sql;
	
	var $field_types = array();
	/*
	var $tables = array( 'stat_onlinemonth', 'stat_onlineday', 'stat_online', 'stat_count', 'stat_browse','shoutbox', 'stat_urls','phpids', 'links_cat', 'links', 'guestbook_replay', 'guestbook', 'gallery_cat','gallery', 'download_cat', 'download', 'contact');
	*/
	var $old_tables = array( 'users_data', 'users', 'sidebar_act', 'sidebar', 'sensor', 'post_topic', 'post_comment_replay', 'post_comment', 'posted_ip', 'post', 'plugins', 'options', 'menu_user', 'menu_sub','menu' );
	
	var $new_tables;
	
	var $last_result;
	
	
	function connect( $persistency = true ){
		global $iw;
		$val = array(
		$persistency,
		@mysql_pconnect( $iw->db_host, $iw->db_user, $iw->db_password ),
		@mysql_connect( $iw->db_host, $iw->db_user, $iw->db_password )
		);
		return filter('persistency',$val);
	}
	function select_db(){
		global $iw;
		if( $this->connect() ){			
			if(@mysql_select_db($iw->db_name)){
				$this->connect = true;
			}else{
				$this->connect = false;			
			}
			return $this->connect;
		}else{
			return false;
		}
	}
	
	
	function db_version() {
		return mysql_get_server_info();
	}
	
	function cek_db_version(){
		global $iw;
		if ( version_compare($this->db_version(), $iw->mysql_version, '<') ){
			return false;
		}else{
			return true;
		}
	}
	
	function tables( $new_table, $prefix = true ) {
		global $iw;
		
		if(!empty($new_table)):
			$tables = array_merge( (array)$new_table, (array)$this->old_tables );
		else:
			$tables = $this->old_tables;
		endif;
		
		if ( $prefix ) {
			
			foreach ( $tables as $k => $table ) {
				$tables[ $table ] = $iw->pre . $table;
				unset( $tables[ $k ] );
			}

		}

		return $tables;
	}
	
	
	function add_table($new){
		if( !empty($new) && (string)$new ) $this->new_tables = $new; 
	}
	/*
	 * $table = array('a','b');
	 * $db->add_table($table);
	 * echo $db->set_prefix('a');
	 * output : prefix_a
	 * script for update
	 **/
	
	function add_prefix($table){
		if(!empty($table))
		if(!in_array($table,$this->old_tables) )			
		return $this->add_table($table);
		
	}
	
	function set_prefix( $load_table ) {

		if ( $load_table ) {
			
			if(!$this->new_tables) $new_table = null;
			else $new_table = $this->new_tables;

			foreach($this->tables($new_table) as $k => $v) {
				if($load_table == $k) $load = $v;
			}
		}
		return $load;
	}
	
	function prepare( $query = null ) {
		if ( is_null( $query ) )
			return;
		$args 	= func_get_args();
		array_shift( $args );
		if ( isset( $args[0] ) && is_array($args[0]) )
		$args 	= $args[0];
		$query 	= str_replace( "'%s'", '%s', $query );
		$query 	= str_replace( '"%s"', '%s', $query );
		$query 	= preg_replace( '|(?<!%)%s|', "'%s'", $query );
		return @vsprintf( $query, $args );
	}
	/*
	* $db->query('select * from table_name');
	*
	*/
	function query( $query ){
		$this->sql = $query;
		if ( preg_match("/^\\s*(select|alter table|create|insert|delete|update|replace) /i", $this->sql ) ){
			$query = @mysql_query( $this->sql );
			return $query;
		}
	}	
	/*
	* $user_name='';
	* $user_pass='';
	*
	* $data = compact('user_name','user_pass');
	* $db->replace( 'table_name', $data + compact( 'user_login' ));
	* 
	*/
	
	function replace( $table, $data, $format = null ) {
		return $this->_ir( $table, $data, $format, 'REPLACE' );
	}	
	/*
	* $user_name='';
	* $user_pass='';
	*
	* $data = compact('user_name','user_pass');
	* $db->insert( 'table_name', $data + compact( 'user_login' ));
	* 
	*/
	function insert( $table, $data, $format = null ) {
		return $this->_ir( $table, $data, $format, 'INSERT' );
	}
	
	function _ir( $table, $data, $format = null, $type = 'INSERT' ) {
		$this->add_prefix($table);
		$table = $this->set_prefix($table);
		
		if ( ! in_array( strtoupper( $type ), array( 'REPLACE', 'INSERT' ) ) )
			return false;
		$formats = $format = (array) $format;
		$fields = array_keys( $data );
		$formatted_fields = array();
		foreach ( $fields as $field ) {
			if ( !empty( $format ) )
				$form = ( $form = array_shift( $formats ) ) ? $form : $format[0];
			elseif ( isset( $this->field_types[$field] ) )
				$form = $this->field_types[$field];
			else
				$form = '%s';
			$formatted_fields[] = $this->escape( $form );
		}
		$sql = "{$type} INTO `$table` (`" . implode( '`,`', $fields ) . "`) VALUES ('" . implode( "','", $formatted_fields ) . "')";
		return $this->query( $this->prepare( $sql, $data ) );
	}
	/*
	* $user_name='';
	* $user_pass='';
	*
	* $data = compact('user_name','user_pass');
	* $db->update( 'table_name', $data, compact( 'user_login' ) );
	* 
	*/
	function update( $table, $data, $where, $format = null, $where_format = null ){
		$this->add_prefix($table);
		$table = $this->set_prefix($table);
		
		if ( ! is_array( $data ) || ! is_array( $where ) )
			return false;

		$formats = $format = (array) $format;
		$bits = $wheres = array();
		foreach ( (array) array_keys( $data ) as $field ) {
			if ( !empty( $format ) )
				$form = ( $form = array_shift( $formats ) ) ? $form : $format[0];
			elseif ( isset($this->field_types[$field]) )
				$form = $this->field_types[$field];
			else
				$form = '%s';
			$values   = $this->escape( $form );
			$bits[]   = "`$field` = {$values}";
		}

		$where_formats = $where_format = (array) $where_format;
		foreach ( (array) array_keys( $where ) as $field ) {
			if ( !empty( $where_format ) )
				$form = ( $form = array_shift( $where_formats ) ) ? $form : $where_format[0];
			elseif ( isset( $this->field_types[$field] ) )
				$form = $this->field_types[$field];
			else
				$form = '%s';
			$values	  = $this->escape( $form );
			$wheres[] = "`$field` = {$values}";
		}
		$sql = "UPDATE `$table` SET " . implode( ', ', $bits ) . ' WHERE ' . implode( ' AND ', $wheres );
		return $this->query( $this->prepare( $sql, array_merge( array_values( $data ), array_values( $where ) ) ) );
	}
	
	function select( $table, $where=false, $order=false ){
		$this->add_prefix($table);
		$table = $this->set_prefix($table);
		
		if(!$where){
			if($order){
			//order true
			$sql 	= "SELECT * FROM `$table` ".$order;
			}else{
			//order false & where false
			$sql 	= "SELECT * FROM `$table`";
			}
		}else{
			//where true
			if ( ! is_array( $where ) )
				return false;
				
			$wheres = array();
			foreach ( (array) $where as $field => $value) {
				if ( isset( $this->field_types[$field] ) )
					$form = $this->field_types[$field];
				else
					$form = $value;
				$wheres[] = $field."='".$this->escape( $form )."'";
			}
			//if order true
			if($order)
			$sql 	= "SELECT * FROM `$table` WHERE " . implode( ' AND ', $wheres ) ." ".$order;			
			else
			$sql 	= "SELECT * FROM `$table` WHERE " . implode( ' AND ', $wheres );
			
		}
		return $this->query( $sql );
	}
	
	function delete( $table, $where=false){
		$this->add_prefix($table);
		$table = $this->set_prefix($table);
		
		//where true
		if ( ! is_array( $where ) )
			return false;
				
		$wheres = array();
		foreach ( (array) $where as $field => $value) {
			if ( isset( $this->field_types[$field] ) )
				$form = $this->field_types[$field];
			else
				$form = $value;
			$wheres[] = $field."='".$this->escape( $form )."'";
		}
			
		$sql 	= "DELETE FROM `$table` WHERE " . implode( ' AND ', $wheres );
		return $this->query( $sql );
	}
	
	function fetch_field( $sql = null ){
		if( $sql )
		return @mysql_fetch_field( $sql );
	}
	
	function fetch_free( $sql = null ){
		if( !$sql )
			return false;
			
		$ret = array();
		while ( $row = @mysql_fetch_array( $sql ) ) {
			$ret[] = $row;
		}
		$this->free( $sql ); 
		return $ret;
		
	}
	
	function fetch_array( $sql = null ){
		if( !$sql )	return false;
		else return @mysql_fetch_array( $sql );
	}
	
	function fetch_assoc( $sql = null ){
		if( !$sql )	return false;
		else return @mysql_fetch_assoc( $sql );
	}
	
	function fetch_row( $sql = null ){
		if( !$sql )	return false;
		else return @mysql_fetch_row( $sql );
	}
	
	function fetch_obj( $sql = null  ){
		if( !$sql ) return false;		
		else return @mysql_fetch_object( $sql );		
	}
	
	
	function fetch_object( $sql = null, $output = OBJECT, $y = 0  ){
		if( !$sql )
			return false;
		
		if ( !isset( $this->last_result[$y] ) )
			return null;

		if ( $output == OBJECT ) {
			return $this->last_result[$y] ? $this->last_result[$y] : null;
		} elseif ( $output == ARRAY_A ) {
			return $this->last_result[$y] ? get_object_vars( $this->last_result[$y] ) : null;
		} elseif ( $output == ARRAY_N ) {
			return $this->last_result[$y] ? array_values( get_object_vars( $this->last_result[$y] ) ) : null;
		} else {
			return false;
		}
	}
	
	function row( $sql = null ){
		if( !$sql )
			return false;
			
		$ret = array();
		while ( $row = @mysql_fetch_row( $sql ) ) {
			$ret[] = $row;
		}
		$this->free( $sql ); 
		return $ret;
	}
	
	function num( $sql ){
		if( !$sql )
			return false;
			
		return @mysql_num_rows( $sql );
		
	}
	
	function free( $sql ){
		if( !$sql )
			return false;
			
		return @mysql_free_result( $sql );		
	}
	
	function insert_id() {
		return mysql_insert_id();
	}
	
	
	function _real_escape( $string ) {
		if ( $this->connect() && $this->real_escape )
			return mysql_real_escape_string( $string, $this->dbh );
		else
			return addslashes( $string );
	}
	
	function weak_escape( $string ) {
		return addslashes( $string );
	}	
	
	function escape_map( $string ){
	if( !empty( $string ) ){
		if( !function_exists( 'mysql_real_escape_string' ) ){
			return array_map( 'mysql_escape_string', $string );
		}else{
			return array_map( 'mysql_real_escape_string', $string );
		}
	}
	}
	
	function my_escape( $string ){
	if( !empty( $string ) ){
		if (version_compare(phpversion(),"4.3.0", "<")) mysql_escape_string($string);
		else mysql_real_escape_string($string);
		return $string;
	}
	}
	
	function escape( $data ){
		if ( is_array( $data ) ) {
			foreach ( (array) $data as $k => $v ) {
				if ( is_array( $v ) )
					$data[$k] = $this->escape( $v );
				else
					$data[$k] = $this->my_escape( $v );
			}
		} else {
			$data = $this->my_escape( $data );
		}

		return $data;
	}
	
	function escape_by_ref( &$string ) {
		$string = $this->_real_escape( $string );
	}
	
	function error(){
		if( $this->error ){
			return trigger_sql("(".mysql_errno().") ".mysql_error(), $this->sql, filter( 'text', array( 'string'=> $_SERVER['PHP_SELF'] ) ), __LINE__);
		}
	}
	
}
if( !isset( $db ) ){
global $iw,$db;
$db = new mysql;
if( !$db->connect() ){
	print_error('Koneksi Server','Gagal koneksi ke server, silahkan cek server anda!');
	return false;
}else{
	if( !$db->select_db() ){
		print_error('Koneksi Database','Gagal koneksi ke database server, silahkan cek configurasi apakah sudah benar!');
		return false;
	}else{
		if( !$db->cek_db_version() ){
			print_error('Kebutuhan MySQL',
			sprintf( 'ID System %1$s membutuhkan MySQL %2$s atau lebih tinggi lagi!', $iw->iw_version, $iw->mysql_version ));
			return false;
		}else{
			return true;
		}
	}
}}