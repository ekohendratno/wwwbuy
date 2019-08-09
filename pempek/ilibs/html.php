<?php
/**
 * @file html.php
 * @package: beta version
 */
//dilarang mengakses
defined('_iEXEC') or die();

class FORM {
	private $html; 
	private $form; 
	 
	function __construct($att = null){	
	
		if(empty($att)) $att = array('@action:','@method:post');
	
		$this->html = new html;
		$this->form = "<form ".$this->html->attributs($att).">\n";	
	}
	function stat(){
		return $this->form;
	}
	function end(){
		return "</form>\n";
	}
	
	function tags($tag,$att,$value = null,$sel = null){
		$str = "";	
		if($tag == 'select'){			
			$str.= "<$tag";	
			$str.= $this->html->attributs(array('@name:'
				  .$this->html->attributs_get_val('name',$att)));
			$str.= ">";
			
			foreach($value as $key => $val){				
				
			$selected='';
			if(!empty($sel))
			if($val[0]==$sel) $selected ='selected="selected"'; 
			
			$str.= "<option value=\"$val[0]\" ".$selected.">$val[1]</option>";
			}
			
			$str.= "</$tag>";
		}
		else
		{	
			$str.= "<$tag";	
			$str.= $this->html->attributs($att) . ">"; 
			$str.= $value; 
			$str.= "</$tag>";
		}
		return $str;
	}
	
	function label($vals,$tag = 'label'){
		return "<$tag>".$vals."</$tag>\n";
	
	}
	function tags_select($tag,$value){
	}
	
	function pre_tag($type,$tag,$value){
		if(!is_array($value))
			return false;
			
		$str = '';
		foreach($value as $key => $val){
			
			$checked='';
			if(!empty($val[3]))
			if($val[3]==1) $checked ='@checked:checked'; 
			
			$values = '';
			if(!empty($val[1]))
			$values ='@value:'.$val[1]; 
			
			$vals= $this->tag_single($tag,array('@type:'.$type,$checked,$values,'@name:'.$val[0]));
			$str.= $this->label($vals.$val[2]); 
		}
		return $str; 
	}
	
	function tag($tag,$att,$value = null){
		
		if( $this->html->attributs_get('checkbox',$att) )
			return $this->pre_tag('checkbox',$tag,$value);
			
		elseif( $this->html->attributs_get('radio',$att) )
			return $this->pre_tag('radio',$tag,$value);
			
		else
			return $this->tag_single($tag,$att,$value);
	}
	
	function tag_single($tag,$att,$value = null){
		
		if(!empty($value))
		$value = " value=\"$value\""; 
		
		$str = "";		
		$str.= "<$tag";	
		$str.= $this->html->attributs($att) . $value .">"; 
		return $str;
	}
		
	function addElement($tag,$att = array('@type:text','@name:input'),$value = null,$sel = null){ 	
		$str = "";
		switch($tag){
			case'input':
			$str.= $this->tag($tag,$att,$value);
			break;	
			case'textarea':
			$str.= $this->tags($tag,$att,$value);
			break;	
			case'select':
			$str.= $this->tags($tag,$att,$value,$sel);
			break;	
		}
		return $str;
	}
	function input($att,$val = null){
		return $this->addElement( 'input',$att,$val );
	}
	function textarea($att,$val = null){
		return $this->addElement( 'textarea',$att,$val );
	}
	function select($att,$val = null,$sel = null){ 
		return $this->addElement( 'select',$att,$val,$sel );
	}

}

class TABLE {
	
    private $html; 
    private $table 	= ''; 
    private $rows 	= array();		
	/*
	 * $data = array('@id:table','@border:0','@cellspacing:0','@cellpadding:0');
	 * $this->__construct($data);
	 */
	function __construct($att = null){
			
		if(empty($att)) $att = array('@width:100%','@border:0','@cellspacing:0','@cellpadding:0');
		
		$this->html  = new html;	
		$this->table = "<table".$this->html->attributs($att).">\n";
	}
		
