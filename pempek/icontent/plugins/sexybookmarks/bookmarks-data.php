<?php
/**
 * @file sexybookmarks.php
 * 
 */
 
//not direct access
defined('_iEXEC') or die();

global $iw,$title,$description,$load_style,$load_script;

$host			= "http://".$_SERVER['HTTP_HOST'];
$url 			= $_SERVER['REQUEST_URI']; 
$ver_sb			= '3.2.3.1';
$load_style[]	='<link rel="stylesheet" href="'.plugin_url('sexybookmarks/style.css?ver='.$ver_sb).'" type="text/css" media="all" />';
$load_script[]	='<script type="text/javascript" src="'.plugin_url('sexybookmarks/sexy-bookmarks-public.js?ver='.$ver_sb).'"></script>';

$checkthis_text = __('Check this box to include %s in your bookmarking menu');
$plugin_title	= __wt($title);
$web_uri 		= $host.$url;
$plugin_desc	= $description;

// array of bookmarks
$shrsb_bookmarks_data=array(
	'shr-scriptstyle'=>array(
		'check'=>sprintf($checkthis_text, 'Script &amp; Style'),
		'share'=>__('Submit this to ').'Script &amp; Style',
		'baseUrl'=>'http://scriptandstyle.com/submit?url='.$web_uri.'&amp;title='.$plugin_title.'',
	),
	'shr-blinklist'=>array(
		'check'=>sprintf($checkthis_text, 'Blinklist'),
		'share'=>__('Share this on ').'Blinklist',
		'baseUrl'=>'http://www.blinklist.com/index.php?Action=Blink/addblink.php&amp;Url='.$web_uri.'&amp;Title='.$plugin_title.'',
	),
	'shr-delicious'=>array(
		'check'=>sprintf($checkthis_text,'Delicious'),
		'share'=>__('Share this on ').'del.icio.us',
		'baseUrl'=>'http://delicious.com/post?url='.$web_uri.'&amp;title='.$plugin_title.'',
	),
	'shr-digg'=>array(
		'check'=>sprintf($checkthis_text,'Digg'),
		'share'=>__('Digg this!'),
		'baseUrl'=>'http://digg.com/submit?phase=2&amp;url='.$web_uri.'&amp;title='.$plugin_title.'',
	),
	'shr-reddit'=>array(
		'check'=>sprintf($checkthis_text,'Reddit'),
		'share'=>__('Share this on ').'Reddit',
		'baseUrl'=>'http://reddit.com/submit?url='.$web_uri.'&amp;title='.$plugin_title.'',
	),
	'shr-yahoobuzz'=>array(
		'check'=>sprintf($checkthis_text,'Yahoo! Buzz'),
		'share'=>__('Buzz up!'),
		'baseUrl'=>'http://buzz.yahoo.com/submit/?submitUrl='.$web_uri.'&amp;submitHeadline='.$plugin_title.'&amp;submitSummary=YAHOOTEASER&amp;submitCategory=YAHOOCATEGORY&amp;submitAssetType=YAHOOMEDIATYPE',
	),
	'shr-stumbleupon'=>array(
		'check'=>sprintf($checkthis_text,'Stumbleupon'),
		'share'=>__('Stumble upon something good? Share it on StumbleUpon'),
		'baseUrl'=>'http://www.stumbleupon.com/submit?url='.$web_uri.'&amp;title='.$plugin_title.'',
	),
	'shr-technorati'=>array(
		'check'=>sprintf($checkthis_text,'Technorati'),
		'share'=>__('Share this on ').'Technorati',
		'baseUrl'=>'http://technorati.com/faves?add='.$web_uri.'',
	),
	'shr-mixx'=>array(
		'check'=>sprintf($checkthis_text,'Mixx'),
		'share'=>__('Share this on ').'Mixx',
		'baseUrl'=>'http://www.mixx.com/submit?page_url='.$web_uri.'&amp;title='.$plugin_title.'',
	),
	'shr-myspace'=>array(
		'check'=>sprintf($checkthis_text,'MySpace'),
		'share'=>__('Post this to ').'MySpace',
		'baseUrl'=>'http://www.myspace.com/Modules/PostTo/Pages/?u='.$web_uri.'&amp;t='.$plugin_title.'',
	),
	'shr-designfloat'=>array(
		'check'=>sprintf($checkthis_text,'DesignFloat'),
		'share'=>__('Submit this to ').'DesignFloat',
		'baseUrl'=>'http://www.designfloat.com/submit.php?url='.$web_uri.'&amp;title='.$plugin_title.'',
	),
	'shr-facebook'=>array(
		'check'=>sprintf($checkthis_text,'Facebook'),
		'share'=>__('Share this on ').'Facebook',
		'baseUrl'=>'http://www.facebook.com/share.php?v=4&amp;src=bm&amp;u='.$web_uri.'&amp;t='.$plugin_title.'',
	),
	'shr-twitter'=>array(
		'check'=>sprintf($checkthis_text,'Twitter'),
		'share'=>__('Tweet This!'),
		'baseUrl'=>'http://twitter.com/home?status=',
	),
	'shr-mail'=>array(
		'check'=>sprintf($checkthis_text, __("an 'Email to a Friend' link")),
		'share'=>__('Email this to a friend?'),
      'baseUrl'=>'mailto:?subject=%22TITLE%22&amp;body=Link: '.$web_uri.' '.__('(sent via shareaholic)').'%0D%0A%0D%0A----%0D%0A '.$plugin_desc.'',
	),
	'shr-tomuse'=>array(
		'check'=>sprintf($checkthis_text,'ToMuse'),
		'share'=>__('Suggest this article to ').'ToMuse',
      'baseUrl'=>'mailto:tips@tomuse.com?subject='.urlencode( __('New tip submitted via the SexyBookmarks Plugin!') ).'&amp;body=Link: '.$web_uri.' %0D%0A%0D%0A '.$plugin_desc.'',
	),
	'shr-comfeed'=>array(
		'check'=>sprintf($checkthis_text, __("a 'Subscribe to Comments' link")),
		'share'=>__('Subscribe to the comments for this post?'),
		'baseUrl'=> $iw->base_url.'rss.xml',
	),
	'shr-linkedin'=>array(
		'check'=>sprintf($checkthis_text,'LinkedIn'),
		'share'=>__('Share this on ').'LinkedIn',
		'baseUrl'=>'http://www.linkedin.com/shareArticle?mini=true&amp;url='.$web_uri.'&amp;title='.$plugin_title.'&amp;summary=POST_SUMMARY&amp;source=SITE_NAME',
	),
	'shr-newsvine'=>array(
		'check'=>sprintf($checkthis_text,'Newsvine'),
		'share'=>__('Seed this on ').'Newsvine',
		'baseUrl'=>'http://www.newsvine.com/_tools/seed&amp;save?u='.$web_uri.'&amp;h='.$plugin_title.'',
	),
	'shr-googlebookmarks'=>array(
		'check'=>sprintf($checkthis_text,'Google Bookmarks'),
		'share'=>__('Add this to ').'Google Bookmarks',
		'baseUrl'=>'http://www.google.com/bookmarks/mark?op=add&amp;bkmk='.$web_uri.'&amp;title='.$plugin_title.'',
	),
	'shr-googlereader'=>array(
		'check'=>sprintf($checkthis_text,'Google Reader'),
		'share'=>__('Add this to ').'Google Reader',
		'baseUrl'=>'http://www.google.com/reader/link?url='.$web_uri.'&amp;title='.$plugin_title.'&amp;srcUrl='.$web_uri.'&amp;srcTitle='.$plugin_title.'&amp;snippet='.$plugin_desc.'',
	),
	'shr-googlebuzz'=>array(
		'check'=>sprintf($checkthis_text,'Google Buzz'),
		'share'=>__('Post on Google Buzz'),
		'baseUrl'=>'http://www.google.com/buzz/post?url='.$web_uri.'&amp;imageurl=',
	),
	'shr-misterwong'=>array(
		'check'=>sprintf($checkthis_text,'Mister Wong'),
		'share'=>__('Add this to ').'Mister Wong',
		'baseUrl'=>'http://www.mister-wong'.$wong_tld.'/addurl/?bm_url='.$web_uri.'&amp;bm_description='.$plugin_title.'&amp;plugin=sexybookmarks',
	),
	'shr-izeby'=>array(
		'check'=>sprintf($checkthis_text,'Izeby'),
		'share'=>__('Add this to ').'Izeby',
		'baseUrl'=>'http://izeby.com/submit.php?url='.$web_uri.'',
	),
	'shr-tipd'=>array(
		'check'=>sprintf($checkthis_text,'Tipd'),
		'share'=>__('Share this on ').'Tipd',
		'baseUrl'=>'http://tipd.com/submit.php?url='.$web_uri.'',
	),
	'shr-pfbuzz'=>array(
		'check'=>sprintf($checkthis_text,'PFBuzz'),
		'share'=>__('Share this on ').'PFBuzz',
		'baseUrl'=>'http://pfbuzz.com/submit?url='.$web_uri.'&amp;title='.$plugin_title.'',
	),
	'shr-friendfeed'=>array(
		'check'=>sprintf($checkthis_text,'FriendFeed'),
		'share'=>__('Share this on ').'FriendFeed',
		'baseUrl'=>'http://www.friendfeed.com/share?title='.$plugin_title.'&amp;link='.$web_uri.'',
	),
	'shr-blogmarks'=>array(
		'check'=>sprintf($checkthis_text,'BlogMarks'),
		'share'=>__('Mark this on ').'BlogMarks',
		'baseUrl'=>'http://blogmarks.net/my/new.php?mini=1&amp;simple=1&amp;url='.$web_uri.'&amp;title='.$plugin_title.'',
	),
	'shr-twittley'=>array(
		'check'=>sprintf($checkthis_text,'Twittley'),
		'share'=>__('Submit this to ').'Twittley',
		'baseUrl'=>'http://twittley.com/submit/?title='.$plugin_title.'&amp;url='.$web_uri.'&amp;desc='.$plugin_desc.'&amp;pcat=TWITT_CAT&amp;tags=DEFAULT_TAGS',
	),
	'shr-fwisp'=>array(
		'check'=>sprintf($checkthis_text,'Fwisp'),
		'share'=>__('Share this on ').'Fwisp',
		'baseUrl'=>'http://fwisp.com/submit?url='.$web_uri.'',
	),
	'shr-bobrdobr'=>array(
		'check'=>sprintf($checkthis_text,'BobrDobr').__(' (Russian)'),
		'share'=>__('Share this on ').'BobrDobr',
		'baseUrl'=>'http://bobrdobr.ru/addext.html?url='.$web_uri.'&amp;title='.$plugin_title.'',
	),
	'shr-yandex'=>array(
		'check'=>sprintf($checkthis_text,'Yandex.Bookmarks').__(' (Russian)'),
		'share'=>__('Add this to ').'Yandex.Bookmarks',
		'baseUrl'=>'http://zakladki.yandex.ru/userarea/links/addfromfav.asp?bAddLink_x=1&amp;lurl='.$web_uri.'&amp;lname='.$plugin_title.'',
	),
	'shr-memoryru'=>array(
		'check'=>sprintf($checkthis_text,'Memory.ru').__(' (Russian)'),
		'share'=>__('Add this to ').'Memory.ru',
		'baseUrl'=>'http://memori.ru/link/?sm=1&amp;u_data[url]='.$web_uri.'&amp;u_data[name]='.$plugin_title.'',
	),
	'shr-100zakladok'=>array(
		'check'=>sprintf($checkthis_text,'100 bookmarks').__(' (Russian)'),
		'share'=>__('Add this to ').'100 bookmarks',
		'baseUrl'=>'http://www.100zakladok.ru/save/?bmurl='.$web_uri.'&amp;bmtitle='.$plugin_title.'',
	),
	'shr-moemesto'=>array(
		'check'=>sprintf($checkthis_text,'MyPlace').__(' (Russian)'),
		'share'=>__('Add this to ').'MyPlace',
		'baseUrl'=>'http://moemesto.ru/post.php?url='.$web_uri.'&amp;title='.$plugin_title.'',
	),
	'shr-hackernews'=>array(
		'check'=>sprintf($checkthis_text,'Hacker News'),
		'share'=>__('Submit this to ').'Hacker News',
		'baseUrl'=>'http://news.ycombinator.com/submitlink?u='.$web_uri.'&amp;t='.$plugin_title.'',
	),
	'shr-printfriendly'=>array(
		'check'=>sprintf($checkthis_text,'Print Friendly'),
		'share'=>__('Send this page to ').'Print Friendly',
		'baseUrl'=>'http://www.printfriendly.com/print?url='.$web_uri.'',
	),
	'shr-designbump'=>array(
		'check'=>sprintf($checkthis_text,'Design Bump'),
		'share'=>__('Bump this on ').'DesignBump',
		'baseUrl'=>'http://designbump.com/submit?url='.$web_uri.'&amp;title='.$plugin_title.'&amp;body='.$plugin_desc.'',
	),
	'shr-ning'=>array(
		'check'=>sprintf($checkthis_text,'Ning'),
		'share'=>__('Add this to ').'Ning',
		'baseUrl'=>'http://bookmarks.ning.com/addItem.php?url='.$web_uri.'&amp;T='.$plugin_title.'',
	),
	'shr-identica'=>array(
		'check'=>sprintf($checkthis_text,'Identica'),
		'share'=>__('Post this to ').'Identica',
		'baseUrl'=>'http://identi.ca//index.php?action=newnotice&amp;status_textarea=Reading:+&quot;SHORT_TITLE&quot;+-+from+FETCH_URL',
	),
	'shr-xerpi'=>array(
		'check'=>sprintf($checkthis_text,'Xerpi'),
		'share'=>__('Save this to ').'Xerpi',
		'baseUrl'=>'http://www.xerpi.com/block/add_link_from_extension?url='.$web_uri.'&amp;title='.$plugin_title.'',
	),
	'shr-wikio'=>array(
		'check'=>sprintf($checkthis_text,'Wikio'),
		'share'=>__('Share this on ').'Wikio',
		'baseUrl'=>'http://www.wikio.com/sharethis?url='.$web_uri.'&amp;title='.$plugin_title.'',
	),
	'shr-techmeme'=>array(
		'check'=>sprintf($checkthis_text,'TechMeme'),
		'share'=>__('Tip this to ').'TechMeme',
		'baseUrl'=>'http://twitter.com/home/?status=Tip+@Techmeme+'.$web_uri.'+&quot;'.$plugin_title.'&quot;&amp;source=shareaholic',
	),
	'shr-sphinn'=>array(
		'check'=>sprintf($checkthis_text,'Sphinn'),
		'share'=>__('Sphinn this on ').'Sphinn',
		'baseUrl'=>'http://sphinn.com/index.php?c=post&amp;m=submit&amp;link='.$web_uri.'',
	),
	'shr-posterous'=>array(
		'check'=>sprintf($checkthis_text,'Posterous'),
		'share'=>__('Post this to ').'Posterous',
		'baseUrl'=>'http://posterous.com/share?linkto='.$web_uri.'&amp;title='.$plugin_title.'&amp;selection='.$plugin_desc.'',
	),
	'shr-globalgrind'=>array(
		'check'=>sprintf($checkthis_text,'Global Grind'),
		'share'=>__('Grind this! on ').'Global Grind',
		'baseUrl'=>'http://globalgrind.com/submission/submit.aspx?url='.$web_uri.'&amp;type=Article&amp;title='.$plugin_title.'',
	),
	'shr-pingfm'=>array(
		'check'=>sprintf($checkthis_text,'Ping.fm'),
		'share'=>__('Ping this on ').'Ping.fm',
		'baseUrl'=>'http://ping.fm/ref/?link='.$web_uri.'&amp;title='.$plugin_title.'&amp;body='.$plugin_desc.'',
	),
	'shr-nujij'=>array(
		'check'=>sprintf($checkthis_text,'NUjij').__(' (Dutch)'),
		'share'=>__('Submit this to ').'NUjij',
		'baseUrl'=>'http://nujij.nl/jij.lynkx?t='.$plugin_title.'&amp;u='.$web_uri.'&amp;b='.$plugin_desc.'',
	),
	'shr-ekudos'=>array(
		'check'=>sprintf($checkthis_text,'eKudos').__(' (Dutch)'),
		'share'=>__('Submit this to ').'eKudos',
		'baseUrl'=>'http://www.ekudos.nl/artikel/nieuw?url='.$web_uri.'&amp;title='.$plugin_title.'&amp;desc='.$plugin_desc.'',
	),
	'shr-netvouz'=>array(
		'check'=>sprintf($checkthis_text,'Netvouz'),
		'share'=>__('Submit this to ').'Netvouz',
		'baseUrl'=>'http://www.netvouz.com/action/submitBookmark?url='.$web_uri.'&amp;title='.$plugin_title.'&amp;popup=no',
	),
	'shr-netvibes'=>array(
		'check'=>sprintf($checkthis_text,'Netvibes'),
		'share'=>__('Submit this to ').'Netvibes',
		'baseUrl'=>'http://www.netvibes.com/share?title='.$plugin_title.'&amp;url='.$web_uri.'',
	),
	'shr-webblend'=>array(
		'check'=>sprintf($checkthis_text,'Web Blend'),
		'share'=>__('Blend this!'),
		'baseUrl'=>'http://thewebblend.com/submit?url='.$web_uri.'&amp;title='.$plugin_title.'&amp;body='.$plugin_desc.'',
	),
	'shr-wykop'=>array(
		'check'=>sprintf($checkthis_text,'Wykop').__(' (Polish)'),
		'share'=>__('Add this to Wykop!'),
		'baseUrl'=>'http://www.wykop.pl/dodaj?url='.$web_uri.'&amp;title='.$plugin_title.'',
	),
	'shr-blogengage'=>array(
		'check'=>sprintf($checkthis_text,'BlogEngage'),
		'share'=>__('Engage with this article!'),
		'baseUrl'=>'http://www.blogengage.com/submit.php?url='.$web_uri.'',
	),
	'shr-hyves'=>array(
		'check'=>sprintf($checkthis_text,'Hyves'),
		'share'=>__('Share this on ').'Hyves',
		'baseUrl'=>'http://www.hyves.nl/profilemanage/add/tips/?name='.$plugin_title.'&amp;text='.$plugin_desc.'+-+'.$web_uri.'&amp;rating=5',
	),
	'shr-pusha'=>array(
		'check'=>sprintf($checkthis_text,'Pusha').__(' (Swedish)'),
		'share'=>__('Push this on ').'Pusha',
		'baseUrl'=>'http://www.pusha.se/posta?url='.$web_uri.'&amp;title='.$plugin_title.'',
	),
	'shr-hatena'=>array(
		'check'=>sprintf($checkthis_text,'Hatena Bookmarks').__(' (Japanese)'),
		'share'=>__('Bookmarks this on ').'Hatena Bookmarks',
		'baseUrl'=>'http://b.hatena.ne.jp/add?mode=confirm&amp;url='.$web_uri.'&amp;title='.$plugin_title.'',
	),
	'shr-mylinkvault'=>array(
		'check'=>sprintf($checkthis_text,'MyLinkVault'),
		'share'=>__('Store this link on ').'MyLinkVault',
		'baseUrl'=>'http://www.mylinkvault.com/link-page.php?u='.$web_uri.'&amp;n='.$plugin_title.'',
	),
	'shr-slashdot'=>array(
		'check'=>sprintf($checkthis_text,'SlashDot'),
		'share'=>__('Submit this to ').'SlashDot',
		'baseUrl'=>'http://slashdot.org/bookmark.pl?url='.$web_uri.'&amp;title='.$plugin_title.'',
	),
	'shr-squidoo'=>array(
		'check'=>sprintf($checkthis_text,'Squidoo'),
		'share'=>__('Add to a lense on ').'Squidoo',
		'baseUrl'=>'http://www.squidoo.com/lensmaster/bookmark?'.$web_uri.'',
	),
	'shr-propeller'=>array(
		'check'=>sprintf($checkthis_text,'Propeller'),
		'share'=>__('Submit this story to ').'Propeller',
		'baseUrl'=>'http://www.propeller.com/submit/?url='.$web_uri.'',
	),
	'shr-faqpal'=>array(
		'check'=>sprintf($checkthis_text,'FAQpal'),
		'share'=>__('Submit this to ').'FAQpal',
		'baseUrl'=>'http://www.faqpal.com/submit?url='.$web_uri.'',
	),
	'shr-evernote'=>array(
		'check'=>sprintf($checkthis_text,'Evernote'),
		'share'=>__('Clip this to ').'Evernote',
		'baseUrl'=>'http://www.evernote.com/clip.action?url='.$web_uri.'&amp;title='.$plugin_title.'',
	),
	'shr-meneame'=>array(
		'check'=>sprintf($checkthis_text,'Meneame').__(' (Spanish)'),
		'share'=>__('Submit this to ').'Meneame',
		'baseUrl'=>'http://meneame.net/submit.php?url='.$web_uri.'',
	),
	'shr-bitacoras'=>array(
		'check'=>sprintf($checkthis_text,'Bitacoras').__(' (Spanish)'),
		'share'=>__('Submit this to ').'Bitacoras',
		'baseUrl'=>'http://bitacoras.com/anotaciones/'.$web_uri.'',
	),
	'shr-jumptags'=>array(
		'check'=>sprintf($checkthis_text,'JumpTags'),
		'share'=>__('Submit this link to ').'JumpTags',
		'baseUrl'=>'http://www.jumptags.com/add/?url='.$web_uri.'&amp;title='.$plugin_title.'',
	),
	'shr-bebo'=>array(
		'check'=>sprintf($checkthis_text,'Bebo'),
		'share'=>__('Share this on ').'Bebo',
		'baseUrl'=>'http://www.bebo.com/c/share?Url='.$web_uri.'&amp;Title='.$plugin_title.'',
	),
	'shr-n4g'=>array(
		'check'=>sprintf($checkthis_text,'N4G'),
		'share'=>__('Submit tip to ').'N4G',
		'baseUrl'=>'http://www.n4g.com/tips.aspx?url='.$web_uri.'&amp;title='.$plugin_title.'',
	),
	'shr-strands'=>array(
		'check'=>sprintf($checkthis_text,'Strands'),
		'share'=>__('Submit this to ').'Strands',
		'baseUrl'=>'http://www.strands.com/tools/share/webpage?title='.$plugin_title.'&amp;url='.$web_uri.'',
	),
	'shr-orkut'=>array(
		'check'=>sprintf($checkthis_text,'Orkut'),
		'share'=>__('Promote this on ').'Orkut',
		'baseUrl'=>'http://promote.orkut.com/preview?nt=orkut.com&amp;tt='.$plugin_title.'&amp;du='.$web_uri.'&amp;cn=POST_SUMMARY',
	),
	'shr-tumblr'=>array(
		'check'=>sprintf($checkthis_text,'Tumblr'),
		'share'=>__('Share this on ').'Tumblr',
		'baseUrl'=>'http://www.tumblr.com/share?v=3&amp;u='.$web_uri.'&amp;t='.$plugin_title.'',
	),
	'shr-stumpedia'=>array(
		'check'=>sprintf($checkthis_text,'Stumpedia'),
		'share'=>__('Add this to ').'Stumpedia',
		'baseUrl'=>'http://www.stumpedia.com/submit?url='.$web_uri.'&amp;title='.$plugin_title.'',
	),
	'shr-current'=>array(
		'check'=>sprintf($checkthis_text,'Current'),
		'share'=>__('Post this to ').'Current',
		'baseUrl'=>'http://current.com/clipper.htm?url='.$web_uri.'&amp;title='.$plugin_title.'',
	),
	'shr-blogger'=>array(
		'check'=>sprintf($checkthis_text,'Blogger'),
		'share'=>__('Blog this on ').'Blogger',
		'baseUrl'=>'http://www.blogger.com/blog_this.pyra?t&amp;u='.$web_uri.'&amp;n='.$plugin_title.'&amp;pli=1',
	),
	'shr-plurk'=>array(
		'check'=>sprintf($checkthis_text,'Plurk'),
		'share'=>__('Share this on ').'Plurk',
		'baseUrl'=>'http://www.plurk.com/m?content='.$plugin_title.'+-+'.$web_uri.'&amp;qualifier=shares',
	),
	'shr-dzone'=>array(
		'check'=>sprintf($checkthis_text,'DZone'),
		'share'=>__('Add this to ').'DZone',
		'baseUrl'=>'http://www.dzone.com/links/add.html?url='.$web_uri.'&amp;title='.$plugin_title.'&amp;description=POST_SUMMARY',
	),	
	'shr-kaevur'=>array(
		'check'=>sprintf($checkthis_text,'Kaevur').__(' (Estonian)'),
		'share'=>__('Share this on ').'Kaevur',
		'baseUrl'=>'http://kaevur.com/submit.php?url='.$web_uri.'',
	),
	'shr-virb'=>array(
		'check'=>sprintf($checkthis_text,'Virb'),
		'share'=>__('Share this on ').'Virb',
		'baseUrl'=>'http://virb.com/share?external&amp;v=2&amp;url='.$web_uri.'&amp;title='.$plugin_title.'',
	),	
	'shr-boxnet'=>array(
		'check'=>sprintf($checkthis_text,'Box.net'),
		'share'=>__('Add this link to ').'Box.net',
		'baseUrl'=>'https://www.box.net/api/1.0/import?url='.$web_uri.'&amp;name='.$plugin_title.'&amp;description=POST_SUMMARY&amp;import_as=link',
	),
	'shr-oknotizie'=>array(
		'check'=>sprintf($checkthis_text,'OkNotizie').__('(Italian)'),
		'share'=>__('Share this on ').'OkNotizie',
		'baseUrl'=>'http://oknotizie.virgilio.it/post?url='.$web_uri.'&amp;title='.$plugin_title.'',
	),
	'shr-bonzobox'=>array(
		'check'=>sprintf($checkthis_text,'BonzoBox'),
		'share'=>__('Add this to ').'BonzoBox',
		'baseUrl'=>'http://bonzobox.com/toolbar/add?pop=1&amp;u='.$web_uri.'&amp;t='.$plugin_title.'&amp;d='.$plugin_desc.'',
	),
	'shr-plaxo'=>array(
		'check'=>sprintf($checkthis_text,'Plaxo'),
		'share'=>__('Share this on ').'Plaxo',
		'baseUrl'=>'http://www.plaxo.com/?share_link='.$web_uri.'',
	),
	'shr-springpad'=>array(
		'check'=>sprintf($checkthis_text,'SpringPad'),
		'share'=>__('Spring this on ').'SpringPad',
		'baseUrl'=>'http://springpadit.com/clip.action?body='.$plugin_desc.'&amp;url='.$web_uri.'&amp;format=microclip&amp;title='.$plugin_title.'&amp;isSelected=true',
	),
	'shr-zabox'=>array(
		'check'=>sprintf($checkthis_text,'Zabox'),
		'share'=>__('Box this on ').'Zabox',
		'baseUrl'=>'http://www.zabox.net/submit.php?url='.$web_uri.'',
	),
	'shr-viadeo'=>array(
		'check'=>sprintf($checkthis_text,'Viadeo'),
		'share'=>__('Share this on ').'Viadeo',
		'baseUrl'=>'http://www.viadeo.com/shareit/share/?url='.$web_uri.'&amp;title='.$plugin_title.'&amp;urlaffiliate=31138',
	),
	'shr-gmail'=>array(
		'check'=>sprintf($checkthis_text,'Gmail'),
		'share'=>__('Email this via ').'Gmail',
		'baseUrl'=>'https://mail.google.com/mail/?ui=2&amp;view=cm&amp;fs=1&amp;tf=1&amp;su='.$plugin_title.'&amp;body=Link: '.$web_uri.' '.__('(sent via shareaholic)').'%0D%0A%0D%0A----%0D%0A '.$plugin_desc.'',
	),
	'shr-hotmail'=>array(
		'check'=>sprintf($checkthis_text,'Hotmail'),
		'share'=>__('Email this via ').'Hotmail',
		'baseUrl'=>'http://mail.live.com/?rru=compose?subject='.$plugin_title.'&amp;body=Link: '.$web_uri.' '.__('(sent via shareaholic)').'%0D%0A%0D%0A----%0D%0A '.$plugin_desc.'',
	),
	'shr-yahoomail'=>array(
		'check'=>sprintf($checkthis_text,'Yahoo! Mail'),
		'share'=>__('Email this via ').'Yahoo! Mail',
		'baseUrl'=>'http://compose.mail.yahoo.com/?Subject='.$plugin_title.'&amp;body=Link: '.$web_uri.' '.__('(sent via shareaholic)').'%0D%0A%0D%0A----%0D%0A POST_SUMMARY',
	),
	'shr-buzzster'=>array(
		'check'=>sprintf($checkthis_text,'Buzzster!'),
		'share'=>__('Share this via ').'Buzzster!',
		'baseUrl'=>"javascript:var%20s=document.createElement('script');s.src='http://www.buzzster.com/javascripts/bzz_adv.js';s.type='text/javascript';void(document.getElementsByTagName('head')[0].appendChild(s));",
	),
);
ksort($shrsb_bookmarks_data, SORT_STRING); //sort array by keys
?>