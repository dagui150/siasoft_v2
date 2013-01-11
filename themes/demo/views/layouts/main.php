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
        <script language="JavaScript">
            $(document).ready(function(){

                $('.decimal').blur(function(){
                    $(this).val(format($(this).val()));
                });                
            });
            function format(value) {
                    var num = value.replace(/\./g,'');	

                    if(!/,/.test(num)){
                        num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
                        num = num.split('').reverse().join('').replace(/^[\.]/,'');
                        return num;
                    }else{
                        var num2 = num.toString().split(',')[0];
                        num2 = num2.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
                        num2 = num2.split('').reverse().join('').replace(/^[\.]/,'');
                        var num3 = num2+','+num.toString().split(',')[1] 
                        return num3;
                    }
            }
                
            function unformat($text){
                var $value = $text.toString().replace(/\./g,'');
                $value = $value.toString().replace(/\,/g,'.');
                return $value;
            }
        </script>
    </head>

    <body>

        <div class="container" id="page">

            <table width="960" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td id="cabecera" height="56">&nbsp;</td>
                </tr>
            </table><!-- header -->
            <div id="menu">

                <?php
                if (!Yii::app()->user->isGuest) {

                    $this->widget('bootstrap.widgets.BootMenu', array(
                        'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
                        'stacked' => false, // whether this is a stacked menu
                        'items' =>$this->menu(),
                                    
                    ));
                }
                ?>
            </div><!-- mainmenu -->

<?php
if (!Yii::app()->user->isGuest) {
    if (isset($this->breadcrumbs)):
        $this->widget('bootstrap.widgets.BootBreadcrumbs', array(
            'links' => $this->breadcrumbs,
        ));
    endif
    ?>
            <?php } ?>

            <?php echo $content; ?>
			
            <div class="clear"></div>

            <div style="width:100%; background-color:#fff; height:100px;">
                <div style="padding-top:20px; padding-right:50px;" align="center">
					Dise&ntilde;o y desarrollo por:<br />
                    <a href="http://www.tramasoft.com" target="_blank" title="Tramasoft - Soluciones TIC"><img src="themes/demo/images/logo_tramasoft.png" alt="Tramasoft - Soluciones TIC" border="0" /></a>
                </div>
            </div><!-- footer -->

        </div><!-- page -->
		
		<?php echo Yii::app()->user->ui->displayErrorConsole(); ?>
    </body>
</html>