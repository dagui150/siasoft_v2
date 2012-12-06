<?php
$this->breadcrumbs=array(
	'Unidad Medidas'=>array('admin'),
	'Crear',
);

?>

<h1>Crear UnidadMedida</h1>
<p class="note">Los Campos con <span class="required">*</span> Son requeridos.</p>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>