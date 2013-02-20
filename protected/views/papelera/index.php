<script>
    $(document).ready(function(){
        $('.arbol').click(function(){
            id_grilla = $(this).attr('id')+'-grid';
        });
        $('.btn-papelera').live('click',function(){
            var sub=$(this).attr('submodulo');
            $.ajax({
                  type:'GET',
                  url:'/siasoft_v2/index.php?r='+$(this).attr('modelo')+'/restaurar&id='+$(this).attr('id'),
                  success:function(html){
                      
                     $("#mensaje").html("<div class='alert alert-success'><button type=\'button\' class=\'close\' data-dismiss=\'alert\'>&times;</button><font size=\'4\' align=\'left\'>&nbsp &nbsp <img src='<?php echo Yii::app()->baseUrl?>/images/success.png'>&nbsp&nbsp Restarurado con éxito</font></div> ");
                        
                        $("#papelera").html(html);
                        setTimeout(function(){
                             $('#'+sub).click();
                        }, 3000);
                  },
                  beforeSend:cargando()
           });
           return false;
        });
    });
    function cargando(){
                          $("#papelera").html('<div align="center" style="height: 185px; margin-right: 144px; margin-top: 108px;"><?php echo CHtml::image($ruta);?></div>');
                 }
</script>
<?php $this->pageTitle = Yii::app()->name . " - Papelera"; ?>
<?php
$this->breadcrumbs = array(
    'Sistema' => array('index'),
    Yii::t('app', 'MANAGE').' Papelera',
);
?>

<h1>Administrar Papelera</h1>

<div style="float: left;width: 30%;">
    <?php
        $this->widget('CTreeView', array(
                'data' => $data,
                'animated' => 'normal',
                'collapsed' => true,
                'htmlOptions' => array('class' => 'treeview-gray')
            )
         );
    ?>
</div>
<br>
<div id="mensaje" style="float: left;width: 70%;"></div>
<div id="papelera" style="float: left;width: 70%;"></div>



