-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2013 at 05:27 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cmsid_order_pc1`
--
CREATE DATABASE IF NOT EXISTS `cmsid_order_pc1` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cmsid_order_pc1`;

-- --------------------------------------------------------

--
-- Table structure for table `pc_menu`
--

CREATE TABLE IF NOT EXISTS `pc_menu` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `group_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `class` varchar(255) NOT NULL DEFAULT '',
  `position` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `pc_menu`
--

INSERT INTO `pc_menu` (`id`, `parent_id`, `group_id`, `title`, `url`, `class`, `position`) VALUES
(1, 0, 0, 'Menu Utama', '', '', 0),
(2, 0, 1, 'Home', '/', 'home', 1),
(3, 0, 1, 'Example Sub', '/example.html', '', 2),
(5, 3, 1, 'Top', '/example/top.html', '', 1),
(6, 3, 1, 'Counter', '/example/counter.html', '', 2),
(7, 0, 1, 'Recent Projects', '/page-recent-projects.html', '', 3),
(8, 0, 1, 'Services', '/page-services.html', '', 4),
(9, 0, 1, 'Clients', '/page-clients.html', '', 5),
(10, 0, 1, 'Solutions', '/page-sulitions.html', '', 6),
(11, 0, 1, 'Contact Us', '/contact-us.html', '', 7);

-- --------------------------------------------------------

--
-- Table structure for table `pc_options`
--

CREATE TABLE IF NOT EXISTS `pc_options` (
  `option_name` varchar(68) NOT NULL,
  `option_value` longtext NOT NULL,
  PRIMARY KEY (`option_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pc_options`
--

INSERT INTO `pc_options` (`option_name`, `option_value`) VALUES
('account_registration', '1'),
('active_plugins', '{"codemirror/codemirror.php":"1","sidebar/sidebar.php":"1","seo-optimization/seo-optimization.php":"1","statistik/statistik.php":"1","rss-reader/rss-reader.php":"1","refreral/refreral.php":"1","disk-memory-usage/disk-memory-usage.php":"1"}'),
('admin_email', 'admin@profile-company.com'),
('architecture2_options', '{"logo":"http://localhost/cmsid/order/profil-company1/content/themes/architecture2/images/logo.png","ads":["http://localhost/cmsid/order/profil-company1/content/uploads/ads.jpg","",""]}'),
('author', 'admin'),
('avatar_default', 'mystery'),
('avatar_type', 'computer'),
('background_admin', ''),
('body_layout', 'left'),
('dashboard_widget', '{"normal":"dashboard_recent_registration,disk_memory_overview,dashboard_feed_news,statistik_monitoring,","side":"dashboard_update_info,dashboard_quick_post,refering,"}'),
('datetime_format', 'Y/m/d'),
('date_format', 'F j, Y'),
('feed-news', '{"news_feeds":{"News Feed cmsid.org":"http://cmsid.org/rss.xml"},"display":{"desc":1,"author":1,"date":1,"limit":30}}'),
('file_allaw', '["txt","csv","htm","html","xml","css","doc","xls","rtf","ppt","pdf","swf","flv","avi","wmv","mov","jpg","jpeg","gif","png"]'),
('frame', '1'),
('help_guide', ''),
('html_type', 'text/html'),
('id', ''),
('image_allaw', '{"image\\/png":".png","image\\/x-png":".png","image\\/gif":".gif","image\\/jpeg":".jpg","image\\/pjpeg":".jpg"}'),
('menu-action', '[''aksi'':{''posts'':{''title'':''Post'',''link'':''?action=post''},''pages'':{''title'':''Pages'',''link'':''?action=pages''}}]'),
('post_comment', '1'),
('post_comment_filter', '1'),
('rewrite', 'clear'),
('rewrite_html', '1'),
('robots', 'index,follow'),
('security_pip', ''),
('sidebar_actions', ''),
('sidebar_widgets', '{"sidebar-1":["pages","meta","archives"],"sidebar-2":["categories","shoutbox"]}'),
('sitedescription', 'Keterangan dari website'),
('sitekeywords', 'keyword website'),
('sitename', 'Profile Company 1'),
('siteslogan', 'slogan website'),
('siteurl', 'http://localhost/cmsid/order/profil-company1'),
('site_charset', 'UTF-8'),
('site_copyright', '2012 Profile Company 1 | All right reserved . Powered by cmsid'),
('site_public', '1'),
('template', 'architecture2'),
('timezone', 'Asia/Jakarta'),
('toogle_menuaction', ''),
('toogle_menutop', ''),
('use_smilies', '1'),
('welcome', '');

-- --------------------------------------------------------

--
-- Table structure for table `pc_post`
--

CREATE TABLE IF NOT EXISTS `pc_post` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_login` varchar(80) NOT NULL,
  `date_post` datetime NOT NULL,
  `title` text NOT NULL,
  `content` longtext NOT NULL,
  `mail` varchar(160) NOT NULL,
  `post_topic` bigint(20) NOT NULL,
  `hits` int(11) NOT NULL,
  `tags` varchar(225) NOT NULL,
  `sefttitle` varchar(200) NOT NULL,
  `type` varchar(20) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `status_comment` int(1) NOT NULL,
  `thumb` longtext NOT NULL,
  `thumb_desc` text NOT NULL,
  `approved` int(1) NOT NULL DEFAULT '0',
  `meta_keys` text NOT NULL,
  `meta_desc` text NOT NULL,
  `headline` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `pc_post`
