<?php $this->beginContent('//layouts/main'); ?>
<script language="JavaScript">
    $(document).ready(function(){
        $('label').addClass('control-label');
    });
</script>
<div id="content" >
    <center>
        <table width="80%" border="0" cellspacing="0" cellpadding="0" style="
                             margin-top: 10px;-webkit-box-shadow: #CCC 0px 0px 10px;
                            -moz-box-shadow: #CCC 0 0 10px;
                            box-shadow:#CCC 0 0 10px;
                            width: 340px;
                        ">
          <tr>
                <td height="25" class="form_superior">&nbsp;</td>
                <td class="form_superior" width="*">&nbsp;</td>
                <td height="25" class="form_superior">&nbsp;</td>
          </tr>
          <tr>
            <td class="form_medio">&nbsp;</td>
            <td class="form_medio" style="width:620px;"><?php echo $content; ?></td>
            <td class="form_medio" style="width:250px;"></td>
          </tr>
        </table>
    </center>

</div><!-- content -->
<?php $this->endContent(); ?>