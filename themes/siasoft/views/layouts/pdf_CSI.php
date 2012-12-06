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
        <style type="text/css">
            body{
                background: white;
            }
            
        </style>
        
    </head>

    <body>

        <div class="container" id="page">

            <table cellspacing="20" style="font-family: Tahoma;">
                <tr>
                    <td colspan="2">
                        <table>
                            <tr>
                                <td width="33%">
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
                                <td width="33%" align="center">
                                    <?php echo $compania->NOMBRE_ABREV.'<br /><b>Nit:</b> '.$compania->NIT; ?>
                                </td>
                                <td width="33%" align="right">
                                    <b> <?php echo $this->submodulo; ?> </b>
                                </td>
                            </tr>
                        </table>
                    </td>               
                </tr>
                <tr>
                    <td>
                        <?php echo $content; ?>
                    </td>
                </tr>
                 
                 <tr>
                    <td width="50%"><b>Elaborado por:</b> <?php echo Yii::app()->user->name; ?></td>
                    <td align="right"><b>Fecha de Elaboración:</b> <?php echo date('Y/m/d'); ?></td>        
                </tr>
                <tr>
                    <td colspan="2" align="center">Desarrollado por Tramasoft Soluciones TIC - www.tramasoft.com</td>     
                </tr>

            
        </div><!-- page -->

    </body>
</html>