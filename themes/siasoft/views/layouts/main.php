<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHtml::encode(Yii::app()->charset); ?>" />
        <meta name="language" content="<?php echo CHtml::encode(Yii::app()->language); ?>" />

        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/siasoft/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/siasoft/css/print.css" media="print" />
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <![endif]-->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/siasoft/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/siasoft/css/form.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/siasoft/css/tables.css" />

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        
        
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/siasoft.js" ></script>
        <?php Yii::app()->bootstrap->register(); ?>
    </head>

    <body>

        <div class="container" id="page">

            <table width="960" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td id="cabecera_sup" height="57">&nbsp;</td>
                </tr>
                <tr>
                    <td id="cabecera" height="56">&nbsp;</td>
                </tr>
            </table><!-- header -->
            <div id="menu">

                <?php
                if (UnidadMedida::validarUnidad() && !Yii::app()->user->isGuest) {

                    $this->widget('bootstrap.widgets.TbMenu', array(
                        'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
                        'stacked' => false, // whether this is a stacked menu
                        'items' =>$this->menu(),
                                    
                    ));
                }
                ?>
            </div><!-- mainmenu -->

<?php
if (UnidadMedida::validarUnidad() && !Yii::app()->user->isGuest) {
    if (isset($this->breadcrumbs)):
        $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
            'links' => $this->breadcrumbs,
        ));
    endif
    ?>
            <?php } ?>

            <?php echo $content; ?>
			
            <div class="clear"></div>

            <div style="width:100%; background-color:#fff; height:100px;">
                <div style="padding-top:20px; float:left; padding-left:50px;">
                    <img src="themes/siasoft/images/footer.png" alt="escudos" width="619" height="59" border="0" usemap="#Map">
                        <map name="Map" id="Map">
                            <area shape="rect" coords="85,4,220,56" href="http://www.tolima.gov.co/tolima/index.php" target="_blank" />
                            <area shape="rect" coords="235,5,440,53" href="http://www.adtolima.org/" target="_blank" />
                            <area shape="rect" coords="450,5,615,54" href="http://www.ccibague.org/" target="_blank" />
                        </map>
                    </img>
                </div>
                <div style="float:right; padding-top:20px; padding-right:50px;">
                    <a href="http://www.tramasoft.com" target="_blank" title="Tramasoft - Soluciones TIC"><img src="themes/siasoft/images/logo_tramasoft.png" alt="Tramasoft - Soluciones TIC" border="0" /></a>
                </div>
            </div><!-- footer -->

        </div><!-- page -->
		
		<?php //echo Yii::app()->user->ui->displayErrorConsole(); ?>
    </body>
</html>