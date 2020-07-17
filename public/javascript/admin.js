//BEGINNING OF PAYMENT MODE
$('#icuprocessApprovalforadmin').click(function(e){
   
   var action = GLOBALS.appRoot+"admininistrator/icuapproval";
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
			setTimeout(function(){window.top.location= GLOBALS.appRoot + "home/myapproval/"} , 2000);
			}else if(data.msgError){
                        $('#icuacceptrequest').html(data.msgError).addClass('errorRed');
			}
		})
                 .fail(function() {
                    $('#icuacceptrequest').html("Error Loading Data, Please try again");
                  });
    }
    
});


//Posting Cashiers payment
    $('.forinsuranceadmin').click(function(e){
	 var assetid = $(this).attr('data-id');
         var cashierEmailTill = $('#cashierEmailTill').val();
         if(assetid == ""){
             alert("Important Variable to render this page is missing, please refresh");
         }else{
            var dt = new Date();
            maindate = dt.getFullYear() + "-" + (dt.getMonth() + 1) + "-" + dt.getDate();
             $.ajax({
                url: GLOBALS.appRoot + "admininistrator/processmycashierstill/"  + cashierEmailTill,
                type: "GET",
                dataType: "JSON"
                , success: function (data) {
                    $('#putoption').html('loading content, please wait....');
                    var changeStatus  = '<small class="category">&nbsp;</small>';
                    changeStatus += '<h3>MAKE PAYMENT</h3><span class="errorGreen"></span><form id="paymentinc" name="winsurnace" action="" onSubmit="return false;">';
                    changeStatus += '<span id="insurerror"></span><br/>Date<input class="form-control" value="'+ maindate +'" type="text" name="dDate" id="dDate"/><br/>Paid To<input type="text" class="form-control name="paidTo" id="paidTo"/><br/>';
                    changeStatus += '<br/><select class="form-control" name="myTillwithme" id="myTillwithme"><option value="">select Till</option>';
                    for (var idx = 0; idx < data.ci.length; ++idx) {
                        changeStatus += '<option value="'+ data.ci[idx].Id +'">'+ data.ci[idx].tillName +'-'+ data.ci[idx].tillBalance +'</option>';
                    }
                     changeStatus  += '</select>';
                      changeStatus  += '<br/>Enter Code: <input type="text" class="form-control" name="userCode" id="userCode"/><br/>';
                    changeStatus  += '<button id="processreminder" type="submit" onClick="makepaymentnow('+ assetid +')" class="btn btn-danger btn-fill btn-sm">Pay</button></form>';
                    $('#putoption').html(changeStatus );

                    }, error: function (xhr) {
                    $('#loaddepdetails').html("<br/>Error Loading content, please try again....");
                     $('#loaddepdetails').addClass("errorRed");

                 }
              });
          }
    });



function makepaymentnow(id){
    var action = GLOBALS.appRoot + "admininistrator/makedpayment";
    var paidTo = $('#paidTo').val();
    var dDate = $('#dDate').val();
    var myTillwithme = $('#myTillwithme').val();
    //var dBank = $('#dBank').val();
    //var dChequeNo = $('#dChequeNo').val();
    var assetID = id;
    var userCode = $('#userCode').val();
   
    if(paidTo == "" || dDate == "" || myTillwithme == "" || userCode == "" ){
        $('#insurerror').html("Please make sure all fields are filled").addClass('alert alert-danger');
    }else{
        $('#insurerror').html('Making Payment, Please wait.....').addClass('errorRed');
         $.post(action, {userCode: userCode, myTillwithme: myTillwithme, paidTo: paidTo, dDate: dDate, assetID: assetID}, function (data) {
              if (data.msg) {
                  $('#insurerror').html(data.msg).addClass('alert alert-success')
                setTimeout(function(){window.top.location= GLOBALS.appRoot + "home/myapproval/"} , 2000);
             }else if (data.warr) {
                  $('#insurerror').html(data.warr).addClass('alert alert-warning')
             }
         });
    }
}


