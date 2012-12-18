<script language="JavaScript">

 function disableKeyPress(e)
 {
      var key;      
      if(window.event)
           key = window.event.keyCode; //IE
      else
           key = e.which; //firefox      
      return (key != 13);
 }
 
     function formato(input)
    {	
        var num = input.value.replace(/\./g,'');	
        
        if(!/,/.test(num)){
            num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
            num = num.split('').reverse().join('').replace(/^[\.]/,'');
            input.value = num;
        }else{
            var num2 = num.toString().split(',')[0];
            num2 = num2.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
            num2 = num2.split('').reverse().join('').replace(/^[\.]/,'');
            var num3 = num2+','+num.toString().split(',')[1] 
            input.value = num3;
        }
    }
    
    function unformat($text){
        var $value = $text.toString().replace(/\./g,'');
        $value = $value.toString().replace(/\,/g,'.');
        return $value;
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