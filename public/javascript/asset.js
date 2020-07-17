/**
 * @copyright: Ognocom Nigeria 2015, All Rights Reserved.
 * @author: Ogiogio Victor
 * @contact: 2347038807891
 * @email: ogiogiovictor@gmail.com
 * 
 */
//APPROVING ASSETS
function approvemant(id) {
    var action = GLOBALS.appRoot + "assetmgt/approveformaintenance";
    var assetID = $('#assetID').val();
    var theID = $('#theID').val();
    var recomm = $('#recomm').val();
    //var vendorName = $('#vendorName').val();
    var schDate = $('#schDate').val();
    //var vendorchoice = $('name=vendorchoice').prop('checked');
    var vendorchoice = $("input[type='radio'][name='vendorchoice']").val();
   
    if (recomm == "" || !$("input[name='vendorchoice']:checked").val()) {
        $('#maintError').html('You must enter a Recommendation and choose a Vendor');
    } else {
        $('#maintError').html('Approving Request, Please wait...').addClass('errorRed');
        $.post(action, $('#requestApproval').serialize(), function (data) {
            if (data.msg) {
                $('#maintError').html(data.msg).addClass('errorGreen');
                setTimeout(function () { window.top.location =  GLOBALS.appRoot + "assetmgt/joborder/" });
                $('#recomm').val('');
            }

        });

    }

}

//APPROVING ASSETS
function notapprove(id) {

    var action = GLOBALS.appRoot + "assetmgt/notapproveformaintenance";
    var assetID = $('#assetID').val();
    var theID = $('#theID').val();
    var recomm = $('#recomm').val();
    var vendorchoice = $("input[type='radio'][name='vendorchoice']").val();
     var dreasonID = $('#dreasonID').val(); 
    if (recomm == "") {
        $('#maintError').html('You must enter a comment');
    } else {
        $('#maintError').html('Approving Request, Please wait...').addClass('errorRed');
        $.post(action, $('#requestApproval').serialize(), function (data) {
            if (data.msg) {
                $('#maintError').html(data.msg).addClass('errorGreen');
                 setTimeout(function () { window.top.location = GLOBALS.appRoot + "assetmgt/joborder/" });
                $('#recomm').val('');
            }

        });

    }

}


//This section deals search by date and account officer and category
  $('#cashiersExport').click(function () {
      
          var status = $('#status').val();
          var cashiersStartDate = $('#cashiersStartDate').val();
          var cashiersEndDate = $('#cashiersEndDate').val();
          
        if(cashiersStartDate =="" || cashiersEndDate =="" || status ==""){
            alert("Please enter a Start and End Date");
         }else{
             $('#results').html('Loading Result, Please wait.....');
            $.ajax({
               url : GLOBALS.appRoot + "reports/cashiersearch",
               method : "POST",
               data: {cashiersStartDate: cashiersStartDate, cashiersEndDate : cashiersEndDate, status : status},
               dataType : "text",
               success : function (data){
                   $('#results').html(data);
               }
            });
        }
});


//This section deals search by date and account officer and category
  $('#cashiersactExport').click(function () {
      
          var status = $('#status').val();
          var cashiersactStartDate = $('#cashiersactStartDate').val();
          var cashiersactEndDate = $('#cashiersactEndDate').val();
          
        if(cashiersactStartDate =="" || cashiersactEndDate =="" || status ==""){
            alert("Please enter a Start and End Date");
         }else{
             $('#results').html('Loading Result, Please wait.....');
            $.ajax({
               url : GLOBALS.appRoot + "reports/actcashiersearch",
               method : "POST",
               data: {cashiersactStartDate: cashiersactStartDate, cashiersactEndDate : cashiersactEndDate, status : status},
               dataType : "text",
               success : function (data){
                   $('#results').html(data);
               }
            });
        }
});


