<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','VIEW')." Tipos de Academicos";?>
<?php
/* @var $this TipoAcademicoController */
/* @var $model TipoAcademico */

$this->breadcrumbs = array(
    'Recursos Humanos' => array('admin'),
    'Tipos de Academicos' => array('admin'),
    $model->TIPO_ACADEMICO,
);

$this->menu = array(
    array('label' => Yii::t('app','LIST').' TipoAcademico', 'url' => array('index')),
    array('label' => Yii::t('app','CREATE').' TipoAcademico', 'url' => array('create')),
    array('label' => Yii::t('app','UPDATE').' TipoAcademico', 'url' => array('update', 'id' => $model->TIPO_ACADEMICO)),
    array('label' => Yii::t('app','DELETE').' TipoAcademico', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->TIPO_ACADEMICO), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => Yii::t('app','MANAGE').' TipoAcademico', 'url' => array('admin')),
);
?>

<h1>Ver Tipo de Academico <?php echo $model->TIPO_ACADEMICO; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'TIPO_ACADEMICO',
        'NOMBRE',
    ),
));
?>
