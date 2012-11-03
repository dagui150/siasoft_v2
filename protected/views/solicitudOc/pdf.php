<div style="width: 650px; margin: auto; font-family: Tahoma; padding-bottom: 2px;">
    <div style="border: 1px solid; height: 950px; font-family: Tahoma;">
        <div style="border-bottom: 1px solid; width: 259px; float: left; height: 90px;">
            <?php 
                if($compania->LOGO != ''){
                    echo '<br />'.CHtml::image(Yii::app()->request->baseUrl."/logo/".$compania->LOGO, 'Logo');     
                }
                else{
                    echo $compania->NOMBRE;
                }
            ?>
        </div>
        <div style="border-bottom: 1px solid; width: 200px; float: left; height: 90px;" align="center">
            <b><?php echo $compania->NOMBRE_ABREV; ?><br />
            <b>Nit:</b> <?php echo $compania->NIT; ?></b><br />
            <span style="font-size: 10px; font-weight: normal;"><?php echo $compania->DIRECCION; ?> - 
            <?php echo $compania->uBICACIONGEOGRAFICA1->NOMBRE; ?> 
            <?php echo $compania->uBICACIONGEOGRAFICA2->NOMBRE; ?><br />
            Teléfonos: <?php echo $compania->TELEFONO1.' '.$compania->TELEFONO2; ?></span>
        </div>
        <div style="width: 80px; float: left; height: 90px; border-bottom: 1px solid;"></div>
	<div style="border-bottom: 1px solid; border-left: 1px solid; width: 107px; float: right; height: 90px; font-family: Tahoma;" align="center">
            <br />Solicitud de<br /> compra<br /> <b><?php echo $solicitud->SOLICITUD_OC; ?></b>
        </div>	<p>&nbsp;</p>			
            <table width="80%" border="0" align="center">
                <tr>
                    <td width="60%" height="100" valign="top">
                        <b>Fecha Solicitud:</b> <?php echo $solicitud->FECHA_SOLICITUD; ?><br />
                        <b>Fecha Requerida:</b> <?php echo $solicitud->FECHA_REQUERIDA; ?><br />
                        <b>Estado:</b> <?php echo SolicitudOc::model()->estado($solicitud->ESTADO); ?><br />
                    </td>
                    <td valign="top" width="30%">
                        <b>Departamento:</b> <?php echo $solicitud->dEPARTAMENTO->DESCRIPCION; ?><br />
                        <b>Prioridad:</b> <?php echo SolicitudOc::model()->prioridad($solicitud->PRIORIDAD); ?><br />
                    </td>
		</tr>
		<tr>
                    <td colspan="2" height="400" valign="top">
                        <table cellpadding="10" border="1" bordercolor="#000000" style="border-collapse:collapse;" align="center">
                            <tr>
                                <th>Articulo</th>
                                <th>Descripción</th>
                                <th>Cantidad</th>
                                <th>Unidad</th>                    
                            </tr>                
                            <?php foreach($lineas as $ln){  ?>                                     
                                <tr>
                                    <td><?php echo $ln->aRTICULO->NOMBRE; ?></td>
                                    <td><?php echo $ln->DESCRIPCION; ?></td>
                                    <td><?php echo $ln->CANTIDAD; ?></td>
                                    <td><?php echo $ln->uNIDAD->NOMBRE; ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </td>						
		</tr>
		<tr>
                    <td colspan="2" height="100" valign="top">
                        <b>Observaciones:</b> Ninguna
                    </td>						
		</tr>
		<tr>
                    <td height="100" valign="top" width="15%">
                        <b>Elaborado por:</b> <?php echo Yii::app()->user->name; ?><br />
                        <b>Autorizada por:</b> <?php echo $solicitud->ACTUALIZADO_POR; ?> <br />
                    </td>
                    <td valign="top" width="50%">
                        <b>Fecha de Elaboración:</b> <?php echo date('Y-m-d'); ?><br />
                        <b>Fecha de Autorización:</b> <?php echo Yii::app()->dateFormatter->format('yyyy-MM-dd',$solicitud->ACTUALIZADO_EL); ?> <br />
                    </td>
		</tr>
            </table>				
    </div>
    <div align="center" style="font-family: Tahoma; font-size: 10px;">Desarrollado por Tramasoft Soluciones TIC - www.tramasoft.com</div>
</div>