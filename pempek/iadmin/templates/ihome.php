<?php
/**
 * @file ihome.php
 *
 */
//dilarang mengakses
defined('_iEXEC') or die();

global $iw,$db;
			

?>
<script type="text/javascript" >
function autosave(sortorder) 
{  
	$.ajax( 
        { 
            type	: "POST", 
            url		: "irequest.php?auto&sort="+$.toJSON(sortorder), 
            cache	: false,
			success: function(sortorder) {
				$('.console').html('<div id="success">Updating Widgets ...</div>').show().fadeOut(1000);
			}
		}); 
}
function updateWidgetData(){
	var items=[];
	$('.column').each(function(){
		var columnId=$(this).attr('id');
		$('.dragbox', this).each(function(i){
			var collapsed=0;
			if($(this).find('.dragbox-content').css('display')=="none")
				collapsed=1;
			var item={
				id			: $(this).attr('id'),
				collapsed	: collapsed,
				order 		: i,
				column		: columnId
			};
			items.push(item);
		});
	});
	var sortorder={ items: items };
			
	//Pass sortorder variable to server using ajax to save state
	//$.post('irequest.php?auto', 'sort='+$.toJSON(sortorder));
	autosave(sortorder);
}
</script>
<?php
function widget_box($param){
	ob('start');
	$file = Back.'templates/panel/'.$param.'.php';
	
	if(file_exists($file) && !empty($param)) require_once($file);
		
	$ret = ob('ended');
	return $ret;
}
function widget_id($string){
	return (int) preg_replace('/[^\d\s]/', '', $string);
}
function widget_reset(){
	//data reset to default
	$values[] = array('id' 	=> 'item1','collapsed' => 0,'order' => 0,'column' => 'column0');
	$values[] = array('id' 	=> 'item3','collapsed' => 0,'order' => 1,'column' => 'column0');
	$values[] = array('id' 	=> 'item4','collapsed' => 0,'order' => 2,'column' => 'column0');
	$values[] = array('id' 	=> 'item2','collapsed' => 0,'order' => 0,'column' => 'column1');
	$values[] = array('id' 	=> 'item5','collapsed' => 0,'order' => 1,'column' => 'column1'); 
	$values[] = array('id' 	=> 'item6','collapsed' => 0,'order' => 2,'column' => 'column1');
	$data	  = array('items' => $values);
	
	$j 		  = new JSON_obj();
	$value	  = $j->encode($data);
	set_option('widgets',$value);
}
//echo '<div class="console"></div>';

$json_value	= get_option('widgets');
$j 			= new JSON_obj();
$obj  		= $j->decode($json_value);
$items		= $obj->{'items'};

$jum_0 = $jum_1 = array();
for($i=0;$i<=1;$i++){
echo '<div class="column column'.$i.'" id="column'.$i.'" >';

foreach($items as $key => $val){
$column_id = widget_id( $items[$key]->{'column'} );
if($column_id==0) $jum_0[] = '';
if($column_id==1) $jum_1[] = '';

if( $column_id == $i ):
echo '<div class="dragbox" id="'.$items[$key]->{'id'}.'">';
echo widget_box($items[$key]->{'id'});
echo '</div>';
endif;

}

echo '</div>';

}

if(count($jum_0) == 0 || count($jum_1) == 0) widget_reset();
?>
