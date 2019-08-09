<?php
/**
 * @file default-filter.php
 *
 */
//dilarang mengakses
defined('_iEXEC') or die();

function _e( $string ){
	echo( $string );
	return;
}

function _pf( $string ){
	return printf( $string );
}

// function filter
function filter_int($value){
	return filter('int',$value);
}
function filter_txt($value){
	return filter('text',array('string'=>$value));
}
function filter_post($value){
	return filter('post',$value);
}
function filter_editor($value){
	return filter('editor',$value);
}
function filter_req($value, $type='htmlentities'){
	return filter('request',array('string'=>$value,'type'=>$type));
}
function filter_persistency($value){
	return filter('persistency',$value);
}
function filter_clear($value){
	return filter('clear',$value);
}
function filter_clean($value){
	return filter('clean',$value);
}
function filter_file($value,$type){
	return filter('file',array('string'=>$value,'type'=>$type));
}
//end function filter

function is_empty($value,$default = 0){
	
	if(empty($value))
	$value 	= $default;
	
	return $value;
}

function plugin_url($path){
	global $iw;
	$base =  $iw->base_url 
		   . 'icontent/'
		   . 'plugins/'
		   . $path; 
	return $base;
}

function nl2br2($string) {
	$string = str_replace(array("\r\n", "\r", "\n"), "<br />", $string);
	return $string;
}

function alert($msg) {
	return '<script type="text/javascript">alert("'.$msg.'");</script>';
}

function js_redirec_list() {
	return '<script language="javascript">function redir(mylist){ if (newurl=mylist.options[mylist.selectedIndex].value)
document.location=newurl;}</script>';
}

function redirect($url=null){
	global $iw;
	
	if( !empty($url) ) 
	{
		if(!preg_match("/^http/", $url)) $base_url = $iw->base_url.$url;
		else $base_url = $url;
	}
	else $base_url = $iw->base_url;
	
    if (!headers_sent()){ 
        header('Location: '.$base_url); exit;
    }else{ 
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$base_url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$base_url.'" />';
        echo '</noscript>'; exit;
    }
}

function random( $min = 0, $max = 0 ){
	$rnd_value 	= md5( uniqid(microtime() . mt_rand(), true ));
	$rnd_value .= sha1($rnd_value);
	$value 		= substr($rnd_value, 0, 8);
	$value 		= abs(hexdec($value));
	if ( $max  != 0 )
		$value 	= $min + (($max - $min + 1) * ($value / (4294967295 + 1)));
	return abs(intval($value));
}

function random_password($length = 12, $special_chars = true, $extra_special_chars = false){
	$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	if ( $special_chars )
		$chars .= '!@#$%^&*()';
	if ( $extra_special_chars )
		$chars .= '-_ []{}<>~`+=,.;:/?|';

	$password = '';
	for ( $i = 0; $i < $length; $i++ ) {
		$password .= substr($chars, random(0, strlen($chars) - 1), 1);
	}
	return $password;
}

function has_password($chars){
	return md5($chars);
}

function strto_case( $str, $case = 'upper' ){
  switch($case)
  {
    case "upper" :
    default:
      $str 		= strtoupper($str);
      $pattern 	= '/&([A-Z])(UML|ACUTE|CIRC|TILDE|RING|';
      $pattern .= 'ELIG|GRAVE|SLASH|HORN|CEDIL|TH);/e';
      $replace 	= "'&'.'\\1'.strtolower('\\2').';'"; //convert the important bit back to lower
  	  $str 		= preg_replace($pattern, $replace, $str);
    break;
   
    case "lower" :
      $str 		= strtolower($str);
    break;
  } 
  return filter_txt( $str );
}
/*
example:
get_option('template'');
*/
function get_option( $param ){
	global $iw, $db;
	$q = $db->select('options');
	if( $q )
	foreach( $db->fetch_free( $q ) as $key ){
		if( filter_txt( $param ) == $key['name'] )
		return $key['value'];
	}
}
/*
example:
add_option('template');
*/
function add_option( $param, $value=''){
	global $iw, $db;
	
	if(!empty($param))
	$name  = esc_sql( $param );
	
	$q = $db->select('options',compact('name'));
	if($db->num($q) <=0){
		
		$value = esc_sql( $value );
				
		$data  = compact('name','value'); 
		$db->insert('options',$data);
	}
	else return false;
}

