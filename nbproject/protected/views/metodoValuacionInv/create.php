<?php
$this->breadcrumbs=array(
	'Metodo Valuacion Invs'=>array('admin'),
	'Crear',
);

?>

<h1>Crear MetodoValuacionInv</h1>
<p class="note">Los Campos con <span class="required">*</span> Son requeridos.</p>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>