	public function row($att){
		$row = new html_table_row( $att ); 
        array_push( $this->rows, $row ); 
	}	
	/*
	 * $data = array('@class:table','@style:text-align.left','@cellspacing:0','@cellpadding:0');
	 * $this->cell($data);
	 */
	public function cell($data = null,$att = array('@align:left','@valign:top')){
        $cell = new html_table_cell( $data, $att ); 
        // add new cell to current row's list of cells 
        $curRow = &$this->rows[ count( $this->rows ) - 1 ]; // copy by reference 
        array_push( $curRow->cells, $cell ); 
	}
	
	public function get_cell($cells){
        $str = ''; 
        foreach( $cells as $cell ) {  
            $str.= "<td";   
            $str.= $this->html->attributs( $cell->attr ) . ">\n";
            $str.= $cell->data; 
            $str.= "</td>\n"; 
        } 
        return $str; 
	}
		
	public function display(){
		foreach( $this->rows as $row ) { 
            $this->table.= "<tr";
			$this->table.= $this->html->attributs( $row->attr ) . ">\n";
			$this->table.= $this->get_cell( $row->cells ); 			 
			$this->table.= "</tr>\n"; 
        } 
        $this->table.= "</table>\n"; 
        return $this->table; 
	}
}

class rel {
    private $script; 
    private $style; 
    private $tag; 
    private $atributs; 
    private $file; 
	
    function __construct( $tag,$file,$att = null ) { 
		$this->tag 		= $tag;
		$this->atributs	= $att;
		$this->file		= $file;
		$this->script 	= array('@type:text/javascript');
		$this->style  	= array('@rel:stylesheet','@type:text/css','@media:all');
	}	
	function display(){
		$html= new html;
		
		$str = '';
		if($this->tag == 'script'){
		$str.= "<$this->tag";
		$str.= " src=\"$this->file\"";
		
		if(!empty($this->atributs))
		$str.= $html->attributs( $this->atributs );
		else
		$str.= $html->attributs( $this->script );
		
		$str.= ">";
		$str.= "</$this->tag>\n";
		}
		else
		{		
			if($this->tag != 'link')
			return false;
			
			$str.= "<$this->tag";
			$str.= " href=\"$this->file\"";
			
			if(!empty($this->atributs))
			$str.= $html->attributs( $this->atributs );
			else
			$str.= $html->attributs( $this->style );
			
			$str.= ">\n";
		}
		return $str;
	}
}

class html_table_row { 
    function __construct($att = array()) { 
        $this->attr 	= $att; 
        $this->cells 	= array(); 
    } 
} 

class html_table_cell { 
    function __construct( $data, $att ) { 
        $this->data = $data; 
        $this->attr = $att; 
    } 
} 

class html {
	function attributs($att){
		
        $str = ''; 
		
		if(!empty($att) && is_array($att))
        foreach( $att as $key => $val ) {
			
			if( preg_match('|@(.*):(.*)|ims', $val, $attrbuts) ){
				$attribut_value = $attrbuts[2];
				
			if( preg_match('|(.*).(.*)|ims', $attrbuts[2]) ) 
				$attribut_value = str_replace('.',':',$attrbuts[2]);
			
            $str.= " $attrbuts[1]=\"$attribut_value\""; 
			
			}
        } 
        return $str; 
	}
	function attributs_get($param,$att){
		
		if(!empty($att))
        foreach( $att as $key => $val ) {
			
			if( preg_match('|@(.*):(.*)|ims', $val, $attrbuts) ) 
			if( $attrbuts[2] == $param )
			return $att;
		}		
	}	
	function attributs_get_val($param,$att){
		
		if(!empty($att))
        foreach( $att as $key => $val ) {
			
			if( preg_match('|@(.*):(.*)|ims', $val, $attrbuts) ) 
			if( $attrbuts[1] == $param )
			return  $attrbuts[2];
		}		
	}	
	function attributs_list($att){
		
		$list_array = array();
		
		if(!empty($att))
        foreach( $att as $key => $val ) {
			
			if( preg_match('|@(.*):(.*)|ims', $val, $attrbuts) ) 
			$list_array[] = $attrbuts[2];
		}
		return $list_array;
	}
	function table($att = null){
		return new TABLE($att);
	}
	function form($att = null){
		return new FORM($att);
	}
	
	function style($file,$att = null){
		$rel = new rel('link',$file,$att);
		return $rel->display();
	}
	function script($file,$att = null){
		$rel = new rel('script',$file,$att);
		return $rel->display();
	}
}
?>