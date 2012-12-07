<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','CREATE')." Existencias en Bodegas";?>
<?php
$this->breadcrumbs=array(
	'Inventario'=>array('articulo/admin'),
	'Existencia en Bodegas'=>array('create', 'id'=>$articulo),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
        
	$('.search-form').toggle('fold');
        
	return false;
});
");

?>

<h1>Bodegas de Articulo "<?php echo $articulo.' - '.$barticulo->NOMBRE?>"</h1>

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
		'BODEGA',
		'EXISTENCIA_MINIMA',
		'EXISTENCIA_MAXIMA',
		'PUNTO_REORDEN',
		'CANT_DISPONIBLE',
		'CANT_RESERVADA',
		'CANT_REMITIDA',
		array(
			 'class'=>'bootstrap.widgets.BootButtonColumn',
                         'template'=>'{update}{delete}'
		),
	),
    ));
    ?>
        <div class="search-form" style="display:none; background-color: white;">
            <?php $this->renderPartial('_form',array(
                'model'=>$model,
                'bodega'=>$bodega,
                'articulo'=>$articulo,
                'barticulo'=>$barticulo,
              )); ?>
        </div>
    