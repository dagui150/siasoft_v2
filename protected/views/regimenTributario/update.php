<?php
$this->breadcrumbs=array(
	'Regimen Tributarios'=>array('index'),
	$model2->REGIMEN=>array('update','id'=>$model2->REGIMEN),
	'Regimen',
);
?>

<h1>Update RegimenTributario <?php echo $model2->REGIMEN; ?></h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>