<?php
/**
 * @file tags.php
 *
 */
//dilarang mengakses
defined('_iEXEC') or die();

echo '<div style="text-align:center">';
if(function_exists('tags_clouds')) tags_clouds();
else echo implode(', ',tags());
echo '</div>';
