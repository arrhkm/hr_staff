<?php 
class Convert extends CFormatter
{
	public $numberFormat=array('decimals'=>2, 'decimalSeparator'=>',', 'thousandSeparator'=>'.');

	public static function get_attribute($model)
	{
		//echo $model->id;
		//return "Utamakan Selamat";
		return $model->id;
	}	

	/*public static function MoneyToNumber($rupiah)
	{
	    return intval(preg_replace('/,.*|[^0-9]/', '', $rupiah));
	}
	*/
	/*public static function NumberToMoney($angka)
	{
	        return strrev(implode('.',str_split(strrev(strval($angka)),3)));
	}*/

	public static function NumberToMoney($value) 
	{
		$numberFormat=array('decimals'=>2, 'decimalSeparator'=>',', 'thousandSeparator'=>'.');
        if($value === null) return null;    // new
        if($value === '') return '';        // new
        return number_format($value, $numberFormat['decimals'], $numberFormat['decimalSeparator'], $numberFormat['thousandSeparator']);
   }

   public static function MoneyToNumber($formatted_number) 
   {
   		$numberFormat=array('decimals'=>2, 'decimalSeparator'=>',', 'thousandSeparator'=>'.');
        if($formatted_number === null) return null;
        if($formatted_number === '') return '';
        if(is_float($formatted_number)) return $formatted_number; // only 'unformat' if parameter is not float already
 
        $value = str_replace($numberFormat['thousandSeparator'], '', $formatted_number);
        $value = str_replace($numberFormat['decimalSeparator'], '.', $value);
        return (float) $value;
    }
}

?>