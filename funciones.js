$(function(){  
  
$('#login').toggle(function(){  
  
$('#login-form').slideDown();  
  
},function(){  
  
$('#login-form').slideUp();  
  
});  
  
$('#usuario').focus(function(){  
$(this).val('');  
  
});  
  
$('#password').focus(function(){  
$(this).val('');  
});  
}); 