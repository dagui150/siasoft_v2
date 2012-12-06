<?php $this->pageTitle=Yii::app()->name." - Cargos";?>
<?php
/* @var $this CargoController */
/* @var $model Cargo */

$this->pageTitle=Yii::app()->name." - Cargos";

$this->breadcrumbs = array(
    'Recursos Humanos' => array('admin'),
    'Cargos',
);

$this->menu = array(
    array('label' => Yii::t('app','LIST').' Cargo', 'url' => array('index')),
    array('label' => Yii::t('app','CREATE').' Cargo', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('cargo-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Cargos</h1>

<div align="right">
    <?php
    $this->widget('bootstrap.widgets.BootButton', array(
        'label' => 'Nuevo',
        'type' => 'success', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size' => 'mini', // '', 'large', 'small' or 'mini'
        'url' => array('cargo/create'),
        'icon' => 'plus white'
    ));
    ?>
</div>


<?php
$this->widget('bootstrap.widgets.BootGridView', array(
    'type' => 'striped bordered condensed',
    'id' => 'cargo-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'CARGO',
        'DESCRIPCION',
        'SALARIO_MINIMO',
        'SALARIO_INTERMEDIO1',
        'SALARIO_INTERMEDIO2',
        'SALARIO_MAXIMO',
        /*
          'SALARIO_ACTUAL',
          'FUNCIONES',
          'NOTAS',
          'ACTIVO',
          'CREADO_POR',
          'CREADO_EL',
          'ACTUALIZADO_POR',
          'ACTUALIZADO_EL',
         */
        array(
            'class' => 'bootstrap.widgets.BootButtonColumn',
            'htmlOptions' => array('style' => 'width: 50px'),
        ),
    ),
));
?>