$('.activatStatus').click(function(e){
    var action = GLOBALS.appRoot + "admininistrator/changeStatus";
    var id = $(this).attr('data-id');
    //var write = $('.activatStatus').attr('value', 'processing..');
    var write = ($(this).attr("value", function(){
       if(id){
        $(this).html("processing.."); 
             $.post(action, {newid: id}, function (data) {
              if(data.msg === 1 || data.msg === "1") {
                  //alert(data.msg);
                  $(this).attr("value", function(){
                      $(this).html("Disable");
                  });
                   setTimeout(function(){window.top.location= GLOBALS.appRoot + "action/disableduser/"} , 200);
             } else if(data.msg === 0 || data.msg === "0"){
              $(this).attr("value", function(){
                   $(this).html("Enable");
                }); 
                setTimeout(function(){window.top.location= GLOBALS.appRoot + "action/disableduser/"} , 200);
             }
         });
       }
    }));
});



$('#resendEmailActivation').click(function(e){
    var action = GLOBALS.appRoot + "admininistrator/resendactivemail";
    var hiddenID = $('#hiddenID').val();
    if(hiddenID){
         $('#activationError').html("Sending Activation Email...<br/>");
          $.post(action, {hiddenID: hiddenID}, function (data) {
              if(data.msg) {
                   $('#activationError').html(data.msg);
              }
          });
    }
    
});



$('#resendpasswordreset').click(function(e){
    var action = GLOBALS.appRoot + "admininistrator/resetdpassword";
    var hiddenID = $('#hiddenID').val();
    if(hiddenID){
         $('#activationError').html("Sending Activation Email..<br/>");
          $.post(action, {hiddenID: hiddenID}, function (data) {
              if(data.msg) {
                   $('#activationError').html(data.msg);
              }
          });
    }
    
});

$('#adminprocessApproval').click(function(e){
   
   var action = GLOBALS.appRoot+"admininistrator/hodhasapproval";
    var acceptrequestID = $('#acceptrequestID').val();
    var dComment = $('#dComment').val();
    var hodEmail = $('#hodEmail').val();
    
   /* if(dComment == ""){
        $('#acceptrequest').html("Please enter a comment").addClass('errorRed');
    }else{ */
    
           $('#acceptrequest').html("Approving Request, Please wait...");  
                $.post(action, {acceptrequestID: acceptrequestID, dComment: dComment, hodEmail: hodEmail},  function(data){
			if(data.msg){
                        $('#acceptrequest').html(data.msg).addClass('errorGreen');;
			setTimeout(function(){window.top.location= GLOBALS.appRoot + "home/myapproval/"} , 100);
			}
		})
                 .fail(function() {
                    $('#acceptrequest').html("Error Loading Data, Please try again");
                  });
  //  }
    
});


//Beginning of Setup for Location
$('#addNewtitle').click(function(e){
    var action = GLOBALS.appRoot+"setup/addtitleshere";
    var dtitle = $('#dtitle').val();
    if(dtitle == ""){
        $('#showError').html("Please make sure all fields are filled").addClass("alert alert-danger");
    }else{
            
           $('#showError').html("Processing Location, Please wait...");  
                $.post(action, {dtitle: dtitle},  function(data){
			if(data.msg){
                        $('#showError').html(data.msg).addClass("alert alert-success");
			$('#dlocation').val('');
                        $('#setLocation').show();
                        setTimeout(function(){window.top.location= GLOBALS.appRoot + "setup/titles/"} , 100);
			}
		})
                 .fail(function() {
                    $('#showError').html("Error Loading Data, Please try again").addClass("alert alert-danger");
                  });
    }
    
});


///////////////////////////////////NEW ADVANCE REQUEST FOR CREATING NEW REQUEST ///////////////////////////////////////


