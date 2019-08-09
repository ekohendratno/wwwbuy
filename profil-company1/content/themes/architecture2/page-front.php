<?php 
if(!defined('_iEXEC')) exit;

global $db;
$page1 = get_page_view(2);
$page2 = get_page_view(3);
?>
      <h2><?php echo $page1->title;?></h2>
      <div id="welcome">
        <?php echo $page1->content;?>
      </div>
      <h3><?php echo $page2->title;?></h3>
      <div id="profile">
        <?php echo $page2->content;?>
      </div>