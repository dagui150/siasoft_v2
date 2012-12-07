<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','CREATE')." Artículo Multimedias";?>
<?php
$this->breadcrumbs=array(
	'Artículo Multimedias'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar ArticuloMultimedia', 'url'=>array('index')),
	array('label'=>'Administrar ArticuloMultimedia', 'url'=>array('admin')),
);
?>

<h1>Crear Artículo Multimedia</h1>


<?php 

    
    echo $this->renderPartial('_form', 
            array(
                'model'=>$model,
		'articulo'=>$articulo,
		'barticulo'=>$barticulo,
            )
        );
  ?>