/*
example:
set_option('template', 'default-style');
*/
function set_option( $where, $data ){	
	global $iw, $db;
	$name	= esc_sql( $where );
	$value	= esc_sql( $data );
	$db->update('options',compact('value'),compact('name'));
}

function list_active_plugins( $param = 1 ){
	global $iw, $db;
	
	$r = array();
	$query_plugins = $db->select('plugins');
	if( $query_plugins )
	foreach( $db->fetch_free( $query_plugins ) as $key ){
		if( filter_int( $param ) == $key['status'] )
		$r[] = $key['plugin_path'];
	}
	return $r;
}

function get_plugins( $param ){
	global $iw, $db;
	
	$query_plugins = $db->select('plugins');
	if( $query_plugins )
	foreach( $db->fetch_free( $query_plugins ) as $key ){
		if( filter_txt( $param ) == $key['plugin_path'] )
		return $key['status'];
	}
}

function add_plugins( $param ){
	global $iw, $db;
	
	if(!empty($param))
	$plugin_path  = esc_sql( $param );
	
	$q = $db->select('plugins',compact('plugin_path'));
	if($db->num($q) <=0){				
		$data  = compact('plugin_path'); 
		$db->insert('plugins',$data);
	}
	else return false;
}

function set_plugins( $where, $data ){	
	global $iw, $db;
	$plugin_path	= esc_sql( $where );
	$status			= esc_sql( $data );
	
	if(!add_plugins($plugin_path)) {
		$db->update('plugins',compact('status'),compact('plugin_path'));
	}
}

function get_post( $where, $order = false ){
	global $iw, $db;
	$q = $db->select('post', $where, $order );
	return $q;
}

function page( $param, $id, $type='page'){
	global $db;
	$type = esc_sql( $type 		);
	$id   = esc_sql( (int)$id 	);
	$post = $db->fetch_array( get_post( compact('type','id') ));
	if(empty($post['id'])){
		return false;
	}else{
		return $post[$param];
	}
}

function get_( $val, $param ){
	global $tpl;
	if( isset( $val ) && !empty( $val ) && !isset( $val ) ? null : $val){
		return filter_txt($val);	
	}else{	
		if( 'web_title' == $param ) $slogan = ' | '.$tpl->main('slogan');
		return get_option( $param ).$slogan;
	}
}

function iset_($load){
	return !isset($load) ? '' : implode("",$load);
}

function ext( $param ){
	$ext= explode(',',get_option('ext'));
	foreach( $ext as $val )
	if( filter_txt($param) == $val ) return '.'.$val;
}

function ob( $param ){
	$list = array('start','get','end','ended');
	foreach( $list as $klist)
	if( $param == $klist )
	switch( $param ){
		case 'start':
		return ob_start();
		break;
		case 'get':
		return ob_get_contents();
		break;
		case 'end':
		return ob_end_clean();
		break;
		case 'ended':
		$get =  ob( 'get' );
				ob( 'end' );
		return $get;
		break;
	}
}

function get_info( $show = '' ){
	global $iw, $tpl;
	switch( $show ) {
		case 'charset':
		$output = strto_case( get_option( 'charset' ) );
		break;
		case 'language':
		if ( isset( $iw->language ) )
			$output = $iw->language;
		if ( empty( $iw->language ) )
			$output = 'en_US';
		$output = str_replace('_', '-', $output);
		break;
		case 'stylesheets':
		$output[] = $iw->base_url.'icontent/stylesheet/default';
		$output[] = $iw->base_url.'icontent/stylesheet/message';
		$output[] = $iw->base_url.'icontent/stylesheet/table';
		$output[] = $tpl->url('themes').get_option('stylesheet');
		break;
		case 'scripts':
		$output[] = $iw->base_url.'icontent/javascripts/jquery';
		$output[] = $iw->base_url.'icontent/javascripts/ani';
		$output[] = $iw->base_url.'icontent/javascripts/xmlhttp';
		$output[] = $iw->base_url.'icontent/javascripts/prototype';
		break;
		case 'icon':
		$output = 'favicon.ico';
		break;
		case 'rss':
		$output = $iw->base_url.'rss.xml';
		break;
		case 'pingback':
		$output = get_option('ping_site');
		break;
		case 'profile':
		$output = get_option('profile');
		break;
		case 'new_style':
		$output = $tpl->url('themes');
		break;
	}
	if(is_array($output)){
	return $output;
	}else{
	return filter_txt( $output );
	}
}

