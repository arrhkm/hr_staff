<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<p>Congratulations! You have successfully created your Yii application.</p>

<p>You may change the content of this page by modifying the following two files:</p>
<ul>
	<li>View file: <code><?php echo __FILE__; ?></code></li>
	<li>Layout file: <code><?php echo $this->getLayoutFile('main'); ?></code></li>
</ul>

<p>For more details on how to further develop this application, please read
the <a href="http://www.yiiframework.com/doc/">documentation</a>.
Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>,
should you have any questions.</p>

<?php
/* Hanya TESTer saja .....*/
/*
$mEmp= Emp::model()->findByPk('S09078');
echo $mEmp->name;
$model2= Helper::get_attribute($mEmp);
echo "<br>". $model2;
$angka = 60000000;
$hasil_uang = Convert::NumberToMoney($angka);
echo "<br>". $hasil_uang;
echo "<br>". Convert::MoneyToNumber($hasil_uang);
*/
?>