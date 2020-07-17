(function ($) {

    /*
     // get the hash
     var csrf_test_name = $("input[name=csrf_test_name]").val();
     
     // send request with hash
     $.ajax({
     type: "POST",
     url: url,
     data: { 'csrf_test_name' : csrf_test_name,'name' : 'arjun'  },
     success: success,
     dataType: dataType
     });
     */

    $('#Loginmein').click(function () {

        var sEmail = $('#sEmail').val().trim();
        var mPassword = $('#mPassword').val().trim();
        //var loginCountry = $('#loginCountry').val().trim();
        var csrf_test_name = $("input[name=csrf_test_name]").val();
        if (!sEmail.length) {
            $('#msgError').html("Email Required").addClass('alert alert-danger');
            return;
        }
        if (!/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(sEmail)) {
            $('#msgError').html('<font style="color:red">Email is invalid</font>');
            return;
        }
        if (!mPassword.length) {
            $('#msgError').html("Password Required").addClass('alert alert-danger');
            return;
        }

       /* if (!loginCountry.length) {
            $('#msgError').html("Select Your Country").addClass('alert alert-danger');
            return;
        } */

        $('#msgError').html("Please wait.....").addClass('alert alert-info');
        $.ajax({
            type: "POST",
            url: GLOBALS.appRoot + "validator/login",
            data: {
                loginEmail: sEmail,
                password: mPassword,
                login: 1,
                csrf_test_name: csrf_test_name
            },
            dataType: "JSON",
            success: loginSuccess,
            error: loginFailure
        });
    });
     
    
    function loginSuccess(returnedData, status) {
        if (typeof returnedData !== 'object' || typeof returnedData.status !== 'number') {
            console.log("Unexpected server response: Status - " + status + " returnedData - " + JSON.stringify(returnedData));
            return;
        }

        switch (returnedData.status) {
            case 1:
                $('#sEmail').val('');
                $('#mPassword').val('');
                //$('#loginCountry').val('');
                $('#msgError').html('<font style="color:green">Authenticated, redirecting...</font>');
                location.assign(GLOBALS.appRoot + 'dashboard/index');
                break;
             case 2:
                $('#msgError').html('<font style="color:blue">Invalid Credentials, Please try again</font>');
                break;
             case 3:
                $('#msgError').html('<font style="color:red">Invalid Email</font>');
                break;
             case 5:
                $('#msgError').html('<font style="color:red">Login With Google (Thats What you used during Registration)</font>');
                break;
            case 6:
                $('#msgError').html('<font style="color:black">Login With Facebook</font>');
                break;
            case 0:
            default:
                $('#msgError').html('<font style="color:red">Incorrect log in details</font>');
                break;
        }

    }
    function loginFailure(request, status, errorMsg) {
        $('#msgError').html('<font style="color:red">Login temporarily failed, please try again</font>');
        console.log("Error: request - " + JSON.stringify(request) + " | status "
                + status + " | errorMsg " + errorMsg);
    }


})(jQuery);
