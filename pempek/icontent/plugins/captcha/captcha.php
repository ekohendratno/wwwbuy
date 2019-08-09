<?php
/**
 * @file: captcha.php
 * @type: plugin
 */
 /*
Plugin Name: Captcha
Plugin URI: http://cmsid.org/#
Description: Plugin di buat untuk membedakan antara mesin ( bot ) dan manusia.
Author: Eko Azza
Version: 1.1.0
Author URI: http://cmsid.org/
*/
//not direct access
defined('_iEXEC') or die();

function load_captcha($param='kcaptcha'){
	global $iw;
	return $iw->base_url.'icontent/plugins/captcha/' . $param .'/'. $param . '.php';
}
