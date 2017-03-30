<?php 
class Helper
{
	
	public static function get_attribute($model)
	{
		//echo $model->id;
		//return "Utamakan Selamat";
		return $model->id;
	}	

	public static function convert_to_number($rupiah)
	{
	    return intval(preg_replace('/,.*|[^0-9]/', '', $rupiah));
	}
	public static function convert_dots($angka)
	{
	        return strrev(implode('.',str_split(strrev(strval($angka)),3)));
	}
}

?>