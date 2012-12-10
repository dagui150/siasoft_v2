<?php
$this->breadcrumbs=array(
        'Sistema'=>array('update', 'id'=>$model->ID),
	"Datos Empresa");
?>

<h1><?php echo Yii::t('app','UPDATE').' '.Yii::t('app','COMPANY'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>