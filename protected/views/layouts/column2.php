<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="col-md-9">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="col-md-3">
	<div id="sidebar">
	<?php
		/*$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Operations',
		));
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'operations'),
		));
		$this->endWidget();
		*/
		$this->beginWidget(
	    	'booster.widgets.TbPanel',
		    array(    
			    'title' => 'Operations',
			    'headerIcon' => 'fa fa-th-list fa-2x',
			    'content' => '',
			    //'icon'=>'facebook',
		    )
    	);		
		$this->widget('booster.widgets.TbMenu', array(
			'items'=>$this->menu,
			'type'=>'list',        
			'htmlOptions'=>array('class'=>'operations'),
		));
		$this->endWidget();
	?>
	</div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>