$('#processdraft').click(function(e){
   
        var dateCreated = $('#dateCreated').val();
        var descItem = $('#descItem').val();
        var benName = $('#benName').val();
        var benEmail = $('#benEmail').val();
        var dUnit = $('#dUnit').val();
        var itemCat = $('#itemCat').val();
        var paymentType = $('#paymentType').val();
        var dComment = $('#dComment').val();
        var dhod = $('#dhod').val();
        var dicu = $('#dicu').val();
        //var payeeActno = $('#payeeActno').val();
        var dcashier = $('#dcashier').val() != "" ? $('#dcashier').val() : "";
        var daccountant = $('#daccountant').val() != "" ? $('#daccountant').val() : "";
        
        
        /////////////////////////PROCESSING FORM VARIABLE FOR EXPENSE DETAILS //////////////////////////////
       
        var exDetailofpayment = $('#exDetailofpayment').val();
        var exAmount = $('#exAmount').val();
        var exCode = $('#exCode').val();
        var exDate = $('#exDate').val();
        var sumall = $('#sumall').val();
        var r = confirm("Are you sure you want to save as Draft?");
       if (r == true) {
       ///////////////////////// END OF PROCESSING FORM VARIABLE FOR EXPENSE DETAILS //////////////////////////////
        var dataString = new FormData(document.getElementById('mainrequestformadvanceform')); //postArticles
        if (dateCreated == "" || descItem == "") {
            $('#showError').html("Please enter a least Date and Description of Item before you can save to draft ").addClass("alert alert-danger");
        } else if(exCode == "" || exDetailofpayment == "" || exDate == ""  || exAmount == ""){
            $('#showError').html("You must enter at least one expense details before you can save to draft").addClass("alert alert-danger");
        }else {
            $('#showError').html("Processing Request, Please wait...").addClass("alert alert-danger");
            $('#processnewrequestadvance').hide();
            $('#processdraft').hide();
            $('.loaderimg').show();
            $.ajax({
                type: "POST",
                url: GLOBALS.appRoot + "draft/draftnewrequest",
                data: dataString,
                contentType: false,
                processData: false,
                cache: false,
                dataType: 'JSON',

                success: function (data) {
                    $('#showError').html('uploading assets to our Database, please wait...').addClass('alert alert-warning');
                    
                    if (data.status == 0) {
                        $('#showError').html(JSON.stringify(data.msg)).addClass('alert alert-warning');
                        $('#processnewrequestadvance').show();
                        $('#processdraft').show();
                    }else if(data.status == 1){
			$('#showError').html(data.msg).addClass('alert alert-success'); 
			$('#dateCreated').val('');   $('#fileUpload').val('');   $('#descItem').val('');
			$('#itemCat').val('');  $('#paymentType').val('');  $('#dhod').val('');
			$('#dicu').val('');  $('#dcashier').val('');  
                        $('#benName').val(''); $('#dAmount').val('');
                        setTimeout(function(){window.top.location= GLOBALS.appRoot + "home/"} , 1000);                        
						
                    }
			 else if(data.status == 2){
		 	$('#showError').html(JSON.stringify(data.msg)).addClass('alert alert-secondary');
                         $('#processnewrequestadvance').show();
                          $('#processdraft').show();
			 }else if(data.status == 5){
			$('#showError').html(JSON.stringify(data.msg)).addClass('alert alert-primary'); 
                         $('#processnewrequestadvance').show();
                          $('#processdraft').show();
                         }else if(data.status == 3){
			$('#showError').html(JSON.stringify(data.msg)).addClass('alert alert-primary'); 
                         $('#processnewrequestadvance').show();
                          $('#processdraft').show();
                         }else if(data.status == 7){
			$('#showError').html(JSON.stringify(data.msg)).addClass('alert alert-primary'); 
                         $('#processnewrequestadvance').show();
                          $('#processdraft').show();
                     }else if(data.status == 9){
			$('#showError').html(JSON.stringify(data.msg)).addClass('alert alert-primary'); 
                         $('#processnewrequestadvance').show();
                          $('#processdraft').show();
                     }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    console.log('An Ajax error was thrown.');
                    console.log(XMLHttpRequest);
                    console.log(textStatus);
                    console.log(errorThrown);
                }

            });
            
        }
        
        } // Save as Draft

    });

///////////////////////////////////////END OF CREATE NEW ADVANCE REQUEST///////////////////////////////////



