<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>
<div id = "login">
	

	<div class="form">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'login-form',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
	)); ?>

		<table width="300" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td height="40" class="form_superior">&nbsp;</td>
			<td class="form_superior" width="*">Ingreso al sistema</td>
			<td height="40" class="form_superior">&nbsp;</td>
		  </tr>
		   <tr>
			<td class="form_medio" width="1">&nbsp;</td>
			<td class="form_medio">
            
            <table width="280" border="0" align="center" cellpadding="0" cellspacing="2">
			  <tr>
				<td width="70%" style="padding-top:10px;">
					<?php echo $form->labelEx($model,'username'); ?>
				</td>
					
				<td>
                <?php echo $form->textField($model,'username', array('size'=>15)); ?>
					<?php echo $form->error($model,'username'); ?>
				</td>
			  </tr>
			  <tr>
				<td>
				<?php echo $form->labelEx($model,'password'); ?>

				</td>
				<td>
				<?php echo $form->passwordField($model,'password', array('size'=>15)); ?>
				<?php echo $form->error($model,'password'); ?>
				</td>
			  </tr>
			  <tr>
				<td colspan="2"><div align="right">
				<?php $this->widget('bootstrap.widgets.BootButton', array(
    'label'=>'Ingresar',
	'icon' => 'user',
	'buttonType'=>'submit',
    'type'=>'action', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'small', // '', 'large', 'small' or 'mini'
)); ?>
				
				<?php //echo CHtml::submitButton('Login'); ?></div></td>
			  </tr>
			</table></td>
			<td class="form_medio" width="1">&nbsp;</td>
		  </tr>
		 </table>
		  
		  
		  
		<div class="row">


		</div>

		<div class="row">


		</div>

		<div class="row rememberMe">
			
			
		</div>

		<div class="row buttons">
			
		</div>

	<?php $this->endWidget(); ?>
	</div><!-- form -->
</div>
