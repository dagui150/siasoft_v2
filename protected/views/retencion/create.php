<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','CREATE')." Retención";?>
<?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
	"Retenciones");
?>

<h1>Crear Retención</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>