$('#processdraftedit').click(function(e){
   
        var dateCreated = $('#dateCreated').val();
        var descItem = $('#descItem').val();
        var benName = $('#benName').val();
        //var benEmail = $('#benEmail').val();
        var dUnit = $('#dUnit').val();
        var itemCat = $('#itemCat').val();
        var paymentType = $('#paymentType').val();
        var dComment = $('#dComment').val();
        var dhod = $('#dhod').val();
        var dicu = $('#dicu').val();
        //var payeeActno = $('#payeeActno').val();
        var dcashier = $('#dcashier').val() != "" ? $('#dcashier').val() : "";
        var daccountant = $('#daccountant').val() != "" ? $('#daccountant').val() : "";
        var hideID = $('#hideID').val();
        var exid = $('#exid').val();
        var mdID = $('#mdID').val();
        var dapprovals = $('#dapprovals').val();
        /////////////////////////PROCESSING FORM VARIABLE FOR EXPENSE DETAILS //////////////////////////////
       
       
       
        var exDetailofpayment = $('#exDetailofpayment').val();
        var exAmount = $('#exAmount').val();
        var exCode = $('#exCode').val();
        var exDate = $('#exDate').val();
        var sumall = $('#sumall').val();
         
       ///////////////////////// END OF PROCESSING FORM VARIABLE FOR EXPENSE DETAILS //////////////////////////////
        var dataString = new FormData(document.getElementById('mainrequestformadvanceform')); //postArticles
        if (exDate == "" || exCode == "" || exDetailofpayment =="" || dateCreated == "" || dUnit == "" || exAmount == "" || descItem == "" || paymentType == "" || dhod == "" || dicu == "") {
            $('#showError').html("Please make sure all fields are filled").addClass("alert alert-danger");
        }else if(dcashier =="null" && daccountant =='0'){
              $('#showError').html("You must select either a cashier or an account group").addClass("alert alert-danger");
        }else if(dcashier !="null" && daccountant !='0'){
           $('#showError').html("You must choose either a cashier or an accountant group but not both").addClass("alert alert-danger"); 
        
       }else {
            $('#showError').html("Processing Request, Please wait...").addClass("alert alert-danger");
            $('#processdraftedit').hide();
            $('#processeditrequest').hide();
            $('.loaderimg').show();
            $.ajax({
                type: "POST",
                url: GLOBALS.appRoot + "draft/advancedraftrequestnew",
                data: dataString,
                contentType: false,
                processData: false,
                cache: false,
                dataType: 'JSON',

                success: function (data) {
                    $('#showError').html('uploading assets to our Database, please wait...').addClass('alert alert-warning');
                    
                    if (data.status == 0) {
                        $('#showError').html(JSON.stringify(data.msg)).addClass('alert alert-warning');
                        $('#processnewrequestadvance').show();
                        $('#processdraftedit').show();
                    }else if(data.status == 1){
			$('#showError').html(data.msg).addClass('alert alert-success'); 
			$('#dateCreated').val('');   $('#fileUpload').val('');   $('#descItem').val('');
			$('#itemCat').val('');  $('#paymentType').val('');  $('#dhod').val('');
			$('#dicu').val('');  $('#dcashier').val('');  
                        $('#benName').val(''); $('#dAmount').val('');
                        //setTimeout(function(){window.top.location= GLOBALS.appRoot + "home/"} , 1000);                        
						
                    }
			 else if(data.status == 2){
		 	$('#showError').html(JSON.stringify(data.msg)).addClass('alert alert-secondary');
                         $('#processnewrequestadvance').show();
                         $('#processdraftedit').show();
			 }else if(data.status == 5){
			$('#showError').html(JSON.stringify(data.msg)).addClass('alert alert-primary'); 
                         $('#processnewrequestadvance').show();
                         $('#processdraftedit').show();
                         }else if(data.status == 3){
			$('#showError').html(JSON.stringify(data.msg)).addClass('alert alert-primary'); 
                         $('#processnewrequestadvance').show();
                         $('#processdraftedit').show();
                     }else if(data.status == 7){
			$('#showError').html(JSON.stringify(data.msg)).addClass('alert alert-primary'); 
                         $('#processnewrequestadvance').show();
                         $('#processdraftedit').show();
                     }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    console.log('An Ajax error was thrown.');
                    console.log(XMLHttpRequest);
                    console.log(textStatus);
                    console.log(errorThrown);
                }

            });
            
        }

    });
    
    
    
    
