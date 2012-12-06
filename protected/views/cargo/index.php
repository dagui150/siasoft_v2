<?php
/* @var $this CargoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Recursos Humanos' => array('admin'),
    'Cargos',
);

$this->menu = array(
    array('label' => Yii::t('app','CREATE').' Cargo', 'url' => array('create')),
    array('label' => Yii::t('app','MANAGE').' Cargo', 'url' => array('admin')),
);
?>

<h1>Cargos</h1>

<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>
