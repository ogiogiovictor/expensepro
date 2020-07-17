
/**
 * @copyright: Ognocom Nigeria 2015, All Rights Reserved.
 * @author: Ogiogio Victor
 * @contact: 2347038807891
 * @email: ogiogiovictor@gmail.com
 * 
 */

function processApprovalnothod(id) {
    var r = confirm("Are you sure you want to approve this request!");
    if (r == true) {
        var action = GLOBALS.appRoot + "dprocess/hodapprovalinside";
        var acceptrequestID = $('#acceptrequestID').val();
        $('#acceptrequest').html("Approving Request, Please wait...");
        $.post(action, { acceptrequestID: acceptrequestID }, function (data) {
            if (data.msg) {
                $('#acceptrequest').html(data.msg).addClass('errorGreen');
                setTimeout(function () { window.top.location = GLOBALS.appRoot + "home/myapproval/" }, 100);
            }
        })
            .fail(function () {
                $('#acceptrequest').html("Error Loading Data, Please try again");
            });

    }

}
/*
$(document).on('click', '#processApprovalnothod', function(e) { 
var action = GLOBALS.appRoot+"dprocess/hodhasapproval";
                    var acceptrequestID = $('#acceptrequestID').val();
                    var dComment = $('#dComment').val();
                    var hodEmail = $('#hodEmail').val();
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
          
});

*/


function processApprovalwithhod(id) {
    var r = confirm("Are you sure you want to approve this request!");
    if (r == true) {
        var action = GLOBALS.appRoot + "dprocess/hodapprovalinside";
        var acceptrequestID = id;

        $('#icuacceptrequest').html("Approving Request, Please wait...");
        $('.rejectrequestID').attr('disabled', 'disabled');
        $.post(action, { acceptrequestID: acceptrequestID }, function (data) {
            if (data.msg) {
                $('#icuacceptrequest').html(data.msg).addClass('errorGreen');
                setTimeout(function () { window.top.location = GLOBALS.appRoot + "home/myapproval/" }, 100);
            }
        })
            .fail(function () {
                $('#icuacceptrequest').html("Error Loading Data, Please try again");
            });
    }
}


function icuapprovefunction(id, icus, amount) {
    var action = GLOBALS.appRoot + "dprocess/icuapproval";
    var icuacceptrequestID = id;
    var groupIDinICU = icus;
    var mainAmount = amount;

    var r = confirm("Are you sure you want to approve this request!");
    if (r == true) {
        // if(icuacceptrequestID == "" || groupIDinICU == "" || mainAmount == "" || mainAmount == "0" ){
        if (icuacceptrequestID == "" || groupIDinICU == "") {
            $('#icuacceptrequest').html("Important Variable to process this page is missing, Please contact Administrator").addClass('errorRed');
        } else {

            $('#icuacceptrequest').html("Approving Request, Please wait...");
            $.post(action, { icuacceptrequestID: icuacceptrequestID, groupIDinICU: groupIDinICU, mainAmount: mainAmount }, function (data) {
                if (data.msg) {
                    $('#icuacceptrequest').html(data.msg).addClass('errorGreen');
                    //setTimeout(function(){window.top.location= GLOBALS.appRoot + "home/myapproval/"} , 100);
                } else if (data.msgError) {
                    $('#icuacceptrequest').html(data.msgError).addClass('errorRed');
                }
            })
                .fail(function () {
                    $('#icuacceptrequest').html("Error Loading Data, Please try again");
                });
        }

    }
}


//BEGINNING OF MODAL FOR ACCOUNT PAYABLE
$('.rejectrequestIDICU').click(function (e) {
    var id = $(this).attr('id');

    var outputs = '<p id="deprocess"><h3 class="btn btn-block btn-fill btn-primary btnblue">Are you Sure?</h3></p><textarea class="" rows="3" name="commentfromicu" id="commentfromicu" cols="55" placeholder="Please add comment"></textarea><br/><button onClick="icurejectrequestapproval(' + id + ')"  class="btn btn-xs btn-fill btn-primary">OK</button>';
    $('#myacctputalert').html(outputs);
});


