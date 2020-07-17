var GLOBAL = "http://localhost:8080/expenseprov2/";
//var GLOBAL = "https://c-iprocure.com/moneybook/";

$('#register').click(function (e) {
   
    var allowedDomains = ['c-ileasing.com', 'ogiogiovictor.com'];
    //Declaring Post Varible for User Registration
    var action = GLOBAL + "register/registerUser";

    //Declare all variables and prepare them for posting...
    var fName = $('#fName').val().trim();;
    var lname = $('#lname').val().trim();;
    var sLocation = $('#sLocation').val();
    var sUnit = $('#sUnit').val();
    var semailAddress = $('#semailAddress').val();
    var password = $('#password').val();
    var confPassword = $('#confPassword').val();
    //End of variable declaration
    var newsemailAddress = semailAddress.split('@').slice(1);
    
    
    //Check if post fields is not empty
    if (fName == "" || lname == "" || sLocation == "" || sUnit == "" || semailAddress == "" || password == "" || confPassword == "") {
       $('#reg_error').html('Please make sure all fields are filled').addClass('errorRed');
    }else 
        
    if ($.inArray(newsemailAddress[0], allowedDomains) === -1) {
     $('#reg_error').html('Only emails with @c-ileasing.com is allowed to register').addClass('errorRed');
    }else {
        $('#reg_error').html('Registering User, Please wait...').addClass('errorGreen');
        $.post(action, $('#mainRegFom').serialize(), function (data) {
            if (data) {
                $('#reg_error').html(data.msg).addClass('errorYellow');
                
                $('#mainbuttonaccount').hide();
                $('#username').val('');
                $('#email').val('');
                $('#cpassword').val('');
                $('#upassword').val('');
            }
      
        });
        
    }
        
});


///////////////////////////////////////////////USER LOGIN AND AUTHENTICATION //////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$('#btnloginauthenticate').click(function (e) {
    e.preventDefault();
    // Prepare javascript variable for posting
    var email = $('#email').val().trim();
    var pass = $('#password').val().trim();
   
       
    if (email == "" || pass == "") {
        $('#ci_error').html("Please make sure all fields are filled").addClass('errorRed');
    } else {
        $('#ci_error').html("authenticating process, please wait...").addClass('errorRed');
        $.ajax({
            type: "POST",
            url: GLOBAL + "login/authenticating",
            data: {
                loginEmail: email,
                loginPass: pass,
                //remember: $('#' + landingPage.config.loginRememberMeId).prop("checked")
            },
            dataType: "json",
            success: loginSuccess,
            error: loginFailure
        });


    }
});

function loginSuccess(returnedData, status) {
    if (typeof returnedData !== 'object' || typeof returnedData.status !== 'number') {
        console.log("Unexpected server response: Status - " + status + " returnedData - " + JSON.stringify(returnedData));
        return;
    }
    
    if(returnedData.status === 5 && returnedData.accessLevel === "2"){
        $('#email').val('');
        $('#password').val('');
        //location.assign(GLOBAL + 'userexpense');
        location.assign(GLOBAL + 'userexpense/generalreportssearch/3');
        $('#ci_error').html('Authenticated, redirecting....').addClass('errorYellow');
         $('#btnloginauthenticate').hide();
    }else if(returnedData.status === 5 && returnedData.accessLevel == "3" || returnedData.accessLevel == "5" || returnedData.accessLevel == "6"){
        $('#email').val('');
        $('#password').val('');
        location.assign(GLOBAL + 'userexpense/generalreportssearch/3');
        $('#ci_error').html('Authenticated, redirecting....').addClass('errorYellow');
         $('#btnloginauthenticate').hide();
    }else if(returnedData.accessLevel == "7"){
        $('#email').val('');
        $('#password').val('');
        location.assign(GLOBAL + 'accounts/settings');
        $('#ci_error').html('Authenticated, redirecting....').addClass('errorYellow'); 
         $('#btnloginauthenticate').hide();
    }else if(returnedData.status === 5 && returnedData.accessLevel == "1" || returnedData.accessLevel == "4" || returnedData.accessLevel == "8"){
        $('#email').val('');
        $('#password').val('');
        location.assign(GLOBAL + 'home');
        $('#ci_error').html('Authenticated, redirecting....').addClass('errorYellow'); 
        $('#btnloginauthenticate').hide();
    }else if(returnedData.status === 3){
        $('#ci_error').html('<font style="color:red">Please enter a correct Email Address</font>'); 
    }else if(returnedData.status === 2){
        $('#ci_error').html('<font style="color:red">Incorrect log in details</font>'); 
    }else if(returnedData.status === 9){
        $('#ci_error').html('<font style="color:red">Your Account has been locked and needs verification due to several wrong attempt to login</font>'); 
        $('#btnloginauthenticate').hide();
        //$('#forgotpassme').hide();
        $('#forgotpassme').html('<span class="form-notify help-block"><span class="icon ti-lock"></span> Verify Account? <a href="login/verifycode/'+ returnedData.dEmail +'" id="forgot" style="text-align: right; color:grey">Click here</a></span>');
    }else if(returnedData.status === 8){
         $('#email').val('');
        $('#password').val('');
         $('#btnloginauthenticate').hide();
         $('#ci_error').html('Incomplete Profile, Redirecting please wait....').addClass('errorYellow'); 
        location.assign(GLOBAL + 'phoneNumber/updaterecord');
    }else{
        $('#ci_error').html('<font style="color:red">Incorrect login Credentials</font>');  
    }

/*
    switch (returnedData.status) {
        case 5:
            $('#email').val('');
            $('#password').val('');
            location.assign(GLOBAL + 'home');
            $('#ci_error').html('Authenticated, redirecting....').addClass('errorYellow');
            break;
        
        case 3:
            $('#ci_error').html('<font style="color:red">Please enter a correct Email Address</font>');
            break;

        case 2:
        default:
            $('#ci_error').html('<font style="color:red">Incorrect log in details</font>');
            break;
    } */

}

function loginFailure(request, status, errorMsg) {
    $('#ci_error').html('<font style="color:red">Login temporarily failed, please try again or Check your Internet</font>');
    console.log("Error: request - " + JSON.stringify(request) + " | status "
            + status + " | errorMsg " + errorMsg);
}

////////////////////////////////////////////END OF USER LOGIN / AUTHENTICATION ////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////