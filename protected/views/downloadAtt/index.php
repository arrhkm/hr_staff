<?php
/* @var $this DownloadAttController */

$this->breadcrumbs=array(
	'Download Att',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>


<?php 

/*if ($ket){
	echo "keterangan :". $ket;
}else {
	echo $dt_array['PIN'];
	echo "<br> Keterangan :".$ket;
	echo "<br> jml :".$jml;
}
*/

/* Data lack List
function Parse_Data($data,$p1,$p2) 
{
	$data=" ".$data;
	$hasil="";
	$awal=strpos($data,$p1);
	if($awal!=""){
		$akhir=strpos(strstr($data,$p1),$p2);
		if($akhir!=""){
			$hasil=substr($data,$awal+strlen($p1),$akhir-strlen($p1));
		}
	}
	return $hasil;	
}

$IP= "192.168.100.136";
$Key= 80;
$Connect = fsockopen($IP, "80", $errno, $errstr, 1);
if($Connect){
	$ket=1;
	$soap_request="<GetAttLog><ArgComKey xsi:type=\"xsd:integer\">".$Key."</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg></GetAttLog>";
	$newLine="\r\n";
	fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
    fputs($Connect, "Content-Type: text/xml".$newLine);
    fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
    fputs($Connect, $soap_request.$newLine);
	$buffer="";
	while($Response=fgets($Connect, 1024)){
		$buffer=$buffer.$Response;
	}
}else $ket=0;


//$dt_array=array('PIN');
$PIN_array= array();
$DateTime_array = array();

$buffer=Parse_Data($buffer,"<GetAttLogResponse>","</GetAttLogResponse>");
$buffer=explode("\r\n",$buffer);
for($a=1;$a<count($buffer);$a++){
	$data=Parse_Data($buffer[$a],"<Row>","</Row>");
	$PIN=Parse_Data($data,"<PIN>","</PIN>");
	$DateTime=Parse_Data($data,"<DateTime>","</DateTime>");
	$Verified=Parse_Data($data,"<Verified>","</Verified>");
	$Status=Parse_Data($data,"<Status>","</Status>");
	
	//echo "<br>".$a." - ".$PIN." - ".$DateTime." - ".$Verified." - ".$Status;			
	
	$dt_array[$a]['PIN']=$PIN;
	$dt_array[$a]['DateTime']=$DateTime;
	$dt_array[$a]['Verified']=$Verified;
	$dt_array[$a]['Status']=$Status;
}
//$dt_array= array('1'=>$a_array, '2'=>$PIN_array, '3'=>$DateTime_array);

*/
if ($dt_array) {

	echo "<table border=1>";
	echo "<tr><th>Key</th><th>PIN</th></tr>";
	foreach ($dt_array as $k=>$v){
		echo "<tr>";
		echo "<td>".$k."</td>";
		echo "<td>".$v['PIN']."</td>";
		echo "<td>". $v['DateTime']."</td>";
		echo "<td>". $v['Verified']. " </td>";
		echo "<td>". $v['Status']."</td>";
		echo "</tr>";
	}
	echo "</table>";
	//echo "Hakam ".$hakam;
} else 
{
	echo "<p>
	Record di mesin tidak ada atau sudah dihapus
	the file <tt> ". __FILE__."</tt>.</p>";
}
		
?>