$('#processeditawitinghodapproval').click(function(e){
   
        var dateCreated = $('#dateCreated').val();
        var descItem = $('#descItem').val();
        var benName = $('#benName').val();
        //var benEmail = $('#benEmail').val();
        var dUnit = $('#dUnit').val();
        var itemCat = $('#itemCat').val();
        var paymentType = $('#paymentType').val();
        var dComment = $('#dComment').val();
        var dhod = $('#dhod').val();
        var dicu = $('#dicu').val();
        //var payeeActno = $('#payeeActno').val();
        var dcashier = $('#dcashier').val() != "" ? $('#dcashier').val() : "";
        var daccountant = $('#daccountant').val() != "" ? $('#daccountant').val() : "";
        var hideID = $('#hideID').val();
        var hashmd5id = $('#hashmd5id').val();
        var currencyType = $('#currencyType').val();
        
        /////////////////////////PROCESSING FORM VARIABLE FOR EXPENSE DETAILS //////////////////////////////
       
        var exDetailofpayment = $('#exDetailofpayment').val();
        var exAmount = $('#exAmount').val();
        var exCode = $('#exCode').val();
        var exDate = $('#exDate').val();
        var sumall = $('#sumall').val();
         
       ///////////////////////// END OF PROCESSING FORM VARIABLE FOR EXPENSE DETAILS //////////////////////////////
        var dataString = new FormData(document.getElementById('mainrequestformadvanceform')); //postArticles
        if (exDate == "" || exCode == "" || exDetailofpayment =="" || dateCreated == "" || dUnit == "" || exAmount == "" || descItem == "" || paymentType == "" || dhod == "" || dicu == "") {
            $('#showError').html("Please make sure all fields are filled").addClass("alert alert-danger");
        } else {
            $('#showError').html("Processing Request, Please wait...").addClass("alert alert-danger");
            $('#processeditawitinghodapproval').hide();
            $('#processeditrequest').hide();
            $('.loaderimg').show();
            $.ajax({
                type: "POST",
                url: GLOBALS.appRoot + "draft/waitinghodtoapproval",
                data: dataString,
                contentType: false,
                processData: false,
                cache: false,
                dataType: 'JSON',

                success: function (data) {
                    $('#showError').html('uploading assets to our Database, please wait...').addClass('alert alert-warning');
                    
                    if (data.status == 0) {
                        $('#showError').html(JSON.stringify(data.msg)).addClass('alert alert-warning');
                         $('#processeditawitinghodapproval').show();
                    }else if(data.status == 1){
			$('#showError').html(data.msg).addClass('alert alert-success'); 
			$('#dateCreated').val('');   $('#fileUpload').val('');   $('#descItem').val('');
			$('#itemCat').val('');  $('#paymentType').val('');  $('#dhod').val('');
			$('#dicu').val('');  $('#dcashier').val('');  
                        $('#benName').val(''); $('#dAmount').val('');
                        setTimeout(function(){window.top.location= GLOBALS.appRoot + "home/"} , 1000);                        
						
                    }
			 else if(data.status == 2){
		 	$('#showError').html(JSON.stringify(data.msg)).addClass('alert alert-secondary');
                         $('#processeditawitinghodapproval').show();
			 }else if(data.status == 5){
			$('#showError').html(JSON.stringify(data.msg)).addClass('alert alert-primary'); 
                         $('#processeditawitinghodapproval').show();
                         }else if(data.status == 3){
			$('#showError').html(JSON.stringify(data.msg)).addClass('alert alert-primary'); 
                        $('#processeditawitinghodapproval').show();
                     }else if(data.status == 7){
			$('#showError').html(JSON.stringify(data.msg)).addClass('alert alert-primary'); 
                        $('#processeditawitinghodapproval').show();
                     }
                },
                error: function (data) {
                    console.log('An Ajax error was thrown.');
                    $('#showError').html(JSON.stringify(data)).addClass('alert-primary'); 
                    $('#showError').html("We Could not process/upload your request");
                }

            });
            
        }

    });
    
    
    
    
    
 $('#changedcashier').click(function(e){
   var action = GLOBALS.appRoot + "supports/updatedcashiersonly";
   var postID = $('#postID').val();
   var approveID = $('#approveID').val();
   var sessionID = $('#sessionID').val();
   var changemycashier = $('#changemycashier').val();
   
    if(postID == "" || sessionID == "" || approveID == ""){
        $('#cashierError').html("Important variables to processing this page is missing. please select group location").addClass("errorRed");
   }else{
       $('#cashierError').html("Processing Request, please wait...").addClass("errorRed"); 
       $.post(action, {approveID: approveID, postID: postID, sessionID: sessionID, changemycashier: changemycashier}, function (data){
        
             if(data.msg){
                 $('#cashierError').html(data.msg).addClass('errorGreen');
                 setTimeout(function(){window.top.location= GLOBALS.appRoot + "home"} , 1000);
             }else if(data.msgError){
                $('#cashierError').html(data.msgError).addClass('errorGreen'); 
             }
           
        });
   }
   
   
});



