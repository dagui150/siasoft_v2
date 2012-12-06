<?php $this->pageTitle=Yii::app()->name." - Horarios";?>
<?php
/* @var $this HorarioController */
/* @var $model Horario */

$this->breadcrumbs = array(
    'Recursos Humanos' => array('admin'),
    'Horarios',
);

$this->menu = array(
    array('label' => 'Listar Horario', 'url' => array('index')),
    array('label' => 'Crear Horario', 'url' => array('create')),
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

<h1>Horarios</h1>

<div align="right">
    <br>
    <?php
    $this->widget('bootstrap.widgets.BootButton', array(
        'label' => 'Nuevo',
        'type' => 'success', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size' => 'mini', // '', 'large', 'small' or 'mini'
        'url' => array('horario/create'),
        'icon' => 'plus white'
    ));
    ?>
</div>

<?php
$this->widget('bootstrap.widgets.BootGridView', array(
    'type' => 'striped bordered condensed',
    'id' => 'horario-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'HORARIO',
        'DESCRIPCION',
        'TOLERA_ENTRADA',
        'TOLERA_SALIDA',
        'REDONDEO_ENTRADA',
        'REDONDEO_SALIDA',
        
        array(
            'class' => 'bootstrap.widgets.BootButtonColumn',
            'htmlOptions' => array('style' => 'width: 50px'),
        ),
    ),
));
?>
