<?php
/* @var $this CargoController */
/* @var $model Cargo */
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
        <?php echo $form->label($model, 'CARGO'); ?>
        <?php echo $form->textField($model, 'CARGO', array('size' => 8, 'maxlength' => 8)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'DESCRIPCION'); ?>
        <?php echo $form->textField($model, 'DESCRIPCION', array('size' => 60, 'maxlength' => 64)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'SALARIO_MINIMO'); ?>
        <?php echo $form->textField($model, 'SALARIO_MINIMO', array('size' => 28, 'maxlength' => 28)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'SALARIO_INTERMEDIO1'); ?>
        <?php echo $form->textField($model, 'SALARIO_INTERMEDIO1', array('size' => 28, 'maxlength' => 28)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'SALARIO_INTERMEDIO2'); ?>
        <?php echo $form->textField($model, 'SALARIO_INTERMEDIO2', array('size' => 28, 'maxlength' => 28)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'SALARIO_MAXIMO'); ?>
        <?php echo $form->textField($model, 'SALARIO_MAXIMO', array('size' => 28, 'maxlength' => 28)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'SALARIO_ACTUAL'); ?>
        <?php echo $form->textField($model, 'SALARIO_ACTUAL', array('size' => 28, 'maxlength' => 28)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'FUNCIONES'); ?>
        <?php echo $form->textArea($model, 'FUNCIONES', array('rows' => 6, 'cols' => 50)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'NOTAS'); ?>
        <?php echo $form->textArea($model, 'NOTAS', array('rows' => 6, 'cols' => 50)); ?>
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