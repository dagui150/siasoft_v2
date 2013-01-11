$(document).ready(function(){
    $(function(){$('form input[type="text"]').keypress(function(e){return e.which!=13})});
    $('.decimal').live('blur',function(){
         $(this).val(format($(this).val()));
    });
                
});
function format(value) {
       var num = value.toString().replace(/\./g,'');
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
                
function unformat(text){
     var value = text.toString().replace(/\./g,'');
     value = value.toString().replace(/\,/g,'.');
     return value;
}


