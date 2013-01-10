<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);

?>
<h1>Ingreso al sistema</h1>
<div id = "login" style="margin-left: -70px; margin-top:23px;">
	

	<div class="form">
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'login-form',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
                'type'=>'horizontal',
	)); ?>
	
	<?php //echo $form->labelEx($model,'username'); ?>
        <?php echo $form->textFieldRow($model,'username', array('size'=>15)); ?>
	<?php //echo $form->error($model,'username'); ?>
        
	<?php //echo $form->labelEx($model,'password'); ?>
	<?php echo $form->passwordFieldRow($model,'password', array('size'=>15)); ?>
	<?php //echo $form->error($model,'password'); ?>
        <div class="row" style="margin-left: -80px">
		<?php //echo $form->labelEx($model,'rememberMe'); ?>
                <?php echo $form->checkBoxRow($model,'rememberMe'); ?>	
			
	</div>
            
        
        <div class="button" align="right">
            <?php
                $this->widget('bootstrap.widgets.TbButton', array(
                    'label'=>'Ingresar',
                    'icon' => 'user',
                    'buttonType'=>'submit',
                    'type'=>'action', 
                    'size'=>'small', 
                )); 
            ?>
        </div>
            
	<?php $this->endWidget(); ?>
	</div><!-- form -->
</div>