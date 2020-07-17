
jQuery(document).ready(function() {
	
  
    $('.login-form input[type="text"], .login-form input[type="password"], .login-form textarea').on('focus', function() {
    	$(this).removeClass('input-error');
    });
    
    $('.login-form').on('submit', function(e) {
    	
    	$(this).find('input[type="text"], input[type="password"], textarea').each(function(){
    		if( $(this).val() == "" ) {
    			e.preventDefault();
    			$(this).addClass('input-error');
    		}
    		else {
    			$(this).removeClass('input-error');
    		}
    	});
    	
    });
    
  
    
});

$(document).ready(function() {
$("#signup").click(function() {
$("#first").slideUp("slow", function() {
$("#second").slideDown("slow");
});
});
// On Click SignIn It Will Hide Registration Form and Display Login Form
$("#signin").click(function() {
$("#second").slideUp("slow", function() {
$("#first").slideDown("slow");
});
});
});

//var GLOBALS = 'https://c-iprocure.com/moneybook/';
var GLOBALS = 'http://localhost:8080/expenseprov2/';

$('#sendpassReset').click(function(e){
    
   var action = GLOBALS + "login/requestpasswordchange";
   var emailAddress = $('#emailAddress').val();
    
   if(emailAddress == ""){
        $('#errorCase').html("Please enter an email address<br/>").addClass("errorRed");
   }else if(vaildEmail(emailAddress) === false){
         $('#errorCase').html("Please enter a valid email address<br/>").addClass("errorRed");
    }else{
         $('#errorCase').html("Validating Email, Please wait...").addClass("errorGreen");
         $.post(action, $('#processemailchecks').serialize(), function (data){ 
             if(data.msg){
                 $('#errorCase').html(data.msg).addClass('errorGreen')
             }
           
        });
   }
});


$('#resettingthepassword').click(function(e){
    
   var action = GLOBALS + "login/resetmypassword";
   var password1 = $('#password1').val();
   var password2 = $('#password2').val();
   var uemail = $('#uemail').val();
   var ids = $('#ids').val();
    
   if(password1 == "" || password2==""){
        $('#errorCase').html("Please enter a Password<br/>").addClass("errorRed");
   }else if(password1 !== password2){
         $('#errorCase').html("Password Do no match<br/>").addClass("errorRed");
    }else{
         $('#errorCase').html("Reseting Password, Please wait...").addClass("errorGreen");
         $.post(action, $('#changingthepass').serialize(), function (data){ 
             if(data.msg){
                 $('#errorCase').html(data.msg).addClass('errorGreen')
             }
           
        });
   }
});