function global_layout($param){
	
	if(!empty($param))
	$GLOBALS['body_layout'] = filter_int( $param );
}
/*
 * parameter function set_layout()
 *
 * set_layout('center') //'full','left','right','center','s-left','s-right'
 * letakkan pada apps yang ingin anda buat tampilannya manual
 */
function set_layout($param){
	$param = body_layout( $param );
	global_layout( $param );
}
/*
 * parameter function get_layout()
 *
 * function ini mengglobalkan $body_layout
 */
function get_layout(){
	return $GLOBALS['body_layout'];
}

function body_layout($param){
	$param 			= filter_txt($param);	
	$default_param 	= array('','full','left','right','center','s-left','s-right');
	
	if(!empty($param))	
	if(!in_array($param,$default_param))
	return false; 
	
	foreach($default_param as $key=>$val){
		if(!empty($key))
		if($default_param[$key] == $param) $rtn = filter_int( $key );
	}
	
	return $rtn;	
}

function iw_style( $param ){
	$string_css = get_option($param);
	echo "<style type=\"text/css\">\n". css_compress($string_css) ."\n</style>\n"; 
}

function iw_head(){	
	global $iw,$load_style,$load_script;
	
	echo "<link rel=\"profile\" href=\"". get_info('profile') ."\">\n";
	echo "<meta name=\"Robots\" content=\"". get_option('robots') ."\">\n";
	echo "<meta name=\"generator\" content=\"". $iw->iw_version ."\" />\n";
	echo "<link rel=\"pingback\" href=\"". get_info( 'pingback' ) ."\">\n";
	echo "<link rel=\"alternate\" type=\"". $iw->rss['type'] ."\" title=\"RSS ".$iw->rss['version']."\" href=\"".get_info( 'rss' )."\">\n";
	echo "<link rel=\"index\" title=\"". get_option( 'web_title' ) ."\" href=\"". $iw->base_url ."\">\n";
	echo "<link rel=\"canonical\" href=\"". $iw->base_url.$_SERVER['REQUEST_URI'] ."\" />\n";
	foreach(get_info( 'stylesheets' ) as $style){
	echo "<link rel=\"stylesheet\" href=\"". $style .".css\" type=\"text/css\">\n";
	}
	if( get_option('body_layout') ){
		if( get_layout() ){	
		
		if(get_layout() == 6) iw_style('content_right');		
		if(get_layout() == 5) iw_style('content_left');		
		if(get_layout() == 4) iw_style('content_center');		
		if(get_layout() == 3) iw_style('content_right');		
		if(get_layout() == 2) iw_style('content_left');		
		if(get_layout() == 1) iw_style('content_full');
		
		}else{
			
		if(get_option('body_layout') == 6) iw_style('sidebar_right'); 		
		if(get_option('body_layout') == 5) iw_style('sidebar_left'); 		
		if(get_option('body_layout') == 4) iw_style('content_center');		
		if(get_option('body_layout') == 3) iw_style('content_right'); 		
		if(get_option('body_layout') == 2) iw_style('content_left'); 		
		if(get_option('body_layout') == 1) iw_style('content_full');
		
		}
		
	}
	foreach(get_info( 'scripts' ) as $javascript){
	 echo "<script type=\"text/javascript\" src=\"". $javascript .".js\"></script>\n";
	}
	 echo "<link rel=\"icon\" href=\"". get_info( 'icon' ) ."\">\n";
	 echo "<!--load-->\n";
	 echo !isset( $load_style ) 	? '' : implode( "", $load_style );
	 echo !isset( $load_script ) 	? '' : implode( "", $load_script );
}

