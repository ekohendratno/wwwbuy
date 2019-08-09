<?php
/**
 * @file: list-country.php
 * @type: plugin
 */
 
/*
Plugin Name: List Country
Plugin URI: http://cmsid.org/#
Description: Ini adalah plugin yang digunakan untuk membantu anda me list kota kota didunia.
Author: Eko Azza
Version: 1.1
Author URI: http://cmsid.org/
*/

//dilarang mengakses
defined('_iEXEC') or die();

class Country {

	private $Codes = array() ;
	
	public function country()
	{
		$this->Codes = new GeoIP;
	}
	
	//list of countries for SELECT
	public function CountryList($Selected="ID")
	{
		foreach($this->Codes->GEOIP_COUNTRY_CODES as $key => $val)
		{
			if($key == 0) echo '<option value="">Select Your Country</option>'."\n";
			else{
			if($val == $Selected)
				echo '<option value="'.$val.'" selected="selected">'.$this->Codes->GEOIP_COUNTRY_NAMES[$key].'</option>'."\n";
			else
				echo '<option value="'.$val.'">'.$this->Codes->GEOIP_COUNTRY_NAMES[$key].'</option>'."\n";
			}
		}
	}
	
	//country count
	public function CountryCount()
	{
		return count($this->Codes->GEOIP_COUNTRY_CODES);
	}
	
	//country code
	public function CountryCode($name)
	{
		foreach($this->Codes->GEOIP_COUNTRY_NAMES as $key => $val)
		{
			if(strpos($key,$name) !== false )
				return $this->Codes->GEOIP_COUNTRY_CODES[$key];
		}
		return false;
	}
	
	//country name
	public function CountryName($code)
	{
		foreach($this->Codes->GEOIP_COUNTRY_CODES as $key => $val)
		{
			if(strpos($val,$code) !== false )
				return $this->Codes->GEOIP_COUNTRY_NAMES[$key];
		}
		return false;
		
	}
}

if(!function_exists('country')){
	function country(){
		return new Country;
	}
}

