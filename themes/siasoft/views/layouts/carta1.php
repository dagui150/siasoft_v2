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

        <div class="container" id="page">

            
<table width="100%" border="1">
  <tr>
    <td width="33%" rowspan="2">
	<?php 
		$compania = Compania::model()->find();
		if($compania->LOGO != ''){
			echo CHtml::image(Yii::app()->request->baseUrl."/logo/".$compania->LOGO, 'Logo');     
		}
		else{
			echo $compania->NOMBRE;

                                        }
                                    ?>
                                    </td>
    <td align="left" > <?php echo $compania->NOMBRE_ABREV; ?></td>
    <td ><b> <?php echo $this->modulo; ?></b></td>
  </tr>
  <tr>
    <td align="left">
      <?php echo '<b>Nit:</b> '.$compania->NIT; ?></td>
    <td><b> <?php echo $this->submodulo; ?></b></td>
  </tr>
  <tr>
    <td colspan="3" aling="center" width="100%"><br/> 
        <center><?php echo $content; ?></center>
    </td>
  </tr>
  <tr>
    <td align="right" class="piePagina"><b>Generado por:</b> <?php echo Yii::app()->user->name; ?></td>
    <td>&nbsp;</td>
    <td align="left" class="piePagina"><b>Generado el:</b> <?php echo date('Y/m/d');?></td>
  </tr>
  <tr>
    <td colspan="3" align="center" class="piePagina"><center>Desarrollado por Tramasoft Soluciones TIC - www.tramasoft.com</center></td>
  </tr>
</table>
            
            
            
        </div><!-- page -->
        


    </body>
</html>