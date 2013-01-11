<?php $this->pageTitle=Yii::app()->name." - Artículos";?>
<?php
/* @var $this ArticuloController*/
if(!ConfCi::darConf())
     $this->redirect(array('/confCi/create'));
$this->breadcrumbs=array(
	'Inventario'=>array('admin'),
	'Artículos'
);

?>

<h1>Artículos</h1>
<?php 
if (isset($_GET['men'])){
    $this->mensaje($_GET['men']);
}
?>
<br>
<div align="right">
    <?php $this->darBotonNuevo(); ?>
</div>

<?php
    $this->widget('bootstrap.widgets.TbGridView', array(
            'type'=>'striped bordered condensed',
            'id'=>'articulo-grid',
            'dataProvider'=>$model->search(),
            'filter'=>$model,
            'columns'=>array(
                    'ARTICULO',
                    'NOMBRE',
                    /*'CLASIFICACION_1',
                    'CLASIFICACION_2',
                    'CLASIFICACION_3',
                    'CLASIFICACION_4',                    
                    'CLASIFICACION_5',
                    'CLASIFICACION_6',
                    'FACTOR_CONVER_1',
                    'FACTOR_CONVER_2',
                    'FACTOR_CONVER_3',
                    'FACTOR_CONVER_4',
                    'FACTOR_CONVER_5',
                    'FACTOR_CONVER_6',
                    'ORIGEN_CORP',
                    'CLASE_ABC',*/
                    array(
                        'name'=>'TIPO_ARTICULO',
                        'header'=>'Tipo de Artículo',
                        'value'=>'$data->tIPOARTICULO->NOMBRE',
                        'filter'=>CHtml::ListData(TipoArticulo::model()->findAll(),'ID','NOMBRE'),
                    ),
                    /*'TIPO_COD_BARRAS',
                    'CODIGO_BARRAS',*/
                    'EXISTENCIA_MINIMA',
                    'EXISTENCIA_MAXIMA',
                    /*'PUNTO_REORDEN',
                    'COSTO_FISCAL',
                    'COSTO_COMPARATIVO',
                    'DESCRIPCION_COMPRA',
                    'IMPUESTO',*/
                    'BODEGA',
                   //'IMP1_AFECTA_COSTO',
                    //'ACTIVO',
                    array(
                            'class'=>'bootstrap.widgets.TbButtonColumn',
                            'template'=>'{view} {update}',
                    ),
                    /*array(
                         'class'=>'CLinkColumn',
			 //'header'=>'Bodegas',
			 'imageUrl'=>Yii::app()->baseUrl.'/images/multimedia.png',
			 //'labelExpression'=>'$data->ID',
			 'urlExpression'=>'"index.php?r=articuloMultimedia/create&id=".$data->ARTICULO',
			 'htmlOptions'=>array('style'=>'text-align:center;'),
			 'linkHtmlOptions'=>array('style'=>'text-align:center','rel'=>'tooltip', 'data-original-title'=>'Multimedia'),
                     ),*/
                    array(
                         'class'=>'CLinkColumn',
			 //'header'=>'Bodegas',
			 'imageUrl'=>Yii::app()->baseUrl.'/images/bodega.png',
			 //'labelExpression'=>'$data->ID',
			 'urlExpression'=>'"index.php?r=existenciaBodega/create&id=".$data->ARTICULO',
			 'htmlOptions'=>array('style'=>'text-align:center;'),
			 'linkHtmlOptions'=>array('style'=>'text-align:center','rel'=>'tooltip', 'data-original-title'=>'Bodegas'),
                     ),
                    array(
                         'class'=>'CLinkColumn',
			 //'header'=>'Proveedores',
			 'imageUrl'=>Yii::app()->baseUrl.'/images/proveedor.png',
			 //'labelExpression'=>'$data->ID',
			 'urlExpression'=>'"index.php?r=articuloProveedor/create&id=".$data->ARTICULO',
			 'htmlOptions'=>array('style'=>'text-align:center;margin:auto'),
			 'linkHtmlOptions'=>array('style'=>'text-align:center;','rel'=>'tooltip', 'data-original-title'=>'Proveedores'),
                     ),
            ),
    ));
?>
