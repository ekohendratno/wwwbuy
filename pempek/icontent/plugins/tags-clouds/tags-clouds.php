<?php
/**
 * @file: tags-clouds.php
 * @type: plugin
 */
/*
Plugin Name: Tags Clouds
Plugin URI: http://cmsid.org/#
Description: Plugin Text Editor.
Author: Eko Azza
Version: 1.1.0
Author URI: http://cmsid.org/
*/ 
//not direct access
defined('_iEXEC') or die();

if(!function_exists('tags_clouds')){
function tags_clouds(){
	
$movie 				= '?r=' . rand(0,9999999);
$tags_clouds		= implode('',tags());
$has_tags_clouds	= urlencode('<tags>'.$tags_clouds.'</tags>');
?>

<script type="text/javascript" src="<?php echo plugin_url('tags-clouds/swfobject.js')?>"></script>
<div id="widget_content">
<p>
<?php echo tags()?>
</p>
<p>
Flash tag cloud by <a href="http://www.cmsid.org" rel="nofollow">Eko.H</a> requires <a href="http://www.macromedia.com/go/getflashplayer">Flash Player</a> 9 or better.</p>
</div>
<script type="text/javascript">
var widget = new SWFObject(
"<?php echo plugin_url('tags-clouds/tagcloud.swf'.$movie)?>", 
"tagcloudflash", 
"100%", 
"200", 
"9", 
"#ffffff"
);
widget.addParam("wmode", "transparent");
widget.addParam("allowScriptAccess", "always");
widget.addVariable("tcolor", "0x333333");
widget.addVariable("tcolor2", "0x333333");
widget.addVariable("hicolor", "0x000000");
widget.addVariable("tspeed", "100");
widget.addVariable("distr", "true");
widget.addVariable("mode", "tags");
widget.addVariable("tagcloud", "<?php _e($has_tags_clouds)?>");
widget.write("widget_content");
</script>

<?php
}
}
?>