//This section deals search by date and account officer and category
  $('#catsearchbydaterejected').click(function () {
      
          var status = $('#status').val();
          var catStartDaterejected = $('#catStartDaterejected').val();
          var catEndDaterejected = $('#catEndDaterejected').val();
          
        if(catStartDaterejected =="" || catEndDaterejected =="" || status ==""){
            alert("Please enter a Start and End Date");
         }else{
             $('#results').html('Loading Result, Please wait.....');
            $.ajax({
               url : GLOBALS.appRoot + "reports/rejectedactcashiersearch",
               method : "POST",
               data: {catStartDaterejected: catStartDaterejected, catEndDaterejected : catEndDaterejected, status : status},
               dataType : "text",
               success : function (data){
                   $('#results').html(data);
               }
            });
        }
});



//Beginning of Setup for Location
$('.addmoremodeytocashier').click(function(e){
    var action = GLOBALS.appRoot+"Changecashier/addmoremoney";
    var idwhochangeit = $('#idwhochangeit').val();
     var emailwhochangeit = $('#emailwhochangeit').val();
    var cashieremail = $('#cashieremail').val();
    var tillbalance = $('#tillbalance').val();
    var tillID = $('#tillID').val();
    var addAmount = $('#addAmount').val();
    var tillName = $('#tillName').val();
    if(idwhochangeit == "" || addAmount == ""){
        $('#tillError').html("Please make sure all fields are filled").addClass("alert alert-danger");
    }else{
            
           $('#tillError').html("Processing Adding Amount, Please wait...");  
                $.post(action, {idwhochangeit: idwhochangeit, idwhochangeit: idwhochangeit, emailwhochangeit: emailwhochangeit, 
                cashieremail: cashieremail, tillbalance: tillbalance, tillID: tillID, addAmount: addAmount, tillName: tillName},  function(data){
			if(data.msg){
                        $('#tillError').html(data.msg).addClass("alert alert-success");
			$('#addAmount').val('');
                        setTimeout(function(){window.top.location= GLOBALS.appRoot + "home/cashierlimit/"} , 100);
			}else if(data.msgEror){
                         $('#tillError').html(data.msgEror).addClass("alert alert-danger");   
                        }
		})
                 .fail(function() {
                    $('#tillError').html("Error Loading Data, Please try again").addClass("alert alert-danger");
                   
                  });
    }
    
});


