//Beginning of Setup for Location
$('#setLocation').click(function(e){
    var action = GLOBALS.appRoot+"dprocess/mainlocation";
    var dlocation = $('#dlocation').val();
    if(dlocation == ""){
        $('#showError').html("Please make sure all fields are filled").addClass("alert alert-danger");
    }else{
            
           $('#showError').html("Processing Location, Please wait...");  
                $.post(action, {dlocation: dlocation},  function(data){
			if(data.msg){
                        $('#showError').html(data.msg).addClass("alert alert-success");
			$('#dlocation').val('');
                        $('#setLocation').show();
                        setTimeout(function(){window.top.location= GLOBALS.appRoot + "setup/location/"} , 100);
			}
		})
                 .fail(function() {
                    $('#showError').html("Error Loading Data, Please try again").addClass("alert alert-danger");
                    $('#setLocation').show();
                  });
    }
    
});

//BEGINNING OF PAYMENT MODE
$('#paymode').click(function(e){
    var action = GLOBALS.appRoot+"dprocess/dpaymentmode";
    var payment = $('#payment').val();
    if(payment == ""){
        $('#showError').html("Please make sure all fields are filled").addClass("alert alert-danger");
    }else{
            
           $('#showError').html("Processing Payment Setup, Please wait...");  
                $.post(action, {payment: payment},  function(data){
			if(data.msg){
                        $('#showError').html(data.msg).addClass("alert alert-success");
			$('#dlocation').val('');
                        $('#setLocation').show();
                        setTimeout(function(){window.top.location= GLOBALS.appRoot + "setup/paymentmode/"} , 100);
			}
		})
                 .fail(function() {
                    $('#showError').html("Error Loading Data, Please try again").addClass("alert alert-danger");
                    $('#setLocation').show();
                  });
    }
    
});





////////////////////////////////////BEGINNING OF ACCESS MODE ///////////////////////////////////////////////
$('#accesspriviedge').click(function(e){
    var action = GLOBALS.appRoot+"dprocess/daccesspriv";
    var accessmode = $('#accessmode').val();
    if(accessmode == ""){
        $('#showError').html("Please make sure all fields are filled").addClass("alert alert-danger");
    }else{
            
           $('#showError').html("Processing Access Setup, Please wait...");  
                $.post(action, {accessmode: accessmode},  function(data){
			if(data.msg){
                        $('#showError').html(data.msg).addClass("alert alert-success");
			$('#accessmode').val('');
			}
		})
                 .fail(function() {
                    $('#showError').html("Error Loading Data, Please try again").addClass("alert alert-danger");
                    $('#setLocation').show();
                  });
    }
    
});



/////////////////////////////////////////CREATE POST USER //////////////////////////////////////////////////////

$('#postCreateUser').click(function(e){
    var action = GLOBALS.appRoot+"dprocess/newuser";
    var fname = $('#fname').val();
    var lname = $('#lname').val();
    var email = $('#email').val();
    var sAccess = $('#sAccess').val();
    var sLocation = $('#sLocation').val();
    if(email == "" || sAccess == "" || sLocation == "" || fname == ""){
        $('#showError').html("Please make sure all fields are filled").addClass("alert alert-danger");
    }else{
            
           $('#showError').html("Processing User Setup, Please wait...");  
           $('#accesspriviedge').hide();
                $.post(action, $('#createUser').serialize(),  function(data){
			if(data.msg){
                        $('#showError').html(data.msg).addClass("alert alert-success");
			$('#fname').val('');
                        $('#lname').val('');
                        $('#email').val('');
                        $('#sAccess').val('');
                        $('#sLocation').val('');
                        $('#accesspriviedge').show();
			}
		})
                 .fail(function() {
                    $('#showError').html("Error Loading Data, Please try again").addClass("alert alert-danger");
                   $('#accesspriviedge').show();
                  });
    }
    
});



////////////////////////////////////////CATEGORY MODE SETUP////////////////////////////////////////////

//BEGINNING OF PAYMENT MODE
$('#createVendor').click(function(e){
    var action = GLOBALS.appRoot+"dprocess/postcategory";
    var vendorName = $('#vendorName').val();
     var actNo = $('#actNo').val();
    if(vendorName == ""){
        $('#showError').html("Please enter a Vendor Name").addClass("alert alert-danger");
    }else{
            
           $('#showError').html("Processing Vendor Setup, Please wait...");  
           $('#createCategory').hide();
                $.post(action, {vendorName: vendorName, actNo: actNo},  function(data){
			if(data.msg){
                        $('#showError').html(data.msg).addClass("alert alert-success");
			$('#categoryName').val('');
                        $('#createCategory').show();
			}
		})
                 .fail(function() {
                    $('#showError').html("Error Loading Data, Please try again").addClass("alert alert-danger");
                    $('#createCategory').show();
                  });
    }
    
});



//BEGINNING OF PAYMENT MODE
$('#createUnit').click(function(e){
    var action = GLOBALS.appRoot+"dprocess/postunit";
    var unitName = $('#unitName').val();
    if(unitName == ""){
        $('#showError').html("Please make sure all fields are filled").addClass("alert alert-danger");
    }else{
            
           $('#showError').html("Processing Category Setup, Please wait...");  
           $('#createCategory').hide();
                $.post(action, {unitName: unitName},  function(data){
			if(data.msg){
                        $('#showError').html(data.msg).addClass("alert alert-success");
			$('#unitName').val('');
                        $('#createCategory').show();
                        setTimeout(function(){window.top.location= GLOBALS.appRoot + "setup/dunit/"} , 100);
			}
		})
                 .fail(function() {
                    $('#showError').html("Error Loading Data, Please try again").addClass("alert alert-danger");
                    $('#createCategory').show();
                  });
    }
    
});

////////////////////////////////////////////END OF CATEGORY MODE SETUP///////////////////////////////



//////////////////////////////////////CREATE NEW REQUEST ///////////////////////////////////////////


