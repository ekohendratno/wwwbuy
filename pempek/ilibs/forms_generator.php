<?php
/**
 * @file forms_generator.php
 * @package: beta version
 */
//dilarang mengakses
defined('_iEXEC') or die();

	class forms_generator{
		function head($action='',$method='post',$enctype=null){
			$head = '';
			$head.= 'action  ="'.	$$action.'" ';
			$head.= 'method  ="'.	$method	.'" ';
			if( !empty($enctype) )
			$head.= 'enctype ="'.	$enctype.'" ';
			
			return '<form '.$head.'>';
		}
		function foot(){
			return '</form>';
		}
		
		function input($name='input',$ext='input',$value='',$type='text',$size='97%'){
			 
			if( !empty($ext) )
			switch($ext){
				case'check':
					$list = '';
					
					if(!is_array($value))
					return false;
					
					foreach($value as $val){
						$checked='';
						if($val[2]==1) $checked ='checked'; 
						
						$list.= '<label><input name="'.$val[0].'" type="checkbox" value="1" '.$checked.'>';
						$list.=  $val[1];
						$list.= '</label><br>';
					}
					return $list;
				break;
				case'input':
					return '<input type="'.$type.'" name="'.$name.'" style="width: '.$size.'" value="'.$value.'">';
				break;
				case'text':
					return '<textarea name="'.$name.'" style="width: '.$size.'">'.$value.'</textarea>';
				break;
				/*
				 * $select_feed_list = 3; // output : d
				 * $list = array(
				 * 'minmax'	=>array('min'=>1,'max'=>10), // or 'list' =>array('a','b','c','d','e','f'),
				 * 'select'	=>$select_feed_list);
				 *
				 * $this->input('feed_list','list',$list)
				*/
				case'list':
					$list = '';
					$list.= '<select name="'.$name.'">';
					if(!is_array($value))
					return false;
					
					if($value['minmax'])
					{
						for($i = $value['minmax']['min']; $i <= $value['minmax']['max']; $i++){
						$selected='';
						if($i == $value['select']) $selected ='selected="selected"'; 	
						
						$list.= '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
						}
					}
					else
					{	
					if($value['list'])		
					{		
						foreach($value['list'] as $key => $val){
						$selected='';
						if($key == $value['select']) $selected ='selected="selected"'; 	
						
						$list.= '<option value="'.$key.'" '.$selected.'>'.$val.'</option>';
						}
					}
					else
					{
						$list.= '<option value="">parameter not valid</option>';
					}
					}
					
					$list.= '</select>';
					return $list;
				break;
			}
		}
		
		function button($name,$icon=null){
			if(!empty($icon)) $icon = '<span class="icon '.$icon.'"></span>';
			else $icon = '';
			
			return '<button name="submit" class="primary">'.$icon.$name.'</button>';
		}
	}
?>