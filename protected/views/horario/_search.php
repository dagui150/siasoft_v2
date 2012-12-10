<?php
/* @var $this HorarioController */
/* @var $model Horario */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
            ));
    ?>

    <div class="row">
        <?php echo $form->label($model, 'HORARIO'); ?>
        <?php echo $form->textField($model, 'HORARIO', array('size' => 4, 'maxlength' => 4)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'DESCRIPCION'); ?>
        <?php echo $form->textField($model, 'DESCRIPCION', array('size' => 60, 'maxlength' => 64)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'TOLERA_ENTRADA'); ?>
        <?php echo $form->textField($model, 'TOLERA_ENTRADA'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'TOLERA_SALIDA'); ?>
        <?php echo $form->textField($model, 'TOLERA_SALIDA'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'REDONDEO_ENTRADA'); ?>
        <?php echo $form->textField($model, 'REDONDEO_ENTRADA'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'REDONDEO_SALIDA'); ?>
        <?php echo $form->textField($model, 'REDONDEO_SALIDA'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'ACTIVO'); ?>
        <?php echo $form->textField($model, 'ACTIVO', array('size' => 1, 'maxlength' => 1)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'CREADO_POR'); ?>
        <?php echo $form->textField($model, 'CREADO_POR', array('size' => 20, 'maxlength' => 20)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'CREADO_EL'); ?>
        <?php echo $form->textField($model, 'CREADO_EL'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'ACTUALIZADO_POR'); ?>
        <?php echo $form->textField($model, 'ACTUALIZADO_POR', array('size' => 20, 'maxlength' => 20)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'ACTUALIZADO_EL'); ?>
        <?php echo $form->textField($model, 'ACTUALIZADO_EL'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->