<script language="JavaScript">
    function disableKeyPress(e){
          var key;      
          if(window.event)
               key = window.event.keyCode; //IE
          else
               key = e.which; //firefox      
          return (key != 13);
     }
 </script>
<?php $this->beginContent('//layouts/main'); ?>
<div id="content" OnKeyPress="return disableKeyPress(event)">
<table width="80%" border="0" cellspacing="0" cellpadding="0">
  <tr>
	<td height="40" class="form_superior">&nbsp;</td>
	<td class="form_superior" width="*">&nbsp;</td>
	<td height="40" class="form_superior">&nbsp;</td>
  </tr>
  <tr>
    <td class="form_medio">&nbsp;</td>
    <td class="form_medio"><?php echo $content; ?></td>
    <td class="form_medio">&nbsp;</td>
  </tr>
  <tr>
    <td class="form_medio">&nbsp;</td>
    <td class="form_medio">&nbsp;</td>
    <td class="form_medio">&nbsp;</td>
  </tr>
</table>

</div><!-- content -->
<?php $this->endContent(); ?>