$('#notcashieradminconfirmpay').click(function(e){
    var action = GLOBALS.appRoot + "paycheques/makedpaymentnotillforadmin";
    var transactID = $('#transactID').val();
    var dcashierwhosentit = $('#dcashierwhosentit').val();
    var paymentCode = $('#paymentCode').val();
    var nPaymentTypes = $('#nPaymentTypes').val();
    var dAmount = $('#dAmount').val();
    var payee = $('#payee').val();
  
   
    if(transactID == ""){
        $('#insurerror').html("Please make sure all fields are filled").addClass('alert alert-danger');
    }else{
        $('#insurerror').html('Making Payment, Please wait.....').addClass('errorRed');
         $.post(action, {payee: payee, dAmount: dAmount, nPaymentTypes: nPaymentTypes, transactID: transactID}, function (data) {
              if (data.msg) {
                  $('#insurerror').html(data.msg).addClass('alert alert-success')
                setTimeout(function(){window.top.location= GLOBALS.appRoot + "paycheques/makenormalpaymentforuser/"} , 1000);
             }else if (data.warr) {
                  $('#insurerror').html(data.warr).addClass('alert alert-warning')
             }
         });
    }
});

 //This section deals search by date and account officer and category
  $('#searchReportbyhod').click(function () {
          var status = $('#status').val();
          var dateCreatedfrom = $('#dateCreatedfrom').val();
          var dateCreatedTo = $('#dateCreatedTo').val();
          
        if(dateCreatedfrom =="" || dateCreatedTo =="" || status ==""){
            alert("Please enter a Start and End Date");
         }else{
             $('#resultpage').html('Loading Result, Please wait.....');
            $.ajax({
               url : GLOBALS.appRoot + "supports/getmoresearchresults",
               method : "POST",
               data: {dateCreatedfrom: dateCreatedfrom, dateCreatedTo : dateCreatedTo, status : status},
               dataType : "text",
               success : function (data){
                   $('#resultpage').html(data);
               }
            }).fail(function() {
                    $('#resultpage').html("<br/>Error Loading Data, Please try again");
                   
                  });
        }
     });
  
   $('.rejectPay').click(function (e) {
            var id = $(this).attr('data-id');
            
            var outputs = '<p id="deprocess"><h3 class="btn btn-block btn-fill btn-primary btnblue">Are you Sure?</h3></p><textarea class="" rows="3" name="dComment" id="dComment" cols="55" placeholder="This request will be rejected, please enter the reject reason"></textarea><br/><button onClick="accountrejectingrequest('+id+')" class="btn btn-xs btn-fill btn-primary">OK</button>';
            $('#myacctputalert').html(outputs);
    });
  
  function accountrejectingrequest(id){
   
   var action = GLOBALS.appRoot+"action/cancelnewrequestbyaccount";
    var rejectrequestID = id;
    var dComment = $('#dComment').val();
    
    if(dComment == ""){
        $('#deprocess').html("Please enter a comment").addClass('errorRed');
    }else{  
           $('#deprocess').html("Rejecting Request, Please wait...");  
                $.post(action, {rejectrequestID: rejectrequestID, dComment: dComment},  function(data){
			if(data.msg){
                        $('#deprocess').html(data.msg).addClass('errorGreen');
			//setTimeout(function(){window.top.location= GLOBALS.appRoot + "home/myapproval/"} , 100);
                         setTimeout(function(){ window.location.reload(1); }, 100);
			}
		})
                 .fail(function() {
                    $('#rejectrequest').html("Error Loading Data, Please try again");
                  });
    }
}

 $('#updateProfileRecord').click(function () {
    var action = GLOBALS.appRoot+"profiledit/updatedetails";
    var phoneNum = $('#phoneNum').val();
    var altEmail = $('#altEmail').val();
    var pEmail = $('#pEmail').val();
    var fname = $('#fname').val();
    var lname = $('#lname').val();
    var fLocation = $('#fLocation').val();
    var fUnit = $('#fUnit').val();
    
    if(pEmail == ""){
        $('#errorCase').html("Your primary email cannot be empty");
    }else{
        $('#errorCase').html("Processing" + "<img src=" + GLOBALS.appRoot + "public/images/loading.gif >");
         $('#updateProfileRecord').hide();
          $.post(action, {fname: fname, lname: lname, fLocation: fLocation, fUnit: fUnit, phoneNum: phoneNum, altEmail: altEmail, pEmail: pEmail},  function(data){
            if(data.msg){
               $('#errorCase').html(data.msg).addClass('errorGreen');
                    setTimeout(function(){ window.location.reload(1); }, 500);
		}
            }).fail(function() {
                $('#errorCase').html("Error Loading Data, Please try again");
                $('#updateProfileRecord').show();
          });
    }
     
 });
 
 
 $('#addAccount').click(function (e) {
        var action = GLOBALS.appRoot + "accountcode/addcode";
        var codeaccountname = $('#codeaccountname').val();
       
        if (codeaccountname === "") {
            $('#showError').html("Please select Code").addClass("errorRed");
        } else {
            $('#showError').html("Adding Code to Unit, Please wait...");
            $.post(action, {codeaccountname: codeaccountname}, function (data) {
                if (data.status == 1) {
                    $('#showError').html(data.msg).addClass("errorGreen");
                    $('#codeaccountname').val('');
                    
                    setTimeout(function () {
                        window.location.reload(1);
                    }, 100);
                }else if(data.status == 0){
                   $('#showError').html(data.msg).addClass("errorRed"); 
                }else if(data.status == 2){
                   $('#showError').html(data.msg).addClass("errorRed"); 
                }
            })
                    .fail(function () {
                        $('#showError').html("Error Loading Data, Please try again").addClass("alert alert-danger");
                    });
        }

    });