function language_attributes($doctype = 'html') {
	$attributes = array();
	$output = '';

	if ( function_exists( 'is_rtl' ) )
		$attributes[] = 'dir="' . ( is_rtl() ? 'rtl' : 'ltr' ) . '"';

	if ( $lang = get_info( 'language' ) ) {
		if ( get_option('html_type') == 'text/html' || $doctype == 'html' )
			$attributes[] = "xmlns=\"http://www.w3.org/1999/xhtml\" lang=".$lang."";

		if ( get_option('html_type') != 'text/html' || $doctype == 'xhtml' )
			$attributes[] = "xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=".$lang."";
	}

	$output = implode(' ', $attributes);
	_e( $output );
}

function is_rtl() {
	return 'rtl' == get_option( 'text_direction' );
}

function _each( $arr = array(), $param ){		
	foreach( array_keys( $arr ) as $key ){
		if( filter_txt( $param ) == $key )
			return $arr[$key];
	}
}
function layout( $param ){
	
	switch( $param ){
		case'sidebar-1':
		if( get_layout() ){	
			
		if( get_layout() ==1)  
		return false;
		
		}else{
			
		if( get_option('body_layout') )
		if( get_option('body_layout') ==1) 
		return false;
				
		}
		break;
		case'sidebar-2':
		
		if( get_layout() ){
		
		if( get_layout() ==1 
		||  get_layout() ==2 
		||  get_layout() ==3 ) 
		return false;
		
		}else{
		
		if( get_option('body_layout') )
		if( get_option('body_layout') ==1 
		||  get_option('body_layout') ==2 
		||  get_option('body_layout') ==3 ) 
		return false;		
		
		}
		break;
	}
	
	return true;
}

function do_template( $class, $param ){
	global $tpl;
	$has_class = filter_txt( $class );
	$has_param = filter_txt( $param );
	return $tpl->$has_class($has_param);
}

function index($param){
	switch($param){
		default:
		$r = 'unknow';
		break;
		case'title':
		$r = do_template('meta','title');
		break;
		case'desc':
		$r = do_template('meta','desc');
		break;
		case'key':
		$r = do_template('meta','key');
		break;
		case'webtitle':
		$r = do_template('main','title');
		break;
		case'leftbar':
		$r = do_template('main','sidebar-1');
		break;
		case'rightbar':
		$r = do_template('main','sidebar-2');
		break;
		case'content':
		$r = do_template('main','content');
		break;
		case'base':
		$r = do_template('url','base');
		break;
		case'exe':
		$r = do_template('meta','exe');
		break;
	}
	echo $r;
}

function limittxt($nama, $limit){
    if (strlen ($nama) > $limit) {
    $nama = substr($nama, 0, $limit).'...';
    }else {
        $nama = $nama;
    }
return $nama;
}
function dateformat($str,$format = null){
	$str = strtotime($str);
	return date("Y/m/d",$str);
	/*
	$today = date("F j, Y, g:i a");                 // March 10, 2001, 5:16 pm
	$today = date("m.d.y");                         // 03.10.01
	$today = date("j, n, Y");                       // 10, 3, 2001
	$today = date("Ymd");                           // 20010310
	$today = date('h-i-s, j-m-y, it is w Day');     // 05-16-18, 10-03-01, 1631 1618 6 Satpm01
	$today = date('\i\t \i\s \t\h\e jS \d\a\y.');   // it is the 10th day.
	$today = date("D M j G:i:s T Y");               // Sat Mar 10 17:16:18 MST 2001
	$today = date('H:m:s \m \i\s\ \m\o\n\t\h');     // 17:03:18 m is month
	$today = date("H:i:s");                         // 17:16:18
	*/
}
function datetimes($tgl,$Jam=true){
/*thanks code date from aura
/*Contoh Format : 2007-08-15 01:27:45*/
$tanggal = strtotime($tgl);
$bln_array = array (
	'01'=>'Jan',
	'02'=>'Feb',
	'03'=>'Mar',
	'04'=>'Apr',
	'05'=>'Mey',
	'06'=>'Jun',
	'07'=>'Jul',
	'08'=>'Aug',
	'09'=>'Sept',
	'10'=>'Okt',
	'11'=>'Nop',
	'12'=>'Dec'
			);
$hari_arr = array (	
	'0'=>'Minggu',
	'1'=>'Senin',
	'2'=>'Selasa',
	'3'=>'Rabu',
	'4'=>'Kamis',
	'5'=>'Jum\'at',
	'6'=>'Sabtu'
				   );
$hari = @$hari_arr[date('w',$tanggal)];
$tggl = date('j',$tanggal);
$bln = @$bln_array[date('m',$tanggal)];
$thn = date('Y',$tanggal);
$jam = $Jam ? date ('H:i:s',$tanggal) : '';
return "$hari, $tggl $bln $thn $jam";	
}	