$('#processnewrequest').click(function(e){

        var dateCreated = $('#dateCreated').val();
        var fileUpload = $('#fileUpload').val();
        var descItem = $('#descItem').val();
        var itemCat = $('#itemCat').val();
        var paymentType = $('#paymentType').val();
        var dhod = $('#dhod').val();
        var locationName = $('#locationName').val();
        var dAmount = $('#dAmount').val();
        var dicu = $('#dicu').val();
        var benName = $('#benName').val();
        var benEmail = $('#benEmail').val();
        var dUnit = $('#dUnit').val();
        var dcashier = $('#dcashier').val() != "" ? $('#dcashier').val() : "";
        var daccountant = $('#daccountant').val() != "" ? $('#daccountant').val() : "";
        var dtransfer = $('#dtransfer').val() != "" ? $('#dtransfer').val() : "";
        var dataString = new FormData(document.getElementById('mainrequestform')); //postArticles
        if (dAmount == "" || dateCreated == "" || dUnit == "" || locationName == "" || descItem == "" || itemCat == "" || paymentType == "" || dhod == "" || dicu == "") {
            $('#showError').html("Please make sure all fields are filled").addClass("alert alert-danger");
        } else {
            $('#showError').html("Processing Request, Please wait...").addClass("alert alert-danger");
           
            $('.loaderimg').show();
            $.ajax({
                type: "POST",
                // OLD URL - url: GLOBALS.appRoot + "dprocess/prequestorder",
                url: GLOBALS.appRoot + "newrequest/createnewrequest",
                data: dataString,
                contentType: false,
                processData: false,
                cache: false,
                dataType: 'JSON',

                success: function (data) {
                    $('#showError').html('uploading assets to our Database, please wait...').addClass('alert alert-warning');
                    if (data.status == 0) {
                        $('#showError').html(JSON.stringify(data.msg)).addClass('alert alert-warning');
                    }else if(data.status == 1){
			$('#showError').html(data.msg).addClass('alert alert-success'); 
			$('#dateCreated').val('');   $('#fileUpload').val('');   $('#descItem').val('');
			$('#itemCat').val('');  $('#paymentType').val('');  $('#dhod').val('');
			$('#dicu').val('');  $('#dcashier').val('');  $('#benEmail').val('');
                        $('#benName').val(''); $('#dAmount').val('');
                        setTimeout(function(){window.top.location= GLOBALS.appRoot + "home/"});                        
						
                    }
			 else if(data.status == 2){
		 	$('#showError').html(JSON.stringify(data.msg)).addClass('alert alert-secondary'); 
			 }else if(data.status == 5){
			$('#showError').html(JSON.stringify(data.msg)).addClass('alert alert-primary'); 
                         }else if(data.status == 3){
			$('#showError').html(JSON.stringify(data.msg)).addClass('alert alert-primary'); 
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

///////////////////////////////////////END OF CREATE NEW REQUEST///////////////////////////////////


/////////////////////////////////////////REQUEST APPROVAL ///////////////////////////////////////

//BEGINNING OF PAYMENT MODE
$('#processApproval').click(function(e){
   
   var action = GLOBALS.appRoot+"dprocess/hodhasapproval";
    var acceptrequestID = $('#acceptrequestID').val();
    var dComment = $('#dComment').val();
    var hodEmail = $('#hodEmail').val();
    
   /* if(dComment == ""){
        $('#acceptrequest').html("Please enter a comment").addClass('errorRed');
    }else{ */
    
           $('#acceptrequest').html("Approving Request, Please wait...");  
                $.post(action, {acceptrequestID: acceptrequestID, dComment: dComment, hodEmail: hodEmail},  function(data){
			if(data.msg){
                        $('#acceptrequest').html(data.msg).addClass('errorGreen');
			setTimeout(function(){window.top.location= GLOBALS.appRoot + "home/myapproval/"} , 100);
			}
		})
                 .fail(function() {
                    $('#acceptrequest').html("Error Loading Data, Please try again");
                  });
  //  }
    
});

//BEGINNING OF PAYMENT MODE
$('#dorejection').click(function(e){
   $('.forcommentdisplay').show();
   $('#processRejection').show();
   $('#processApproval').hide();
   $('#dorejection').hide();
   
});

//BEGINNING OF PAYMENT MODE
$('#processRejection').click(function(e){
   //$('.forcommentdisplay').show();
   var action = GLOBALS.appRoot+"dprocess/hodrejection";
    var rejectrequestID = $('#rejectrequestID').val();
    var dComment = $('#dComment').val();
    var hodEmail = $('#hodEmail').val();
    
    if(dComment == ""){
        $('#rejectrequest').html("Please enter a comment").addClass('errorRed');
    }else{  
           $('#rejectrequest').html("Approving Request, Please wait...");  
                $.post(action, {rejectrequestID: rejectrequestID, dComment: dComment, hodEmail: hodEmail},  function(data){
			if(data.msg){
                        $('#rejectrequest').html(data.msg).addClass('errorGreen');
			setTimeout(function(){window.top.location= GLOBALS.appRoot + "home/myapproval/"} , 100);
			}
		})
                 .fail(function() {
                    $('#rejectrequest').html("Error Loading Data, Please try again");
                  });
    }
    
});
/////////////////////////////////////END OF REQUEST APPROVAL /////////////////////////////////////


////////////////////////////////////////ICU APPROVAL ///////////////////////////////////////////

//BEGINNING OF PAYMENT MODE
$('#icuprocessApproval').click(function(e){
   
   var action = GLOBALS.appRoot+"dprocess/icuapproval";
   var icuacceptrequestID = $('#icuacceptrequestID').val();
   var groupIDinICU = $('#groupIDinICU').val();
   var mainAmount = $('#mainAmount').val();
   
    if(icuacceptrequestID == "" || groupIDinICU == "" || mainAmount == "" || mainAmount == "0" ){
        $('#icuacceptrequest').html("Important Variable to process this page is missing, Please contact Administrator").addClass('errorRed');
    }else{
            
           $('#icuacceptrequest').html("Approving Request, Please wait...");  
                $.post(action, {icuacceptrequestID: icuacceptrequestID, groupIDinICU: groupIDinICU, mainAmount: mainAmount},  function(data){
			if(data.msg){
                        $('#icuacceptrequest').html(data.msg).addClass('errorGreen');
			setTimeout(function(){window.top.location= GLOBALS.appRoot + "home/myapproval/"} , 100);
			}else if(data.msgError){
                        $('#icuacceptrequest').html(data.msgError).addClass('errorRed');
			}
		})
                 .fail(function() {
                    $('#icuacceptrequest').html("Error Loading Data, Please try again");
                  });
    }
    
});


$('#icudorejection').click(function(e){
  $('.forcommentdisplayforicuonly').show(); 
  $('#icuprocessApproval').hide(); 
  $('#icudorejection').hide(); 
  $('#icurejectApproval').show(); 
});

//BEGINNING OF PAYMENT MODE
$('#icurejectApproval').click(function(e){
   //$('.forcommentdisplayforicuonly').show();
   var action = GLOBALS.appRoot+"dprocess/icurejection";
    var icurejectrequestID = $('#icurejectrequestID').val();
    var groupIDinICU = $('#groupIDinICU').val();
    var mainAmount = $('#mainAmount').val();
    var commentfromicu = $('#commentfromicu').val();
    
    if(icurejectrequestID == "" || commentfromicu == "" || groupIDinICU == "" || mainAmount == "" || mainAmount == "0" ){
        $('#icurejecttrequest').html("Please add a comment").addClass('errorRed');
    }else{
            
           $('#icurejecttrequest').html("Approving Request, Please wait...");  
                $.post(action, {icurejectrequestID: icurejectrequestID, commentfromicu: commentfromicu, groupIDinICU: groupIDinICU, mainAmount: mainAmount},  function(data){
			if(data.msg){
                        $('#icurejecttrequest').html(data.msg).addClass('errorGreen');;
			setTimeout(function(){window.top.location= GLOBALS.appRoot + "home/myapproval/"} , 100);
			}else if(data.msgError){
                        $('#icurejecttrequest').html(data.msgError).addClass('errorRed');
			}
		})
                 .fail(function() {
                    $('#icurejecttrequest').html("Error Loading Data, Please try again");
                  });
    }
    
});


////////////////////////////////////////END OF ICU APPROVAL ////////////////////////////////////


//////////////////////////////////REPORTING BEGINS HERE /////////////////////////////////////

//This section deals search by date and account officer
  $('#searchbydate').click(function () {
          var startDateall = $('#startDateall').val();
          var endDateall = $('#endDateall').val();
          var dacctCode = $('#dacctCode').val();
          
          
        if(startDateall =="" || endDateall =="" || dacctCode ==""){
            alert("Please enter a Start and End Date");
         }else{
             $('#results').html('Loading Result, Please wait.....');
            $.ajax({
               url : GLOBALS.appRoot + "reports/mainsearch",
               method : "POST",
               data: {dacctCode: dacctCode, startDateall: startDateall, endDateall : endDateall},
               dataType : "text",
               success : function (data){
                   $('#results').html(data);
               }
            });
        }
     });
     
     
  //This section deals search by date and account officer and category
  $('#catsearchbydate').click(function () {
          var status = $('#status').val();
          var catStartDate = $('#catStartDate').val();
          var catEndDate = $('#catEndDate').val();
          
        if(catStartDate =="" || catEndDate =="" || status ==""){
            alert("Please enter a Start and End Date");
         }else{
             $('#results').html('Loading Result, Please wait.....');
            $.ajax({
               url : GLOBALS.appRoot + "reports/categorymainsearch",
               method : "POST",
               data: {catStartDate: catStartDate, catEndDate : catEndDate, status : status},
               dataType : "text",
               success : function (data){
                   $('#results').html(data);
               }
            });
        }
     });
     
    

 //This section deals search by date and account officer and category
  $('#summarybygroup').click(function () {
          var datefromsummary = $('#datefromsummary').val();
          var dateendsummary = $('#dateendsummary').val();
          
        if(datefromsummary =="" || dateendsummary ==""){
            alert("Please choose a Start and End Date");
           
         }else{
             $('#results').html('Loading Result, Please wait.....');
            $.ajax({
               url : GLOBALS.appRoot + "reports/summaryresult",
               method : "POST",
               data: {datefromsummary: datefromsummary, dateendsummary : dateendsummary},
               dataType : "text",
               success : function (data){
                   $('#results').html(data);
               }
            });
        }
     });
     
     
//Beginning of Setup for group Account
$('#setgroupaccount').click(function(e){
    var action = GLOBALS.appRoot+"dprocess/groupaccount";
    var dgroupaccout = $('#dgroupaccout').val();
    if(dgroupaccout == ""){
        $('#showError').html("Please Enter a Group Name").addClass("alert alert-danger");
    }else{
            
           $('#showError').html("Processing Group, Please wait...");  
                $.post(action, {dgroupaccout: dgroupaccout},  function(data){
			if(data.msg){
                        $('#showError').html(data.msg).addClass("alert alert-success");
			$('#dlocation').val('');
                        $('#dgroupaccout').show();
                        setTimeout(function(){window.top.location= GLOBALS.appRoot + "home/accountgroup/"} , 100);
			}
		})
                 .fail(function() {
                    $('#showError').html("Error Loading Data, Please try again").addClass("alert alert-danger");
                    $('#dgroupaccout').show();
                  });
    }
    
});



//Beginning of Setup for group Account
$('#setupbankalert').click(function(e){
    var action = GLOBALS.appRoot+"dprocess/bankalert";
    var dgroupbankalert = $('#dgroupbankalert').val();
    if(dgroupbankalert == ""){
        $('#showError').html("Please Enter a Group Name").addClass("alert alert-danger");
    }else{
            
           $('#showError').html("Processing Group, Please wait...");  
                $.post(action, {dgroupbankalert: dgroupbankalert},  function(data){
			if(data.msg){
                        $('#showError').html(data.msg).addClass("alert alert-success");
			$('#dgroupbankalert').val('');
                        $('#dgroupaccout').show();
			}
		})
                 .fail(function() {
                    $('#showError').html("Error Loading Data, Please try again").addClass("alert alert-danger");
                    $('#dgroupbankalert').show();
                  });
    }
    
});



//Beginning of Setup for Location
$('#cashierstillrequest').click(function(e){
    var action = GLOBALS.appRoot+"dprocess/tillrequest";
    var tillsDate = $('#tillsDate').val();
    var tilleDate = $('#tilleDate').val();
    var tillAmount = $('#tillAmount').val();
    if(tillsDate == "" ||  tilleDate == "" || tillAmount == ""){
        $('#errorCharging').html("Please make sure all fields are filled").addClass("alert alert-danger");
    }else{
            
           $('#errorCharging').html("Processing Till Request, Please wait...");  
                $.post(action, {tillsDate: tillsDate, tilleDate: tilleDate, tillAmount: tillAmount, },  function(data){
			if(data.msg){
                        $('#errorCharging').html(data.msg).addClass("alert alert-success");
			$('#tillAmount').val(''); $('#tillsDate').val(''); $('#tilleDate').val('');
			}
		})
                 .fail(function() {
                    $('#errorCharging').html("Error Loading Data, Please try again").addClass("alert alert-danger");
                   
                  });
    }
    
});


   $('.addCashier').click(function(e){
	 
          $.ajax({

        url: GLOBALS.appRoot + "home/allcashiers",
        type: "GET",
        dataType: "JSON"
        , success: function (data) {
            $('#loaddepdetails').html('loading cashiers, please wait....');
             
            var output = '<span id="cashError"></span><select class="form-control" id="chooseCashier">';
            
            output += '<option value="">Select Cashier</option>';
            for (var idx = 0; idx < data.ci.length; ++idx) {
                output += '<form id="addCashier" name="addCashier" action="" onSubmit="return false;">\n\
                             <option value='+ data.ci[idx].id+'>'+ data.ci[idx].fname+' '+ data.ci[idx].lname+'</option>';
                }
                output += '</select><br/>';
                output  +='<input type="text" id="tillName" name="tillName" placeholder="Till Name" class="form-control"/><br/><input type="text" class="form-control" placeholder="Add Limit" id="cashierLimit" name="cashierLimit"/>\n\
                            <br/><select id="tillType" class="form-control" name="tillType"><option value="primary">Select Till Type</option> <option value="primary">Primary</option> <option value="secondary">Secondary</option></select>\n\
                            <br/><button id="processLimit" onClick="processCashierLimit()" class="btn btn-sm btn-fill btn-primary">ADD Limit</button></form></div>';
            $('#loaddepdetails').html(output);
            
        }}).error(function () {
        $('#loaddepdetails').html("<br/>Error Loading content, please try again....");
        $('#loaddepdetails').addClass("errorRed");

    });
});

function processCashierLimit(){
   var action = GLOBALS.appRoot + "home/addcashierLimit";
   var chooseCashier = $('#chooseCashier').val();
   var cashierLimit = $('#cashierLimit').val();
   var tillName = $('#tillName').val();
   var tillType = $('#tillType').val();
   
   if(chooseCashier == "" || cashierLimit =="" || tillName ==""){
        $('#cashError').html("Please make sure all fields are filled").addClass("errorRed");
   }else{
         $('#cashError').html("Adding Cashing, Please wait...").addClass("errorGreen");
         $.post(action, {tillType: tillType, chooseCashier: chooseCashier, cashierLimit: cashierLimit , tillName: tillName}, function (data){
             
             if(data.msg){
                 $('#cashError').html(data.msg).addClass('errorGreen')
                 setTimeout(function () { window.location.reload(1); }, 1000);
             }else if (data.errmsg) {
                  $('#cashError').html(data.errmsg).addClass('errorRed');
             
             }
           
        });
   }
   
}


$('.approvecashrequest').click(function(e){
    
    var id = $(this).attr('data-id');
    if(id){
       
        _('errorme').innerHTML = "Approving Cheque, please wait...";
        var ajax = ajaxObj("POST", GLOBALS.appRoot + "action/approvecashamount");
        ajax.onreadystatechange = function () {
            if (ajaxReturn(ajax) == true) {
                var datArray = ajax.responseText;
                if (datArray == "empty_id") {
                    _('errorme').innerHTML = 'Important Variable to render this page is missing';
                }
                if (datArray == "amount_approve") {
                    _('errorme').innerHTML = 'Cheque/Amount Successfully Approved and Signed';
                    $('#errorme').addClass('alert alert-success');
                    setTimeout(function(){ window.location.reload(1); }, 3000);
                } else {

                    _('errorme').innerHTML = 'Something Went Wrong, Please check your Internet';
                    $('#errorme').addClass('alert alert-danger');
                }
            }
        }

        ajax.send("action=approve_id&aid=" + id);
    }else {
        alert("Important Values to process this page is missing");
    }
});


//REquest Decline

$('.requestnotapprove').click(function(e){
    
    var id = $(this).attr('data-id');
    if(id){
       
        _('errorme').innerHTML = "Approving Cash Asset, please wait...";
        var ajax = ajaxObj("POST", GLOBALS.appRoot + "action/requestamountnotapproved");
        ajax.onreadystatechange = function () {
            if (ajaxReturn(ajax) == true) {
                var datArray = ajax.responseText;
                if (datArray == "empty_id") {
                    _('errorme').innerHTML = 'Important Variable to render this page is missing';
                }
                if (datArray == "disamount_unapprove") {
                    _('errorme').innerHTML = 'Cash Not Approved';
                    $('#errorme').addClass('alert alert-warning');
                    setTimeout(function(){ window.location.reload(1); }, 1000);
                } else {

                    _('errorme').innerHTML = 'Something Went Wrong, Please check your Internet';
                    $('#errorme').addClass('alert alert-danger');
                }
            }
        }

        ajax.send("action=notapprove_id&aid=" + id);
    }else {
        alert("Important Values to process this page is missing");
    }
});



$('#addtogroup').click(function(e){
    
   var action = GLOBALS.appRoot + "action/addtogroup";
   var dAccountName = $('#dAccountName').val();
   var dAccountGroup = $('#dAccountGroup').val();
   
   if(dAccountName == "" || dAccountGroup ==""){
        $('#showError').html("Please make sure all fields are filled").addClass("errorRed");
   }else{
         $('#showError').html("Adding Cashing, Please wait...").addClass("errorGreen");
         $.post(action, {dAccountName: dAccountName, dAccountGroup: dAccountGroup}, function (data){
             
             if(data.msg){
                 $('#showError').html(data.msg).addClass('alert alert-success');
                 setTimeout(function(){window.top.location= GLOBALS.appRoot + "setup/setupaccountants/"} , 100);
             }
           
        });
   }
});



$('#addtoicugroup').click(function(e){
    
   var action = GLOBALS.appRoot + "action/addtogroupinicuonly";
   var dicugroupname = $('#dicugroupname').val();
   var dICUname = $('#dICUname').val();
   var approvalLimit = $('#approvalLimit').val();
   
   if(dICUname == "" || dicugroupname ==""){
        $('#showError').html("Please make sure all fields are filled").addClass("errorRed");
   }else{
         $('#showError').html("Adding User, Please wait...").addClass("errorGreen");
         $.post(action, {dicugroupname: dicugroupname, dICUname: dICUname, approvalLimit: approvalLimit}, function (data){
             
             if(data.msg){
                 $('#showError').html(data.msg).addClass('alert alert-success')
             }
           
        });
   }
});


$('#addcashier').click(function(e){
    
   var action = GLOBALS.appRoot + "action/addcashierlevel";
   var dUser = $('#dUser').val();
   var dLevel = $('#dLevel').val();
   
   if(dUser == "" || dLevel ==""){
        $('#showError').html("Please make sure all fields are filled").addClass("errorRed");
   }else{
         $('#showError').html("Adding Cashing, Please wait...").addClass("errorGreen");
         $.post(action, {dUser: dUser, dLevel: dLevel}, function (data){
             
             if(data.msg){
                 $('#showError').html(data.msg).addClass('alert alert-success')
                  setTimeout(function(){window.top.location= GLOBALS.appRoot + "setup/cashiersetup/"} , 1000); 
             }
           
        });
   }
});



///////////////////////////////////NEW ADVANCE REQUEST FOR CREATING NEW REQUEST ///////////////////////////////////////



///////////////////////////////////////END OF CREATE NEW ADVANCE REQUEST///////////////////////////////////

//Beginning of Setup for group Account
$('#setupicusubmit').click(function(e){
    var action = GLOBALS.appRoot+"dprocess/createicugroup";
    var icugroupname = $('#icugroupname').val();
    var grouplimit = $('#grouplimit').val();
    if(icugroupname == "" || grouplimit == "" ){
        $('#showError').html("Please Make sure all fields are filled").addClass("alert alert-danger");
    }else{
            
           $('#showError').html("Processing Group, Please wait...");  
                $.post(action, {icugroupname: icugroupname, grouplimit: grouplimit },  function(data){
			if(data.msg){
                        $('#showError').html(data.msg).addClass("alert alert-success");
			$('#icugroupname').val('');
			}
		})
                 .fail(function() {
                    $('#showError').html("Error Loading Data, Please try again").addClass("alert alert-danger");
                  });
    }
    
});


//////////////////////////ADD FIRST AMOUNT TO TILL CREATED NEWLY /////////////////////////////////////
$('.postfirstAmount').click(function(e){
    
   var action = GLOBALS.appRoot + "action/filltillfirstamount";
   var postID = $('#postID').val();
   var firsttillamount = $('#firsttillamount').val();
   
   if(postID == "" || firsttillamount ==""){
        $('#showError').html("Please make sure First Amount is filled").addClass("errorRed");
   }else{
         $('#showError').html("Adding Amount, Please wait...").addClass("errorGreen");
         $.post(action, {postID: postID, firsttillamount: firsttillamount}, function (data){
             
             if(data.msg){
                 $('#showError').html(data.msg).addClass('alert alert-success');
             setTimeout(function(){window.top.location= GLOBALS.appRoot + "home/cashierlimit/"} , 1000); 
             }else if(data.msgError){
                 $('#showError').html(data.msgError).addClass('alert alert-danger');
             }
           
        });
   }
});

    
 function makepaymentnowbycashier(id){
    var action = GLOBALS.appRoot + "dprocess/makedpayment";
    var paidTo = $('#paidTo').val();
    var dDate = $('#dDate').val();
    var myTillwithme = $('#myTillwithme').val();
    var userCode = $('#userCode').val();
    var paymentTypes = $('#paymentTypes').val();
    //var dBank = $('#dBank').val();
    //var dChequeNo = $('#dChequeNo').val();
    var assetID = id;
   
    if(paidTo == "" || dDate == "" || myTillwithme == ""){
        $('#insurerror').html("Please make sure all fields are filled").addClass('alert alert-danger');
    }else if(paymentTypes != 2 &&  userCode == ""){
         $('#insurerror').html("Please enter a code").addClass('alert alert-danger');
     }else{
        $(this).prop('disabled', true)
          $('#processreminder').prop('disabled', true);
        $('#putoption').html('Making Payment, Please wait.....').addClass('errorRed');
         $('#putoption').append('<img src="https://c-iprocure.com/expensepro/public/images/load.gif"/>');
        $('#processreminder').hide();
         $.post(action, {paymentTypes: paymentTypes, userCode: userCode, myTillwithme: myTillwithme, paidTo: paidTo, dDate: dDate, assetID: assetID}, function (data) {
              if (data.msg) {
                  $('#putoption').html(data.msg).addClass('alert alert-success')
                setTimeout(function(){window.top.location= GLOBALS.appRoot + "home/myapproval/"} , 100);
             }else if (data.warr) {
                  //$('#insurerror').html(data.warr).addClass('alert alert-warning');
                  $('#putoption').html(data.warr).addClass('alert alert-warning');
                   //setTimeout(function(){ window.location.reload(1); }, 5000);
                   //$('#processreminder').show();
             }
         });
    }
}


$('#EditButton').click(function(e){
    var action = GLOBALS.appRoot + "action/editprequestdetails";
    var hideID = $('#hideID').val();
    var ndescriptOfitem = $('#ndescriptOfitem').val();
    var dAmount = $('#dAmount').val();  
    var dComment = $('#dComment').val();  
    var benName = $('#benName').val(); 
    var newDate = $('#newDate').val();
    var dcashier = $('#dcashier').val();
    var dAccountGroup = $('#dAccountGroup').val();
    var dHOD = $('#dHOD').val();
    
     if(dAmount == "" ){
        $('#insurerror').html("Amount Cannot be Empty").addClass('errorRed');
    }else{
        $('#insurerror').html('Sending Request, Please wait.....').addClass('errorRed');
         $.post(action, $('#dEditRequest').serialize(), function (data) {
              if (data.msg) {
                  $('#insurerror').html(data.msg).addClass('errorGreen')
                setTimeout(function(){window.top.location= GLOBALS.appRoot + "home/"} , 1000);
             }else if (data.warr) {
                  $('#insurerror').html(data.warr).addClass('errorGreen')
             }
         });
    }
    
});



//BEGINNING OF PAYMENT MODE
$('#createAccout').click(function(e){
    var action = GLOBALS.appRoot+"dprocess/postforaccount";
    var actName = $('#actName').val();
     var actCode = $('#actCode').val();
    if(actName == "" || actCode == ""){
        $('#showError').html("Please make sure all fields are filled").addClass("alert alert-danger");
    }else{
            
           $('#showError').html("Processing Account, Please wait...");  
           $('#createCategory').hide();
                $.post(action, {actName: actName, actCode: actCode},  function(data){
			if(data.msg){
                        $('#showError').html(data.msg).addClass("errorGreen");
                        setTimeout(function(){window.top.location= GLOBALS.appRoot + "setup/setaccount/"} , 1000);
			$('#actName').val('');
                        $('#actCode').val('');
			}
		})
                 .fail(function() {
                    $('#showError').html("Error Loading Data, Please try again").addClass("alert alert-danger");
                    $('#createCategory').show();
                  });
    }
    
});



//Posting Cashiers payment
    $('.fordaccountant').click(function(e){
	 var assetid = $(this).attr('data-id');
         if(assetid == ""){
             alert("Important Variable to render this page is missing, please refresh");
         }else{
            
             $.ajax({
                url: GLOBALS.appRoot + "action/getdinforfromdetails/"  + assetid,
                type: "GET",
                dataType: "JSON"
                , success: function (data) {
                    $('#putoption').html('loading content, please wait....');
                    var changeStatus  = '<small class="category">&nbsp;</small>';
                    changeStatus += '<h5>PREPARE CHEQUE</h5><span class="errorGreen"></span><form id="paymentinc" name="winsurnace" action="" onSubmit="return false;">';
                    changeStatus += '<span id="insurerror"></span>Date <span style="color:red">format(yyyy-mm-dd)</span><input class="form-control datepicker" placeholder="yyyy-mm-dd" type="date" name="dDate" id="dDate"/><br/>';
                   
                    for (var idx = 0; idx < data.ci.length; ++idx) {
                        changeStatus += 'Payee<input type="text" value="'+ data.ci[idx].benName +'" disabled class="form-control name="paidTo" id="paidTo"/><br/>';
                        changeStatus += 'Amount<input type="text" value="'+ data.ci[idx].dAmount +'" disabled class="form-control name="Amount" id="Amount"/><br/>';
                    }
                   changeStatus += 'Select Bank<select class="form-control" name="dBank" id="dBank"><option value="">select Bank</option><option value="377849488">Oceanic Bank</option><option value="2637781">UBA Account One</option> <option value="1200093">UBA Account Two</option></select><br/>';
                    changeStatus += 'Cheque #Number<input class="form-control" placeholder="cheque No" type="text" name="chequeNo" id="chequeNo"/><br/>';
                    changeStatus  += '<button id="processreminder" type="submit" onClick="sendChequerequest('+ assetid +')" class="btn btn-danger btn-fill btn-sm">Confirm</button></form>';
                    $('#putoption').html(changeStatus );

                    }, error: function (xhr) {
                    $('#putoption').html("<br/>Error Loading content,Please check your internet and try again....");
                     $('#putoption').addClass("errorRed");

                 }
              });
          }
    });
    
  ///////////////////////////////////POP UP BOX FOR ACCOUNT TO MAKE PAYMENT ////////////////////
 
function sendChequerequest(id){
    var action = GLOBALS.appRoot + "dprocess/makedpaymentbyaccount";
    var paidTo = $('#paidTo').val();
    var dDate = $('#dDate').val();
    var chequeNo = $('#chequeNo').val();
    //var getSignatory = $('#getSignatory').val();
    var assetID = id;
    var dBank = $('#dBank').val();
    
    if(dDate == "" || chequeNo == "" || dBank == ""){
        $('#insurerror').html("Please make sure all fields are filled<br/>").addClass('errorRed');
    }else{
        $('#insurerror').html('Making Payment, Please wait.....').addClass('errorRed');
         $.post(action, {paidTo: paidTo, dDate: dDate, assetID: assetID, chequeNo: chequeNo, dBank: dBank}, function (data) {
              if (data.msg) {
                  $('#insurerror').html(data.msg).addClass('alert alert-success')
                setTimeout(function(){window.top.location= GLOBALS.appRoot + "home/myapproval/"} , 1000);
             }else if (data.warr) {
                  $('#insurerror').html(data.warr).addClass('alert alert-warning')
             }
         });
    }
}

////////////////////////////////POP UP BOX FOR ACCOUNT TO MAKE PAYMENT /////////////////////


$('#addBankandactno').click(function(e){
    var action = GLOBALS.appRoot + "action/addbankaccountnoprocess"; 
    var bankName = $('#bankName').val(); 
    var actNumber = $('#actNumber').val();
    var address1 = $('#address1').val();
    var state = $('#state').val();
    var acctName = $('#acctName').val();
    
     if(bankName == "" || actNumber == "" || address1 == "" || state == "" || acctName ==""){
        $('#insurerror').html("Please make sure all field are filled").addClass('errorRed');
    }else{
        $('#insurerror').html('Sending Request, Please wait.....').addClass('errorRed');
         $.post(action, $('#addBankaccout').serialize(), function (data) {
              if (data.msg) {
                  $('#insurerror').html(data.msg).addClass('errorGreen')
                  $('#actNumber').val('');
                  $('#bankName').val('');
                setTimeout(function(){window.top.location= GLOBALS.appRoot + "setup/addBank/"} , 100);
             }else if (data.warr) {
                  $('#insurerror').html(data.warr).addClass('errorGreen')
             }
         });
    }
    
});

$('#generateNow').click(function(e){
    var action = GLOBALS.appRoot+"action/getbankstatement/";
    var lang = [];
    //var dBankAct = $('#dBankAct');
       // Initializing array with Checkbox checked values
        $("input[name='dChecking']:checked").each(function(){
            lang.push(this.value);
            //lang.push(parseInt($(this).val()));
        });
        
        if(lang != ""){
            //alert(lang);
            $('#bankerror').html("Generating Bank Confirmation Statement, Please wait....<br/>").addClass("errorRed");
              $.post(action, $('#chequepost').serialize(), function (data) {
               setTimeout(function(){window.top.location= action + lang} , 1000);
         });
         
        }else{
        $('#bankerror').html("Please select a Bank<br/>").addClass("errorRed");
    }
    
});


$('#bankStatement').click(function(e){
    
    var generateStatement = $('#generateStatement').val();
    var action = GLOBALS.appRoot + "home/getthebanksyouwanttoprint/" + generateStatement;
   
    if(generateStatement !== ""){
        $('#bankerror').html("generating report, please wait...");
         $.post(action, $('#bankselected').serialize(), function (data) {
             setTimeout(function(){window.top.location= action }, 500)
             //window.open(action+generateStatement, 'Cheque Request', 'width=800, height=600');
         });
     
    }else{
        $('#bankerror').html("Please select a Bank<br/>").addClass("errorRed");
    }
});



$('#sendforreimbursementasforrembursement').click(function(e){
    
   var action = GLOBALS.appRoot + "action/updatereimbursementdetails";
   var sendformID = $('#sendformID').val();
   var daccountant = $('#daccountant').val();
   
  
   if(sendformID == "" || daccountant =="" || daccountant == "0"){
        $('#showcasherror').html("Please make sure all fields are filled").addClass("errorRed");
   }else{
         $('#showcasherror').html("Sending Reimbursement Request to Account, Please wait...").addClass("errorGreen");
         $.post(action, {sendformID: sendformID, daccountant: daccountant}, function (data){
           setTimeout(function(){window.top.location= GLOBALS.appRoot + "home/myrequest/"} , 500);  
             if(data.msg){
                 $('#showcasherror').html(data.msg).addClass('alert alert-success')
             }
           
        });
   }
});




$('#chequeforcashier').click(function(e){
    
   var action = GLOBALS.appRoot + "dprocess/preparecashierscheque";
   var dateprepared = $('#dateprepared').val();
   var dPayee = $('#dPayee').val();
   var dAmount = $('#dAmount').val();
   var cheQueNo = $('#cheQueNo').val();
   var dBank = $('#dBank').val();
   var sentID = $('#sentID').val();
  
   if(sentID == "" || dAmount ==""){
        $('#errorCase').html("Please make sure all fields are filled").addClass("errorRed");
   }else{
         $('#errorCase').html("Sending Reimbursement Request to Accountant, Please wait...").addClass("errorGreen");
         $.post(action, $('#preparecashiercheques').serialize(), function (data){
         setTimeout(function(){window.top.location= GLOBALS.appRoot + "home/requestforpayment/"} , 1000);  
             if(data.msg){
                 $('#errorCase').html(data.msg).addClass('alert alert-success')
             }
           
        });
   }
});


 $(function() {
$('.printchequerequests').click(function(e){
     var action = GLOBALS.appRoot+"dprocess/printrequestdetails/";
    var reqid = $(this).attr('data-id');
    var newWindow = window.open(action+reqid, 'Cheque Request', 'width=800, height=600');
    //newWindow.document.getElementById("output").innerHTML;
    newWindow.print();
});



//Posting Cashiers payment
    $('.forinsurance').click(function(e){
        var maindate = "";
	 var assetid = $(this).attr('data-id');
         var cashierEmailTill = $('#cashierEmailTill').val();
         var paymentTypes = $('#paymentTypes').val();
         if(assetid == ""){
             alert("Important Variable to render this page is missing, please refresh");
         }else{
            var dt = new Date();
            maindate = dt.getFullYear() + "-" + (dt.getMonth() + 1) + "-" + dt.getDate();
            
             $.ajax({
                url: GLOBALS.appRoot + "action/processmycashierstill/"+ cashierEmailTill,
                type: "GET",
                dataType: "JSON"
                , success: function (data) {
                    // if(typeof data == "object" && data.ci !== []){
                     
                    $('#putoption').html('loading content, please wait....');
                    var changeStatus  = '<small class="category">&nbsp;</small>';
                    changeStatus += '<h3>CONFIRM PAYMENT</h3><span class="errorGreen"></span><form id="paymentinc" name="winsurnace" action="" onSubmit="return false;">';
                    changeStatus += '<span id="insurerror"></span><br/>Date :<input class="form-control" value="'+ maindate +'" placeholder="yyyy-mm-dd" type="text" name="dDate" id="dDate"/><br/>Paid To<input type="text" class="form-control name="paidTo" id="paidTo"/><br/>';
                    changeStatus += '<select class="form-control" name="myTillwithme" id="myTillwithme"><option value="">select Till</option>';
                    for (var idx = 0; idx < data.ci.length; ++idx) {
                        changeStatus += '<option value="'+ data.ci[idx].Id +'">'+ data.ci[idx].tillName +'-'+ data.ci[idx].tillBalance +'</option>';
                    }
                     changeStatus  += '</select>';
                    
                    if(paymentTypes == 1 || paymentTypes == '1'){
                    changeStatus  += '<br/>Enter Code: <input type="text" class="form-control" name="userCode" id="userCode"/><br/>';
                    }else{
                     changeStatus  += '';  
                    }
                    changeStatus  += '<input type="hidden" name="paymentTypes" id="paymentTypes" value="'+paymentTypes +'" />';  
                    changeStatus  += '<button id="processreminder" type="submit" onClick="makepaymentnowbycashier('+ assetid +')" class="btn btn-danger btn-fill btn-sm">Pay</button></form>';
                    $('#putoption').html(changeStatus );
               // }
                    }, error: function (data) {
                    $('#putoption').html("<br/>Error Loading content, please try again....");
                     $('#putoption').addClass("errorRed");

                 }
              });
          }
    });
    
 });

//////////////////////////////////////////CHANGE PASSWORD /////////////////////////////////////////////////////////



$('#sendpassReset').click(function(e){
    
   var action = GLOBALS.appRoot + "action/requestpasswordchange";
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
    
   var action = GLOBALS.appRoot + "action/resetmypassword";
   var password1 = $('#password1').val();
   var password2 = $('#password2').val();
   var uemail = $('#uemail').val();
   var ids = $('#ids').val();
    
   if(password1 == "" || password2){
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




 
$('#confirmchequepay').click(function(e){
    
    var action = GLOBALS.appRoot + "paycheques/confirmchequerequestnownow";
    //var chequeDate = $('#chequeDate').val();
    var payee = $('#payee').val();
    var mainAount = $('#mainAount').val();
    var getBank = $('#getBank').val();
    var chequeNo = $('#chequeNo').val();
    var transactID = $('#transactID').val();
    var acctGroup = $('#acctGroup').val();
    var chequeManualDate = $('#chequeManualDate').val();
    var partAmount = $('#partAmount').val();
    
    if(mainAount === "" || chequeManualDate === ""){
        $('#insurerror').html("Please make sure all fields are filled<br/>").addClass('errorRed');
    }else if(chequeManualDate === "0000-00-00"){
          $('#chequeManualDate').after("<span style='color:red'>Please choose a cheque date</span><br/>");
    }else{
        $('#insurerror').html('Making Payment, Please wait.....').addClass('errorRed');
        $('#confirmchequepay').hide();
         $.post(action, {acctGroup: acctGroup, partAmount: partAmount, transactID: transactID, chequeNo: chequeNo, payee: payee, mainAount: mainAount, getBank: getBank, chequeManualDate: chequeManualDate}, function (data) {
              if (data.msg) {
                  $('#insurerror').html(data.msg).addClass('alert alert-success');
                    
                    if(data.newlink){
                    setTimeout(function(){window.top.location= GLOBALS.appRoot + data.newlink});
                    }
                    
                   }else if (data.warr) {
                  $('#insurerror').html(data.warr).addClass('errorRed');
                    $('#confirmchequepay').show();
             }
         });
    }
});



$('#partpaymentbalance').click(function(e){
    
  var action = GLOBALS.appRoot + "home/dblancetopay";
  var requestID = $('#requestID').val();
  var newAmountopay = parseInt($('#newAmountopay').val()); 
  var paypaybalance = $('#paypaybalance').val(); 
  var aAmount = $('#aAmount').val(); 
  var userID = $('#userID').val(); 
  //var appurL = $('#appurL').val(); 
  var newChequeNo = $('#newChequeNo').val();
  var newBank = $('#newBank').val();
  var balancepay = parseInt($('#balancepay').val());
  
  var fullpayment = parseInt(newAmountopay) + parseInt(paypaybalance);
  
 // alert(fullpayment);
  //alert(aAmount);
  if(paypaybalance === "" || newAmountopay ==="" || aAmount===""){
      $('#errorbalance').html("Please make sure all fields are filled<br/>").addClass('errorRed');
  }else if(newAmountopay > balancepay){
       $('#errorbalance').html("You cannot pay " + newAmountopay + " The Balance is " + balancepay  + "<br/>").addClass('errorRed');
  }else if(fullpayment > aAmount){
     $('#errorbalance').html("You cannot pay that amount. Total amount must be " + aAmount + " and you have paid " + paypaybalance + "<br/>").addClass('errorRed');  
  }else {
      $('#errorbalance').html('Making Payment, Please wait.....<br/>').addClass('errorRed');
      $('#partpaymentbalance').hide();
      $.post(action, {balancepay: balancepay, newBank: newBank, newChequeNo: newChequeNo, requestID: requestID, 
          userID: userID, aAmount: aAmount, paypaybalance: paypaybalance, newAmountopay: newAmountopay}, function (data) {
              if (data.msg) {
                  $('#errorbalance').html(data.msg).addClass('alert alert-success')
                setTimeout(function(){window.top.location= GLOBALS.appRoot + "home/allpartpayments/"});
             }else if (data.warr) {
                  $('#errorbalance').html(data.warr).addClass('errorRed');
                   $('#partpaymentbalance').show();
             }
         });
  }
    
});


///////////////////////////////////////PROCESSING MERGED PAYMENT //////////////////////////////////////////////////////
    $("#makemergedpaymentrequest").click(function(){
         var action = GLOBALS.appRoot+"mergedpay/mergepayment/";
        var merge = [];
       // Initializing array with Checkbox checked values
        $("input[name='mergepayment[]']:checked").each(function(){
            merge.push(this.value);
            //lang.push(parseInt($(this).val()));
        });
        
        if(merge != ""){
            //alert(merge);
              $('#mergeErrors').html("Processing request, Please wait....<br/>").addClass("errorRed");
              $.post(action, $('#chequepost').serialize(), function (data) {
               setTimeout(function(){window.top.location= action + merge} , 1000);
         });
         
        }else{
        $('#mergeErrors').html("Please select a request/checkbox<br/>").addClass("errorRed");
        }
    })


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 $("#mergingpaymentnow").click(function(){
    
    var action = GLOBALS.appRoot + "mergedpay/confirmchequerequestnownow";
    var mainAmount = $('#mainAmount').val(); 
    var ndesc = $('#ndesc').val();
    var jointbenName = $('#jointbenName').val();
    var chequeID = $('#chequeID').val();
    var payee = $('#payee').val();
    var getBank = $('#getBank').val();
    var chequeNo = $('#chequeNo').val();
    var chequeDate = $('#chequeDate').val();
    var vatcharge = $('#vatcharge').val();
    var witholdingtax = $('#witholdingtax').val();
    
     if(chequeNo == "" || getBank == "" || payee == "" || mainAmount == "" || ndesc == "" || chequeDate ==""){
        $('#insurerror').html("Please make sure all fields are filled<br/>").addClass('errorRed');
    }else{
        $('#insurerror').html('Making Payment, Please wait.....').addClass('errorRed');
         $.post(action,  $('#mergingpayment').serialize(), function (data) {
              if (data.msg) {
                  $('#insurerror').html(data.msg).addClass('alert alert-success')
                setTimeout(function(){window.top.location= GLOBALS.appRoot + "home/myapproval/"});
             }else if (data.warr) {
                  $('#insurerror').html(data.warr).addClass('errorRed')
             }
         });
    }
 });
 
 
 $('#addusertohod').click(function(e){
    //alert("i am here oo");
   var action = GLOBALS.appRoot + "admininistrator/adduserashod";
   var dUsernam = $('#dUsernam').val();
   var dhodgroup = $('#dhodgroup').val();
   
   if(dUsernam == "" || dhodgroup ==""){
        $('#showError').html("Please make sure all fields are filled").addClass("errorRed");
   }else{
         $('#showError').html("Adding Cashing, Please wait...").addClass("errorGreen");
         $.post(action, {dUsernam: dUsernam, dhodgroup: dhodgroup}, function (data){
             
             if(data.msg){
                 $('#showError').html(data.msg).addClass('alert alert-success');
                 setTimeout(function(){window.top.location= GLOBALS.appRoot + "setup/hoddropdownforusers/"} , 100);
             }
           
        });
   }
});

var box = "";
$(document).ready(function () {
        window.addEventListener('mouseup', function (event) {

            var box = document.getElementById('disposebox');
            var putalert = document.getElementById('myacctputalert');
            //var tagName = document.getElementsByTagName('input');
            if (event.target !== box && event.target.parentNode !== box && event.target !== putalert && event.target.parentNode !== putalert) {
                box.style.display = 'none';
            }
        });
        
         
        
        //BEGINNING OF MODAL FOR ACCOUNT PAYABLE
        $('.rejectrequestID').click(function (e) {
            var id = $(this).attr('data-id');
            
            var outputs = '<p id="deprocess"><h3 class="btn btn-block btn-fill btn-primary btnblue">Are you Sure?</h3></p><textarea class="" rows="3" name="dComment" id="dComment" cols="63" placeholder="This request will be rejected, please enter the reject reason"></textarea><br/><button onClick="rejectrequest('+id+')" id="approveRequistion" class="btn btn-sm btn-fill btn-primary">OK</button>';
            $('#myacctputalert').html(outputs);
        });
        
        
    });
    
    $('.disposebox').click(function (e) {
      //alert("kind that folds");
      //$('#disposebox').style.display='block';
      document.getElementById("disposebox").style.display = 'block';
    });
         
         
   function rejectrequest(id){
   //$('.forcommentdisplay').show();
   var action = GLOBALS.appRoot+"dprocess/hodrejection";
    var rejectrequestID = id;
    var dComment = $('#dComment').val();
    
    if(dComment == ""){
        $('#deprocess').html("Please enter a comment").addClass('errorRed');
    }else{  
           $('#deprocess').html("Rejecting Request, Please wait...");  
                $.post(action, {rejectrequestID: rejectrequestID, dComment: dComment},  function(data){
			if(data.msg){
                        $('#deprocess').html(data.msg).addClass('errorGreen');
			setTimeout(function(){window.top.location= GLOBALS.appRoot + "home/myapproval/"} , 100);
			}
		})
                 .fail(function() {
                    $('#rejectrequest').html("Error Loading Data, Please try again");
                  });
    }
    
}


function icurejectApproval(){
   //$('.forcommentdisplayforicuonly').show();
   var action = GLOBALS.appRoot+"dprocess/icurejection";
    var icurejectrequestID = $('#icurejectrequestID').val();
   //var icuacceptrequestID  = $('#icuacceptrequestID').val();
    var groupIDinICU = $('#groupIDinICU').val();
    var mainAmount = $('#mainAmount').val();
    var commentfromicu = $('#commentfromicu').val();
    
    if(icuacceptrequestID == "" || commentfromicu == "" || groupIDinICU == "" || mainAmount == "" || mainAmount == "0" ){
        $('#deprocess').html("Please add a comment").addClass('errorRed');
    }else{
            
           $('#deprocess').html("Approving Request, Please wait...");  
                $.post(action, {icurejectrequestID: icurejectrequestID, commentfromicu: commentfromicu, groupIDinICU: groupIDinICU, mainAmount: mainAmount},  function(data){
			if(data.msg){
                        $('#deprocess').html(data.msg).addClass('errorGreen');;
			//setTimeout(function(){window.top.location= GLOBALS.appRoot + "home/myapproval/"} , 100);
			}else if(data.msgError){
                        $('#deprocess').html(data.msgError).addClass('errorRed');
			}
		})
                 .fail(function() {
                    $('#deprocess').html("Error Loading Data, Please try again");
                  });
    }
    
};


$('#addicuhead').click(function(e){
    
   var action = GLOBALS.appRoot + "admininistrator/addheadicu";
   var dUsernam = $('#dUsernam').val();
   var dicugroup = $('#dicugroup').val();
   
   if(dUsernam == "" || dicugroup ==""){
        $('#showError').html("Please make sure all fields are filled").addClass("errorRed");
   }else{
         $('#showError').html("Adding Cashing, Please wait...").addClass("errorGreen");
         $.post(action, {dUsernam: dUsernam, dicugroup: dicugroup}, function (data){
             
             if(data.msg){
                 $('#showError').html(data.msg).addClass('alert alert-success');
                 setTimeout(function(){window.top.location= GLOBALS.appRoot + "setup/icuheadsetup/"} , 100);
             }
           
        });
   }
});



$('#updateLimit').click(function(e){
    
   var action = GLOBALS.appRoot + "setup/changelimitbyhod";
   var userLimit = $('#userLimit').val();
   var transID = $('#transID').val();
   
   if(userLimit == "" || transID ==""){
        $('#showError').html("Please make sure all fields are filled").addClass("errorRed");
   }else{
         $('#showError').html("Adding Cashing, Please wait...").addClass("errorGreen");
         $.post(action, {userLimit: userLimit, transID: transID}, function (data){
             
             if(data.msg){
                 $('#showError').html(data.msg).addClass('alert alert-success');
                 setTimeout(function(){window.top.location= GLOBALS.appRoot + "setup/changeicumemberlimit/"} , 100);
             }
           
        });
   }
});


 //This section deals search by date and account officer and category
  $('#searchbyUnit').click(function () {
          var dUnit = $('#dUnit').val();
          var unitStartDate = $('#unitStartDate').val();
          var unitEndDate = $('#unitEndDate').val();
          
        if(unitEndDate =="" || unitStartDate =="" || dUnit ==""){
            alert("Please enter a Start and End Date");
         }else{
             $('#results').html('Loading Result, Please wait.....');
            $.ajax({
               url : GLOBALS.appRoot + "reports/dunimainsearch",
               method : "POST",
               data: {unitStartDate: unitStartDate, unitEndDate : unitEndDate, dUnit : dUnit},
               dataType : "text",
               success : function (data){
                   $('#results').html(data);
               }
            });
        }
     });
     
     
     
 
//This section deals search by date and account officer and category
  $('#actsearchbyUnit').click(function () {
     
          var dUnit = $('#dUnit').val();
          var unitStartDate = $('#unitStartDate').val();
          var unitEndDate = $('#unitEndDate').val();
          
        if(unitEndDate =="" || unitStartDate =="" || dUnit ==""){
            alert("Please enter a Start and End Date");
         }else{
             $('#results').html('Loading Result, Please wait.....');
            $.ajax({
               url : GLOBALS.appRoot + "reports/actdunimainsearch",
               method : "POST",
               data: {unitStartDate: unitStartDate, unitEndDate : unitEndDate, dUnit : dUnit},
               dataType : "text",
               success : function (data){
                   $('#results').html(data);
               }
            });
        }
     });
     
     

 //This section deals search by date and account officer and category
  $('#hodcatsearchbydate').click(function () {
          var hodstatus = $('#hodstatus').val();
          var hodcatStartDate = $('#hodcatStartDate').val();
          var hodcatEndDate = $('#hodcatEndDate').val();
          
        if(hodcatStartDate =="" || hodcatEndDate =="" || hodstatus ==""){
            alert("Please enter a Start and End Date");
         }else{
             $('#results').html('Loading Result, Please wait.....');
            $.ajax({
               url : GLOBALS.appRoot + "reports/hodcategorymainsearch",
               method : "POST",
               data: {hodcatStartDate: hodcatStartDate, hodcatEndDate : hodcatEndDate, hodstatus : hodstatus},
               dataType : "text",
               success : function (data){
                   $('#results').html(data);
               }
            });
        }
     });
    