<html>
<head>
<title><?php echo $error_title;?></title>
<style type="text/css">

body { 
background-color	:#fff; 
margin				:40px; 
font-family			:'Segoe UI', 'Lucida Grande', Verdana, Arial, Helvetica, sans-serif;
font-size			:12px;
color				:#000;
}

#content  {
background-color	:#fff;
padding				:20px 20px 12px 20px;
text-align			:center;
}

h1 {
font-weight			:normal;
font-size			:28px;
margin				:0 0 4px 0;
}
</style>
</head>
<body>
<?php global $iw;?>
<div id="content">
<!--<a href="<?php _e($iw->base_url)?>"><?php _e($iw->base_url)?></a>-->
<h1>Underconstruction</h1>
<p>
Apologies, but This Website Underconstruction. Please come back latter.<br>
</p>
<img src="<?php _e($iw->base_url)?>icontent/images/website-maintenance.png"><br>
All Right Reserved &bull; Powered by <b><?php _e(get_option('poweredby'));?></b>
</div>
</body>
</html>