function get_file($path) {

	if ( function_exists('realpath') )
		$path = realpath($path);

	if ( ! $path || ! @is_file($path) )
		return '';

	return @file_get_contents($path);
}

function valid_url($url) {
   return preg_match("/(((ht|f)tps*:\/\/)*)((([a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3}))|(([0-9]{1,3}\.){3}([0-9]{1,3})))((\/|\?)[a-z0-9~#%&'_\+=:\?\.-]*)*)$/", $url);
}

function valid_mail($mail) {
	// checks email address for correct pattern
	// simple: 	"/^[-_a-z0-9]+(\.[-_a-z0-9]+)*@[-a-z0-9]+(\.[-a-z0-9]+)*\.[a-z]{2,6}$/i"
	$r = 0;
	if($mail) {
		$p  =	"/^[-_a-z0-9]+(\.[-_a-z0-9]+)*@[-a-z0-9]+(\.[-a-z0-9]+)*\.(";
		// TLD  (01-30-2004)
		$p .=	"com|edu|gov|int|mil|net|org|aero|biz|coop|info|museum|name|pro|arpa";
		// ccTLD (01-30-2004)
		$p .=	"ac|ad|ae|af|ag|ai|al|am|an|ao|aq|ar|as|at|au|aw|az|ba|bb|bd|";
		$p .=	"be|bf|bg|bh|bi|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|";
		$p .=	"cg|ch|ci|ck|cl|cm|cn|co|cr|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|";
		$p .=	"ec|ee|eg|eh|er|es|et|fi|fj|fk|fm|fo|fr|ga|gd|ge|gf|gg|gh|gi|";
		$p .=	"gl|gm|gn|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|";
		$p .=	"im|in|io|iq|ir|is|it|je|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|";
		$p .=	"ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mk|ml|";
		$p .=	"mm|mn|mo|mp|mq|mr|ms|mt|mu|mv|mw|mx|my|mz|na|nc|ne|nf|ng|ni|";
		$p .=	"nl|no|np|nr|nu|nz|om|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|ps|pt|pw|";
		$p .=	"py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|";
		$p .=	"sr|st|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|";
		$p .=	"tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|";
		$p .=	"za|zm|zw";
		$p .=	")$/i";

		$r = preg_match($p, $mail) ? 1 : 0;
	}
	return $r;
}
function mail_send($email, $subject, $message) {
    $smail   = get_option('admin_email');
    $email   = filter_txt( $email 	);
    $smail   = filter_txt( $smail 	);
    $subject = filter_txt( $subject );
    $headers = "MIME-Version: 1.0\n"
    ."Content-Type: text/html; charset=utf-8\n"
    ."Reply-To: \"$smail\" <$smail>\n"
    ."From: \"$smail\" <$smail>\n"
    ."Return-Path: <$smail>\n"
    ."X-Priority: 1\n"
    ."X-Mailer: Mailer\n";
    
    if(mail($email, $subject, $message, $headers)) return true;
    else return false;
}

