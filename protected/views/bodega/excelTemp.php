<?php
if($model!==null){ 
$labels = new Bodega?>



<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<table border='1'>
<tr>    <th> <?php echo $labels->getAttributeLabel('ID')?></th>
        <th> <?php echo $labels->getAttributeLabel('DESCRIPCION')?></th>
        <th> <?php echo $labels->getAttributeLabel('TIPO')?></th>
        <th> <?php echo $labels->getAttributeLabel('TELEFONO')?></th>
        <th> <?php echo $labels->getAttributeLabel('DIRECCION')?></th>
    
</tr><?php $x=0; ?><?php foreach ($model as $value) { ?><?php $x++;?>
<tr>
    <td <?php echo ($x)%2==0 ?"style='background-color:#CCC'":""?>><?php echo$value->ID?></td>
            <td <?php echo ($x)%2==0 ?"style='background-color:#CCC'":""?>><?php echo$value->DESCRIPCION?></td>
            <td <?php echo ($x)%2==0 ?"style='background-color:#CCC'":""?>><?php echo Bodega::tipo($value->TIPO)?></td>
            <td <?php echo ($x)%2==0 ?"style='background-color:#CCC'":""?>><?php echo$value->TELEFONO?></td>
            <td <?php echo ($x)%2==0 ?"style='background-color:#CCC'":""?>><?php echo$value->DIRECCION?></td>
        </tr><?php } ?>	   
</table><?php } ?>
