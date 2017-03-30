<?php
/* @var $this KehadiranController */

$this->breadcrumbs=array(
	'Kehadiran',
);


$this->menu=array(
	array('label'=>'Kehadiran by date', 'url'=>array('bydate')),
	array('label'=>'Ontime', 'url'=>array('ontime')),
);
?>

<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<p>
	You may change the content of this page by modifying
	the file <tt><?php echo __FILE__; ?></tt>.
</p>