function cek_ip ($check) {
	$bytes = explode('.', $check);
		if (count($bytes) == 4 or count($bytes) == 6) {
			$returnValue = true;
			foreach ($bytes as $byte) {
				if (!(is_numeric($byte) && $byte >= 0 && $byte <= 255)) {
					$returnValue = false;
				}
			}
			return $returnValue;
		}
		return false;
}
function getIP(){
	$banned = array ('127.0.0.1', '192.168', '10');
	$ip_adr = @$_SERVER['HTTP_X_FORWARDED_FOR'];
	$bool = false;
	foreach ($banned as $key=>$val){
		if(!empty($ip_adr))
		if(ereg("^$val",$ip_adr)){
	$bool = true;
	break;
	}
	}
	if (empty($ip_adr) or $bool or !cek_ip($ip_adr)){
		$ip_adr = @$_SERVER['REMOTE_ADDR'];	
	}
	return $ip_adr; 	
}
function posted($filename,$menit = 10){
	global $iw,$db;
	//$file = basename($_SERVER['PHP_SELF']);
	$file = esc_sql( $filename );
	$ip   = esc_sql( getIP() );
	$time = esc_sql( time() + 60 * $menit );
	$data = compact('file','ip','time');
	@$db->insert("posted_ip",$data);
}
function cek_post($filename){
		global $iw,$db;
		$db->query ("	DELETE FROM `".$iw->pre."posted_ip` 
						WHERE `time` < '".time()."'");
		$q		= $db->query ("	SELECT COUNT(`ip`) AS IP 
								FROM `".$iw->pre."posted_ip` 
								WHERE `ip` = '".getIP()."' AND `file` = '".$filename."' AND `time` > '".time()."'");
		$total =$db->fetch_array($q);
		if ($total['IP'] >= 1){
			return 1;	
		}else {
			return 0;	
		}
}

function emotions($str){
	global $iw;
	/*
	project	: emotions v 1.2
	sumber	: http://id.messenger.yahoo.com/features/emoticons/
	*/
	$charEmo	= array('',':)',':(',';)',':D',';;)','>:D<',':-/',':x',':">',':P',':-*','=((',':-O','X(',':>','B-)',':-S','#:-S','>:)',':((',':))',' :|','/:)','=))','O:-)',':-B','=;',':-c',':)]','~X(',':-h',':-t','8->','I-)','8-|','L-)',':-&',':-$','[-(',':O)','8-}','<:-P','(:|','=P~',':-?','#-o','=D>',':-SS','@-)',':^o',':-w',':-<','>:P','<):)','X_X',':!!','\m/',':-q',':-bd','^#(^',':ar!');
	
	foreach($charEmo as $key => $val) $str = str_replace($charEmo[$key], " <img src=\"". $iw->base_url . "icontent/images/emotion/".$key.".gif\"> ", $str);
	 
return $str;
}


function set_link($text='',$target='_blank')
{
	$text = preg_replace("/\s+/", ' ', str_replace(array("\r\n", "\r", "\n"), ' ', $text));
    $data = '';
    foreach( explode(' ', $text) as $str){
        if (preg_match('#^http?#i', trim($str)) || preg_match('#^www.?#i', trim($str))) {
            $data .= '<a href="'.$str.'" target="'.$target.'">click here</a> ';
        } else {
            $data .= $str .' ';
        }
    }
    return trim($data);
}

function get_gravatar( $email, $default = '', $s = 50, $d = 'mm', $r = 'g', $img = false, $atts = array()) {
	global $iw;
	
	$set_avatar = get_option('avatar_default');
	if($set_avatar!=$default && empty($default)) $default = $set_avatar;
	
	if($default=='blank'):
	$out = $iw->base_url.'icontent/images/blank.gif';
	else:
	
	$email_hash = md5( strtolower( $email ) );
	if($img){
		$host = 'https://secure.gravatar.com';
	}else{
	if ( !empty($email) ){
		$host = sprintf( "http://%d.gravatar.com", ( hexdec( $email_hash{0} ) % 2 ) );
	}else{
		$host = 'http://0.gravatar.com';
	}
	$out =$host.'/avatar/s='.$s;
	}
	if ( 'mystery' == $default )
		$default = "$host/avatar/ad516503a11cd5ca435acc9bb6523536?s=".$s; 
		// ad516503a11cd5ca435acc9bb6523536 == md5('unknown@gravatar.com')
	elseif ( !empty($email) && 'gravatar_default' == $default )
		$default = '';
	elseif ( 'gravatar_default' == $default )
		$default = $host."/avatar/s=".$s;
	elseif ( empty($email) )
		$default = $host."/avatar/?d=".$default."&amp;s=".$s;
		
	if ( !empty($email) ) {
		$out  = $host."/avatar/";
		$out .= $email_hash;
		$out .= '?s='.$s;
		$out .= '&amp;d='.urlencode($default);
	}
	endif;
	return $out;
}

function crop_image($src, $width, $height, $crop=0){
		
	if(empty($width) && empty($height))
	return false;
	
	if(!list($w, $h) = getimagesize($src)) return "Unsupported picture type!";
	
	$type = strtolower(substr(strrchr($src,"."),1));
	if($type == 'jpeg') $type = 'jpg';
	switch($type){
	case 'bmp': $img = imagecreatefromwbmp($src); break;
	case 'gif': $img = imagecreatefromgif($src); break;
	case 'jpg': $img = imagecreatefromjpeg($src); break;
	case 'png': $img = imagecreatefrompng($src); break;
	default : return "Unsupported picture type!";
	}
	
	// resize
	if($crop){
	if($w < $width or $h < $height) return "Picture is too small!";
		$ratio = max($width/$w, $height/$h);
		$h = $height / $ratio;
		$x = ($w - $width / $ratio) / 2;
		$w = $width / $ratio;
	}
	else{
		if($w < $width and $h < $height) return "Picture is too small!";
		$ratio = min($width/$w, $height/$h);
		$width = $w * $ratio;
		$height = $h * $ratio;
		$x = 0;
	}
	
	$new = imagecreatetruecolor($width, $height);
	
	  // preserve transparency
	  if($type == "gif" or $type == "png"){
		imagecolortransparent($new, imagecolorallocatealpha($new, 0, 0, 0, 127));
		imagealphablending($new, false);
		imagesavealpha($new, true);
	  }
	
	  imagecopyresampled($new, $img, 0, 0, $x, 0, $width, $height, $w, $h);
	
	  switch($type){
		case 'bmp': 
		header('Content-type: image/bmp');
		imagewbmp($new); 
		imagedestroy($new);
		break;
		case 'gif': 
		header('Content-type: image/gif');
		imagegif($new); 
		imagedestroy($new);
		break;
		case 'jpg': 
		header('Content-type: image/jpeg');
		imagejpeg($new); 
		imagedestroy($new);
		break;
		case 'png': 
		header('Content-type: image/png');
		imagepng($new); 
		imagedestroy($new);
		break;
	  }
	return true;
}

function css_compress($buffer) {
  // remove comments
  $pattern = '!/\*[^*]*\*+([^/][^*]*\*+)*/!';
  $buffer = preg_replace($pattern, '', $buffer);

  // remove new lines, tabs, spaces
  $buffer = str_replace(array("\r\n","\r","\n","\t",' {','} ',';}'),array('','','','','{', '}','}'), $buffer);

  // drop more unecessary spaces
  $buffer = preg_replace(array('!\s+!','!(\w+:)\s*([\w\s,#]+;?)!'),array(' ','$1$2'),$buffer);

  return $buffer;
}

function save_widgets($json){
	$json = esc_sql($json);
	set_option('widgets',$json);
}

function set_widgets($string){
	global $access;
	
	if($access->cek_login() && $access->login_level('admin'))
	save_widgets($string);	
	
}

function print_scripts() {
	global $fscript,$qscript,$include_rel_script;

	if ( !empty($include_rel_script) ) {
		
		if(!is_array($include_rel_script))
			echo "\n".$include_rel_script;
		else
			foreach($include_rel_script as $key) echo "\n".$key;
				
	}
	
	if ( !empty($fscript) || !empty($qscript) ) {
		echo "\n<script type='text/javascript'>";
		echo "\n/* <![CDATA[ */";
		if( !empty($fscript) ):
		echo "\n$(document).ready(function(){\n";
			
		if(!is_array($fscript))
			echo "\n".$fscript;
		else
			foreach($fscript as $key) echo "\n".$key;
			
		echo "\n});";
		endif;
		
		if( !empty($qscript) ):
				
		if(!is_array($qscript))
			echo "\n".$qscript;
		else
			foreach($qscript as $key) echo "\n".$key;	
			
		endif;
		
		echo "\n/* ]]> */";
		echo "\n</script>\n";
	}
	
}

function javascript_url($file){
	global $iw;
	$html = new html;
	if(!is_array($file)){
		$src  = $iw->base_url . "icontent/javascripts/".$file.".js";
		echo $html->script($src);
	}else{
		foreach($file as $val){ 
		$src  = $iw->base_url . "icontent/javascripts/".$val.".js";
		echo $html->script($src);
		}
	}
}

function stylesheet_url($file){
	global $iw;
	$html = new html;
	
	if(!is_array($file)){
		$src  = $iw->base_url . "icontent/stylesheet/".$file.".css";
		echo $html->style($src);
	}else{
		foreach($file as $val){ 
		$src  = $iw->base_url . "icontent/stylesheet/".$val.".css";
		echo $html->style($src);
		}
	}
}

function themes_url($file){
	global $iw;
	echo $iw->base_url.'icontent/themes/'.get_option('template').'/'.$file;
}

function uploads_url($file){
	global $iw;
	if(file_exists('icontent/uploads/'.$file) && !empty($file))
	return $iw->base_url.'icontent/uploads/'.$file; 
}
function apps_url($file){
	global $iw;
	if(file_exists('icontent/applications/'.$file) && !empty($file))
	return $iw->base_url.'icontent/applications/'.$file; 
}
 
function fix_unsafe_attributes($s , $keep = '' , $expand = 'script|style|noframes|select|option'){ 
        /**///prep the string 
        $s = ' ' . $s; 
        
        /**///initialize keep tag logic 
        if(strlen($keep) > 0){ 
            $k = explode('|',$keep); 
            for($i=0;$i<count($k);$i++){ 
                $s = str_replace('<' . $k[$i],'[{(' . $k[$i],$s); 
                $s = str_replace('</' . $k[$i],'[{(/' . $k[$i],$s); 
            } 
        } 
        
        //begin removal 
        /**///remove comment blocks 
        while(stripos($s,'<!--') > 0){ 
            $pos[1] = stripos($s,'<!--'); 
            $pos[2] = stripos($s,'-->', $pos[1]); 
            $len[1] = $pos[2] - $pos[1] + 3; 
            $x = substr($s,$pos[1],$len[1]); 
            $s = str_replace($x,'',$s); 
        } 
        
        /**///remove tags with content between them 
        if(strlen($expand) > 0){ 
            $e = explode('|',$expand); 
            for($i=0;$i<count($e);$i++){ 
                while(stripos($s,'<' . $e[$i]) > 0){ 
                    $len[1] = strlen('<' . $e[$i]); 
                    $pos[1] = stripos($s,'<' . $e[$i]); 
                    $pos[2] = stripos($s,$e[$i] . '>', $pos[1] + $len[1]); 
                    $len[2] = $pos[2] - $pos[1] + $len[1]; 
                    $x = substr($s,$pos[1],$len[2]); 
                    $s = str_replace($x,'',$s); 
                } 
            } 
        } 
        
        /**///remove remaining tags 
        while(stripos($s,'<') > 0){ 
            $pos[1] = stripos($s,'<'); 
            $pos[2] = stripos($s,'>', $pos[1]); 
            $len[1] = $pos[2] - $pos[1] + 1; 
            $x = substr($s,$pos[1],$len[1]); 
            $s = str_replace($x,'',$s); 
        } 
        
        /**///finalize keep tag 
        for($i=0;$i<count($k);$i++){ 
            $s = str_replace('[{(' . $k[$i],'<' . $k[$i],$s); 
            $s = str_replace('[{(/' . $k[$i],'</' . $k[$i],$s); 
        } 
        
        return trim($s); 
    } 

