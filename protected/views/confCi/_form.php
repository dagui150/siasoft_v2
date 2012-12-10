<div class="form">

<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id'=>'conf-ci-form',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
			'validateOnSubmit'=>true,
	),
	'type'=>'horizontal',
)); ?>
	<?php echo $form->errorSummary($model); ?>
	<?php 
		$this->widget('bootstrap.widgets.BootTabbable', array(
			'type'=>'tabs', // 'tabs' or 'pills'
			'tabs'=>array(
				array(
					'label'=>'General',
					'content'=>
						'<table>
							<tr>
								<td>
									<fieldset style="width: 280px;float: left;">
										<legend ><font face="arial" size=3 >Cantidad de Decimales</font></legend>'
										.$form->textFieldRow($model,'COSTOS_DEC',array('size'=>3,'maxlength'=>10))
										.$form->textFieldRow($model,'EXISTENCIAS_DEC',array('size'=>3,'maxlength'=>10))
										.$form->textFieldRow($model,'PESOS_DEC',array('size'=>3,'maxlength'=>10))
									.'</fieldset>
								</td>'
								
								.'<td>
                                                                        <br><fieldset style="width: 280px;float: left;">
                                                                        <legend ><font face="arial" size=3 >Valores por defecto</font></legend>
                                                                            <div style="width: 200px; margin: 20px 50px 0px 0px;">'
                                                                                    .$form->dropDownListRow($model,'COSTO_INGR_DEFAULT',array(''=>'Seleccione','U'=>'Ultimo','P'=>'Promedio','F'=>'Fiscal'))
                                                                                    .$form->dropDownListRow($model,'UNIDAD_PESO',UnidadMedida::getPeso(),array('empty'=>'Seleccione'))
                                                                                    .$form->dropDownListRow($model,'UNIDAD_VOLUMEN',UnidadMedida::getVolumen(),array('empty'=>'Seleccione'))
                                                                            .'</div>
                                                                        </fieldset>
								</td>
							</tr>
							<tr>
								<td>
									<fieldset style="width: 280px; height: 190px;">
										<legend ><font face="arial" size=3 >Costos por Omision</font></legend>'
										.$form->dropDownListRow($model,'COSTO_FISCAL',MetodoValuacionInv::getMetodo(),array('empty'=>'Seleccione'))
									.'</fieldset>
								</td>
								<td>
									<fieldset style="width: 283px">
										<legend ><font face="arial" size=3 >Existencias en Totales </font></legend>'
										.$form->checkBoxRow($model, 'EXIST_DISPONIBLE')
                                                                                .$form->checkBoxRow($model, 'EXIST_REMITIDA')
                                                                                .$form->checkBoxRow($model, 'EXIST_RESERVADA')
									.'</fieldset>
								</td>
							</tr>
						</table>',
					'active'=>true
				),
				array(
					'label'=>'Indicadores',
					'content'=>
						$form->checkBoxRow($model, 'INTEGRACION_CONTA',array('disabled'=>true))
						.$form->checkBoxRow($model, 'USA_CODIGO_BARRAS',
											array(
												'onclick'=>
													'
													if(ConfCi_USA_UNIDADES_DIST.disabled == true){
														ConfCi_USA_UNIDADES_DIST.disabled = false
														ConfCi_ASISTENCIA_AUTOMAT.disabled = false
														ConfCi_USA_CODIGO_EAN13.disabled = false
														ConfCi_USA_CODIGO_EAN8.disabled = false
														ConfCi_USA_CODIGO_UCC12.disabled = false
														ConfCi_USA_CODIGO_UCC8.disabled = false
													}else{
														ConfCi_USA_UNIDADES_DIST.disabled = true
														ConfCi_ASISTENCIA_AUTOMAT.disabled = true
														ConfCi_USA_CODIGO_EAN13.disabled = true
														ConfCi_EAN13_REGLA_LOCAL.disabled = true
														ConfCi_USA_CODIGO_EAN8.disabled = true
														ConfCi_EAN8_REGLA_LOCAL.disabled = true
														ConfCi_USA_CODIGO_UCC12.disabled = true
														ConfCi_UCC12_REGLA_LOCAL.disabled = true
														ConfCi_USA_CODIGO_UCC8.disabled = true
													}
													'
											)
								)
						.'<fieldset>
							<legend ><font face="arial" size=3 >Transacciones de Inventario</font></legend>'
							.$form->textFieldRow($model,'LINEAS_MAX_TRANS',array('size'=>'5',))
						.'</fieldset>'
				),
				array(
					'label'=>'Codigo de Barras',
					'content'=>
						//$form->checkBoxRow($model, 'USA_UNIDADES_DIST',array('disabled'=>true))
						$form->checkBoxRow($model, 'ASISTENCIA_AUTOMAT',
												array(
													'disabled'=>true, 
													'onclick'=>
														'
														if(ConfCi_EAN13_REGLA_LOCAL.disabled == true){
															ConfCi_EAN13_REGLA_LOCAL.disabled = false
															PRODUCTO_EAN13.disabled = false
															ConfCi_EAN8_REGLA_LOCAL.disabled = false
															ConfCi_UCC12_REGLA_LOCAL.disabled = false
															PRODUCTO_UCC12.disabled = false
														}else{
															ConfCi_EAN13_REGLA_LOCAL.disabled = true
															PRODUCTO_EAN13.disabled = true
															ConfCi_EAN8_REGLA_LOCAL.disabled = true
															ConfCi_UCC12_REGLA_LOCAL.disabled = true
															PRODUCTO_UCC12.disabled = true
															
														}
														'
												)
											)
						.'<fieldset style="width: 430px; float: left;">
							<legend ><font face="arial" size=3 >Tipos a utilizar</font></legend>
							<table>
								<th></th>
								<th><div align="center">Reglas locales</div></th>
								<tr>
									<td>'.$form->checkBoxRow($model, 'USA_CODIGO_EAN13',array('disabled'=>true)).'</td>
									<td>'
										.$form->textField($model, 'EAN13_REGLA_LOCAL',array('disabled'=>true,'size'=>3,'maxlength'=>3))
										.' - '.CHtml::textField('PRODUCTO_EAN13', '',array('disabled'=>true,'size'=>5,'maxlength'=>5))
								  .'</td>
								    <tr>
										<td></td>
										<td>'.$form->error($model,'EAN13_REGLA_LOCAL').'</td>
									</tr>
								</tr>
								<tr>
									<td>'.$form->checkBoxRow($model, 'USA_CODIGO_EAN8',array('disabled'=>true)).'</td>
									<td>'
										.$form->textField($model,'EAN8_REGLA_LOCAL',array('disabled'=>true,'size'=>3,'maxlength'=>3))
								  .'</td>
								</tr>
								<tr>
										<td></td>
										<td>'.$form->error($model,'EAN8_REGLA_LOCAL').'</td>
									</tr>
								<tr>
									<td>'.$form->checkBoxRow($model, 'USA_CODIGO_UCC12',array('disabled'=>true)).'</td>
									<td>'
										.$form->textField($model,'UCC12_REGLA_LOCAL',array('disabled'=>true,'size'=>1,'maxlength'=>1))
										.' - '.CHtml::textField('PRODUCTO_UCC12', '',array('disabled'=>true,'size'=>5,'maxlength'=>5))
								  .'</td>
								</tr>
								<tr>
										<td></td>
										<td>'.$form->error($model,'UCC12_REGLA_LOCAL').'</td>
									</tr>
								<tr>
								<tr>
									<td>'.$form->checkBoxRow($model, 'USA_CODIGO_UCC8',array('disabled'=>true)).'</td>
									<td></td>
								</tr>
								
							</table>'
						.'</fieldset>'
						.'<fieldset style="width: 380px; float: left; margin-left: 10px;">
							<legend ><font face="arial" size=3 >Prioridad Busqueda</font></legend>'
							.$form->radioButtonListRow($model, 'PRIORIDAD_BUSQUEDA', array('A'=>'Por Codgo de Articulo','C'=>'Por Codigo de Barras'))
						.'</fieldset>'
				),
			),
		)); 
	?>
	<div align="center">
		<?php 
			$this->widget('bootstrap.widgets.BootButton', array(
						'label'=>'Guardar',
						'buttonType'=>'submit',
						'type'=>'primary',
						'icon'=>'ok-circle white', 
					)
			);
		?>
		<?php
			$this->widget('bootstrap.widgets.BootButton', array(
						'label'=>'Cancelar',
						'type'=>'action',
						'icon'=>'remove', 
						'url'=>array('site/index'), 
					)
			);
			
		?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->