function icurejectrequestapproval(id) {
    //$('.forcommentdisplayforicuonly').show();
    var action = GLOBALS.appRoot + "dprocess/newicurejection";
    var icurejectrequestID = id;
    var commentfromicu = $('#commentfromicu').val();

    if (id == "" || commentfromicu == "") {
        $('#deprocess').html("Please add a comment").addClass('errorRed');
    } else {

        $('#deprocess').html("Rejecting Request, Please wait...");
        $('#processApprovalnothod').attr('disabled', 'disabled');
        $.post(action, { icurejectrequestID: icurejectrequestID, commentfromicu: commentfromicu }, function (data) {
            if (data.msg) {
                $('#deprocess').html(data.msg).addClass('errorGreen');;
                setTimeout(function () { window.top.location = GLOBALS.appRoot + "home/myapproval/" }, 100);
            } else if (data.msgError) {
                $('#deprocess').html(data.msgError).addClass('errorRed');
            }
        })
            .fail(function () {
                $('#deprocess').html("Error Loading Data, Please try again");
            });
    }

};


$('#processeditrequest').click(function (e) {

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

    /////////////////////////PROCESSING FORM VARIABLE FOR EXPENSE DETAILS //////////////////////////////

    var exDetailofpayment = $('#exDetailofpayment').val();
    var exAmount = $('#exAmount').val();
    var exCode = $('#exCode').val();
    var exDate = $('#exDate').val();
    var sumall = $('#sumall').val();

    ///////////////////////// END OF PROCESSING FORM VARIABLE FOR EXPENSE DETAILS //////////////////////////////
    var dataString = new FormData(document.getElementById('mainrequestformadvanceform')); //postArticles
    if (exDate == "" || exCode == "" || exDetailofpayment == "" || dateCreated == "" || dUnit == "" || exAmount == "" || descItem == "" || paymentType == "" || dhod == "" || dicu == "") {
        $('#showError').html("Please make sure all fields are filled").addClass("alert alert-danger");
    } else {
        $('#showError').html("Processing Request, Please wait...").addClass("alert alert-danger");
        $('#processnewrequestadvance').hide();
        $('#processeditrequest').hide();
        $('.loaderimg').show();
        $.ajax({
            type: "POST",
            url: GLOBALS.appRoot + "nopriveledge/advancenewrequest",
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
                } else if (data.status == 1) {
                    $('#showError').html(data.msg).addClass('alert alert-success');
                    $('#dateCreated').val(''); $('#fileUpload').val(''); $('#descItem').val('');
                    $('#itemCat').val(''); $('#paymentType').val(''); $('#dhod').val('');
                    $('#dicu').val(''); $('#dcashier').val('');
                    $('#benName').val(''); $('#dAmount').val('');
                    setTimeout(function () { window.top.location = GLOBALS.appRoot + "home/" }, 1000);

                }
                else if (data.status == 2) {
                    $('#showError').html(JSON.stringify(data.msg)).addClass('alert alert-secondary');
                    $('#processnewrequestadvance').show();
                } else if (data.status == 5) {
                    $('#showError').html(JSON.stringify(data.msg)).addClass('alert alert-primary');
                    $('#processnewrequestadvance').show();
                } else if (data.status == 3) {
                    $('#showError').html(JSON.stringify(data.msg)).addClass('alert alert-primary');
                    $('#processnewrequestadvance').show();
                } else if (data.status == 7) {
                    $('#showError').html(JSON.stringify(data.msg)).addClass('alert alert-primary');
                    $('#processnewrequestadvance').show();
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


function deleteImage(id) {
    var deleteid = id;
    var action = GLOBALS.appRoot + "nopriveledge/deleteimage";
    $.post(action, { deleteid: deleteid }, function (data) {
        if (data.msg) {
            $('#errormsg').html(data.msg);
            $(this).parent().remove();
            setTimeout(function () { window.location.reload(1); });
        }
    }).fail(function () {
        $('#errormsg').html("Sorry, There was a problem the image");
    });
    //postDataVal("POST", GLOBALS.appRoot + "nopriveledge/deleteimage", {tid: deleteid}, "JSON", _deleteimageItemSuccess(deleteid), "", null, null);
}



function approvecheques(id, group, amount) {

    var id = id;
    var dgroup = group;
    var mainAmount = amount;

    
    var r = confirm("Are you sure you want to Confirm this payment!!");
    if (r == true) {
        var action = GLOBALS.appRoot + "action/accountpayment";

        // if(id == "" || dgroup == "" || mainAmount == ""){
        if (id == "" || dgroup == "") {
            alert("important variable to process this request is missing, Please see the administrator");
            //$('#insurerror').html("Important Variable to process this request is missing <br/>").addClass('errorRed');
        } else {
            $('#icuacceptrequest').html('Confirming Payment, Please wait.....').addClass('errorRed');
            $('.theaccountantrejectedit').attr('disabled', 'disabled');
            $.post(action, { id: id, dgroup: dgroup, mainAmount: mainAmount }, function (data) {
                if (data.msg) {
                    $('#icuacceptrequest').html(data.msg).addClass('alert alert-success')
                    //setTimeout(function(){window.top.location= GLOBALS.appRoot + "home/myapproval/"});
                    setTimeout(function () { window.top.location = GLOBALS.appRoot + "accounts/index/" });
                } else if (data.warr) {
                    $('#icuacceptrequest').html(data.warr).addClass('errorRed')
                }
            });
        }
    } else {
        alert("You did not confirm payment! Payment was not made.");
    }
}




function cancethisrequest(id, group, amount) {
    var id = id;
    var dgroup = group;
    var mainAmount = amount;

    var r = confirm("Are you sure you want to Cancel Payment!!");
    if (r == true) {
        var action = GLOBALS.appRoot + "action/cancelnewrequestbyaccount";

        //if(id == "" || dgroup == "" || mainAmount == ""){
        if (id == "" || dgroup == "") {
            alert("important variable to process this request is missing, Please see the administrator");
            //$('#insurerror').html("Important Variable to process this request is missing <br/>").addClass('errorRed');
        } else {
            $('#icuacceptrequest').html('Cancelling Payment, Please wait.....').addClass('errorRed');
            $.post(action, { id: id, dgroup: dgroup, mainAmount: mainAmount }, function (data) {
                if (data.msg) {
                    $('#icuacceptrequest').html(data.msg).addClass('alert alert-success')
                    setTimeout(function () { window.top.location = GLOBALS.appRoot + "home/myapproval/" });
                } else if (data.warr) {
                    $('#icuacceptrequest').html(data.warr).addClass('errorRed')
                }
            });
        }
    }
}



//$(document).ready(function () {
//BEGINNING OF MODAL FOR ACCOUNT PAYABLE
$('.theaccountantrejectedit').click(function (e) {
    var id = $(this).attr('data-id');

    var outputs = '<p id="deprocess"><h3 class="btn btn-block btn-fill btn-primary btnblue">Are you Sure?</h3></p><textarea class="" rows="3" name="dComment" id="dComment" cols="55" placeholder="This request will be rejected, please enter the reject reason"></textarea><br/><button onClick="accountrejectingrequest(' + id + ')" class="btn btn-xs btn-fill btn-primary">OK</button>';
    $('#myacctputalert').html(outputs);
});

//});

function accountrejectingrequest(id) {

    var action = GLOBALS.appRoot + "action/cancelnewrequestbyaccount";
    var rejectrequestID = id;
    var dComment = $('#dComment').val();

    if (dComment == "") {
        $('#deprocess').html("Please enter a comment").addClass('errorRed');
    } else {
        $('#deprocess').html("Rejecting Request, Please wait...");
        $.post(action, { rejectrequestID: rejectrequestID, dComment: dComment }, function (data) {
            if (data.msg) {
                $('#deprocess').html(data.msg).addClass('errorGreen');
                setTimeout(function () { window.top.location = GLOBALS.appRoot + "home/myapproval/" }, 100);
            }
        })
            .fail(function () {
                $('#rejectrequest').html("Error Loading Data, Please try again");
            });
    }
}


$(function () {
    $('.cashiersreimbursement').click(function (e) {
        var action = GLOBALS.appRoot + "dprocess/printcashiersreimbursementrequest/";
        var reqid = $(this).attr('data-id');
        var newWindow = window.open(action + reqid, 'Cheque Request', 'width=800, height=600');
        //newWindow.document.getElementById("output").innerHTML;
        newWindow.print();
    });

});



function reimbursedcashiers(id, Amount) {
    var action = GLOBALS.appRoot + "action/preparecashierscheque";
    var cashiserEmail = $('#cashiserEmail').val();
    var newid = id;
    var newamounts = Amount;

    var r = confirm("Are you sure you want to reimburse this cashier with this Amount" + newamounts);
    if (r == true) {
        if (cashiserEmail == "" || newid == "" || newamounts == "") {
            $('#errorme').html("Please make sure all fields are filled").addClass("errorRed");
        } else {
            $('#errorme').html("Approving Cashiers Reimbursement, Please wait...").addClass("errorGreen");
            $.post(action, { newid: newid, newamounts: newamounts, cashiserEmail: cashiserEmail }, function (data) {
                if (data.msg) {
                    $('#errorme').html(data.msg).addClass('alert alert-success');
                    setTimeout(function () { window.top.location = GLOBALS.appRoot + "home/requestforpayment/" }, 1000);
                } else if (data.error) {
                    $('#errorme').html(data.error).addClass('alert alert-danger');
                }

            });
        }
    }
}


$('.sendpaymentCode').click(function (e) {
    var reqid = $(this).attr('id');
    var action = GLOBALS.appRoot + "home/mypaymentcode";

    if (reqid == "") {
        $('#pCodeStatus').html("Important Variable to send payment Code is Empty. Please contact administrator").addClass("errorRed");
    } else {
        $('#pCodeStatus').html("Sending payment Code, Please wait...").addClass("errorRed");
        $.post(action, { reqid: reqid }, function (data) {
            //setTimeout(function(){window.top.location= GLOBALS.appRoot + "home"} , 1000);  
            if (data.msg) {
                $('#pCodeStatus').html(data.msg).addClass('errorGreen')
            }

        });
    }
})


$('#changelocationnow').click(function (e) {
    var locationchanging = $('#locationchanging').val();
    var groupName = $('#groupName').val();
    var action = GLOBALS.appRoot + "location/changegrouplocation";

    if (groupName == "" || locationchanging == "") {
        $('#pCodeStatus').html("Important variables to processing this page is missing. please select group location").addClass("errorRed");
    } else {
        $('#pCodeStatus').html("Processing Request").addClass("errorRed");
        $.post(action, { groupName: groupName, locationchanging: locationchanging }, function (data) {
            setTimeout(function () { window.top.location = GLOBALS.appRoot + "home/myapproval" }, 1000);
            if (data.msg) {
                $('#pCodeStatus').html(data.msg).addClass('errorGreen');
            }

        });
    }

});



$('.sendnewcahsierrequest').click(function (e) {
    var action = GLOBALS.appRoot + "changecashier/changecashdetails";
    var postID = $('#postID').val();
    var approveID = $('#approveID').val();
    var sessionID = $('#sessionID').val();
    var changemyicu = $('#changemyicu').val();
    var changemycashier = $('#changemycashier').val();

    if (postID == "" || sessionID == "" || approveID == "") {
        $('#cashierError').html("Important variables to processing this page is missing. please select group location").addClass("errorRed");
    } else {
        $('#cashierError').html("Processing Request, please wait...").addClass("errorRed");
        $.post(action, { approveID: approveID, postID: postID, sessionID: sessionID, changemyicu: changemyicu, changemycashier: changemycashier }, function (data) {

            if (data.msg) {
                $('#cashierError').html(data.msg).addClass('errorGreen');
                setTimeout(function () { window.top.location = GLOBALS.appRoot + "home" }, 1000);
            } else if (data.msgError) {
                $('#cashierError').html(data.msgError).addClass('errorGreen');
            }

        });
    }


});



$('.nowchangetonewcashier').click(function (e) {
    var action = GLOBALS.appRoot + "changecashier/attachnewcasher";
    var idwhochangeit = $('#idwhochangeit').val();
    var emailwhochangeit = $('#emailwhochangeit').val();
    var oldchashieremail = $('#oldchashieremail').val();
    var tillType = $('#tillType').val();
    var tillbalance = $('#tillbalance').val();
    var newcashier = $('#newcashier').val();
    var tillID = $('#tillID').val();

    if (idwhochangeit == "" || emailwhochangeit == "" || oldchashieremail == "" || tillType == "" || newcashier == "") {
        $('#tillError').html("Important variables to processing this page is missing. Please make sure all fields are filled").addClass("errorRed");
    } else {
        $('#tillError').html("Processing Request, please wait...").addClass("errorRed");
        $.post(action, {
            tillID: tillID, idwhochangeit: idwhochangeit, emailwhochangeit: emailwhochangeit,
            oldchashieremail: oldchashieremail, tillType: tillType, newcashier: newcashier, tillbalance: tillbalance
        }, function (data) {
            if (data.msg) {
                $('#tillError').html(data.msg).addClass('errorGreen');
                setTimeout(function () { window.top.location = GLOBALS.appRoot + "home/cashierlimit" }, 1000);
            } else if (data.msgError) {
                $('#tillError').html(data.msgError).addClass('errorGreen');
            }

        });
    }


});


function printchequerequests(id) {
    var action = GLOBALS.appRoot + "dprocess/printrequestdetails/" + id;
    //var reqid = $(this).attr('data-id');
    var newWindow = window.open(action, 'Cheque Request', 'width=800, height=600');
    //newWindow.document.getElementById("output").innerHTML;
    newWindow.print();
}

function printchequerequestswithmaintenance(id) {
    var action = GLOBALS.appRoot + "paycheques/printrequestdetailsbymaintenance/" + id;
    //var reqid = $(this).attr('data-id');
    var newWindow = window.open(action, 'Cheque Request', 'width=800, height=600');
    //newWindow.document.getElementById("output").innerHTML;
    newWindow.print();
}


$('#changelocationnowsupport').click(function (e) {
    var locationchanging = $('#locationchanging').val();
    var groupName = $('#groupName').val();
    var action = GLOBALS.appRoot + "location/changegrouplocation";

    if (groupName == "" || locationchanging == "") {
        $('#showError').html("Important variables to processing this page is missing. please select group location").addClass("errorRed");
    } else {
        $('#showError').html("Processing Request").addClass("errorRed");
        $.post(action, { groupName: groupName, locationchanging: locationchanging }, function (data) {
            setTimeout(function () { window.top.location = GLOBALS.appRoot + "supports/getphenugu" }, 1000);
            if (data.msg) {
                $('#showError').html(data.msg).addClass('errorRed');
            }

        });
    }

});



function icumustconfirm(id, Amount) {
    var action = GLOBALS.appRoot + "action/confirmreimbursementrequest";
    var newid = id;
    var newamounts = Amount;

    var r = confirm("Are you sure you want to confirm this  " + newamounts + " Please make sure user has posted to sage");
    if (r == true) {
        if (newid == "" || newamounts == "") {
            $('#errorme').html("Important variable to process this page is missing, please see I.T").addClass("errorRed");
        } else {
            $('#errorme').html("Confirming Reimbursement, Please wait...").addClass("errorGreen");
            $.post(action, { newid: newid, newamounts: newamounts }, function (data) {

                if (data.msg) {
                    $('#errorme').html(data.msg).addClass('alert alert-success');
                    setTimeout(function () { window.top.location = GLOBALS.appRoot + "home/requestforpayment/" }, 1000);
                } else if (data.error) {
                    $('#errorme').html(data.error).addClass('alert alert-danger');
                }

            });
        }

    }
}





////////////////////////////////////////////////  CHEQUE PRINTING ////////////////////////////////////////////////////

//BEGINNING OF MODAL FOR ACCOUNT PAYABLE
$('.putbackforcheque').click(function (e) {
    var id = $(this).attr('data-id');

    var outputs = '<p id="deprocess"><h3 class="btn btn-block btn-fill btn-primary btnblue">Add Cheque Back Details</h3></p><textarea class="" rows="3" name="dChequeBack" id="dChequeBack" cols="55" placeholder="Add the Content that will appear at the back of the cheque"></textarea><br/><button onClick="fillchequeback(' + id + ')" class="btn btn-xs btn-fill btn-primary">OK</button>';
    $('#myacctputalert').html(outputs);
});

//});

function fillchequeback(id) {

    var action = GLOBALS.appRoot + "home/pushcontentatback";
    var chequeID = id;
    var dChequeBack = $('#dChequeBack').val();

    if (dChequeBack == "") {
        $('#deprocess').html("Please enter cheque content").addClass('errorRed');
    } else {
        $('#deprocess').html("Adding Content, Please wait...");
        $.post(action, { chequeID: chequeID, dChequeBack: dChequeBack }, function (data) {
            if (data.status == 200) {
                $('#deprocess').html(data.msg).addClass('errorGreen');
                setTimeout(function () { window.top.location = GLOBALS.appRoot + "home/printerback/" + chequeID }, 100);
            }
        })
            .fail(function () {
                $('#rejectrequest').html("Error Loading Data, Please try again");
            });
    }
}


//BEGINNING OF MODAL FOR ACCOUNT PAYABLE
var payeeaction = GLOBALS.appRoot + "travels/getallpayee/";
//var outputs = '';
$('.changepayee').click(function (e) {
    var id = $(this).attr('data-id');
    fetch(payeeaction)
        .then((res) => res.json())
        .then((data) => {
            var outputs = "<p id='deprocess'><h3 class='btn btn-block btn-fill btn-primary btnblue'>Change Payee Name</h3><select name='payeeL' id='payeeL' class='form-control'>";
            for (var x = data.length - 1; x >= 0; x--) {
                outputs += '<option value="' + data[x].id + '">' + data[x].workshop_name + '</option>';
            }
            outputs += "</select></p><br/><button onClick='pushbypayee("+id+")' class='btn btn-xs btn-fill btn-primary'>UPDATE</button>";

            $('#myacctputalert').html(outputs);
        });

    //$('#myacctputalert').html(outputs);
});


function pushbypayee(id) {
    var updatepayeeaction = GLOBALS.appRoot + "home/updatepayeetoanother/";
    var payeeL = document.getElementById('payeeL').value;
    var requestID = id;
    $('#deprocess').html("Updating Payee Name, Please wait...");
    $.post(updatepayeeaction, { payeeL: payeeL, requestID: requestID }, function (data) {
        if (data.status == 200) {
            $('#deprocess').html(data.msg).addClass('errorGreen');
            $('#myacctputalert').html('');
        }
    })
        .fail(function () {
            $('#deprocess').html("Error Loading Data, Please try again");
        });
}




function processwithmd(id) {
    var r = confirm("Are you sure you want to approve this request!");
   
    if (r == true) {
        var action = GLOBALS.appRoot + "dprocess/mdapprovalinside";
        var acceptrequestID = id;

        $('#icuacceptrequest').html("Approving Request, Please wait...");
        $('.rejectrequestID').attr('disabled', 'disabled');
        $.post(action, { acceptrequestID: acceptrequestID }, function (data) {
            if (data.msg) {
                $('#icuacceptrequest').html(data.msg).addClass('errorGreen');
                setTimeout(function () { window.top.location = GLOBALS.appRoot + "home/myapproval/" }, 100);
            }
        })
            .fail(function () {
                $('#icuacceptrequest').html("Error Loading Data, Please try again");
            });
    }
}