--

INSERT INTO `pc_post` (`id`, `user_login`, `date_post`, `title`, `content`, `mail`, `post_topic`, `hits`, `tags`, `sefttitle`, `type`, `status`, `status_comment`, `thumb`, `thumb_desc`, `approved`, `meta_keys`, `meta_desc`, `headline`) VALUES
(1, 'admin', '2013-03-22 14:11:29', 'Hallo Semua!', '<p>Selamat datang di CMS ID. Ini adalah tulisan pertama Anda. Sunting atau hapus, kemudian mulai membuat artikel!<span id="pastemarkerend"></span><br>\r\n\r\n</p>\r\n', 'id.hpaherba@yahoo.co.id', 1, 32, '', 'hallo-semua', 'post', 1, 0, '', '', 1, '', '', 0),
(2, 'admin', '0000-00-00 00:00:00', 'Welcome to Our Site!', '<p><img alt="" style="cursor: default; float: left; margin: 0px 10px 10px 0px;" unselectable="on" src="http://localhost/cmsid/order/profil-company1/content/uploads/20131201050154@pic_1.jpg"></p>\r\n\r\n<p>Don''t forget to check <a href="http://www.freewebsitetemplates.com">free website templates</a> every day, because we add  a new free website template almost daily.</p>\r\n\r\n<p>You can remove any link to our websites from this template you''re free to use the template without linking back to us.</p>\r\n\r\n        <p>This is just a place holder so you can see how the site would look like.<span id="pastemarkerend">&nbsp;</span></p>\r\n', 'id.hpaherba@yahoo.co.id', 0, 0, '', 'welcome-to-our-site', 'page', 1, 0, '', '', 1, '', '', 0),
(3, 'admin', '2005-10-00 00:00:00', 'Company Profile', '<table id="table21573">\r\n\r\n<tbody>\r\n\r\n	<tr>\r\n\r\n		<td><p><img alt="" style="cursor: default; float: left; margin: 0px 10px 10px 0px;" unselectable="on" src="http://localhost/cmsid/order/profil-company1/content/uploads/20131201050536@pic_2.jpg"></p>\r\n\r\n&nbsp;If you''re having problems editing the template please don''t hesitate to ask for help on <a href="http://www.freewebsitetemplates.com/forum/">the forum</a>.<span id="pastemarkerend">&nbsp;</span></td>\r\n\r\n\r\n		<td>&nbsp;<p><img alt="" style="cursor: default; float: left; margin: 0px 10px 10px 0px;" unselectable="on" src="http://localhost/cmsid/order/profil-company1/content/uploads/20131201050549@pic_3.jpg"></p>\r\n\r\nThis is a template designed by free website templates for you for free you can replace all the text by your own   text.<span id="pastemarkerend">&nbsp;</span>\r\n</td>\r\n\r\n	</tr>\r\n\r\n\r\n	<tr>\r\n\r\n		<td><p><img alt="" style="cursor: default; float: left; margin: 0px 10px 10px 0px;" unselectable="on" src="http://localhost/cmsid/order/profil-company1/content/uploads/20131201050536@pic_2.jpg"></p>\r\n\r\n&nbsp;If you''re having problems editing the template please don''t hesitate to ask for help on <a href="http://www.freewebsitetemplates.com/forum/">the forum</a>.<span id="pastemarkerend">&nbsp;</span></td>\r\n\r\n\r\n		<td>&nbsp;<p><img alt="" style="cursor: default; float: left; margin: 0px 10px 10px 0px;" unselectable="on" src="http://localhost/cmsid/order/profil-company1/content/uploads/20131201050549@pic_3.jpg"></p>\r\n\r\nThis is a template designed by free website templates for you for free you can replace all the text by your own   text.<span id="pastemarkerend">&nbsp;</span>\r\n</td>\r\n\r\n	</tr>\r\n\r\n</tbody>\r\n\r\n</table>', 'id.hpaherba@yahoo.co.id', 0, 0, '', 'company-profile', 'page', 1, 0, '', '', 1, '', '', 0),
(4, 'admin', '2013-03-24 05:08:46', 'Company Profile', '<p>Kelangsungan ketersediaan widget dan layanan web situs&nbsp;ini tergantung kepada bantuan dan dukungan dari anda. Banyak cara untuk mewujudkan dukungan tersebut.</p>\r\n\r\n\r\n<p><b>Beritahu Yang Lain!</b></p>\r\n\r\n<p>Silakan gunakan satu atau dua (atau lebih)&nbsp;pada situs atau blog yang anda punyai. Jika anda menggunakan&nbsp;twitter,&nbsp;atau tweet-ulang tulisan-tulisan kami. Jika anda adalah penggemar&nbsp;facebook, jadilah salah satu penggemar Halaman Fan kami ataupun juga jika anda menggunakan Goolgle+. Klik pada tombol&nbsp;Like&nbsp;pada kolom sisi kanan halaman ini.</p>\r\n\r\n\r\n<p><b>Berikan Sumbangan!</b></p>\r\n\r\n<p>Setiap sumbangsih finansial anda, sebesar apapun akan sangat berarti bagi pembayaran hosting situs dan pengelolaannya.</p>\r\n\r\n\r\n\r\n<p>Donation bisa ditransfer ke rekening kami di:</p>\r\n\r\n<p><b>BRI UNIT SIDOMULYO TELUK BETUNG&nbsp;</b></p>\r\n\r\n<p><b>No. Rek. 3562-01-016475-53-9&nbsp;</b></p>\r\n\r\n<p><b>a.n. Eko Hendratno</b></p>\r\n\r\n\r\n\r\n<p>Kami memohon kepada Allah atas petunjuk dan pertolongan-Nya serta limpahan rizqi yang terbaik.</p>', 'id.hpaherba@yahoo.co.id', 1, 2, 'cerita, cmsid', 'company-profile', 'post', 1, 0, '20130602123301@1.jpg', 'ilst(keterangan gambar)', 1, '', '', 0),
(5, 'admin', '2013-12-01 05:36:55', 'Recent Projects', '<p>desc</p>\r\n', 'admin@profile-company.com', 0, 0, '', 'recent-projects', 'page', 1, 0, '', '', 1, '', '', 0),
(6, 'admin', '2013-12-01 05:37:22', 'Services', '<p>desc</p>\r\n', 'admin@profile-company.com', 0, 0, '', 'services', 'page', 1, 0, '', '', 1, '', '', 0),
(7, 'admin', '2013-12-01 05:37:37', 'Clients', '', 'admin@profile-company.com', 0, 0, '', 'clients', 'page', 1, 0, '', '', 1, '', '', 0),
(8, 'admin', '2013-12-01 05:37:55', 'Solutions', '<p>desc</p>\r\n', 'admin@profile-company.com', 0, 0, '', 'solutions', 'page', 1, 0, '', '', 1, '', '', 0),
(9, 'admin', '0000-00-00 00:00:00', 'Page etc', '<p>desc</p>\r\n', 'admin@profile-company.com', 0, 0, '', 'page-etc', 'page', 1, 0, '', '', 1, '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pc_post_comment`
--

CREATE TABLE IF NOT EXISTS `pc_post_comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `author` varchar(30) NOT NULL,
  `email` varchar(90) NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `time` int(20) NOT NULL,
  `post_id` int(11) NOT NULL DEFAULT '0',
  `comment_parent` int(11) NOT NULL,
  `approved` int(1) NOT NULL DEFAULT '1',
  `user_id` varchar(80) NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `pc_post_comment`
--

INSERT INTO `pc_post_comment` (`comment_id`, `comment`, `author`, `email`, `date`, `time`, `post_id`, `comment_parent`, `approved`, `user_id`) VALUES
(1, 'Hai, ini adalah komentar.<br />\r\nUntuk menghapus sebuah komentar, cukup masuk log dan lihat komentar tulisan tersebut. Di sana Anda akan memiliki pilihan untuk mengedit atau menghapusnya.', 'Eko Azza', 'id.hpaherba@yahoo.co.id', '2013-03-24 23:32:35', 1364167955, 1, 0, 1, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `pc_post_topic`
--

CREATE TABLE IF NOT EXISTS `pc_post_topic` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `topic` varchar(100) NOT NULL,
  `desc` text NOT NULL,
  `public` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `pc_post_topic`
--

INSERT INTO `pc_post_topic` (`id`, `topic`, `desc`, `public`, `status`) VALUES
(1, 'Sebuah kategori', 'Keterangan Sebuah kategori', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pc_stat_browse`
--

CREATE TABLE IF NOT EXISTS `pc_stat_browse` (
  `title` varchar(255) NOT NULL DEFAULT '',
  `option` text NOT NULL,
  `hits` text NOT NULL,
  PRIMARY KEY (`title`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pc_stat_browse`
--

INSERT INTO `pc_stat_browse` (`title`, `option`, `hits`) VALUES
('browser', 'Opera#Mozilla Firefox#Galeon#Mozilla#MyIE#Lynx#Netscape#Konqueror#SearchBot#IE 6#IE 7#IE 8#IE 9#IE 10#Other#', '0#3#0#0#0#0#0#0#0#0#0#0#0#0#0#'),
('os', 'Windows#Mac#Linux#FreeBSD#SunOS#IRIX#BeOS#OS/2#AIX#Other#', '3#0#0#0#0#0#0#0#0#0#'),
('day', 'Minggu#Senin#Selasa#Rabu#Kamis#Jumat#Sabtu#', '1#2#0#0#0#0#0#'),
('month', 'Januari#Februari#Maret#April#Mei#Juni#Juli#Agustus#September#Oktober#November#Desember#', '0#0#0#0#0#0#0#0#0#0#0#3#'),
('clock', '0:00#1:00#2:00#3:00#4:00#5:00#6:00#7:00#8:00#9:00#10:00#11:00#12:00#13:00#14:00#15:00#16:00#17:00#18:00#19:00#20:00#21:00#22:00#23:00#', '1#0#0#0#0#0#0#0#0#1#0#0#0#0#0#1#0#0#0#0#0#0#0#0#'),
('country', '#', '1#');

-- --------------------------------------------------------

--
-- Table structure for table `pc_stat_count`
--

CREATE TABLE IF NOT EXISTS `pc_stat_count` (
  `id` tinyint(11) NOT NULL AUTO_INCREMENT,
  `ip` text NOT NULL,
  `counter` int(11) NOT NULL DEFAULT '0',
  `hits` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `pc_stat_count`
--

INSERT INTO `pc_stat_count` (`id`, `ip`, `counter`, `hits`) VALUES
(1, '::1', 1, 118);

-- --------------------------------------------------------

--
-- Table structure for table `pc_stat_online`
--

CREATE TABLE IF NOT EXISTS `pc_stat_online` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ipproxy` varchar(100) DEFAULT NULL,
  `host` varchar(100) DEFAULT NULL,
  `ipanda` varchar(100) DEFAULT NULL,
  `proxyserver` varchar(100) DEFAULT NULL,
  `timevisit` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58 ;

--
-- Dumping data for table `pc_stat_online`
--

INSERT INTO `pc_stat_online` (`id`, `ipproxy`, `host`, `ipanda`, `proxyserver`, `timevisit`) VALUES
(57, '::1', 'Azza-PC', '::1', '', 1386001626);

-- --------------------------------------------------------

--
-- Table structure for table `pc_stat_onlineday`
--

CREATE TABLE IF NOT EXISTS `pc_stat_onlineday` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ipproxy` varchar(100) DEFAULT NULL,
  `host` varchar(100) DEFAULT NULL,
  `ipanda` varchar(100) DEFAULT NULL,
  `proxyserver` varchar(100) DEFAULT NULL,
  `timevisit` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `pc_stat_onlineday`
--

INSERT INTO `pc_stat_onlineday` (`id`, `ipproxy`, `host`, `ipanda`, `proxyserver`, `timevisit`) VALUES
(4, '::1', 'Azza-PC', '::1', '', 1386001626);

-- --------------------------------------------------------

--
-- Table structure for table `pc_stat_onlinemonth`
--

CREATE TABLE IF NOT EXISTS `pc_stat_onlinemonth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ipproxy` varchar(100) DEFAULT NULL,
  `host` varchar(100) DEFAULT NULL,
  `ipanda` varchar(100) DEFAULT NULL,
  `proxyserver` varchar(100) DEFAULT NULL,
  `timevisit` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `pc_stat_onlinemonth`
--

INSERT INTO `pc_stat_onlinemonth` (`id`, `ipproxy`, `host`, `ipanda`, `proxyserver`, `timevisit`) VALUES
(3, '::1', 'Azza-PC', '::1', '', 1386001626);

-- --------------------------------------------------------

--
-- Table structure for table `pc_stat_urls`
--

CREATE TABLE IF NOT EXISTS `pc_stat_urls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `domain` varchar(256) NOT NULL,
  `referrer` longtext NOT NULL,
  `search_terms` text NOT NULL,
  `hits` int(11) NOT NULL DEFAULT '1',
  `date_modif` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pc_users`
--

CREATE TABLE IF NOT EXISTS `pc_users` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) NOT NULL,
  `user_author` varchar(80) NOT NULL,
  `user_pass` varchar(64) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_sex` enum('p','l') NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `pc_users`
--

INSERT INTO `pc_users` (`ID`, `user_login`, `user_author`, `user_pass`, `user_email`, `user_sex`, `user_registered`, `user_last_update`, `user_activation_key`, `user_level`, `user_url`, `display_name`, `user_country`, `user_province`, `user_avatar`, `user_status`) VALUES
(1, 'admin', 'Admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@profile-company.com', 'l', '2013-11-26 03:33:52', '2013-12-02 15:31:11', '', 'admin', '', 0, 'ID', '', '', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
