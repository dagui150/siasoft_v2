<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','CREATE')." Artículo Proveedores";?>
<?php
$this->breadcrumbs=array(
	'Artículo Proveedores'=>array('index'),
	'Crear',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle('fold');
});
");

?>

<h1>Crear Artículo Proveedor</h1>

<br>
    <div align="right">
         <?php
            $this->widget('bootstrap.widgets.BootButton', array(
                    'type'=>'success',
                    'size'=>'mini',
                    'label'=>'Nuevo',
                    'icon'=>'plus white',
                    'htmlOptions'=>array('class'=>'search-button','onClick'=>"$('html,body').animate({scrollTop:'2000px'}, 'slow');return false;"),
                ));
         ?>
     </div>

  <?php   
     $this->widget('bootstrap.widgets.BootGridView', array(
        'type'=>'striped bordered condensed',
	'id'=>'existencia-bodega-grid',
	'dataProvider'=>$model2->search2($articulo),
	'filter'=>$model2,
	'columns'=>array(
		'ID',
		'ARTICULO',
		'PROVEEDOR',
		'CODIGO_CATALOGO',
		'NOMBRE_CATALOGO',
		array(
                    'class'=>'bootstrap.widgets.BootButtonColumn',
                    'htmlOptions'=>array('style'=>'width: 50px'),
		),
	),
    ));
    ?>
        <div class="search-form" style="display:none; background-color: white;">
            <?php echo $this->renderPartial('_form', 
                    array(
                        'model'=>$model,
                        'proveedor'=>$proveedor,
                        'articulo'=>$articulo,
                        'barticulo'=>$barticulo
                    )
               ); ?>
        </div><!-- search-form -->