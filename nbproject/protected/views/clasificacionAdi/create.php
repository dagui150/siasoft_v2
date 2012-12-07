<?php
$this->breadcrumbs=array(
	'Clasificacion Adis'=>array('admin'),
	'Crear',
);

?>

<h1>Crear ClasificacionAdi</h1>
<p class="note">Los Campos con <span class="required">*</span> Son requeridos.</p>
<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>