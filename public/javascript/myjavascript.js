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



 $('.fadein img:gt(0)').hide();
    setInterval(function(){
      $('.fadein :first-child').fadeOut()
         .next('img').fadeIn()
         .end().appendTo('.fadein');},
      3000);

    $('#myCountryRes').click(function () {
        // $(this).find('option:selected').attr("name");
        /* $('[name=options] option').filter(function() {
         return ($(this).text() == 'Blue'); //To select Blue
         }).prop('selected', true);
         */

        var myCount = $('select[name=country3]').val().trim();
        if (myCount == "") {
            $('#oneError').html("Please select country").addClass('errorRed');
        } else {
            setTimeout(function () {
                window.top.location = GLOBALS.appRoot + "home/residentCountry/" + myCount
            }, 100);
        }
    });


    $('#register_now').click(function () {
        let action = GLOBALS.appRoot + "register/processregisteration/";
        var dCountry = $('select[name=country_register]').val().trim();
        var sEmail = $('#sEmail').val().trim();
        var mPassword = $('#mPassword').val().trim();
        var cPassword = $('#cPassword').val().trim();
        var referaldetails = $('#referaldetails').val().trim();
        var terms = $('#terms').val().trim();
        var csrf_test_name = $("input[name=csrf_test_name]").val().trim();

        if (dCountry == "") {
            $('#errorAlert').html("Please select country").addClass('alert alert-danger');
        } else if (sEmail == "") {
            $('#errorAlert').html("Please enter an Email Address").addClass('alert alert-danger');
        } else if (mPassword !== cPassword) {
            $('#errorAlert').html("Password does not match").addClass('alert alert-danger');
        } else if (!$('#terms').is(':checked')) {
            $('#errorAlert').html("You must agree to term and condition to proceed").addClass('alert alert-danger');
        } else {
            $('#register_now').attr('disabled', true);
            $('#loadme').html('<img src="https://dginvestmentsltd.com/absgroup/public/images/loadme.gif"');
            $.post(action, {referaldetails: referaldetails, dCountry: dCountry, sEmail: sEmail, cPassword: cPassword, mPassword: mPassword, terms: terms, csrf_test_name: csrf_test_name}, function (data) {
                //var mess = JSON.parse(data.msg).;
                if (data.status == 1) {
                    $('#errorAlert').html(data.msg).addClass("alert alert-success");
                    setTimeout(function () {
                        window.top.location = GLOBALS.appRoot + "register/cont/" + data.rand
                    }, 100);
                } else if (data.status == 0) {
                    $('#errorAlert').html(data.msg).addClass("alert alert-warning");
                    $('register_now').attr('disabled', false);
                }
            }, "json")
                    .fail(function () {
                        $('#errorAlert').html("Error Loading Data, Please try again").addClass("alert alert-danger");
                        $('#errorAlert').show();
                        //$('register_now').attr('disabled', false);
                        $('#loadme').hide();
                    });
        }

    });



    $('#regContinue').click(function () {
        var days = $('#days').val().trim();
        var months = $('#months').val().trim();
        var years = $('#years').val().trim();
        var firstname = $('#firstname').val().trim();
        var middlename = $('#middlename').val().trim();
        var lastname = $('#lastname').val().trim();
        var phoneCountry = $('#phoneCountry').val().trim();
        var mPhone = $('#mPhone').val().trim();
        var pCode = $('#pCode').val().trim();
        var sAddress = $('#sAddress').val().trim();
        var sCity = $('#sCity').val().trim();
        var csrf_test_name = $("input[name=csrf_test_name]").val().trim();
        var randID = $('#randID').val().trim();
        var uniqueEmail = $('#uniqueEmail').val().trim();
        var countryCurrency = $('#countryCurrency').val().trim();
        var dataString = new FormData(document.getElementById('continueReg')); //postArticles

        if (firstname == "" || lastname == "") {
            $('.mainError').html("Firstname and Lastname cannot be empty").addClass('alert alert-danger');
        } else if (days == "" || months == "" || years == "") {
            $('.mainError').html("Date of Birth Cannot be Empty").addClass('alert alert-danger');
        } else if (phoneCountry == "" || mPhone == "") {
            $('.mainError').html("Phone Country Code and Phone Number cannot be Empty").addClass('alert alert-danger');
        } else if (sAddress == "" || sCity == "") {
            $('.mainError').html("Please enter address and city").addClass('alert alert-danger');
        } else if (uniqueEmail == "" || randID == "") {
            $('.mainError').html("Important Variable to render this page is missing. Please try again").addClass('alert alert-danger');
        } else {
            $('.mainError').html("Processing request, please wait").addClass('alert alert-warning');
            $.ajax({
                type: "POST",
                url: GLOBALS.appRoot + "register/continuereqistration",
                data: dataString,
                contentType: false,
                processData: false,
                cache: false,
                dataType: 'JSON',
                success: function (data) {
                    if (data.status == 0) {
                        $('.mainError').html(data.msg).addClass('alert alert-danger');
                    } else if (data.status == 1) {
                        $('.mainError').html(data.msg).addClass('alert alert-success');
                        location.assign(GLOBALS.appRoot + 'dashboard');
                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    $('#showError').html('Error Processing Request, please try again or check your internet...').addClass('alert alert-danger');
                    console.log('An Ajax error was thrown.');
                    console.log(XMLHttpRequest);
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            });
        }


    });




    $('#addCountry').click(function () {
        var countryName = $('#countryName').val().trim();
        var countryCode = $('#countryCode').val().trim();
        var csrf_test_name = $("input[name=csrf_test_name]").val();
        var action = GLOBALS.appRoot + "dashboard/addCountryxxx";

        if (countryName == "" || countryCode == "") {
            $('#errorMsg').html("All Fields Required").addClass("errorRed");
        } else {
            $('#errorMsg').html("Processing Please wait").addClass("errorGreen");
            $('#addCountry').attr("disabled", "disabled");
            $.post(action, {csrf_test_name: csrf_test_name, countryName: countryName, countryCode: countryCode}, function (data) {
                if (data.status == 1) {
                    $('#errorMsg').html(data.msg).addClass('errorGreen');
                    setTimeout(function () {
                        window.top.location = GLOBALS.appRoot + "dashboard"
                    }, 1000);
                    $('#countryName').val('');
                    $('#countryCode').val('');
                } else if (data.status == 0) {
                    $('#errorMsg').html(data.msg).addClass('errorRed');
                }

            });
        }

    });





    $('#addBank').click(function () {

        var addCountrynow = $('#addCountrynow').val().trim();
        var bankName = $('#bankName').val().trim();
         var actNumber = $('#actNumber').val().trim();
         var actName = $('#actName').val().trim();
        var addAddress = $('#addAddress').val().trim();
        var csrf_test_name = $("input[name=csrf_test_name]").val();
        var action = GLOBALS.appRoot + "dashboard/add_Bakn092kjdsj_";

        if (addCountrynow == "" || bankName == "" || actName =="" || actNumber == "" || addAddress == "") {
            $('#errorMsg').html("All Fields Required").addClass("errorRed");
        } else {
            $('#errorMsg').html("Processing Please wait").addClass("errorGreen");
            $('#addCountry').attr("disabled", "disabled");
            $.post(action, {actName: actName, actNumber: actNumber, csrf_test_name: csrf_test_name, addCountrynow: addCountrynow, bankName: bankName, addAddress: addAddress}, function (data) {
                if (data.status == 1) {
                    $('#errorMsg').html(data.msg).addClass('errorGreen');
                    setTimeout(function () {
                        window.top.location = GLOBALS.appRoot + "dashboard"
                    }, 1000);
                    $('#addCountry').val('');
                    $('#bankName').val('');
                    $('#addAddress').val('');
                } else if (data.status == 0) {
                    $('#errorMsg').html(data.msg).addClass('errorRed');
                }

            });
        }
    });



    $('#country').on('change', function () {
        var countryID = $(this).val().trim();
         var csrf_test_name = $("input[name=csrf_test_name]").val();
        if (countryID) {
            $.ajax({
                type: 'POST',
                url: GLOBALS.appRoot + "dashboard/getBanksonselect",
                //url: 'ajaxData.php'
                data: {country_id: countryID, csrf_test_name: csrf_test_name},
                //data: 'country_id=' + countryID,
                success: function (data) {
                    if(data.status == 1){
                       $('#dBank').html(data.msg);
                    }else if(data.status == 0){
                        $('#dBank').html(data.msg);
                    }

                }
            });
        } else {
            $('#dBank').html('<option value="">Select country first</option>');
        }
    });





$('#addBeneficiary').click(function () {

    let country = $('#country').val().trim();
    let payoutMethod = $('#payoutMethod').val().trim();
    let countryCurrency = $('#countryCurrency').val().trim();
    let fName = $('#fName').val().trim();
    let Lname = $('#Lname').val().trim();
    let bEmail = $('#bEmail').val().trim();
    let mPhone = $('#mPhone').val().trim();
    let mmPhone = $('#mmPhone').val().trim();
    let dBank = $('#dBank').val().trim();
    let actNumber = $('#actNumber').val().trim();
    let acctType = $('#acctType').val().trim();
    var csrf_test_name = $("input[name=csrf_test_name]").val();
    var action = GLOBALS.appRoot + "dashboard/addBeneficary";

    if (country == "" || payoutMethod == "" || countryCurrency == "" || fName == "" || Lname == "" || mPhone == "" || dBank == "" || acctType == "") {
        $('#mCfishError').html("All Fields Required").addClass("errorRed");
    } else {
        //$('#mCfishError').html("Processing Request, Please Wait....").addClass("errorRed");
        $('#mCfishError').html("<img src='https://dginvestmentsltd.com/absgroup/public/images/loadme.gif' style='width:200px'/>");
        $('#addBenButton').hide();
        $.post(action, {csrf_test_name: csrf_test_name, country: country, payoutMethod: payoutMethod, countryCurrency: countryCurrency,
            fName: fName, Lname: Lname, bEmail: bEmail, mPhone: mPhone, mmPhone: mmPhone,
            dBank: dBank, acctType: acctType, actNumber: actNumber}, function (data) {
            if (data.status == 2) {
                $('#mCfishError').html(data.msg).addClass('errorGreen');
                setTimeout(function () {
                        window.top.location = GLOBALS.appRoot + "dashboard"
                    }, 1000);
                $('#fName').val('');
                $('#Lname').val('');
                $('#country').val('');
                $('#payoutMethod').val('');
            } else if (data.status == 0) {
                $('#mCfishError').html(data.msg).addClass('errorRed');
            } else if (data.status == 1) {
                $('#mCfishError').html(data.msg).addClass('errorRed');
            }else if (data.status == 3) {
                $('#mCfishError').html(data.msg).addClass('errorRed');

            }

        });
    }
});






$('#addExchangeNow').click(function () {
    var countryA = $('#countryA').val().trim();
    var countryB = $('#countryB').val().trim();
    var currencyA = $('#currencyA').val().trim();
    var currencyB = $('#currencyB').val().trim();
    var exchangeRate = $('#exchangeRate').val().trim();
    var csrValue = $('#csrValue').val();
    var fee = $('#fee').val().trim();
    var csrf_test_name = $("input[name=csrf_test_name]").val();
    var action = GLOBALS.appRoot + "dashboard/changemyexchangeRate";

     if (countryA == "" || countryB == "" || currencyA == "" || currencyB == "" || exchangeRate == "" || fee =="") {
            $('#errorMsg').html("All Fields Required").addClass("errorRed");
      }else if(csrValue ==""){
          $('#errorMsg').html("Important Variable to process this page is missing. Contact Admin").addClass("errorRed");
    }else {
            $('#errorMsg').html("Processing Please wait").addClass("errorGreen");
            $('#addCountry').attr("disabled", "disabled");
            $.post(action, {csrf_test_name: csrf_test_name, countryA: countryA, countryB: countryB,
                currencyA: currencyA, currencyB: currencyB, exchangeRate: exchangeRate, csrValue: csrValue, fee: fee}, function (data) {
                if (data.status == 1) {
                    $('#errorMsg').html(data.msg).addClass('errorGreen');
                    setTimeout(function () {
                        window.top.location = GLOBALS.appRoot + "dashboard/mL_ex8ULxEXCHANGE_mdn000Op/" +csrValue
                    }, 1000);
                    $('#countryA').val('');
                    $('#countryB').val('');
                    $('#exchangeRate').val('');
                    $('#currencyA').val('');
                    $('#currencyB').val('');
                } else if (data.status == 0) {
                    $('#errorMsg').html(data.msg).addClass('errorRed');
                }

            });
        }


});


$('#CheckPriceNow').click(function () {
    var countryA = $('#countryA').val().trim();
    var countryB = $('#countryB').val().trim();
    var dAmount = $('#dAmount').val().trim();
    var csrf_test_name = $("input[name=csrf_test_name]").val();
    var action = GLOBALS.appRoot + "exchange/checkExchangePrice";

    if(countryA == "" || countryB ==""){
        $('#priceError').html("<div class='alert alert-danger'>Please Select Country For Exchange</div>");
    }else if(dAmount == ""){
         $('#priceError').html("<div class='alert alert-warning'>Please Add Amount</div>");
    }else{

         $('#errorMsg').html("Processing Please wait").addClass("errorGreen");
            $('#addCountry').attr("disabled", "disabled");
            $.post(action, {csrf_test_name: csrf_test_name, countryA: countryA, countryB: countryB, dAmount: dAmount}, function (data) {
                if (data.status == 1) {
                    $('#priceError').html(data.msg);
                    //$('#countryA').val('');
                    //$('#countryB').val('');
                    //$('#dAmount').val('');
                } else if (data.status == 0) {
                    $('#priceError').html(data.msg);
                }else if (data.status == 2) {
                    $('#priceError').html(data.msg);
                }

            });
    }
});



$('.checkpriceInside').click(function () {
    var FromCountry = $('#FromCountry').val().trim();
    var ToCountry = $('#ToCountry').val().trim();
   // var method = $('#method').val().trim();
    var amount = $('#amount').val().trim();
    var csrf_test_name = $("input[name=csrf_test_name]").val();
    var action = GLOBALS.appRoot + "exchange/dasboardexchange";

    if(FromCountry == "" || FromCountry ==""){
        $('#priceError').html("<div class='alert alert-danger'>All Fields are compulsory</div>");
    }else if(amount == ""){
         $('#priceError').html("<div class='alert alert-warning'>Please Add Amount</div>");
    }else{

         $('#priceError').html("Processing Please wait").addClass("errorGreen");
            //$('.checkpriceInside').attr("disabled", "disabled");
            //$('.checkpriceInside').hide();
            $.post(action, {csrf_test_name: csrf_test_name, FromCountry: FromCountry, ToCountry: ToCountry, amount: amount }, function (data) {
                if (data.status == 1) {
                    $('#priceError').html(data.msg);
                } else if (data.status == 0) {
                    $('#priceError').html(data.msg);
                }else if (data.status == 2) {
                    $('#priceError').html(data.msg);
                }

            });
    }
});



   $('.mybeneficial').click(function(e){
	 var dataid = $(this).attr('data-id');

         if(dataid == ""){
             alert("Important Variable to render this page is missing, please refresh");
         }else{

             $.ajax({
                url: GLOBALS.appRoot + "dashboard/getallmybeneficiary/"  + dataid,
                type: "GET",
                dataType: "JSON"
                , success: function (data) {

                    if(typeof data == "object" && data.ci){
                        $('#putoption').html('loading beneficiaries, please wait....');
                        var changeStatus  = '<small class="category">&nbsp;</small>';
                        changeStatus += '<form id="getBeneficiarydetails" name="getBeneficiarydetails" action="" onSubmit="return false;">';
                        changeStatus += '<h5>SELECT BENEFICIARY</h5>';
                        changeStatus += '<span id="insurerror"><select name="getbenDetails" id="getbenDetails" class="form-control"> <br/>';
                       changeStatus += '<option value="">Select</option>';
                        for (var idx = 0; idx < data.ci.length; ++idx) {
                            changeStatus += '<option value="'+ data.ci[idx].mdhash +'">'+ data.ci[idx].benFName +'  '+ data.ci[idx].benLName +'</option>';

                        }
                       changeStatus += '</select><br/>';
                       changeStatus += '<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />';
                       changeStatus  += '<button id="processreminder" type="submit" onClick="getmybenXficay23()" class="btn btn-danger btn-fill btn-sm">PROCEED</button>';
                       changeStatus += '</form><br/>';
                        $('#putoption').html(changeStatus);
                  }else{
                     $('#putoption').html(data.msg);
                  }


                    }, error: function (data) {
                    $('#putoption').html("<br/>Error Loading beneficiary,Please check your internet and try again....");
                     $('#putoption').addClass("errorRed");

                 }
              });
          }
    });



$('#SendFile').click(function(e){
         var dataString = new FormData(document.getElementById('fileUploadform')); //postArticles
         var uploadFile = $("#uploadFile").val().trim();

         if(uploadFile == ""){
             $('.validocument').html("Please Select File To Upload")
             $('.validocument').removeClass('alert alert-info');
         }else{
              $('.validocument').html("Processing Request, Please Wait..")
              $.ajax({
                type: "POST",
                // OLD URL - url: GLOBALS.appRoot + "dprocess/prequestorder",
                url: GLOBALS.appRoot + "dashboard/uploadvalidationdocuments",
                data: dataString,
                contentType: false,
                processData: false,
                cache: false,
                dataType: 'JSON',

                success: function (data) {
                    $('.validocument').html('uploading File to our Database, please wait...');
                    if (data.status == 0) {
                        $('.validocument').html(JSON.stringify(data.msg));
                    }else{
                        $('.validocument').html(JSON.stringify(data.msg)).addClass('errorRed');
                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    $('.validocument').html('Error Processing Request, please try again or check your internet...').addClass('alert alert-danger');
                    console.log('An Ajax error was thrown.');
                    console.log(XMLHttpRequest);
                    console.log(textStatus);
                    console.log(errorThrown);
                }

            });

         }

     });






$('#addCurrency').click(function () {

        var country_register = $('#country_register').val().trim();
        var paypalCode = $('#paypalCode').val().trim();
        var paystackCode = $('#paystackCode').val().trim();
        var csrf_test_name = $("input[name=csrf_test_name]").val();
        var action = GLOBALS.appRoot + "dashboard/addmyCurrency_";

        if (country_register == "") {
            $('#errorMsg').html("Please Select a Country").addClass("errorRed");
        } else {
            $('#errorMsg').html("Processing Please wait").addClass("errorGreen");
            $.post(action, {csrf_test_name: csrf_test_name, country_register: country_register, paypalCode: paypalCode, paystackCode: paystackCode}, function (data) {
                if (data.status == 1) {
                    $('#errorMsg').html(data.msg).addClass('errorGreen');
                    setTimeout(function () {
                        window.top.location = GLOBALS.appRoot + "dashboard/addCurriencies"
                    }, 1000);
                    $('#paystackCode').val('');
                    $('#paypalCode').val('');

                } else if (data.status == 0) {
                    $('#errorMsg').html(data.msg).addClass('errorRed');
                }

            });
        }
    });


////////////////////////////////////////////EDITING BENEFICIARY //////////////////////////////////////////////////////


$('#editBeneficiary').click(function () {

    let country = $('#country').val().trim();
    let payoutMethod = $('#payoutMethod').val().trim();
    let countryCurrency = $('#countryCurrency').val().trim();
    let fName = $('#fName').val().trim();
    let Lname = $('#Lname').val().trim();
    let bEmail = $('#bEmail').val().trim();
   
    let mmPhone = $('#mmPhone').val().trim();
    let dBank = $('#dBank').val().trim();
    let actNumber = $('#actNumber').val().trim();
    let acctType = $('#acctType').val().trim();
    let benID = $('#benID').val();
    var csrf_test_name = $("input[name=csrf_test_name]").val();
    var action = GLOBALS.appRoot + "benficial/processeditbeneficial";

    if (country == "" || payoutMethod == "" || countryCurrency == "" || fName == "" || Lname == ""  || acctType == "") {
        $('#mCfishError').html("All Fields Required").addClass("errorRed");
    } else if(benID == ""){
        $('#mCfishError').html("Required Parameter To Process This Page Is Missing").addClass("errorRed"); 
    }else {
        //$('#mCfishError').html("Processing Request, Please Wait....").addClass("errorRed");
        $('#mCfishError').html("<img src='https://dginvestmentsltd.com/absgroup/public/images/loadme.gif' style='width:200px'/>");
        $('#editBeneficiary').hide();
        $.post(action, {csrf_test_name: csrf_test_name, country: country, payoutMethod: payoutMethod, countryCurrency: countryCurrency,
            fName: fName, Lname: Lname, bEmail: bEmail, mmPhone: mmPhone,
            dBank: dBank, acctType: acctType, actNumber: actNumber, benID: benID}, function (data) {
            if (data.status == 2) {
                $('#mCfishError').html(data.msg).addClass('errorGreen');
                setTimeout(function () {
                        window.top.location = GLOBALS.appRoot + "dashboard"
                    }, 1000);
                $('#fName').val('');
                $('#Lname').val('');
                $('#country').val('');
                $('#payoutMethod').val('');
            } else if (data.status == 0) {
                $('#mCfishError').html(data.msg).addClass('errorRed');
                 $('#editBeneficiary').show();
            } else if (data.status == 1) {
                $('#mCfishError').html(data.msg).addClass('errorRed');
                  $('#editBeneficiary').show();
            }else if (data.status == 3) {
                $('#mCfishError').html(data.msg).addClass('errorRed');
                  $('#editBeneficiary').show();

            }

        });
    }
});

//////////////////////////////////////////END OF EDITING BENEFICIARY ///////////////////////////////////////////////

$('.confirmTransaction').click(function () {
    var dataid = $(this).attr('data-id').trim();
    var csrf_test_name = $("input[name=csrf_test_name]").val();
     var action = GLOBALS.appRoot + "dashboard/confirmtrasactionXD";
    if(dataid == ""){
        $('#myError').html("Required Parameter To Process This Page Is Missing").addClass("errorRed"); 
    }else{
       $('#myError').html("Processing Please Wait...").addClass("errorGreen"); 
       $.post(action, {csrf_test_name: csrf_test_name, dataid: dataid}, function (data) {
                if (data.status == 1) {
                    $('#myError').html(data.msg).addClass('errorGreen');
                    setTimeout(function () {
                        window.top.location = GLOBALS.appRoot + "dashboard/xxTransavctview12763_0"
                    }, 1000);
           
                } else if (data.status == 0) {
                    $('#myError').html(data.msg).addClass('errorRed');
                }
        });
    }
});



$('#resetPassword').click(function () {
   var sEmail = $('#sEmail').val().trim();
    var csrf_test_name = $("input[name=csrf_test_name]").val();
     var action = GLOBALS.appRoot + "login/resetpasswordX";
    if(sEmail == ""){
        $('#msgError').html("Please Enter an Email Address").addClass("errorRed"); 
    }else{
       $('#msgError').html("Processing Please Wait...").addClass("errorGreen"); 
       $.post(action, {csrf_test_name: csrf_test_name, sEmail: sEmail}, function (data) {
                if (data.status == 0) {
                    $('#msgError').html(data.msg).addClass('errorGreen');
                } else if (data.status == 1) {
                    $('#msgError').html(data.msg).addClass('errorRed');
                }else if (data.status == 2) {
                    $('#msgError').html(data.msg).addClass('errorRed');
                }else if (data.status == 3) {
                    $('#msgError').html(data.msg).addClass('errorRed');
                    $('.hideForm').html();
                }
        });
    }
});


$('#paypalbtn').click(function () {
    $('#paypalbtn').hide();
});


$('#changemypasswordnow').click(function () {
   var nPassword = $('#nPassword').val();
   var cPassword = $('#cPassword').val();
   var email = $('#email').val();
   var mID = $('#mID').val();
   var random = $('#random').val();
   var passReset = $('#passReset').val();
    var csrf_test_name = $("input[name=csrf_test_name]").val();
     var action = GLOBALS.appRoot + "login/changepasswordX";
    if(nPassword == "" || cPassword == ""){
        $('#msgError').html("Please Enter an Email Address").addClass("errorRed"); 
    }else{
       $('#msgError').html("Processing Please Wait...").addClass("errorGreen"); 
       $.post(action, {csrf_test_name: csrf_test_name, nPassword: nPassword, cPassword: cPassword, email: email, mID: mID, 
       random: random, passReset: passReset}, function (data) {
                if (data.status == 0) {
                    $('#msgError').html(data.msg).addClass('errorGreen');
                } else if (data.status == 1) {
                    $('#msgError').html(data.msg).addClass('errorRed');
                }else if (data.status == 2) {
                    $('#msgError').html(data.msg).addClass('errorRed');
                }else if (data.status == 3) {
                    $('#msgError').html(data.msg).addClass('errorRed');
                    $('.hideForm').hide();
                }
        });
    }
});



$('.declineTransaction').click(function () {
    var dataid = $(this).attr('data-id');
    var csrf_test_name = $("input[name=csrf_test_name]").val();
     var action = GLOBALS.appRoot + "dashboard/declineTransactionXD";
    if(dataid == ""){
        $('#myError').html("Required Parameter To Process This Page Is Missing").addClass("errorRed"); 
    }else{
       $('#myError').html("Processing Please Wait...").addClass("errorGreen"); 
       $.post(action, {csrf_test_name: csrf_test_name, dataid: dataid}, function (data) {
                if (data.status == 1) {
                    $('#myError').html(data.msg).addClass('errorGreen');
                    setTimeout(function () {
                        window.top.location = GLOBALS.appRoot + "dashboard/xxTransavctview12763_0"
                    }, 1000);
           
                } else if (data.status == 0) {
                    $('#myError').html(data.msg).addClass('errorRed');
                }
        });
    }
});



})(jQuery);

function getmybenXficay23(){
     var benhash = $('#getbenDetails').val().trim();
      var csrf_test_name = $("input[name=csrf_test_name]").val();
     var action = GLOBALS.appRoot + "dashboard/checkifbenexist";

   if(benhash == ""){
        $('#insurerror').html("Please select a beneficiary").addClass("errorRed");
   }else{
         $('#insurerror').html("Processing, Please wait...").addClass("errorGreen");
         $.post(action, {benhash: benhash, csrf_test_name: csrf_test_name}, function (data){

             if(data.status == 2){
                 $('#insurerror').html("Authenticating Request, Please wait").addClass('errorGreen')
               setTimeout(function () {
                        window.top.location = GLOBALS.appRoot + "dashboard/sendmoneyXform239fm/" + benhash
                  }, 1000);
             }else if (data.status == 0) {
                  $('#insurerror').html(data.msg).addClass('errorRed');

             }else if (data.status == 1) {
                  $('#insurerror').html(data.msg).addClass('errorRed');

             }

        });
        }
  }


    function payWithPaystack(){
      var dAmount = $('#amount').val();
      var newid = $('#dbid').val();
      var handler = PaystackPop.setup({
        key: 'pk_test_be2605d3d3471e94e1a827e0178c2425010ce08f',
        email: $('#email').val(),
        amount: dAmount,
        ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
        metadata: {
           custom_fields: [
              {
                  display_name: $('#fullName').val(),
                  variable_name: "mobile_number",
                  value: ""
              }
           ]
        },
        callback: function(response){
          setTimeout(function () {
                   
                   window.top.location = GLOBALS.appRoot + "dashboard/paystacksuccess/" + response.reference + "/" + newid
             }, 1000);
          //  alert('success. transaction ref is ' + response.reference);
        },
        onClose: function(){
            alert('window closed');
        }
      });
      handler.openIframe();
    }



$('#mPhone, #dAmount').blur(function () {
   
    var country_register = $('#country_register').val();
    $('#dCountry').html(country_register);
    
    var mPhone = $('#mPhone').val();
    $('#dPhone').html(mPhone);
    
     var dAmount = $('#dAmount').val();
    $('#dmainAmount').html(dAmount);
    
     var myAirtime = $('input[name=airtime]:checked').val();
    $('#dairtime').html(myAirtime);
    
});



 $('#submitBill').click(function () {
        var payoption = $('#payoption').val().trim();
        var disComp = $('#disComp').val().trim();
        var icuNum = $('#icuNum').val().trim();
        var userName = $('#userName').val().trim();
        var eMail = $('#eMail').val().trim();
        var meter = $('#meter').val().trim();
        var phone = $('#phone').val().trim();
        var amt = $('#amt').val().trim();
       
        var csrf_test_name = $("input[name=csrf_test_name]").val();
        var dataString = new FormData(document.getElementById('billForm')); //postArticles
        if(payoption === ""){
            $('#paymsg').html("Please select an option");
        }else{
            
             $.ajax({
                type: "POST",
                url: GLOBALS.appRoot + "topup/paymybillsnow",
                data: dataString,
                contentType: false,
                processData: false,
                cache: false,
                dataType: 'JSON',
                success: function (data) {
                    if (data.status === 0) {
                        $('#paymsg').html(data.msg).addClass('alert-danger');
                    } else if (data.status === 1) {
                        $('#paymsg').html("");
                        $('.myform').html(data.msg);
                    } else if (data.status === 2) {
                        $('#paymsg').html(data.msg);
                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    $('#paymsg').html('Error Processing Request, please try again or check your internet...').addClass('alert alert-danger');
                    console.log('An Ajax error was thrown.');
                    console.log(XMLHttpRequest);
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            });
            
        }
        
 });
 
 
 
$('.confirmAirtime').click(function () {
    var dataid = $(this).attr('data-id').trim();
    var csrf_test_name = $("input[name=csrf_test_name]").val();
     var action = GLOBALS.appRoot + "transaction/passairtime";
    if(dataid == ""){
        $('#myError').html("Required Parameter To Process This Page Is Missing").addClass("errorRed"); 
    }else{
       $('#myError').html("Processing Please Wait...").addClass("errorGreen"); 
       $.post(action, {csrf_test_name: csrf_test_name, dataid: dataid}, function (data) {
                if (data.status == 1) {
                    $('#myError').html(data.msg).addClass('errorGreen');
                    setTimeout(function () {
                        window.top.location = GLOBALS.appRoot + "transaction/allairtime"
                    }, 1000);
           
                } else if (data.status == 0) {
                    $('#myError').html(data.msg).addClass('errorRed');
                }
        });
    }
});


$('.paybillsnownow').click(function () {
    var dataid = $(this).attr('data-id').trim();
    var csrf_test_name = $("input[name=csrf_test_name]").val();
     var action = GLOBALS.appRoot + "transaction/paymybillsnow";
    if(dataid == ""){
        $('#myError').html("Required Parameter To Process This Page Is Missing").addClass("errorRed"); 
    }else{
       $('#myError').html("Processing Please Wait...").addClass("errorGreen"); 
       $.post(action, {csrf_test_name: csrf_test_name, dataid: dataid}, function (data) {
                if (data.status == 1) {
                    $('#myError').html(data.msg).addClass('errorGreen');
                    setTimeout(function () {
                        window.top.location = GLOBALS.appRoot + "transaction/allbills"
                    }, 1000);
           
                } else if (data.status == 0) {
                    $('#myError').html(data.msg).addClass('errorRed');
                }
        });
    }
});


$('.contactusNow').click(function (e) {
         //var hash = Math.floor((Math.random() * 10) + 1);
         var output ="<form enctype=\"multipart-form-data\" name=\"contactForm\" id=\"contactForm\"  onSubmit=\"return false;\">\n\
                    <span id=\"nowerrorprocess\"></span><div style=\"font-size:20; font-weight:bold; text-align:center; color:white; padding:10px\" class=\"newbtncl\">CONTACT US</div><br/><div class=\"row\">\n\
                    <div class=\"col-sm-6\">\n\
                    <label>NAME</label><input required type=\"text\" name=\"yName\" id=\"yName\" class=\"form-control\" />\n\
                    </div>\n\
                    <div class=\"col-sm-6\"><label>EMAIL</label><input required type=\"email\" name=\"yourEmail\"  id=\"yourEmail\" class=\"form-control\" /></div>\n\
                   \n\<div class=\"col-sm-12\"><br/><label>PHONE</label><input type=\"number\" name=\"yourPhone\"  id=\"yourPhone\" class=\"form-control\" /></div>\n\
                  \n\<div class=\"col-sm-12\"><label><br/>MESSAGE</label><textarea required class=\"form-control\" name=\"myMessage\" id=\"myMessage\"></textarea></div>\n\
                    </div><br/>\n\<br/><center>\n\
                    <input type=\"hidden\" name=\"csrf_test_name\" value=\"dea8ce075acc706da2c1fa9fb4f5ac78\">\n\
                    <button onClick=\"processContactFrom()\" class=\"btn btn-sm btn-primary newbtncl\">SEND</button></center></div></form>";
         $('#putoption').html(output);
 });
 
 
 function processContactFrom(){
     var yName = $('#yName').val();
     var yourEmail = $('#yourEmail').val();
     var yourPhone = $('#yourPhone').val();
     var myMessage = $('#myMessage').val();
     var csrf_test_name = $("input[name=csrf_test_name]").val();
     var dataString = new FormData(document.getElementById('contactForm')); //postArticles
     
     if(yName == "" || yourEmail =="" || yourPhone == "" || myMessage == ""){
         $('#eloaddformerror').html("Please make sure all fields are filled");
     }else{
         
          $.ajax({
                type: "POST",
                url: GLOBALS.appRoot + "home/processcontactus",
                data: dataString,
                contentType: false,
                processData: false,
                cache: false,
                dataType: 'JSON',
                success: function (data) {
                    if (data.status === 0) {
                        $('#eloaddformerror').html(data.msg).addClass('alert-danger');
                    }else if(data.status === 1){
                        $('#eloaddformerror').html(data.msg).addClass('alert-success');
                        $('#yName').val('');
                        $('#yourEmail').val('');
                        $('#yourPhone').val('');
                        $('#myMessage').val('');
                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    $('#eloaddformerror').html('Error Processing Request, please try again or check your internet...').addClass('alert alert-danger');
                    console.log('An Ajax error was thrown.');
                    console.log(XMLHttpRequest);
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            });
     }
 }
      
      
      
$('#socialreg').click(function () {
        var days = $('#days').val().trim();
        var months = $('#months').val().trim();
        var years = $('#years').val().trim();
        var country_register = $('#country_register').val().trim();
     
        var phoneCountry = $('#phoneCountry').val().trim();
        var mPhone = $('#mPhone').val().trim();
       
        var sAddress = $('#sAddress').val().trim();
        var sCity = $('#sCity').val().trim();
        var csrf_test_name = $("input[name=csrf_test_name]").val().trim();
        var randID = $('#randID').val().trim();
        var uniqueEmail = $('#uniqueEmail').val().trim();
        var countryCurrency = $('#countryCurrency').val().trim();
        var dataString = new FormData(document.getElementById('continueReg')); //postArticles

        if (country_register == "" || phoneCountry == "" || mPhone == "") {
            $('.mainError').html("Fields marked in * are compulsory").addClass('alert alert-danger');
        } else if (days == "" || months == "" || years == "") {
            $('.mainError').html("Date of Birth Cannot be Empty").addClass('alert alert-danger');
        } else if (phoneCountry == "" || mPhone == "") {
            $('.mainError').html("Phone Country Code and Phone Number cannot be Empty").addClass('alert alert-danger');
        } else if (sAddress == "" || sCity == "") {
            $('.mainError').html("Please enter address and city").addClass('alert alert-danger');
        } else if (uniqueEmail == "" || randID == "") {
            $('.mainError').html("Important Variable to render this page is missing. Please try again").addClass('alert alert-danger');
        } else {
            $('.mainError').html("Processing request, please wait").addClass('alert alert-warning');
            $.ajax({
                type: "POST",
                url: GLOBALS.appRoot + "complete/registerall",
                data: dataString,
                contentType: false,
                processData: false,
                cache: false,
                dataType: 'JSON',
                success: function (data) {
                    if (data.status == 0) {
                        $('.mainError').html(data.msg).addClass('alert alert-danger');
                    } else if (data.status == 1) {
                        $('.mainError').html(data.msg).addClass('alert alert-success');
                        location.assign(GLOBALS.appRoot + 'dashboard');
                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    $('#showError').html('Error Processing Request, please try again or check your internet...').addClass('alert alert-danger');
                    console.log('An Ajax error was thrown.');
                    console.log(XMLHttpRequest);
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            });
        }


    });
    
    
    
    
   $('#trannumtransack').click(function () {
    var csrf_test_name = $("input[name=csrf_test_name]").val();
     var trackingNo = $("#trackingNo").val();
     var action = GLOBALS.appRoot + "home/trackmyid";
    if(trackingNo == ""){
        $('#trackError').html("Please Enter Tracking Number").addClass("errorRed"); 
    }else{
       $('#trackError').html("Tracking Transaction Please Wait...").addClass("errorGreen"); 
       $.post(action, {csrf_test_name: csrf_test_name, trackingNo: trackingNo}, function (data) {
                if (data.status == 1) {
                    $('#trackError').html(data.msg);
                   
                } else if (data.status == 0) {
                    $('#trackError').html(data.msg).addClass('errorRed');
                }else if (data.status == 2) {
                    $('#trackError').html(data.msg).addClass('errorRed');
                }
        });
    }
   });
   
   
   $('.confirmdUpload').click(function () {
    var dataid = $(this).attr('data-id');
    var csrf_test_name = $("input[name=csrf_test_name]").val();
     var action = GLOBALS.appRoot + "transaction/confirmyupload";
    if(dataid == ""){
        $('#myError').html("Required Parameter To Process This Page Is Missing").addClass("errorRed"); 
    }else{
       $('#myError').html("Processing Please Wait...").addClass("errorGreen"); 
       $.post(action, {csrf_test_name: csrf_test_name, dataid: dataid}, function (data) {
                if (data.status == 1) {
                    $('#myError').html(data.msg).addClass('errorGreen');
                    setTimeout(function () {
                        window.top.location = GLOBALS.appRoot + "transaction/confirmupload"
                    }, 1000);
           
                } else if (data.status == 0) {
                    $('#myError').html(data.msg).addClass('errorRed');
                }
        });
    }
});


 $('.declinedUpload').click(function () {
    var dataid = $(this).attr('data-id');
    var csrf_test_name = $("input[name=csrf_test_name]").val();
     var action = GLOBALS.appRoot + "transaction/declineupload";
    if(dataid == ""){
        $('#myError').html("Required Parameter To Process This Page Is Missing").addClass("errorRed"); 
    }else{
       $('#myError').html("Processing Please Wait...").addClass("errorGreen"); 
       $.post(action, {csrf_test_name: csrf_test_name, dataid: dataid}, function (data) {
                if (data.status == 1) {
                    $('#myError').html(data.msg).addClass('errorGreen');
                    setTimeout(function () {
                        window.top.location = GLOBALS.appRoot + "transaction/confirmupload"
                    }, 1000);
           
                } else if (data.status == 0) {
                    $('#myError').html(data.msg).addClass('errorRed');
                }
        });
    }
});