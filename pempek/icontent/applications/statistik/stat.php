<?php
/**
 * @file stat.php
 *
 */
//dilarang mengakses
defined('_iEXEC') or die();

global $iw;

if(!function_exists('statistik'))
{
	echo 'plugin statistik not active';
}
else
{
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody><tr>
  <td width="10%"><img src="<?php _e($iw->base_url.'icontent/applications/statistik/images/community.png');?>" alt="" border="0"></td>
    <td width="15%">Visitor</td>
    <td width="1%">:</td>
    <td width="74%"><center><b><?php echo statistik('visitor');?></b></center></td>
  </tr>
  <tr>
    <td><img src="<?php _e($iw->base_url.'icontent/applications/statistik/images/chart.png');?>" alt="" border="0"></td>
    <td>Hits</td>
    <td>:</td>
    <td><center><b><?php echo statistik('hits');?></b></center></td>
  </tr>
  <tr>
    <td><img src="<?php _e($iw->base_url.'icontent/applications/statistik/images/users.png');?>" alt="" border="0"></td>
    <td>Month</td>
    <td>:</td>
    <td><center><b><b><?php echo statistik('month');?></b></b></center></td>
  </tr>
  <tr>
    <td><img src="<?php _e($iw->base_url.'icontent/applications/statistik/images/user.png');?>" alt="" border="0"></td>
    <td>Day</td>
    <td>:</td>
    <td><center><b><b><?php echo statistik('day');?></b></b></center></td>
  </tr>
  <tr>
    <td><img src="<?php _e($iw->base_url.'icontent/applications/statistik/images/user_add.png');?>" alt="" border="0"></td>
    <td>Online</td>
    <td>:</td>
    <td><center><b><b><?php echo statistik('now');?></b></b></center></td>
	
</tr></tbody></table>
<?php
}
?>
