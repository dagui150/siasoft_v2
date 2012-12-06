<?php
/* @var $this HorarioController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Recursos Humanos' => array('admin'),
    'Horarios',
);

$this->menu = array(
    array('label' => Yii::t('app','CREATE').' Horario', 'url' => array('create')),
    array('label' => Yii::t('app','MANAGE').' Horario', 'url' => array('admin')),
);
?>

<h1>Horarios</h1>

<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>
