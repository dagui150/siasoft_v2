<script>
function completado(){
    $.fn.yiiGridView.update('bodega-grid');
}
</script>
<?php $this->pageTitle=Yii::app()->name." - Bodegas - Inventario";?>

<?php
$this->breadcrumbs=array(
        //'Inventario'=>array('inventario'),
	'Bodegas',
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' Bodega', 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE').' Bodega', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('bodega-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Asociación de artículos a Bodegas</h1>
<?php 
if (isset($_GET['men'])){
    $this->mensaje($_GET['men']);
}
?>
<?php
     $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
	'id'=>'bodega-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID',
		'DESCRIPCION',
		array(
                        'name'=>'TIPO',
                        'header'=>'Tipo',
                        'value'=>'Bodega::tipo($data->TIPO)',
                        'filter'=>array('C'=>'Consumo','V'=>'Ventas','N'=>'No Disponible',''=>'Todos'),
                    ),
		/*
		'TELEFONO',
		'DIRECCION',
		'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
		*/
		array(
                         'class'=>'CLinkColumn',
			 //'header'=>'Bodegas',
			 'imageUrl'=>Yii::app()->baseUrl.'/images/bodega.png',
			 //'labelExpression'=>'$data->ID',
			 'urlExpression'=>'"index.php?r=bodega/articulos&id=".$data->ID',
			 'htmlOptions'=>array('style'=>'text-align:center;'),
			 'linkHtmlOptions'=>array('style'=>'text-align:center','rel'=>'tooltip', 'data-original-title'=>'Artículos'),
                     ),

	),
)); ?>