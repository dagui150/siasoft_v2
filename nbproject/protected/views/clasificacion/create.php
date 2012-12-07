<?php
$this->breadcrumbs=array(
	'Clasificacions'=>array('admin'),
	'Crear',
);

?>

<h1>Crear Clasificacion</h1>
<p class="note">Los Campos con <span class="required">*</span> Son requeridos.</p>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>