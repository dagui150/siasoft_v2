<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','CREATE')." Valor-Clasificación";?>
<?php
$this->breadcrumbs=array(
	'Inventario'=>array('admin'),
	'Valores - Clasificaciónes'=>array('admin'),
	'Crear',
);

?>

<h1>Crear Valor - Clasificación</h1>
<p class="note">Los Campos con <span class="required">*</span> Son requeridos.</p>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>