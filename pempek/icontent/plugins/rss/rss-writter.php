<?php
/**
 * @file rss-writter.php
 * 
 */
 
//not direct access
defined('_iEXEC') or die();

global $iw,$db;
$doc	= new DOMDocument();
$rss	= $doc->createElement('rss');
$channel= $doc->createElement('channel');

$title	= $doc->createElement('title'		,get_option( 'web_title' ));
$link	= $doc->createElement('link'		,$iw->base_url);
$desc	= $doc->createElement('description'	,get_option( 'web_desc' ));
$lang	= $doc->createElement('language'	,'en');

$doc->appendChild($rss);
$rss->appendChild($channel);

$channel->appendChild($title);
$channel->appendChild($desc);
$channel->appendChild($desc);
$channel->appendChild($lang);

$q		= $db->select('post',array('type'=>'post','status'=>1),'ORDER BY date_post DESC LIMIT 10');
while($r= $db->fetch_array($q)){

$id		= $r['id'];	
$title	= $r['title'];
$author	= $r['user_login'];
$date	= $r['date_post'];

if(!function_exists('do_links'))
$link	= $iw->base_url;
else
{
$link	= do_links('post',array('view'=>'item','id'=>$id,'title'=>$title));
$link	= str_replace('&amp;','&',$link);
$link	= str_replace('&','&amp;',$link);
}

$isi	= $r['content'];

$isi	= htmlentities(strip_tags(nl2br($isi)));
$isi   	= substr($isi,0,200);
$isi   	= substr($isi,0,strrpos($isi," "));

$item	= $doc->createElement('item');
$ititle	= $doc->createElement('title', $title);
$ilink	= $doc->createElement('link', $link);
$idesc	= $doc->createElement('description', $isi);
$iauthor= $doc->createElement('author', $author);
$idate	= $doc->createElement('pubDate', $date);
	
$item->appendChild($ititle);
$item->appendChild($ilink);
$item->appendChild($idesc);
$item->appendChild($iauthor);
$item->appendChild($idate);
	
$channel->appendChild($item);
}
$file = fopen(abs_path."rss.xml", "w");
$rss  = str_replace('<rss>','<rss version="'.$iw->rss['version'].'">',$doc->saveXML());
fwrite($file,$rss);
fclose($file);