$('#changedcashierbysupport').click(function(e){
   var action = GLOBALS.appRoot + "supports/updatedcashiersonly";
   var postID = $('#postID').val();
   var approveID = $('#approveID').val();
   var sessionID = $('#sessionID').val();
   var changemycashier = $('#changemycashier').val();
   
    if(postID == "" || sessionID == "" || approveID == ""){
        $('#cashierError').html("Important variables to processing this page is missing. please select group location").addClass("errorRed");
   }else{
       $('#cashierError').html("Processing Request, please wait...").addClass("errorRed"); 
       $.post(action, {approveID: approveID, postID: postID, sessionID: sessionID, changemycashier: changemycashier}, function (data){
        
             if(data.msg){
                 $('#cashierError').html(data.msg).addClass('errorGreen');
                 setTimeout(function(){window.top.location= GLOBALS.appRoot + "supports/getphenugu"} , 1000);
             }else if(data.msgError){
                $('#cashierError').html(data.msgError).addClass('errorGreen'); 
             }
           
        });
   }
   
   
});

   
   


    
$('#proceeadvancedit').click(function(e){
   
        var dateCreated = $('#dateCreated').val();
        var descItem = $('#descItem').val();
        var benName = $('#benName').val();
        
        var dUnit = $('#dUnit').val();
       
        var dComment = $('#dComment').val();
        var dhod = $('#dhod').val();
        var dcashier = $('#dcashier').val() != "" ? $('#dcashier').val() : "";
        var daccountant = $('#daccountant').val() != "" ? $('#daccountant').val() : "";
        var hideID = $('#hideID').val();
        var hashmd5id = $('#hashmd5id').val();
        var currencyType = $('#currencyType').val();
        
        /////////////////////////PROCESSING FORM VARIABLE FOR EXPENSE DETAILS //////////////////////////////
       
       ///////////////////////// END OF PROCESSING FORM VARIABLE FOR EXPENSE DETAILS //////////////////////////////
        var dataString = new FormData(document.getElementById('mainrequestformadvanceform')); //postArticles
        if (dateCreated == "") {
            $('#showError').html("Please make sure all fields are filled").addClass("alert alert-danger");
        } else {
            $('#showError').html("Processing Request, Please wait...").addClass("alert alert-danger");
            $('#processeditawitinghodapproval').hide();
            $('#processeditrequest').hide();
            $('.loaderimg').show();
            $.ajax({
                type: "POST",
                url: GLOBALS.appRoot + "home/advancepackedit",
                data: dataString,
                contentType: false,
                processData: false,
                cache: false,
                dataType: 'JSON',

                success: function (data) {
                    $('#showError').html('uploading assets to our Database, please wait...').addClass('alert alert-warning');
                    
                    if (data.status == 0) {
                        $('#showError').html(JSON.stringify(data.msg)).addClass('alert alert-warning');
                         $('#processeditawitinghodapproval').show();
                    }else if(data.status == 1){
			
                        setTimeout(function(){window.top.location= GLOBALS.appRoot + "archieves/"} , 10);                        
						
                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    console.log('An Ajax error was thrown.');
                    console.log(XMLHttpRequest);
                    console.log(textStatus);
                    console.log(errorThrown);
                }

            });
            
        }

    });
    
   
   
  function removeexpense(id){ 
     var deleteid = id;
     var action = GLOBALS.appRoot+"draft/deletexpense";
     $.post(action, {deleteid: deleteid},  function(data){
	if(data.msg){
           $('#genmessag').html(data.msg);
	   $(this).parent().remove();
            setTimeout(function(){ window.location.reload(1); });
	}
    }).fail(function() {
            $('#genmessag').html("Sorry, There was a problem the image");
         });
     //postDataVal("POST", GLOBALS.appRoot + "nopriveledge/deleteimage", {tid: deleteid}, "JSON", _deleteimageItemSuccess(deleteid), "", null, null);
  } 