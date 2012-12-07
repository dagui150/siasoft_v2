
<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','CREATE')." Clasificaciónes";?><?php
$this->breadcrumbs=array(
	'Inventario'=>array('admin'),
	'Clasificaciónes'=>array('admin'),
	'Crear',
);

?>

<h1>Crear ClasificacionAdi</h1>
<p class="note">Los Campos con <span class="required">*</span> Son requeridos.</p>
<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>