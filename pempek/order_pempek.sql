DROP TABLE IF EXISTS iw_album;

CREATE TABLE `iw_album` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `user_login` varchar(88) NOT NULL,
  `cat` int(12) NOT NULL,
  `title` varchar(225) NOT NULL,
  `desc` varchar(225) NOT NULL,
  `image` text NOT NULL,
  `date` datetime NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS iw_album_cat;

CREATE TABLE `iw_album_cat` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `user_login` varchar(88) NOT NULL,
  `title` varchar(225) NOT NULL,
  `status` int(12) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

INSERT INTO iw_album_cat VALUES('17', '', 'Foto Bersama Orang2 Terkenal', '1');
INSERT INTO iw_album_cat VALUES('18', '', 'HIPMI CENTER', '1');
INSERT INTO iw_album_cat VALUES('19', '', 'Liputan TVone', '1');
INSERT INTO iw_album_cat VALUES('20', '', 'Mania', '1');
INSERT INTO iw_album_cat VALUES('21', '', 'Palembang', '1');
INSERT INTO iw_album_cat VALUES('22', '', 'Pameran', '1');
INSERT INTO iw_album_cat VALUES('23', '', 'PELATIHAN RHENALD KASALI', '1');
INSERT INTO iw_album_cat VALUES('24', '', 'PEMBICARA', '1');
INSERT INTO iw_album_cat VALUES('25', '', 'Pempek', '1');
INSERT INTO iw_album_cat VALUES('26', '', 'Penghargaan', '1');
INSERT INTO iw_album_cat VALUES('27', '', 'Siaran di Radio 103.4dfm', '1');
INSERT INTO iw_album_cat VALUES('28', '', 'Trans TV', '1');
INSERT INTO iw_album_cat VALUES('29', '', 'Trans Tv Balik Layar', '1');



DROP TABLE IF EXISTS iw_contact;

CREATE TABLE `iw_contact` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `subject` varchar(60) NOT NULL,
  `email` varchar(225) NOT NULL,
  `message` text NOT NULL,
  `inbox` int(1) NOT NULL DEFAULT '0',
  `outbox` int(1) NOT NULL DEFAULT '0',
  `read` int(1) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO iw_contact VALUES('4', '', 'admin@cmsid.org', 'hallo semua, salam kenal', '1', '0', '1', '2011-09-04 12:14:44');



DROP TABLE IF EXISTS iw_download;

CREATE TABLE `iw_download` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) NOT NULL,
  `desc` text NOT NULL,
  `author` varchar(225) NOT NULL,
  `url` varchar(225) NOT NULL,
  `hits` int(12) NOT NULL,
  `date` datetime NOT NULL,
  `timeupdate` varchar(78) NOT NULL,
  `size` varchar(12) NOT NULL,
  `d_cat` int(12) NOT NULL,
  `broken` int(12) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `privacy` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

INSERT INTO iw_download VALUES('1', 'id v 2beta1', 'cmsid versi 2 beta 1 dengan code name id v2b1', 'eko', 'http://cmsid.org/download.html', '10', '2011-01-02 20:35:24', '1293975324', '4.5MB', '1', '1', '1', '1');



DROP TABLE IF EXISTS iw_download_cat;

CREATE TABLE `iw_download_cat` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `desc` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `hits` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

INSERT INTO iw_download_cat VALUES('1', 'Opensource', 'cms id content management system indonesia', '1', '59');
INSERT INTO iw_download_cat VALUES('10', 'coba', 'sdasasda', '1', '10');



DROP TABLE IF EXISTS iw_guestbook;

CREATE TABLE `iw_guestbook` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `author` varchar(45) NOT NULL,
  `comment` text NOT NULL,
  `web` varchar(225) NOT NULL,
  `mail` varchar(225) NOT NULL,
  `date` date NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `read` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

INSERT INTO iw_guestbook VALUES('35', 'eko', 'cmsid group http://www.facebook.com/home.php?sk=group_163438580346100', 'http://www.cmsid.org', 'id.hpaherba@yahoo.co.id', '2011-01-09', '1', '0');
INSERT INTO iw_guestbook VALUES('55', 'eko', 'coba', '', 'id.hpaherba@yahoo.co.id', '2011-03-07', '1', '0');



DROP TABLE IF EXISTS iw_guestbook_replay;

CREATE TABLE `iw_guestbook_replay` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `UserId` int(12) NOT NULL DEFAULT '0',
  `author` varchar(80) NOT NULL,
  `web` varchar(225) NOT NULL,
  `mail` varchar(225) NOT NULL,
  `message` text NOT NULL,
  `reply` int(12) NOT NULL,
  `date` date NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `read` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=97 DEFAULT CHARSET=utf8;

INSERT INTO iw_guestbook_replay VALUES('92', '0', 'eko', '', 'id.hpaherba@yahoo.co.id', 'ksadsd', '35', '2011-02-07', '1', '0');
INSERT INTO iw_guestbook_replay VALUES('73', '1', 'eko', 'http://www.cmsid.org', 'id.hpaherba@yahoo.co.id', 'yups gabung ya.. :D', '35', '2011-01-21', '1', '0');
INSERT INTO iw_guestbook_replay VALUES('94', '0', 'eko', '', 'id.hpaherba@yahoo.co.id', 'teset', '55', '2011-03-11', '1', '0');



DROP TABLE IF EXISTS iw_links;

