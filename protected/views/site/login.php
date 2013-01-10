<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);

?>
<h1>Ingreso al sistema</h1>
<div id = "login" style="margin-left: -92px; margin-top:23px;">
	

	<div class="form">
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'login-form',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
                'type'=>'horizontal',
	)); ?>
	
        <?php echo $form->textFieldRow($model,'username', array('size'=>15)); ?>
	<?php echo $form->passwordFieldRow($model,'password', array('size'=>15)); ?>
        <div style="margin-left: -80px">
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