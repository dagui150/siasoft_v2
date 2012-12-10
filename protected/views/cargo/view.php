<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','VIEW')." Cargo";?>
<?php
/* @var $this CargoController */
/* @var $model Cargo */

$this->breadcrumbs = array(
    'Recursos Humanos' => array('admin'),
    'Cargo' => array('admin'),
    $model->CARGO,
);

$this->menu = array(
    array('label' => Yii::t('app','LIST').' Cargo', 'url' => array('index')),
    array('label' => Yii::t('app','CREATE').' Cargo', 'url' => array('create')),
    array('label' => Yii::t('app','UPDATE').' Cargo', 'url' => array('update', 'id' => $model->CARGO)),
    array('label' => Yii::t('app','DELETE').' Cargo', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->CARGO), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => Yii::t('app','MANAGE').' Cargo', 'url' => array('admin')),
);
?>

<h1>Visualizar Cargo <?php echo $model->CARGO; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'CARGO',
        'DESCRIPCION',
        'SALARIO_MINIMO',
        'SALARIO_INTERMEDIO1',
        'SALARIO_INTERMEDIO2',
        'SALARIO_MAXIMO',
        'SALARIO_ACTUAL',
        'FUNCIONES',
        'NOTAS',
    ),
));
?>
