<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','UPDATE')." Existencias en Bodegas";?>
<?php
$this->breadcrumbs=array(
	'Inventario'=>array('articulo/admin'),
	'Existencias en Bodegas'=>array('create', 'id'=>$model->ARTICULO),
	'Actualizar',
);
?>

<h1>Actualizar ExistenciaBodega </h1>
<?php
    $sql = "SELECT count(ORDEN_COMPRA) FROM orden_compra";
    $consulta = OrdenCompra::model()->findAllBySql($sql);
    $connection=Yii::app()->db;
    $command=$connection->createCommand($sql);
    $row=$command->queryRow();
    echo $bandera=$row['count(ORDEN_COMPRA)'];
    
?>
<?php 
/*echo $this->renderPartial('_form', array(
            'model'=>$model,
            'model2'=>$model2,
            'articulo'=>$articulo,
            'barticulo'=>$barticulo,
            'bodega'=>$bodega,
    ));*/ ?>