CREATE TABLE `iw_links` (
  `judul` varchar(255) NOT NULL DEFAULT '',
  `keterangan` text NOT NULL,
  `url` varchar(255) NOT NULL DEFAULT '',
  `hit` int(11) NOT NULL DEFAULT '0',
  `tgl` date NOT NULL,
  `timeupdate` varchar(78) NOT NULL,
  `broken` int(12) NOT NULL DEFAULT '0',
  `public` int(1) NOT NULL DEFAULT '0',
  `kid` int(12) NOT NULL DEFAULT '0',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

INSERT INTO iw_links VALUES('Wikipedia', 'the free encyclopedia that anyone can edit', 'http://www.wikipedia.org/', '13', '2010-11-02', '2307580558', '0', '1', '3', '14');
INSERT INTO iw_links VALUES('Indo Code', 'Indonesian Coders Community', 'http://www.indo-code.com/', '46', '2011-02-15', '97746345', '0', '1', '3', '1');



DROP TABLE IF EXISTS iw_links_cat;

CREATE TABLE `iw_links_cat` (
  `kategori` varchar(30) NOT NULL DEFAULT '',
  `keterangan` varchar(255) NOT NULL DEFAULT '',
  `kid` int(12) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`kid`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

INSERT INTO iw_links_cat VALUES('Pemerintah', 'Berisi website pemerintah yang memakai CMSID maupun yang tidak pakai', '1');
INSERT INTO iw_links_cat VALUES('Personal Web', 'Berisi website pribadi yang menggunakan CMSID', '2');
INSERT INTO iw_links_cat VALUES('Pendidikan', 'Berisi Webesite sekolahan baik setingakat SMU, SMP, SD maupun Universitas', '3');
INSERT INTO iw_links_cat VALUES('Lain-lain', 'Berisi Website lain-lain ya hehe :)', '4');



DROP TABLE IF EXISTS iw_menu;

CREATE TABLE `iw_menu` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `ordering` int(12) NOT NULL,
  `position` int(1) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT '0',
  `for` enum('all','admin','user') NOT NULL DEFAULT 'all',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

INSERT INTO iw_menu VALUES('1', 'Pages', '1', '0', '1', 'all');
INSERT INTO iw_menu VALUES('9', 'Interaktif', '2', '1', '1', 'all');



DROP TABLE IF EXISTS iw_menu_sub;

CREATE TABLE `iw_menu_sub` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `title` varchar(60) NOT NULL,
  `url` text NOT NULL,
  `ordering` int(12) NOT NULL,
  `orderby` int(12) NOT NULL,
  `position` int(1) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `for` enum('all','admin','user') NOT NULL DEFAULT 'all',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

INSERT INTO iw_menu_sub VALUES('2', 'Sejarah', 'index.php?com=page&id=2', '1', '1', '0', '1', 'all');
INSERT INTO iw_menu_sub VALUES('3', 'F.A.Q.S', 'index.php?com=page&id=3', '2', '1', '0', '0', 'all');
INSERT INTO iw_menu_sub VALUES('22', 'Login', '?login', '2', '9', '1', '1', 'all');
INSERT INTO iw_menu_sub VALUES('23', 'Register', '?login&go=register', '3', '9', '1', '1', 'all');
INSERT INTO iw_menu_sub VALUES('24', 'Lost Pasword', '?login&go=lostpass', '4', '9', '1', '1', 'all');
INSERT INTO iw_menu_sub VALUES('25', 'Link', '?com=links', '1', '9', '1', '1', 'all');



DROP TABLE IF EXISTS iw_menu_user;

CREATE TABLE `iw_menu_user` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) NOT NULL,
  `url` text NOT NULL,
  `ordering` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `for` enum('all','admin','user') NOT NULL DEFAULT 'all',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

INSERT INTO iw_menu_user VALUES('1', 'Logout', '?login&go=logout', '1', '1', 'all');
INSERT INTO iw_menu_user VALUES('2', 'My Profile', '?login&go=profile', '2', '1', 'all');
INSERT INTO iw_menu_user VALUES('8', 'Edit Password', '?login&go=profile&to=password', '3', '0', 'all');
INSERT INTO iw_menu_user VALUES('9', 'Avatar', '?login&go=profile&to=avatar', '4', '0', 'all');
INSERT INTO iw_menu_user VALUES('10', 'My Article', 'index.php?com=news&view=myarticle', '6', '0', 'all');
INSERT INTO iw_menu_user VALUES('11', 'My Album', 'index.php?com=gallery&view=myalbum', '5', '0', 'all');



DROP TABLE IF EXISTS iw_options;

CREATE TABLE `iw_options` (
  `name` varchar(64) NOT NULL,
  `value` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO iw_options VALUES('template', 'pempek');
INSERT INTO iw_options VALUES('stylesheet', 'style');
INSERT INTO iw_options VALUES('web_title', 'ID | System');
INSERT INTO iw_options VALUES('web_slogan', 'Easy, Simple, and Fast your access system');
INSERT INTO iw_options VALUES('meta_desc', 'CMS ID Official Site Content Management System Indonesia yang User Frendly');
INSERT INTO iw_options VALUES('meta_key', 'CMS ID, CMS, OpenSource, CMSIndo, PHP, Karya Anak Bangsa, Indonesia, Endonesia, Indonesiaa CMS');
INSERT INTO iw_options VALUES('author', 'admin');
INSERT INTO iw_options VALUES('account', '1');
INSERT INTO iw_options VALUES('web_status', '1');
INSERT INTO iw_options VALUES('charset', 'UTF-8');
INSERT INTO iw_options VALUES('ping_site', 'http://rpc.pingomatic.com/');
INSERT INTO iw_options VALUES('html_type', 'text/html');
INSERT INTO iw_options VALUES('text_direction', 'ltr');
INSERT INTO iw_options VALUES('admin_email', 'id.hpaherba@yahoo.co.id');
INSERT INTO iw_options VALUES('profile', 'http://gmpg.org/xfn/11');
INSERT INTO iw_options VALUES('ext', 'php,css,js,xml,jpg,jpeg,png,gif');
INSERT INTO iw_options VALUES('robots', 'index,follow');
INSERT INTO iw_options VALUES('text_editor', 'tiny_mce');
INSERT INTO iw_options VALUES('copyright', 'YourCompany');
INSERT INTO iw_options VALUES('poweredby', 'cmsid');
INSERT INTO iw_options VALUES('welcom_message', '');
INSERT INTO iw_options VALUES('timezone', 'Asia/Jakarta');
INSERT INTO iw_options VALUES('permalinks', '1::advance::index.php?com=N/A&view=N/A&item_id=N/A::1#2::advance-type::com_N/A&view_N/A=2:N/A::0#3::Slash::com/view/id/title.html::0#4::Clear Slash::view/title.html::0#5::Clear Strip::view-title.html::0');
INSERT INTO iw_options VALUES('update_system', 'yes');
INSERT INTO iw_options VALUES('backup_file', 'cd9c1c9fc1de35331f8c3c7e010cce8b::1321263685#');
INSERT INTO iw_options VALUES('avatar_default', 'mystery');
INSERT INTO iw_options VALUES('post_comment', '1');
INSERT INTO iw_options VALUES('timeout', '3600');
INSERT INTO iw_options VALUES('gmt_set', '0');
INSERT INTO iw_options VALUES('qlinks', 'Media::1::media#Menus::1::menus#Sidebar::1::sidebar#Options::1::options#Layout::1::layout#Backup::1::backup#Users::1::users#Plugins::1::plugins#SEO::3::seo');
INSERT INTO iw_options VALUES('post_comment_filter', '1');
INSERT INTO iw_options VALUES('datetime_format', 'Y/m/d');
INSERT INTO iw_options VALUES('body_layout', '4');
INSERT INTO iw_options VALUES('content_full', '/* CSS Document */#main {	float: left;	margin-left:10px;	width:97.5%;	}');
INSERT INTO iw_options VALUES('content_left', '/* CSS Document */#sidebar{	float:right;	width:220px;	padding-left:1px;	padding-right:10px;}#main {	float:left;	margin-left:10px;	width:70%;	}');
INSERT INTO iw_options VALUES('content_right', '/* CSS Document */#sidebar{	float:left;	width:220px;	padding-left:10px;	padding-right:5px;}#main {	float:left;	margin-left:1px;	width:70%;	}');
INSERT INTO iw_options VALUES('last_checked_update', '{"version":"2.1.0.4","date":"2011-10-18 09:57:57"}');
INSERT INTO iw_options VALUES('sidebar_left', '/* CSS Document */#sidebar{	float:left;	width:165px;	padding-left:13px;	padding-right:5px;}#rightbar {	float:left;	width:28%;	margin-right:5px; }#main{	float:right;	margin-left:1px;	width:47%;	margin-right:15px; }');
INSERT INTO iw_options VALUES('sidebar_right', '/* CSS Document */#sidebar{	float:right;	width:170px;	padding-left:5px;	padding-right:10px;	padding-bottom:9px;}#rightbar {	float:right;	width:28%;	margin-right:0; }#main{	float:left;	width:48%;	margin-left:10px; }');
INSERT INTO iw_options VALUES('widgets', '{"items":[{"id":"item1","collapsed":0,"order":0,"column":"column0"},{"id":"item2","collapsed":0,"order":1,"column":"column0"},{"id":"item3","collapsed":0,"order":2,"column":"column0"},{"id":"item5","collapsed":0,"order":3,"column":"column0"},{"id":"item4","collapsed":0,"order":0,"column":"column1"},{"id":"item6","collapsed":0,"order":1,"column":"column1"}]}');
INSERT INTO iw_options VALUES('content_center', '/* CSS Document */#sidebar{	float:left;	width:165px;	padding-left:13px;	padding-right:5px;}#rightbar {	float:right;	width:28%;	margin-right:15px; }#main{	float:left;	margin-left:1px;	width:47%;}');
INSERT INTO iw_options VALUES('feed_news', '{"feed_judul":"Feed News","feed_url":"http://cmsid.org/rss.xml","feed_list":"5","feed_content":1,"feed_author":null,"feed_date":null}');
INSERT INTO iw_options VALUES('sexybookmarks', '{"status":"1","bg":"7","social":["comfeed","delicious","digg","googlebuzz","misterwong","mixx","reddit","technorati","twitter","blogger","designfloat","facebook","gmail"]}');
INSERT INTO iw_options VALUES('contact_person', '<h3>Tlp. : <span>021-7089 1954, 021-8033 4666</span> HP. : <span>0815 7478 1976</span></h3>E.Yopieyanty,Yahoo Messenger : eyopieyanty@yahoo.com & Blackberry Messenger Pin  219E0C18 FB : pempek8ulu.cikning@yahoo.co.id');



DROP TABLE IF EXISTS iw_phpids;

CREATE TABLE `iw_phpids` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL DEFAULT '',
  `value` text NOT NULL,
  `page` varchar(255) NOT NULL DEFAULT '',
  `ip` varchar(15) NOT NULL DEFAULT '',
  `impact` int(11) unsigned NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS iw_plugins;

CREATE TABLE `iw_plugins` (
  `plugin_path` varchar(80) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`plugin_path`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO iw_plugins VALUES('captcha', '1');
INSERT INTO iw_plugins VALUES('geoip', '1');
INSERT INTO iw_plugins VALUES('stats', '1');
INSERT INTO iw_plugins VALUES('phpids', '0');
INSERT INTO iw_plugins VALUES('sexybookmarks', '1');
INSERT INTO iw_plugins VALUES('list-country', '1');
INSERT INTO iw_plugins VALUES('referer', '1');
INSERT INTO iw_plugins VALUES('rss', '1');
INSERT INTO iw_plugins VALUES('timezone', '1');
INSERT INTO iw_plugins VALUES('posted', '1');
INSERT INTO iw_plugins VALUES('zipped', '1');
INSERT INTO iw_plugins VALUES('cstat', '1');
INSERT INTO iw_plugins VALUES('browse', '1');
INSERT INTO iw_plugins VALUES('seo', '1');
INSERT INTO iw_plugins VALUES('uploader', '1');
INSERT INTO iw_plugins VALUES('editor', '1');
INSERT INTO iw_plugins VALUES('script-load', '0');
INSERT INTO iw_plugins VALUES('gravatar', '1');
INSERT INTO iw_plugins VALUES('tags-clouds', '1');



DROP TABLE IF EXISTS iw_polling;

CREATE TABLE `iw_polling` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) NOT NULL,
  `vote` varchar(225) NOT NULL,
  `hits` varchar(225) NOT NULL,
  `created` date NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO iw_polling VALUES('1', 'Darimana Anda tahu web ini?', '#Search Engine #Blogwalking#Email#Liplet#Dari Teman#Spanduk', '#14#5#1#0#5#0', '2011-09-12', '1');



DROP TABLE IF EXISTS iw_post;

CREATE TABLE `iw_post` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_login` varchar(80) NOT NULL,
  `date_post` datetime NOT NULL,
  `date_modif` datetime NOT NULL,
  `date_update` datetime NOT NULL,
  `title` text NOT NULL,
  `content` longtext NOT NULL,
  `mail` varchar(160) NOT NULL,
  `post_topic` bigint(20) NOT NULL,
  `hits` int(11) NOT NULL,
  `tags` varchar(225) NOT NULL,
  `sefttitle` varchar(200) NOT NULL,
  `type` varchar(20) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `thumb` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

INSERT INTO iw_post VALUES('3', 'admin', '2011-08-24 14:12:39', '2011-09-23 08:25:43', '2011-10-07 20:43:32', 'Varian terbaru cms id sedang dikembangkan', '<p>Mungkin anda sedang bertanya tanya apa maksud judul diatas...</p><p>Baiklah saya akan jelaskan maksudnya iyalah kini cms id sedang mengembangkan verian terbarunya yg powerfull ini juga berkat dari refrensi2 cms yg ada..</p><p>Varian ini diklaim lebih mutahir dari pada versi-versi cms id sebelumnya, tidak akan saya sebutkan verian terbaru ini dikembangkan untuk cms id versi berapa, yg jelas verian ini lebih simple, mudah tapi tidak mudah untuk ditaklukkan... hehehe kyx penjinak aja...:), lebih nyaman digunkan, lebih enteng, content management tersendiri seperti themes, plugin dan application.</p><p>ok saya tidak akan terburu buru untuk mereleasenya... karna saya ingin melihat respon dari anda masing2 pecinta cms id, baik tiu sebagai penyumbang ide, modul, maupun sempat bertanya..</p><p>cms id varian baru ini dikembangkan pada platform yg umum digunakan, seperti</p><p>php dan mysql versi standar, maka dari itu saya selaku admin dan pendiri id (cms id) agar anda mengirimkan kritik dan sarannya agar kami bisa lebih maju &amp; sesuai dengan keinginan anda walaupun tak sempurna, dan saya menyarankan agar anda lebih sabar menunggu kehadiran varian baru ini yg diadobsi dari dari cms cms yg pernah dibuat, kalau bisa dibilang sich mirip tapi tak sama :), itulah cms id</p><p>&nbsp;</p><p>salam id</p><p>by eko</p><p>&nbsp;</p>', '0', '4', '56', 'varian,baru,cmsid', 'varian-terbaru-cms-id-sedang-dikembangkan', 'post', '1', '');
INSERT INTO iw_post VALUES('5', 'admin', '2011-04-24 14:12:51', '2011-09-23 08:29:13', '2011-09-20 08:35:03', 'News and Pages akan jadi satu pada versi terbaru', '<p>ini baru terfikir oleh saya selaku admin &amp; developer bahwa keduannya memiliki karakteristik yang sama yaitu menampilkan text barita / informasi yang kita ketik ini ditunjukan adanya header / title &amp; isi / content, hal ini dapat disatukan dengan menggunakan pemisah type baik itu pages / news. Nah news disini saya ganti menjadi post&nbsp;agar tidak salah kaprah serta memudahkan penyebutannya, lalu bagaimana managemennya yg jelas tidak jauh beda dengan versi versi sebelumnnya.</p><p>&nbsp;</p><p>Pengujian &amp; penerapan ini membuat database tidak memakan banyak space nama &amp; hal ini membuat semakin mudahnya dalam hal backup.</p><p>untuk sisi load code cukup mudah hanya dengan memanggil function yang saya sediakan nantinya.</p><p>mudah mudahan hal ini cepat cepat terlaksana &amp; selesai pada waktunya. amiin</p><p>&nbsp;</p><p>cukup sekian artikel yang saya buat karna saya tidak terlalu pandai dalam membuat sebuah karya tulisan..dan saya menghimbau kepada teman2 agar mendukung kami &amp; para developer cmsid terimakasih..</p>', '0', '17', '23', 'bersatu,terbaru,versi,cmsid,pages,news,post', 'news-and-pages-akan-jadi-satu-pada-versi-terbaru', 'post', '1', '');
INSERT INTO iw_post VALUES('6', 'admin', '2011-04-24 14:12:57', '2011-09-23 08:28:49', '2011-10-26 10:09:38', 'preview design baru untuk cms id versi terbaru yaitu versi 2.1', '<p>versi baru design baru.., ya tema mungkin anda tidak sabar dengan kedatangan versi baru yang akan kami release berikutnya.</p><p>dan tak usah lamalama lagi berikut saya kasih liat preview versi terbaru cms id yang mengusung jQuery.</p><p>berikut link preview lebih lengkapnya <a href="http://www.flickr.com/photos/58290089@N03/5939398637/" target="_self">http://www.flickr.com/photos/58290089@N03/5939398637/&nbsp;</a></p><p>silahkan dinikmati...</p><p>&nbsp;</p><p>versi terbaru yang mengusung jQuery atau yang lebih dikenal bahasa pemrograman javascript ini sangat mudah anda gunakan untuk pengaplikasian cms id , apalagi banyak sekali dukungan plugin2 untuk jQuery tsb, diantara plugin2 jQuery tsb yang saya gunakan diantarannya ada,..</p><p><strong>drag ndrop</strong> yang memungkinkan anda memindai panel2 sesuka anda</p><p><strong>tabs </strong>yang meungkinkan anda meringkas konten dengan hanya menggunakan menu tab</p><p><strong>uniform</strong> hal ini memungkinkan anda membuat menarik tampilan form anda</p><p><strong>wkrte</strong> adalah text editor terbaru untuk cms id yang dimofikasi untuk lebih memudahkan menulis text naskah favorite anda, tp jangan khawatir karna jika anda tidak suka dengan text editor default yang kami sediakan anda bisa memodifikasi dari tinyeditor atau text editor2 yang anda sukai atau anggap favorite dan masih banyak lagi&nbsp;</p><p><img src="http://farm7.static.flickr.com/6014/5939398637_888efbe077_b.jpg" alt="" width="100%" /></p><p>salam id by</p><p>eko</p><p>pendiri cmsid</p>', '0', '17', '5', 'versi baru,cmsid,2.1', 'preview-design-baru-untuk-cms-id-versi-terbaru-yaitu-versi-2-1', 'post', '1', '');
INSERT INTO iw_post VALUES('7', 'admin', '2011-04-24 14:13:03', '2011-09-23 08:29:22', '2011-11-12 13:45:50', 'fitur fitur dan kelebihan yang diusung cms id versi terbaru', '<p>&nbsp;</p><p>pertama tama izinkan saya untuk mengenalkan versi baru cmsid.&nbsp;</p><p>Belum terbayang atau sudah terbayangkah anda dengan cmsid&nbsp;</p><p>versi terbaru ini, apasaja fiturnya, apa lebih mudah apa lebih</p><p>susah,..</p><p>jawabannya adalah banyak sekali keungulan yang diusung di versi</p><p>terbaru ini diantaranya.</p><p>&nbsp;</p><p>1. load query semakin simple.</p><p>misal jika kita ingin meload suatu database anda cukup menggunkan</p><p>library yang sudah disiapkan.</p><p>&nbsp;</p><p>berikut load variable default table</p><blockquote><p>var $old_tables = array( \'users_data\', \'users\', \'sidebar_act\', \'sidebar\', \'sensor\', \'post_topic\', \'post_comment_replay\', \'post_comment\', \'posted_ip\', \'post\', \'plugins\', \'options\', \'menu_user\', \'menu_sub\',\'menu\' );</p></blockquote><p>pertamakali anda harus tau function loadnya</p><p>&nbsp;</p><blockquote><p>global $iw,$db;</p><p>a. $db-&gt;select($table,$where=false,$order=false);</p><p>b. $db-&gt;insert($table,$data);</p><p>c. $db-&gt;update($table,$data,$where=false);</p><p>d. $db-&gt;delete($table,$where);</p><p>e. $db-&gt;replace($table,$data);</p></blockquote><p>&nbsp;</p><p>catatan:</p><p>variabel $table : nama table yang digunakan, misal table \'dbprefix_post\' cukup dipanggil dengan \'post\'</p><p>variabel $where : harus array,karena bernilai false tidak diisi tidak apa apa</p><p>variabel $order : untuk variabel order anda bisa mendescripsikan seperti biasa, bernilai false</p><p>variabel $data &nbsp;: variable yang akan diinsertkan atau di update</p><p>&nbsp;</p><p>contoh:</p><p>kita mau melist table posting scriptnya:</p><p>&nbsp;</p><blockquote><p>global $iw,$db;</p><p>$db=new mysql; // ini tidak ditulis tidak apa apa, karena system mengglobalkan variablenya</p><p>$db-&gt;add_table(\'post\'); // ini digunakan jika table yang ada panggil tidak ada pada daftar array default</p><p>&nbsp;</p><p>$where = array(\'id\'=&gt;23,\'type\'=&gt;\'post\');</p><p>$order = \'id DESC LIMIT 10\';</p><p>&nbsp;</p><p>$sql = $db-&gt;select(\'post\',$where,$order);</p><p>while($row = $db-&gt;fetch_array($sql)){</p><p>&nbsp;</p><p>echo $row[\'title\'];</p><p>&nbsp;</p><p>}</p></blockquote><p>trus bagaimana klo pemanggilan querynya seperti biasa aja, apa masih bisa?<br /> jawabannya masih bisa:<br /> scriptnya sbr:</p><blockquote><p>global $iw,$db;</p><p>$db-&gt;query(\'SELECT * FROM \'.$iw-&gt;pre.\'post WHERE id=23 AND type="post" ORDER BY id DESC LIMIT 10 \');</p><p>while($row = $db-&gt;fetch_array($sql)){</p><p>&nbsp;</p><p>echo $row[\'title\'];</p><p>&nbsp;</p><p>}</p></blockquote><p>&nbsp;</p><p>2.struktur direktori cmsid</p><p>&nbsp;</p><blockquote><p>iadmin/</p><p>-manage/</p><p>--direktor system</p><p>----&gt;manage.php</p><p>----&gt;inc.php</p><p>-templates</p><p>&nbsp;</p><p>icontent/</p><p>-applications/</p><p>--direktor aplikasi</p><p>----&gt;manage.php</p><p>----&gt;inc.php&nbsp;</p><p>----&gt;load.name load .php (*) file ini yang akan di load dengan link \'irequest.php?load=(nama load)&amp;app=(nama apps)\'</p><p>&nbsp;</p><p>-images/</p><p>-javascripts/</p><p>-plugins/</p><p>--berisi plugin-plugin, bisa berupa direktori atau berupa file</p><p>&nbsp;</p><p>-stylesheet/</p><p>-themes/</p><p>--direktori themes</p><p>&nbsp;</p><p>-uploads/</p><p>&nbsp;</p><p>ilibs/</p><p>-(*) library pendukung</p><p>&nbsp;</p><p>temp/</p><p>-(*) tempat penyimpanan sementara</p><p>&nbsp;</p><p>iconfig.php (*) pengaturan koneksi kedatabase dan lain-lain</p><p>irequest.php (*) load request file apps</p><p>index.php (*) indexing cms</p><p>&nbsp;</p></blockquote><p>&nbsp;</p><p>3.halaman login, registrasi tersendiri</p><p>4.cpanel management lebih memudahkan dalam berinstraksi seperti yang bisa anda lihat&nbsp;</p><p>pada link: http://www.cmsid.org/article/preview-design-baru-untuk-cms-id-versi-terbaru-yaitu-versi-2-1.html</p><p>&nbsp;</p><p>5.table news &amp; page dijadikan satu \'post\' dengan type sebagai pembedanya&nbsp;</p><p>6.pengaturan web lebih mudah dengan disediakannya panel panel sebagai berikut:</p><p>a. panel option</p><p>1.general: mengatur meta web seperti title,deskription,keyword, email bahkan zona waktu atau timzone</p><p>2.privacy: pengaturan pribadi content, seperti author name, account registration,web status, admin message, update system &nbsp;(belum tersedia untuk versi beta),</p><p>timout (batas waktu web logout bisa tidak ada kativitas sama sekali pada admin atau content)</p><p>3.permalinks: mengatur bentuk link content (belum tersedia untuk versi beta), dan lain lain.</p><p>b. panel users</p><p>untuk mengatur &amp; memanage user account</p><p>c. panel backup</p><p>untuk membeckup database maupun file website</p><p>d. panel layout</p><p>untukn mengatur &amp; mengedit themes</p><p>e. panel sidebar</p><p>untuk mengatur posisi, action, block dengan mudah, sekarang sudah dipermudah dengan icon icon action</p><p>f. panel menus</p><p>untuk mengatur menu yang ditampilkan di web (dalam penyempurnaan)</p><p>g. media /file web manager</p><p>untuk memonitoring file dan direktori web &nbsp;(dalam penyempurnaan)</p><p>h. panel plugins</p><p>untuk memange plugin-plugin dengan mudah, anda bisa layaknya plugin-plugin pada cms wordpress</p><p>&nbsp;</p><p>7.application manager</p><p>untuk memanage aplikasi seperti postingan, contact message dll</p><p>&nbsp;</p><p>&nbsp;</p><p>itu adalah beberapa kelebihan atau fitur yang diusing pada versi terbaru, kami developer tidak luput dari kesalahan atau humman error</p><p>maka dari itu kami memerlukan sedikit dukungan anda yang sekirannya dapat menjadikan cms ini sebagai cms yang lebih baik lagi</p><p>&nbsp;</p><p>trimakasih..</p><p>&nbsp;</p><p>salam id</p><p>&nbsp;</p><p>by eko</p><p>&nbsp;</p><p>dev &amp; pendiri id</p><p>&nbsp;</p>', '0', '17', '174', 'fitur,new version,cmsid', 'fitur-fitur-dan-kelebihan-yang-diusung-cms-id-versi-terbaru', 'post', '1', '');
INSERT INTO iw_post VALUES('37', 'admin', '2011-11-11 21:13:29', '2011-11-12 14:23:40', '2011-11-11 21:13:29', 'Pempek 8 Ulu Cik Ning', '<div>Congratulations.</div><div>Selamat atas keberhasilan Pempek 8 Ulu Cik Ning dalam meraih apresiasi penghargaan sebagai peraih "FRANCHISE &amp; BUSINESS OPPORTUNITY BEST SELLER 2010" untuk kategori business opportunity Pempek, paling "LARIS" yang dipilih oleh calon investor atau calon franchisee sepanjang tahun 2010 dari Majalah Info Franchise Indonesia &amp; Tabloid Business Opportunity melalui kajian riset (phone survey) terhadap perkembangan dan penambahan jumlah gerai dari masing masing merek franchise &amp; business opportunity di setiap kategori bisnis untuk masa 2010.</div><div>&nbsp;</div><div><div><div><div>Pempek 8 Ulu Cik Ning</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</div><div>Adalah pempek yang dibuat dengan resep dari leluhur kami, yang pada awalnya tinggal di pinggiran Sungai Musi dan secara turun-temurun mewariskan resep tersebut hingga akhirnya di generasi kami merasa perlu untuk dikembangkan secara Profesional.</div><div><br /></div><div>Adapun sistem yang kami tawarkan yaitu Franchise atau bisnis Opportunity, yang kita kenal secara umum Waralaba.</div></div><div><br /></div><div>Keunggulan menjadi Mitra usaha Pempek 8 Ulu Cik Ning :</div><div><ul><li>1. Produk (pempek palembang) sudah sangat terkenal di seluruh Indonesia bahkan dinegara ASEAN dan Timur Tengah, sebagai makanan yang mempunyai ciri khas tersendiri dan bernilai gizi tinggi.</li><li>2. Usaha sudah terbukti menguntungkan dengan 3 (tiga) cabang yang kami miliki dan 20 (Dua Puluh) mitra yang sudah bergabung dengan kami<br /></li><li>3. Rasa yang sangat istimewa (gurih, rasa ikan terasa, cuko/kuah pempek sangat khas, karena sebagian besar bahan bakunya kami datangkan dari Palembang)</li><li>4. Tidak menggunakan bahan pengawet makanan, tanpa pemutih, tanpa pelembut.</li><li>5. Kemasan/packaging pempek sudah menggunakan teknologi mesin sehingga&nbsp; rasa dan kualitas tetap terjaga.</li><li>6. Desain gerobak dan interior sangat menarik dan modern (desain gerobak menggunakan miniatur Jembatan Ampera yang sudah sangat terkenal di Indonesia)</li><li>7. Sangat cepat balik modal / BEP ( 5 - 7 bulan )</li><li>8. Nilai investasi terjangkau, dibandingkan dengan kompetitor lain.</li><li>9. Sangat mudah dijalankan oleh mitra usaha</li><li>10. Mitra usaha akan ditraining dan dikontrol secara berkala</li><li>11. Pangsa pasar yang masih terbuka lebar di seluruh Indonesia</li><li>11. Promosi Pempek 8 Ulu Cik Ning dilakukan secara terus menerussecara nasional sehingga makin dikenal masyarakat</li><li>12. Keuntungan belum termasuk penjualan minuman yang hasilnya secara utuh dimiliki oleh pihak mitra. &nbsp;&nbsp;</li></ul><div><div>E.Yopieyanty,Yahoo Messenger : eyopieyanty@yahoo.com &amp; Blackberry Messenger Pin &nbsp;219E0C18 &nbsp; Tlp. : 021-7089 1954, 021-8033 4666, HP. : 0815 7478 1976 ; FB : pempek8ulu.cikning@yahoo.co.id</div><div><br /></div><div>Pilihan Investasi&nbsp;</div><div><br /></div><div>Ada empat pilihan investasi yang kami berikan untuk Anda :</div></div><div><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: justify; padding: 0px;">&nbsp;</p><p>&nbsp;</p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: justify; padding: 0px;">&nbsp;</p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: center; padding: 0px;">&nbsp;<span style="background-color: inherit;"><a href="?com=page&amp;id=2"><img style="border-color: #cccccc; border-style: solid; padding: 0px; margin: 0px;" src="http://www.pempekcikning.com/files/gerobak_1.gif" alt="" width="105" height="119" /></a></span>&nbsp;&nbsp;<a href="?com=page&amp;id=2"><span style="background-color: inherit;"><img style="border-color: #cccccc; border-style: solid; padding: 0px; margin: 0px;" src="http://www.pempekcikning.com/files/gerobak_2.gif" alt="" width="105" height="119" /></span>&nbsp;</a>&nbsp;<a href="?com=page&amp;id=2"><span style="background-color: inherit;"><img style="border-color: #cccccc; border-style: solid; padding: 0px; margin: 0px;" src="http://www.pempekcikning.com/files/gerobak_3.gif" alt="" width="105" height="119" /></span>&nbsp;</a>&nbsp;<span style="background-color: inherit;"><a href="?com=page&amp;id=2"><img style="border-color: #cccccc; border-style: solid; padding: 0px; margin: 0px;" src="http://www.pempekcikning.com/files/kios.gif" alt="" width="105" height="119" /></a></span></p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: center; padding: 0px;">&nbsp;</p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: center; padding: 0px;"><img style="border-color: #cccccc; border-style: solid; padding: 0px; margin: 0px;" src="http://www.pempekcikning.com/grbk1.jpg" alt="" width="110" height="146" /><img style="border-color: #cccccc; border-style: solid; padding: 0px; margin: 0px;" src="http://www.pempekcikning.com/grbk2.jpg" alt="" width="109" height="146" />&nbsp;&nbsp;<img style="border-color: #cccccc; border-style: solid; padding: 0px; margin: 0px;" title="typeresto" src="http://www.pempekcikning.com/images/typeresto.jpg" alt="" width="195" height="147" /></p></div></div></div></div>', 'admin@pempek.com', '0', '0', '', 'pempek-8-ulu-cik-ning', 'page', '1', 'pempek.jpg');
INSERT INTO iw_post VALUES('44', 'admin', '2011-11-12 12:43:30', '2011-11-12 12:43:30', '2011-11-12 12:43:30', 'Type Resto', '<p>&nbsp;</p><p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;"><img style="border-color: #cccccc; border-style: solid; padding: 0px; margin: 0px;" title="Resto" src="http://www.pempekcikning.com/images/resto.gif" alt="" width="442" height="289" /></p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;">&nbsp;</p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;"><span style="font-size: medium; padding: 0px; margin: 0px;">TYPE RESTO / KIOS&nbsp;&nbsp;</span>&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;<strong style="padding: 0px; margin: 0px;"><span style="color: #ff0000; font-size: small; padding: 0px; margin: 0px;">Rp. 50.000.000,-</span></strong></p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;">Ukuran Ruangan min. panjang 6 m x lebar 3 m&nbsp;&nbsp;&nbsp;<br style="padding: 0px; margin: 0px;" /><br style="padding: 0px; margin: 0px;" />Pihak mitra akan mendapatkan :</p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;"><img style="border-color: #cccccc; border-style: solid; padding: 0px; margin: 0px;" src="http://www.pempekcikning.com/files/resto1.gif" alt="" width="536" height="682" /></p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;"><img style="border-color: #cccccc; border-style: solid; padding: 0px; margin: 0px;" src="http://www.pempekcikning.com/files/resto2.gif" alt="" width="536" height="642" /></p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;">&nbsp;</p></p>', 'admin@pempek.com', '0', '0', '', 'type-resto', 'page', '1', '');
INSERT INTO iw_post VALUES('38', 'admin', '2011-11-12 11:09:10', '2011-11-12 12:31:18', '2011-11-12 11:09:10', 'Produk Pempek Cik Ning', '<h2><span style="font-weight: normal;">Produk Pempek Cik Ning</span></h2><div><br /></div><div><strong>KAPAL SELAM (Submarine)</strong></div><div><br /></div><div>Kapal Selam adalah menu pempek terpopuler di Indonesia, dari seluruh jenis makanan Palembang. Dibuat dari tepung sagu berkualitas yang diadon bersama daging ikan tengiri beserta bumbu-bumbu khas, dibentuk menyerupai kapal selam serta diisi dengan telur. Disajikan dengan kuah cuko dan serbuk ebi. Sangat lezat.</div><div><br /></div><div><br /></div><div><strong>LENJER</strong></div><div><br /></div><div>Lenjer memiliki bahan dasar yang sama dengan Kapal Selam, hanya saja produk ini tidak diisi dengan telur di dalamnya. Ia hanya dibentuk menyerupai silinder, digoreng untuk kemudian dihidangkan bersama larutan khas &ldquo;cuko Palembang&rdquo; ditambah serbuk ebi (udang kering), dan irisan mentimun.&nbsp;</div><div><br /></div><div>Lenjer digemari oleh penikmat pempek yang benar-benar ingin merasakan aroma ikan tenggiri murni tanpa campuran rasa telur.</div><div><br /></div><div><br /></div><div><strong>ADAAN</strong></div><div><br /></div><div>Adaan bebentuk bulat seperti bola pingpong, diameter sekitar 5 &ndash; 7 sentimeter. Dibuat dari bahan dasar yang sedikit berbeda dengan Kapal Selam atau pun Lenjer.</div><div><br /></div><div>Adonan Adaan dibuat dari bahan dasar pempek yang mirip dengan yang digunakan Kapal Selam dan Lenjer, tapi ditambah dengan beberapa bahan bumbu alamiah lain yang akan meningkatkan gurihnya rasa Adaan. Sangat digemari oleh mereka yang memuja selera bernuansa rasa gurih. Disajikan dengan kuah cuko bertabur serbuk ebi.</div><div><br /></div><div><br /></div><div><strong>LENGGANG</strong></div><div><br /></div><div>Lenggang pada umumnya disajikan dari irisan pempek Lenjer yang kemudian dicemplungkan ke dalam kocokan telur. Bentuk hidangannnya mirip dengan omelet yang dikonsumsi bersama kuah Cuko Palembang, taburan serbuk ebi dan juga irisan mentimun.</div><div><br /></div><div><br /></div><div><strong>PISTEL</strong></div><div><br /></div><div>Pempek Pistel merupakan salah satu anggota produk pempek yang di dalamnya diisikan sesuatu. Dalam hal ini, Pistel berisi irisan buah pepaya mengkal yang dibumbui dengan bahan nabati sehingga mampu mempersembahkan rasa lexat.</div><div><br /></div><div>Seperti lazimnya jenis-jenis pempek yang lain, Pistel juga dihidangkan bersama kuah Cuko Palembang yang memiliki rasa kombinasi manis-asam- gurih-pedas.</div><div><br /></div><div><br /></div><div><strong>PEMPEK KERITING</strong></div><div><br /></div><div>Mengapa produk yang satu ini dinamakan Pempek Keriting? Nah, kalau Anda pernah melihat sejenis kue yang disebut Kue Kutu Mayang, maka Pempek Keriting memiliki bentuk yang sangat mirip dengan itu.</div><div><br /></div><div>Menyerupai mie yang terpilin-pilin satu sama lain, Pempek Pistel membentuk satu kesatuan tampilan yang indah dan menggugah selera.</div><div><br /></div><div>Disajikan dengan kuah Cuko Palembang, taburan serbuk ebi dan irisan buah ketimun. Sedap sekali.</div><div><br /></div><div><br /></div><div><strong>TEKWAN</strong></div><div><br /></div><div>Produk ini berbeda dengan produk pempek pada umumnya. Tekwan sangat menyerupai sup, karena memiliki kuah persis seperti sup biasa yang berwarna bening. Karena bentuknya yang seperti itu, Tekwan menjadi lazim untuk dimakan sebagai makanan utama (main course), lengkap dengan nasi beserta lauk-pauk yang lainnya.</div><div><br /></div><div>Tekwan berisi pempek-pempek kecil yang dibentuk sedemikian rupa, dikombinasi dengan irisan bangkuang, daun bawang, seledri, jamur kuping dan lain-lain. Cocok untuk makan siang atau malam.</div><div><br /></div><div><br /></div><div><strong>MODEL</strong></div><div><br /></div><div>Kalau Tekwan menyerupai sup dengan kuah bening, maka demikian juga dengan Model. Bedanya hanyalah Model menggunakan bumbu ikan, sedangkan Tekwan menggunakan bumbu udang.</div><div><br /></div><div>Bahan pempek yang dibubuhkan ke dalam kuah Model, mirip dengan bahan Lenjer tapi sedikit lebih gurih. Bahan pempek dalam kuah Model biasanya diisi dengan tahu.</div><div><br /></div><div>Seperti juga Tekwan, Model cocok untuk dihidangkan sebagai menu pokok (main course) untuk makan siang atau makan malam. Lezat dan gurih.</div>', 'admin@pempek.com', '0', '0', '', 'produk-pempek-cik-ning', 'page', '1', 'pempek.jpg');
INSERT INTO iw_post VALUES('39', 'admin', '2011-11-12 11:53:09', '2011-11-12 11:53:47', '2011-11-12 11:53:09', 'Paket Penjualan Pempek', '<p></p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;"></p><p>&nbsp;</p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;">Paket Hemat ( Spesial Ramadhan )</p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;">&nbsp;</p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;">Pempek Cikning selain melayani catering juga menerima pesanan dalam bentuk paket, berikut adalah Paket - paket yang kami tawarkan :</p><p>&nbsp;</p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;"><img src="icontent/uploads/post/pakethemat.png" alt="" width="526" height="369" /></p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;">&nbsp;</p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; padding: 0px;">Note :&nbsp;</p><ul style="padding-top: 0px; padding-right: 15px; padding-bottom: 0px; padding-left: 15px; margin-top: 10px; margin-right: 30px; margin-bottom: 10px; margin-left: 30px; color: #4284b0;"><li style="padding: 0px; margin: 0px;">Harga belum termasuk ongkos kirim</li><li style="padding: 0px; margin: 0px;">Tanggal order terakhir&nbsp;25 Agustus 2011</li><li style="padding: 0px; margin: 0px;">Daya tahan perjalanan 4 hari dan daya tahan penyimpanan dalam cheeler 2 minggu</li><li style="padding: 0px; margin: 0px;">Tanpa pengawet karena dikemas dengan Vacuman, tidak ada bakteri</li><li style="padding: 0px; margin: 0px;">Order langsung by phone : ke Opie&nbsp;( 0815 1988 7702 )&nbsp;atau&nbsp;( 021 921 25607 ).<br style="padding: 0px; margin: 0px;" /></li></ul><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; padding: 0px;">&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>', 'admin@pempek.com', '0', '0', '', 'paket-penjualan-pempek', 'page', '1', '');
INSERT INTO iw_post VALUES('40', 'admin', '2011-11-12 12:08:16', '2011-11-12 12:28:18', '2011-11-12 12:08:16', 'Profile', '<p>&nbsp;</p><p>Dari Petugas Cleaning Servis ke Bisnis Waralaba</p><p>Pondokgede, Warta Kota</p><p>Perjalanan usaha Imron Casidy, pemilik usaha Pempek 8 Ulu Cik Ning, agaknya merupakan kisah menakjubkan yang datang dari dunia wirasusaha di Indonesia, khususnya UMKM (Usaha Mikro Kecil dan menengah). Berangkat dari strata terbawah, jatuh bangun meraih cita-cita menjadi wirausahawan di bidang kuliner pempek yang kini diwaralabakan, memberikan inspirasi menarik bagi siapa pun.</p><p>Setelah lulus SMA di kota asalnya, Palembang, Sumatera Selatan pada tahun 1995, Imron, demikian dia dipanggil, merantau ke Jakarta untuk mengadu nasib. Dia mengawali dunia kerjanya sebagai wiraniaga alias sales panci dan sederet pekerjaan serabutan lain.</p><p>Namun Imron hanya tahan menjalani pekerjaan sebagai sales panci dan sejumlah pekerjaan serabutan itu selama enam bulan. Lepas dari pekerjaan-pekerjaan yang dipandangnya tidak memiliki masa depan yang cerah, Imron berupaya mencari pekerjaan lain. Tetapi bekal ijazah SMA-nya hanya mampu mengantarkannya menjadi petugas kebersihan alias cleaning servis pada sebuah rumah sakit swasta di Jakarta.</p><p>Di rumah sakit swasta itu, Imron menjalani perkerjaannya dengan rajin, tekun dan disiplin.</p><p>Buahnya adalah kenaikan pangkat. Posisinya sebagai petugas kebersihan pun segera berubah menjadi pembantu alias asisten perawat dan asisten dokter di rumah sakit itu.</p><p>Setelah menjadi asisten perawat dan dokter, pria kelahiran Palembang 30 Agustus 1976 ini menyadari bahwa meningkatkan pendidikan menjadi kebutuhan yang tidak bisa diabaikan. Karena itu pada 1998, dengan tetap bekerja di rumah sakit dia juga menjalani kuliah di Sekolah Tinggi Ilmu Ekonomi (STIE) Kusuma Negara.</p><p>Menjalani tugas ganda, yakni bekerja sambil kuliah bukanlah hal yang mudah. Namun Imron sudah terlatih untuk memperjuangkan cita-cita yang ingin diraihnya dengan gigih. Hasilnya pada 2002 Imron menyabet gelar S1. Bahkan dia kemudian diangkat sebagai asisten manajer pada departemen gizi rumah sakit itu.</p><p>Pindah profesi</p><p>Namun setelah merasa cukup waktu menjalani pekerjaannya sebagai karyawan, ada hal yang mengusik pikiran Imron. Hal itu ialah naluri bisnis yang dia nilai turun dari kedua orangtuanya, pasangan suami-isteri Mat Musi dan Cik Ning. Pada saat yang bersamaan dia juga ingin berpindah kuadran yang dinilainya sulit dipenuhi hanya dengan membenamkan hidup sebagai karyawan.</p><p>Sebelumnya selama tinggal bersama orang tuanya di Palembang, Imron telah terbiasa bekerja ikut menjalani usaha orangtuanya, yakni berjualan makanan khas Palembang, pempek. Masa-masa ini secara perlahan menumbuhkan jiwa bisnis dalam dirinya.</p><p>Pada tahun 2004 Imron nekat mulai menjalani usaha dengan membuka usaha bakery dan agensi di bidang properti. Selain itu dia juga mulai melirik dunia advertising. Namun ternyata usaha hanya dengan mengandalkan naluri bisnis saja tidak cukup. Pengalamannnya yang minim di dunia bakery dan agensi propertinya membawanya ke jurang kegagalan.</p><p>Setelah mengalami kegagalan mata Imron terbuka. Dia tidak kapok. Alih-alih dia mulai menyadari bahwa banyak hal yang harus dipelajari dalam dunia usaha. Banyak syarat yang harus dipenuhi dan dilakukan ketika seseorang menjalani usaha.</p><p>Imron pun mulai belajar banyak dari orang lain yang dia pandang sukses dalam menjalani usaha. Dari pembelajarannya dia memperoleh inspirasi sekaligus melihat propsek bisnis dari usaha orang tuanya di Palembang. Sebab selain memiliki kemampuan bertahan dalam waktu yang lama, usaha pempek orang tuanya dengan merek Pempek 8 Ulu Cik Ning di Palembang memiliki sejumlah kekuatan untuk dikembangkan di Jakarta.</p><p>Pada 2007 dia meralisasikan mimpinya dengan membuka usaha pempek di Jalan Lapangan Tembak, Cibubur, Jakarta Timur. Nama usahanya mengusung merek usaha orang tuanya, yakni Pempek 8 Ulu Cik Ning Pelembang.</p><p>"Pempek 8 Ulu Cik Ning adalah pempek yang dibuat dengan resep dari leluhur kami, yang tinggal di pinggiran Sungai Musi dan secara turun-temurun mewariskan resepnya hingga generasi orang tua kami. Jadi sudah teruji sehingga generasi kami merasa perlu mengembangkannya secara profesional," kata Imron dalam suatu percakapan dengan Warta Kota baru-baru ini..</p><p>Profesional menjadi kata kunci bagi Imron dalam menjalani usaha. Dalam waktu satu tahun usahanya berkembang . Secara bertahap dalam waktu satu tahun usaha yang berdiri pada 2007 itu berkembang menjadi tiga cabang.</p><p>Mewaralabakan</p><p>Setelah usaha pempeknya berkembang, Imron tak mau berhenti. Suatu hari pada 2009 dia memperoleh informasi bahwa Rumah Perubahan "Rhenald Kasali Schooll of Entrepreneur (RKSE) membuka pelatihan bagi wirausahwan muda.</p><p>RKSE adalah sebuah lembaga yang didirikan oleh pakar manajemen sekaligus guru besar pada Fakultas Ekonomi Universitas Indonesia, Prof Dr Rhenald Kasali bersama dua wirausahawan yakni Henky Eko Sriyantono. dan Sunaryo Suhadi. Lembaga ini didirikan untuk memberikan pelatihan kepada para wirusahawan muda dan pelaku UMKM Indonesia agar nmereka naik kelas menjadi wirausahawan modern.</p><p>"Pelatihan di RKSE memberikan banyak bekal kepada saya. Selain motivasi, teknis dasar</p><p>memulai bisnis secara benar, dan langkah-langkah mengembankannya, sya juga mendapatkan wawasan berbisnis secara benar, beretika juga visi yang harus dibangun. Selain itu kami didorong untuk berani menerobios pasar dan saling berbagi dengan sesama peserta,:" kata Imron tentang pelatihan yang dijalaninya di RKSE</p><p>Selepas dari RKSE Imron Caisidy berusaha mempertajam visi bisnisnya. Setelah melihat peluang pasar pempek begitu besar dia pun membuat pengembangan secara berani. Pria yang kini tengah menyelesaikan studi S2-nya pada Fakultas Ekonomi Universitas Trisakti Jakarta ini memasuki bisnis waralaba. Brand Pempek 8 Ulu Cik Ning diwaralabakan. Dan hasilnya adalah sambutan yang menurunya luar biasa..</p><p>Secara bertahap dalam waktu satu tahun Pempek 8 Ulu Cik Ning pun memiliki 14 mitra franchise dengan 19 outlet di Jabodetabek dan satu gerai lagi di Banda Aceh. Selain itu usaha pempeknya juga mulai memasuki pusat perbelanjaan seperti Hypermart, hotel dan penyetok pempek untuk usaha katering.</p><p>"Pempek kami juga mulai dikenal kalangan secara lebih luas. Selain kami telah membuka cabang di lingkungan DPR, pempek kami juga mulai dikenal oleh kalangan pejabat tinggi. Kami juga diundang untuk mengikuti pameran makanan khas yang diselengfarakan oleh KBRI Manila, Filipina yang akan berlangsung selama tiga hari tanggal 7-9 Oktober 2010 mendatang. Doakan saja semoga sukses," kata Imron yang pandai bergaul ini.</p><p>Imron juga meyakinkan bahwa bermitra dengan Pempek 8 Ulu Cik Ning adalah peluang usaha yang prospektif dan memiliki visi bisnis yang baik. Sebab mejalani usaha di bidang makanan khas Palembang ini juga merupakan upaya melestarikan warisan kuliner atau makanan enak Indonesia secara nasional dan internasional.</p><p>"Kami juga membangun sistem manajemen yang profesional dan jaringan bisnis yang tepat dan menguntungkan,\' kata Imron Casidy dengan nada meyakinkan. (willy Pramudya)</p>', 'admin@pempek.com', '0', '0', '', 'profile', 'page', '1', '091d43e6c627d68eb52a628e0f5cc7b0.jpg');
INSERT INTO iw_post VALUES('41', 'admin', '2011-11-12 12:41:02', '2011-11-12 12:41:02', '2011-11-12 12:41:02', 'Type Gerobak 1', '<p>&nbsp;</p><p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;"><img style="border-color: #cccccc; border-style: solid; padding: 0px; margin: 0px;" src="http://www.pempekcikning.com/grbk1.jpg" alt="" width="283" height="378" /></p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;">&nbsp;</p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;"><span style="font-size: medium; padding: 0px; margin: 0px;">TYPE GEROBAK I&nbsp;</span>&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;<strong style="padding: 0px; margin: 0px;"><span style="color: #ff0000; font-size: small; padding: 0px; margin: 0px;">Rp. 10.000.000,-</span></strong><br style="padding: 0px; margin: 0px;" /><br style="padding: 0px; margin: 0px;" />Ukuran Panjang 1,25 m x Lebar 60 cm<br style="padding: 0px; margin: 0px;" />Pihak mitra akan mendapatkan :</p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;"><img style="border-color: #cccccc; border-style: solid; padding: 0px; margin: 0px;" src="http://www.pempekcikning.com/files/10_A.gif" alt="" /></p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;"><img style="border-color: #cccccc; border-style: solid; padding: 0px; margin: 0px;" src="http://www.pempekcikning.com/files/10_B.gif" alt="" /></p></p>', 'admin@pempek.com', '0', '0', '', 'type-gerobak-1', 'page', '1', '');
INSERT INTO iw_post VALUES('42', 'admin', '2011-11-12 12:41:41', '2011-11-12 12:41:41', '2011-11-12 12:41:41', 'Type Gerobak 2', '<p>&nbsp;</p><p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;"><img style="border-color: #cccccc; border-style: solid; padding: 0px; margin: 0px;" src="http://www.pempekcikning.com/grbk2.jpg" alt="" width="283" height="378" /></p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;">&nbsp;</p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;"><span style="font-size: medium; padding: 0px; margin: 0px;">TYPE GEROBAK II&nbsp;&nbsp;</span>&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;<strong style="padding: 0px; margin: 0px;"><span style="color: #ff0000; font-size: small; padding: 0px; margin: 0px;">Rp. 12.500.000,-</span></strong></p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;"><br style="padding: 0px; margin: 0px;" />Ukuran Panjang 1,50 m x Lebar 60 cm<br style="padding: 0px; margin: 0px;" />Pihak mitra akan mendapatkan :</p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;">&nbsp;<img style="border-color: #cccccc; border-style: solid; padding: 0px; margin: 0px;" src="http://www.pempekcikning.com/files/12_A.gif" alt="" /></p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;"><img style="border-color: #cccccc; border-style: solid; padding: 0px; margin: 0px;" src="http://www.pempekcikning.com/files/12_B.gif" alt="" /></p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;">&nbsp;</p></p>', 'admin@pempek.com', '0', '0', '', 'type-gerobak-2', 'page', '1', '');
INSERT INTO iw_post VALUES('43', 'admin', '2011-11-12 12:42:05', '2011-11-12 12:42:05', '2011-11-12 12:42:05', 'Type Gerobak 3', '<p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;"><img style="border-color: #cccccc; border-style: solid; padding: 0px; margin: 0px;" src="http://www.pempekcikning.com/grbk2.jpg" alt="" width="283" height="378" /></p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;">&nbsp;</p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;">&nbsp;</p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;"><span style="font-size: medium; padding: 0px; margin: 0px;">TYPE GEROBAK III &nbsp;</span>&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;<strong style="padding: 0px; margin: 0px;"><span style="color: #ff0000; font-size: small; padding: 0px; margin: 0px;">Rp. 15.000.000,-</span></strong></p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;"><br style="padding: 0px; margin: 0px;" />Ukuran Panjang 1,50 m x Lebar 60 cm<br style="padding: 0px; margin: 0px;" />Pihak mitra akan mendapatkan :</p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;">&nbsp;</p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;"><img style="border-color: #cccccc; border-style: solid; padding: 0px; margin: 0px;" src="http://www.pempekcikning.com/files/15_A.gif" alt="" width="483" height="445" /></p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;"><img style="border-color: #cccccc; border-style: solid; padding: 0px; margin: 0px;" src="http://www.pempekcikning.com/files/15_B.gif" alt="" /></p></p>', 'admin@pempek.com', '0', '0', '', 'type-gerobak-3', 'page', '1', '');
INSERT INTO iw_post VALUES('45', 'admin', '2011-11-12 12:51:01', '2011-11-12 12:51:01', '2011-11-12 12:51:01', 'Testimoni', '<p><p>Berikut adalah beberapa komentar tamu yang telah mencoba Pempek Cik Ning :</p><p>Wah enak banget rasanya.. pempek 8 ulu cik ning Palembang tidak kalah dengan rasanya pempek yg sudah duluan Top namanya. Ir.Fuad Zakaria ( Ketua Umum Apersi)</p><p>Luar Biasa Enak pempek 8 ulu cik ning, ikan nya sangat terasa, teksturnya lembut dan gurih serta bumbu cukanya yang pas di lidah. Henky Eko Sriyantono ST. MT (Pimpinan Bakso Malang Kota Cak Eko dan sebagai Direktur PT. Rhenald Kasali School for Entrepreneurs )</p><p>Dahsyat, Rasanya Luar Biasa. Kapten Jhony Bais&nbsp;</p><p>aduh emang enak bangeeet yee kalau makan makanan khas suatu daerah dari negeri asal sendiri .. beda ajah rasanya dan tempatnya ne loch seperti sedang &nbsp;di palembang. &nbsp;E.Yopie Yanty ( Karyawan Bank Mega )</p><p>Gila bener mantapny ini pempek 8 ulu cik ning ... br x ne ngerasain pempek yg pas bgt di lidah kalah dc yg laen... &nbsp;Hizrian Fathullah Raz ( Board of Director PT.Asda)</p><p>TOP Buanggett... pempek 8 ulu cik ning Palembang. Rasanya pempek, ikan, cuko nya g bisa di ungkapkan dgn kata2 dc. Maida Novriza ( Director of HR Smart FM Network)</p><p>2 Jempol dc buat Pempek 8 ulu cik ning... top &amp; mantap. Ryan Hartono, SE. SH ( Managing Partner Harmet &amp; CO )</p><p>Saya gak begitu sering makan yang namanya pempek. Terakhir kali kalau gak salah ingat waktu pacaran dulu.Tapi begitu suami saya menyuruhnya mencoba pempek yang dibawanya yang katanya dibeli di warung pempek Cik Ning 8 Ulu. Saya menyuruhnya membeli sekali lagi. Kalau rasa yang kedua kali saya makan dalam keadaan perut kenyang pempek masih terasa enak baru terbukti kalau makanan itu memang enak. Dan ternyata.... Luar biasa bahkan saya rasa tetap enak. Camelia Wibowo (Pemilik Resturant Lemon Kitchen )</p></p>', 'admin@pempek.com', '0', '0', '', 'testimoni', 'page', '1', '');
INSERT INTO iw_post VALUES('46', 'admin', '2011-11-12 12:52:13', '2011-11-12 12:52:13', '2011-11-12 12:52:13', 'Catering', '<p><p>Program Catering Pempek Cik Ning merupakan salah satu side business andalan yang dikelola oleh Pempek Cik Ning sebagai upaya untuk mendekatkan diri dengan para pelanggan.</p><p>Kami siap melayani berbagai moment special Anda, seperti :</p><p>- pesta pernikahan</p><p>- pesta ulang tahun</p><p>- Seminar</p><p>- Rapat kantor</p><p>- Pertemuan keluarga</p><p>- Arisan, dll.</p></p><p><img style="color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; border-color: #cccccc; border-style: solid; padding: 0px; margin: 0px;" src="http://www.pempekcikning.com/images/ctrg1.jpg" alt="" width="177" height="133" /><img style="color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; border-color: #cccccc; border-style: solid; padding: 0px; margin: 0px;" src="http://www.pempekcikning.com/images/ctrg2.jpg" alt="" width="183" height="133" /><img style="color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; border-color: #cccccc; border-style: solid; padding: 0px; margin: 0px;" src="http://www.pempekcikning.com/images/ctrg3.jpg" alt="" width="176" height="133" /></p><p><p>KLIEN KAMI :</p><p>&nbsp;</p><p>MEGA ANGGREK Hotel &amp; Convention</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Jl. Arjuna Selatan No.4 Kemanggisan Jakarta - Indonesia</p><p>&nbsp;</p><p>MENARA PENINSULA HOTEL JAKARTA</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Jl. Letjend S.Parman 78 Slipi - Jakarta 11410 - Indonesia</p></p>', 'admin@pempek.com', '0', '0', '', 'catering', 'page', '1', '');
INSERT INTO iw_post VALUES('47', 'admin', '2011-11-12 12:54:00', '2011-11-12 12:54:00', '2011-11-12 12:54:00', 'Info Franchise', '<p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;"><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;"><strong>TYPE GEROBAK I&nbsp;&nbsp;</strong></p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;">&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;<br style="padding: 0px; margin: 0px;" />Rp. 10.000.000,-</p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;"><br style="padding: 0px; margin: 0px;" />Ukuran Panjang 1,25 m x Lebar 60 cm<br style="padding: 0px; margin: 0px;" /><br style="padding: 0px; margin: 0px;" />Pihak mitra akan mendapatkan :</p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;"><img style="border-color: #cccccc; border-style: solid; padding: 0px; margin: 0px;" src="http://www.pempekcikning.com/files/grbk1_1.gif" alt="" width="533" height="420" /></p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;"><img style="border-color: #cccccc; border-style: solid; padding: 0px; margin: 0px;" src="http://www.pempekcikning.com/files/grbk1_2.gif" alt="" width="533" height="320" /></p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;">&nbsp;</p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;"><br style="padding: 0px; margin: 0px;" />TYPE GEROBAK II&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;</p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;">Rp. 15.000.000,-</p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;">Ukuran Panjang 1,50 m x Lebar 60 cm</p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;">Pihak Mitra akan mendapatkan :</p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;"><img style="border-color: #cccccc; border-style: solid; padding: 0px; margin: 0px;" src="http://www.pempekcikning.com/grbk2edit.gif" alt="" width="435" height="759" /><br style="padding: 0px; margin: 0px;" /><br style="padding: 0px; margin: 0px;" /><br style="padding: 0px; margin: 0px;" />TYPE RESTO / KIOS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;</p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;">Rp.&nbsp;50.000.000,-</p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;"><br style="padding: 0px; margin: 0px;" />Ukuran Ruangan min. panjang 6 m x lebar 3 m&nbsp;&nbsp;</p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;">Pihak Mitra akan mendapatkan :</p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;"><br style="padding: 0px; margin: 0px;" /><img style="border-color: #cccccc; border-style: solid; padding: 0px; margin: 0px;" src="http://www.pempekcikning.com/files/resto1.gif" alt="" /></p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;"><img style="border-color: #cccccc; border-style: solid; padding: 0px; margin: 0px;" src="http://www.pempekcikning.com/files/resto2.gif" alt="" width="536" height="642" /></p></p></p>', 'admin@pempek.com', '0', '0', '', 'info-franchise', 'page', '1', '');
INSERT INTO iw_post VALUES('48', 'admin', '2011-11-12 12:54:50', '2011-11-12 12:54:50', '2011-11-12 12:54:50', 'Estimasi ROI', '<p><p>&nbsp;</p><p>&nbsp;</p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: center; padding: 0px;"><img style="border-color: #cccccc; border-style: solid; padding: 0px; margin: 0px;" src="http://www.pempekcikning.com/files/roi_grbk1.gif" alt="" width="442" height="420" /></p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;">&nbsp;</p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: center; padding: 0px;"><img style="border-color: #cccccc; border-style: solid; padding: 0px; margin: 0px;" src="http://www.pempekcikning.com/files/roi_grbk2.gif" alt="" width="442" height="459" /></p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;">&nbsp;</p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: center; padding: 0px;"><img style="border-color: #cccccc; border-style: solid; padding: 0px; margin: 0px;" src="http://www.pempekcikning.com/files/roi_kios.gif" alt="" width="442" height="516" /></p><p style="margin-top: 5px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; color: #666666; font-family: Verdana, Tahoma, Helvetica, sans-serif; line-height: 13px; text-align: left; padding: 0px;">&nbsp;</p><p>&nbsp;</p></p>', 'admin@pempek.com', '0', '0', '', 'estimasi-roi', 'page', '1', '');



DROP TABLE IF EXISTS iw_post_comment;

CREATE TABLE `iw_post_comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `author` varchar(30) NOT NULL,
  `email` varchar(90) NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_id` int(11) NOT NULL DEFAULT '0',
  `comment_parent` int(11) NOT NULL,
  `approved` int(1) NOT NULL DEFAULT '1',
  `user_id` varchar(80) NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

INSERT INTO iw_post_comment VALUES('1', 'dicoba bro...', 'Aay', 'aay_bro@yahoo.com', '2011-09-21 11:58:44', '7', '0', '1', '');
INSERT INTO iw_post_comment VALUES('2', 'iya boleh boleh..', 'Eko', 'id.hpaherba@yahoo.co.id', '2011-09-21 12:04:12', '7', '1', '1', '');



DROP TABLE IF EXISTS iw_post_topic;

CREATE TABLE `iw_post_topic` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `topic` varchar(100) NOT NULL,
  `desc` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

INSERT INTO iw_post_topic VALUES('4', 'Komputer dan Internet', 'Komputer dan Internet');
INSERT INTO iw_post_topic VALUES('2', 'Tip dan Trik', 'Tip dan Trik');
INSERT INTO iw_post_topic VALUES('17', 'Feature', 'Feature');
INSERT INTO iw_post_topic VALUES('18', 'Release', 'deskription release version');



DROP TABLE IF EXISTS iw_posted_ip;

CREATE TABLE `iw_posted_ip` (
  `id` bigint(21) NOT NULL AUTO_INCREMENT,
  `file` varchar(100) NOT NULL DEFAULT '',
  `ip` varchar(100) NOT NULL DEFAULT '',
  `time` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO iw_posted_ip VALUES('5', 'testimonial', '::1', '1321211411');



DROP TABLE IF EXISTS iw_sensor;

CREATE TABLE `iw_sensor` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `word` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

INSERT INTO iw_sensor VALUES('1', 'kontol,anjing,asu,anjrit,memek,tempek,bangsat,persetan,eSDeCe');



DROP TABLE IF EXISTS iw_shoutbox;

CREATE TABLE `iw_shoutbox` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `nama` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `pesan` text COLLATE latin1_general_ci NOT NULL,
  `waktu` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=145 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO iw_shoutbox VALUES('133', 'eko', 'id.hpaherba@yahoo.co.id', 'test shoutbox', '2011-02-18 10:57:49');
INSERT INTO iw_shoutbox VALUES('140', 'eko', 'id.hpaherba@yahoo.co.id', 'test site http://cmsid.org and aaybro.web.id juga smile :)', '2011-06-21 11:25:44');
INSERT INTO iw_shoutbox VALUES('144', 'test', 'admin@cmsid.org', 'test', '2011-08-04 04:54:26');



DROP TABLE IF EXISTS iw_sidebar;

CREATE TABLE `iw_sidebar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) NOT NULL,
  `file` varchar(225) NOT NULL,
  `coder` text NOT NULL,
  `type` enum('app','block') NOT NULL,
  `position` int(1) NOT NULL DEFAULT '0',
  `ordering` int(12) NOT NULL DEFAULT '1',
  `aplikasi` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

INSERT INTO iw_sidebar VALUES('1', 'Statistik', 'statistik/stat.php', '', 'app', '0', '5', '1', '1');
INSERT INTO iw_sidebar VALUES('3', 'Support YM', '', '<table width="100%" border="0" cellspacing="0" cellpadding="0">    <tr>        <td width="50%" align="center">Eko</td>        <td align="center">Aay</td>    </tr>    <tr>      <td align="center">    <a href="ymsgr:sendIM?id.hpaherba">      <img src="http://opi.yahoo.com/online?u=id.hpaherba&m=g&t=1&l=us&opi.jpg" border="0" alt="Status YM" /></a>    </td>        <td align="center">      <a href="ymsgr:sendIM?aay_bro.ilang">      <img src="http://opi.yahoo.com/online?u=aay_bro.ilang&m=g&t=1&l=us&opi.jpg" border="0" alt="Status YM" />      </a>    </td>    </tr></table>', 'block', '0', '3', '1', '1');
INSERT INTO iw_sidebar VALUES('2', 'Shoutbox', 'shoutbox/sbx.php', '', 'app', '1', '1', '0', '1');
INSERT INTO iw_sidebar VALUES('4', 'IP Logs', 'phpids/ids.php', '', 'app', '1', '4', '0', '0');
INSERT INTO iw_sidebar VALUES('5', 'Random Links', 'links/rlink.php', '', 'app', '0', '2', '1', '1');
INSERT INTO iw_sidebar VALUES('44', 'Tags Clouds', 'post/tags.php', '', 'app', '1', '6', '0', '0');
INSERT INTO iw_sidebar VALUES('45', 'Category', 'post/category.php', '', 'app', '0', '7', '1', '1');
INSERT INTO iw_sidebar VALUES('46', 'Top Article', 'post/top-post.php', '', 'app', '1', '8', '1', '1');



DROP TABLE IF EXISTS iw_sidebar_act;

CREATE TABLE `iw_sidebar_act` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aplikasi` varchar(122) NOT NULL,
  `posisi` int(1) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL,
  `id_sidebar` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

INSERT INTO iw_sidebar_act VALUES('1', 'download', '1', '3', '1');
INSERT INTO iw_sidebar_act VALUES('9', 'users', '1', '2', '1');
INSERT INTO iw_sidebar_act VALUES('30', 'contact', '0', '2', '1');
INSERT INTO iw_sidebar_act VALUES('28', 'post', '0', '3', '46');
INSERT INTO iw_sidebar_act VALUES('27', 'post', '0', '2', '45');
INSERT INTO iw_sidebar_act VALUES('26', 'contact', '0', '1', '3');
INSERT INTO iw_sidebar_act VALUES('29', 'post', '0', '1', '3');
INSERT INTO iw_sidebar_act VALUES('31', 'links', '0', '0', '5');



DROP TABLE IF EXISTS iw_slider;

CREATE TABLE `iw_slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` text NOT NULL,
  `desc` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO iw_slider VALUES('1', 'img1.jpg', '<strong>Italian<span>Fettuccine</span></strong>										<b>Dish of the Day</b>										<p>											<span>Lorem ipsum dolamet consectetur<br>											adipisicing elit, sed do eiusmod tempor aliqua enim ad minim veniam, quis nosinci- didunt ut labore et dolore.</span>										</p>', '1');
INSERT INTO iw_slider VALUES('2', 'img2.jpg', '<strong>succulent<span>meat</span></strong>										<b>Dish of the Day</b>										<p>											<span>Lorem ipsum dolamet consectetur <br>											adipisicing elit, sed do eiusmod tempor aliqua enim ad minim veniam, quis nosinci- didunt ut labore et dolore.</span>										</p>', '1');
INSERT INTO iw_slider VALUES('3', 'img3.jpg', '<strong>French-Style<span>Tartlet</span></strong>										<b>Dish of the Day</b>										<p>											<span>Lorem ipsum dolamet consectetur <br>											adipisicing elit, sed do eiusmod tempor aliqua enim ad minim veniam, quis nosinci- didunt ut labore et dolore.</span>										</p>', '1');



DROP TABLE IF EXISTS iw_stat_browse;

CREATE TABLE `iw_stat_browse` (
  `title` varchar(255) NOT NULL DEFAULT '',
  `option` text NOT NULL,
  `hits` text NOT NULL,
  PRIMARY KEY (`title`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO iw_stat_browse VALUES('browser', 'Opera#Mozilla Firefox#Galeon#Mozilla#MyIE#Lynx#Netscape#Konqueror#SearchBot#Internet Explorer 6#Internet Explorer 7#Internet Explorer 8#Internet Explorer 9#Internet Explorer 10#Other', '0#2#0#69#0#0#0#0#0#0#0#0#0#0#0');
INSERT INTO iw_stat_browse VALUES('os', 'Windows#Mac#Linux#FreeBSD#SunOS#IRIX#BeOS#OS/2#AIX#Other', '67#4#0#0#0#0#0#0#0#0');
INSERT INTO iw_stat_browse VALUES('day', 'Minggu#Senin#Selasa#Rabu#Kamis#Jumat#Sabtu', '13#11#17#14#4#5#7');
INSERT INTO iw_stat_browse VALUES('month', 'Januari#Februari#Maret#April#Mei#Juni#Juli#Agustus#September#Oktober#November#Desember', '0#0#0#0#0#0#0#0#0#64#7#0');
INSERT INTO iw_stat_browse VALUES('clock', '0:00 - 0:59#1:00 - 1:59#2:00 - 2:59#3:00 - 3:59#4:00 - 4:59#5:00 - 5:59#6:00 - 6:59#7:00 - 7:59#8:00 - 8:59#9:00 - 9:59#10:00 - 10:59#11:00 - 11:59#12:00 - 12:59#13:00 - 13:59#14:00 - 14:59#15:00 - 15:59#16:00 - 16:59#17:00 - 17:59#18:00 - 18:59#19:00 - 19:59#20:00 - 20:59#21:00 - 21:59#22:00 - 22:59#23:00 - 23:59', '4#4#3#4#1#1#1#1#5#2#5#0#1#1#2#0#3#1#5#4#11#5#0#7');
INSERT INTO iw_stat_browse VALUES('country', '#', '1#');



DROP TABLE IF EXISTS iw_stat_count;

CREATE TABLE `iw_stat_count` (
  `id` tinyint(11) NOT NULL AUTO_INCREMENT,
  `ip` text NOT NULL,
  `counter` int(11) NOT NULL DEFAULT '0',
  `hits` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO iw_stat_count VALUES('1', '::1-127.0.0.1-74.63.226.246-125.166.242.21-38.99.186.20-125.163.153.227-', '1', '14140');



DROP TABLE IF EXISTS iw_stat_online;

CREATE TABLE `iw_stat_online` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ipproxy` varchar(100) DEFAULT NULL,
  `host` varchar(100) DEFAULT NULL,
  `ipanda` varchar(100) DEFAULT NULL,
  `proxyserver` varchar(100) DEFAULT NULL,
  `timevisit` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=131 DEFAULT CHARSET=utf8;

INSERT INTO iw_stat_online VALUES('130', '::1', 'localhost', '::1', '', '1321263073');



DROP TABLE IF EXISTS iw_stat_onlineday;

CREATE TABLE `iw_stat_onlineday` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ipproxy` varchar(100) DEFAULT NULL,
  `host` varchar(100) DEFAULT NULL,
  `ipanda` varchar(100) DEFAULT NULL,
  `proxyserver` varchar(100) DEFAULT NULL,
  `timevisit` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

INSERT INTO iw_stat_onlineday VALUES('12', '::1', 'localhost', '::1', '', '1321263073');



DROP TABLE IF EXISTS iw_stat_onlinemonth;

CREATE TABLE `iw_stat_onlinemonth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ipproxy` varchar(100) DEFAULT NULL,
  `host` varchar(100) DEFAULT NULL,
  `ipanda` varchar(100) DEFAULT NULL,
  `proxyserver` varchar(100) DEFAULT NULL,
  `timevisit` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO iw_stat_onlinemonth VALUES('1', '127.0.0.1', 'Azza-PC', '127.0.0.1', '', '1321083561');
INSERT INTO iw_stat_onlinemonth VALUES('2', '::1', 'localhost', '::1', '', '1321263073');



DROP TABLE IF EXISTS iw_stat_urls;

CREATE TABLE `iw_stat_urls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `domain` varchar(256) NOT NULL,
  `referrer` longtext NOT NULL,
  `search_terms` text NOT NULL,
  `hits` int(11) NOT NULL DEFAULT '1',
  `date_modif` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO iw_stat_urls VALUES('1', '127.0.0.1', 'https://127.0.0.1/cmsid/2.1/', '', '1', '2011-10-26 11:20:29');
INSERT INTO iw_stat_urls VALUES('2', 'google.com', 'http://www.google.com/url?sa=D&q=http://localhost/cmsid/2.1/0/&usg=AFQjCNGe89H-MlT0SmmkYBLWeAEwdNGhJQ', 'http://localhost/cmsid/2.1/0/', '1', '2011-10-27 01:28:28');



DROP TABLE IF EXISTS iw_testimoni;

;




DROP TABLE IF EXISTS iw_testimonial;

CREATE TABLE `iw_testimonial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(60) NOT NULL,
  `email` varchar(80) NOT NULL,
  `pesan` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO iw_testimonial VALUES('1', 'Jemmi Willis', 'jemmi-wilies@mail.com', 'Nemo enim ipsam voluptatem quia voluptas', '1');
INSERT INTO iw_testimonial VALUES('2', 'Marcus Remer', 'marcus-remer@mail.com', 'Quasi arctecto beatae vitae dicta sunt explicabo', '1');
INSERT INTO iw_testimonial VALUES('3', 'Samuel Chamer', 'samuel-chamer@mail.com', 'Remperam eaquepsa quae abillo inventore vertatis', '1');
INSERT INTO iw_testimonial VALUES('5', 'dsd', 'test@sd.com', 'sadad', '0');



DROP TABLE IF EXISTS iw_users;

CREATE TABLE `iw_users` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) NOT NULL,
  `user_author` varchar(80) NOT NULL,
  `user_pass` varchar(64) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_sex` int(1) NOT NULL,
  `user_registered` datetime NOT NULL,
  `user_last_update` datetime NOT NULL,
  `user_activation_key` varchar(60) NOT NULL,
  `user_level` varchar(25) NOT NULL DEFAULT 'user',
  `user_url` varchar(100) NOT NULL,
  `display_name` smallint(250) NOT NULL,
  `user_country` varchar(64) NOT NULL,
  `user_province` varchar(80) NOT NULL,
  `user_avatar` longtext NOT NULL,
  `user_status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO iw_users VALUES('1', 'admin', 'Admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@pempek.com', '1', '2010-03-02 13:09:37', '2011-11-14 16:31:13', '', 'admin', '', '0', 'ID', 'Bandar Lampung', '', '1');
INSERT INTO iw_users VALUES('2', 'user', 'Example', 'ee11cbb19052e40b07aac0ca060c23ee', 'user@cmsid.org', '0', '2010-08-04 09:06:13', '2011-10-26 16:39:08', '', 'user', '', '0', 'ID', 'Bandar Lampung', '', '1');



