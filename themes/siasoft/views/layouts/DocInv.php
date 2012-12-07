<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/siasoft/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/siasoft/css/print.css" media="print" />
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <![endif]-->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/siasoft/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/siasoft/css/form.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/siasoft/css/tables.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        
        <style>
            .piePagina{
                
                color:#999999;
            }    
            body{
                background: white;
            }
            
        </style>
        
        
    </head>

    <body>

        <div class="container" id="page" >


<table width="100%" >
  <tr>
    <td height="75" colspan="2"><table width="100%" >
      <tr>
        <td width="26%" rowspan="3" align="left" valign="middle"><?php 
		$compania = Compania::model()->find();
		if($compania->LOGO != ''){
			echo CHtml::image(Yii::app()->request->baseUrl."/logo/".$compania->LOGO, 'Logo');     
		}
		else{
			echo $compania->NOMBRE;

                                        }
                                    ?></td>
        <?php $compania = Compania::model()->find();?>
        <td width="41%" align="center"><?php echo $compania->NOMBRE_ABREV; ?></td>
        <td width="33%" rowspan="2" align="right" valign="middle"><strong>Número</strong></td>
      </tr>
      <tr>
        <td align="center"><?php echo '<b>Nit:</b> '.$compania->NIT; ?></td>
      </tr>
      <tr>
        <td height="23" align="center"><?php echo '<b>Tels:</b> '.$compania->TELEFONO1.'-'.$compania->TELEFONO2; ?></td>
        <td width="33%" align="right" valign="middle"><?php echo $this->doc->DOCUMENTO_INV; ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="61" colspan="2" align="center" valign="middle"><strong>Documento de Inventario</strong></td>
  </tr>
  <tr>
    <td width="50%"><strong>Fecha Documento:</strong> <?php echo $this->doc->FECHA_DOCUMENTO; ?>	</td>
    <td width="50%"><strong>Estado:</strong> <?php echo DocumentoInv::darEstado($this->doc->ESTADO); ?></td>
  </tr>
  <tr>
    <td colspan="2"><center>
      <p>&nbsp;</p>
      <p><?php echo $content; ?></p>
    </center></td>
  </tr>
  <tr>
    <td colspan="2" align="left"><p><strong>Referencia:</strong> <?php echo $this->doc->REFERENCIA; ?></p>
    <p>&nbsp;</p></td>
  </tr>
</table>   
        </div><!-- page -->

    </body>
</html>