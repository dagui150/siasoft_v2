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
    <td><table width="100%" >
      <tr>
       <?php $compania = Compania::model()->find();?>
        <td align="center"><?php echo $compania->NOMBRE_ABREV; ?></td>
        <td rowspan="4" width="33%"><?php 
		$compania = Compania::model()->find();
		if($compania->LOGO != ''){
			echo CHtml::image(Yii::app()->request->baseUrl."/logo/".$compania->LOGO, 'Logo');     
		}
		else{
			echo $compania->NOMBRE;

                                        }
                                    ?></td>
      </tr>
      <tr>
        <td align="center"><?php echo '<b>Nit:</b> '.$compania->NIT; ?></td>
        </tr>
      <tr>
        <td align="center"><?php echo $compania->uBICACIONGEOGRAFICA1->NOMBRE.' - '.$compania->uBICACIONGEOGRAFICA2->NOMBRE; ?></td>
        </tr>
      <tr>
        <td align="center"><?php echo '<b>Tels:</b> '.$compania->TELEFONO1.'-'.$compania->TELEFONO2; ?></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td><center><b> <?php echo $this->submodulo; ?></b></center></td>
  </tr>
  <tr>
    <td><p>&nbsp;</p>
      <p><br />   
        <?php echo $content; ?>
      </p>
    <p>&nbsp;</p></td>
  </tr>
  <tr>
    <td><table width="100%"  align="center">
      <tr>
        <td class="piePagina" align="right"> <center><b>Generado por:</b> <?php echo Yii::app()->user->name; ?></center></td>
        <td class="piePagina"><b>Generado el:</b> <?php echo date('Y/m/d');?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center" class="piePagina"><center>Desarrollado por Tramasoft Soluciones TIC - www.tramasoft.com</center></td>
  </tr>
</table>
            
            
            
            
            
        </div><!-- page -->

    </body>
</html>