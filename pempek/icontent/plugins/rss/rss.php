<?php
/**
 * @file: rss-reader.php
 * @type: plugin
 */
/*
Plugin Name: Rss Reader & Writter
Plugin URI: http://cmsid.org/#
Description: Ini adalah plugin yang digunakan untuk membantu anda membuat & membaca rss secara mudah otomatis.
Author: Eko Azza
Version: 1.1.1
Author URI: http://cmsid.org/
*/
 
//not direct access
defined('_iEXEC') or die();

@include 'rss-writter.php';
@include 'rss-reader.php';