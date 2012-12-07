<?php
if(!ConfFa::darConf())
     $this->redirect(array('/confFa/create'));   

$this->breadcrumbs=array(
	'Facturación'=>array('admin'),
	'Clientes'=>array('admin'),
	'Crear',
);
?>

<h1>Crear Cliente</h1>

<?php echo $this->renderPartial('_form',
        array(
            'model'=>$model,
            'nit'=>$nit,
            'impuesto'=>$impuesto,
            'regimen'=>$regimen,
        )
     ); ?>