$(document).ready(function () {

    /* PER DIEM AND HOTELL 
     $('select[name="logistics"]').on('change',function(){
     var  logsit = $(this).val();
     if(logsit === "perdiem"){
     $('.perdiemTravels').show();
     $('.perdiemTravels').removeAttr('style');
     $('.hoteldetails').hide();
     }else if(logsit === "hotel"){
     $('.hoteldetails').show();
     $('.hoteldetails').removeAttr('style');
     $('.perdiemTravels').hide();
     }else if(logsit ==""){
     $('.perdiemTravels').hide();
     $('.hoteldetails').hide();
     }
     
     });
     /* END OF PER DIEM AND HOTELL */

    $('#staffID').on('input', function () {
        var input = $(this);
        var is_staffID = input.val();
        if (is_staffID) {
            input.removeClass("invalid").addClass("valid");
        } else {
            input.removeClass("valid").addClass("invalid");
        }
    });

    $('#warefoffice').on('input', function () {
        var input = $(this);
        var is_staffID = input.val();
        if (is_staffID) {
            input.removeClass("invalid").addClass("valid");
        } else {
            input.removeClass("valid").addClass("invalid");
        }
    });


    $('#benName').on('input', function () {
        var input = $(this);
        var is_staffID = input.val();
        if (is_staffID) {
            input.removeClass("invalid").addClass("valid");
        } else {
            input.removeClass("valid").addClass("invalid");
        }
    });

    $('#benEmail').on('input', function () {
        var input = $(this);
        var is_staffID = input.val();
        if (is_staffID) {
            input.removeClass("invalid").addClass("valid");
        } else {
            input.removeClass("valid").addClass("invalid");
        }
    });


    $('#exsDate').on('input', function () {
        var input = $(this);
        var is_staffID = input.val();
        if (is_staffID) {
            input.removeClass("invalid").addClass("valid");
        } else {
            input.removeClass("valid").addClass("invalid");
        }
    });


    $('#exrDate').on('input', function () {
        var input = $(this);
        var is_staffID = input.val();
        if (is_staffID) {
            input.removeClass("invalid").addClass("valid");
        } else {
            input.removeClass("valid").addClass("invalid");
        }
    });


    $('#hodEmail').on('input', function () {
        var input = $(this);
        var is_staffID = input.val();
        if (is_staffID) {
            input.removeClass("invalid").addClass("valid");
        } else {
            input.removeClass("valid").addClass("invalid");
        }
    });


    $('#logistics').on('input', function () {
        var input = $(this);
        var is_staffID = input.val();
        if (is_staffID) {
            input.removeClass("invalid").addClass("valid");
        } else {
            input.removeClass("valid").addClass("invalid");
        }
    });


    $('#purpose').on('input', function () {
        var input = $(this);
        var is_staffID = input.val();
        if (is_staffID) {
            input.removeClass("invalid").addClass("valid");
        } else {
            input.removeClass("valid").addClass("invalid");
        }
    });


    $('#benEmail').on('input', function () {
        var input = $(this);
        var re = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        var is_email = re.test(input.val());
        if (is_email) {
            input.removeClass("invalid").addClass("valid");
        } else {
            input.removeClass("valid").addClass("invalid");
        }
    });



    /***********************SUBMITTION GOES HERE *****************************************/
    // After Form Submitted Validation
    $("#nowSubmit").click(function (event) {


        var staffID = $('#staffID').val();
        var benName = $('#benName').val();
        var benEmail = $('#benEmail').val();

        var sDate = $('#exsDate').val();
        var rDate = $('#exrDate').val();
        var hodEmail = $('#hodEmail').val();
        var logistics = $('#logistics').val();
        var purpose = $('#purpose').val();

        var tFromlocation = $('#tFromlocation').val();
        var tTolocation = $('#tTolocation').val();
        var warefoffice = $('#warefoffice').val();
        var upfile = $('#upfile').val();

        
        if(upfile === ""){
            alert("Please upload approval your HOD approval as attachment before your can travel' ");
            return; 
        }
        
        if (tTolocation === "" || tFromlocation == "") {
            alert("Please choose your from and to location under 'Trip / Local Transport' ");
            return;
        }

        if (staffID === "") {
            $('#staffID').addClass('errorMsgTravel');
            $('.errorNo').html("**Required**");
        } else {
            $('.errorNo').hide();
        }

        if (warefoffice === "") {
            $('#warefoffice').addClass('errorMsgTravel');
            $('.errorWarefare').html("**Required**");
        } else {
            $('.errorWarefare').hide();
        }

        if (benName == "") {
            $('#benName').addClass('errorMsgTravel');
            $('.errorName').html("**Enter Name**");
        } else {
            $('.errorName').hide();
        }

        if (benEmail == "" || validateEmail(benEmail) == false) {
            $('#benEmail').addClass('errorMsgTravel');
            $('.errorEmail').html("**Enter Valid Email**");
        } else {
            $('.errorEmail').hide();
        }

        if (sDate == "") {
            $('#exsDate').addClass('errorMsgTravel');
            $('.serror').html("**Enter Period**");
        } else {
            $('.serror').hide();
        }

        if (rDate == "") {
            $('#exrDate').addClass('errorMsgTravel');
            $('.rerror').html("**Enter Period**");
        } else {
            $('.rerror').hide();
        }


        if (hodEmail == "") {
            $('#hodEmail').addClass('errorMsgTravel');
            $('.errorHOD').html("**Select HOD**");
        } else {
            $('.errorHOD').hide();
        }

        if (logistics == "") {
            $('#logistics').addClass('errorMsgTravel');
            $('.errorLog').html("**Select Logistic**");
        } else {
            $('.errorLog').hide();
        }

        var bankName = $('#bankName').val();
        var acctNum = $('#acctNum').val();
        var dHotels = $('#dHotels').val();

        if (rDate < sDate) {
            alert("returned date cannot be greater than start date");
            return;
        }

        var input = $(this);
        $('#tFromlocation').each(function () {
            var count = 1;
            if ($(this).val() === "") {
                //error += "<p>Please select or to location</p>";
                input.removeClass("valid").addClass("invalid");
                return false;
            }
            count = count + 1;
        });

        $('#tTolocation').each(function () {
            var count = 1;
            if ($(this).val() === "") {
                //error += "<p>Please select or to location</p>";
                input.removeClass("valid").addClass("invalid");
                return false;
            }
            count = count + 1;
        });

        $('#exrDate').each(function () {
            var count = 1;
            if ($(this).val() === "") {
                //error += "<p>Make sure dates are collected</p>";
                input.removeClass("valid").addClass("invalid");
                return false;
            }
            count = count + 1;
        });


        $('#exsDate').each(function () {
            var count = 1;
            if ($(this).val() === "") {
                //error += "<p>Make sure dates are collected</p>";
                input.removeClass("valid").addClass("invalid");
                return false;
            }
            count = count + 1;
        });


        $('#logistics').each(function () {
            var count = 1;
            if ($(this).val() === "") {
                //error += "<p>Make sure dates are collected</p>";
                input.removeClass("valid").addClass("invalid");
                return false;
            }
            count = count + 1;
        });

        if (staffID && benName && benEmail && sDate && rDate && hodEmail && logistics && warefoffice) {

            $('.mainError').html("Processing Flight Request, Please wait...").addClass('errorRed');
            $('#nowSubmit').attr('disabled', true);
            $('.mainError').append('<img src="https://c-iprocure.com/expensepro/public/images/loading.gif" style="width:20px"/>');
            var dataString = new FormData(document.getElementById('travelStartForm'));
            $.ajax({
                type: "POST",
                url: GLOBALS.appRoot + "travelstart/processform",
                processData: false,
                cache: false,
                contentType: false,
                data: dataString,
                dataType: "json",
                timeout: 600000,
                success: function (data) {
                    if (data.status === 3) {
                        $('#nowSubmit').attr('disabled', true);
                        $('#travelStartForm').fadeOut();
                        $('.mainError').fadeOut();
                        //$('#message').html(data.msg);
                        $('.myMessage').html(data.msg);
                        $('.myMessage').fadeIn();
                    } else if (data.status === 0) {
                        $('#nowSubmit').attr('disabled', false);
                        $('.mainError').html(data.msg).addClass('errorRed');
                    } else if (data.status === 1) {
                        $('#nowSubmit').attr('disabled', false);
                        $('.mainError').html(data.msg).addClass('errorRed');
                    } else if (data.status === 2) {
                        $('#nowSubmit').attr('disabled', false);
                        $('.mainError').html(data.msg).addClass('errorRed');
                    }

                },
                error: function () {
                    $('.mainError').html("Error Processing Request, Please Try Again..");
                    $('#nowSubmit').attr('disabled', false);
                }
            });
        }


    });


    /************************CHECKING FOR STAFF ID IN GET A JOB ***********************************************/
    $('#staffID').blur(function () {
        var action = GLOBALS.appRoot + "travelstart/processtravel/";
        var staffID = $('#staffID').val();
        if (!$.isNumeric(staffID)) {
            $('.errorNo').html("**Must be number**");
            $('#nowSubmit').attr('disabled', true);
        } else {
            $('#nowSubmit').attr('disabled', true);
            $('.errorNo').html("checking ");
            $('.errorNo').append('<img src="https://c-iprocure.com/expensepro/public/images/loading.gif" style="width:30px"/>');

            $.post(action + staffID, {staffID: staffID}, function (data) {
                if (data.msg === 'Confirmed') {
                    $('#nowSubmit').attr('disabled', false);
                    $('.errorNo').html("correct");
                    $('.errorNo').append('<img src="https://c-iprocure.com/expensepro/public/images/round_success.png" style="width:20px"/>');
                    $('#benName').val(data.staffname);
                    $('#benEmail').val(data.sEmail);
                    $('#sLevel').val(data.sLevel);
                    //alert(data.sLevel);

                } else if (data.msg === 'No_staff') {
                    $('#nowSubmit').attr('disabled', true);
                    $('.errorNo').html("Not a Staff");
                    $('.errorNo').append('<img src="https://c-iprocure.com/expensepro/public/images/round_error.png" style="width:20px"/>');
                    $('#benName').val('');
                    $('#benEmail').val('');
                }

            });

        }
    });



    /************************ BEGINNING OF LOAD PER DIEM **********************************/
    $('#listperdiem').html("<p style='color:red'>Loading perdiem, please wait...");
    $('#listperdiem').append('<img src="https://c-iprocure.com/expensepro/public/images/loading.gif" style="width:30px"/>');

    $.ajax({
        type: "GET",
        url: GLOBALS.appRoot + "travelstart/getperdiems",
        dataType: "json",
        timeout: 600000,
        success: _loadperdeimsSuccess,
        error: _loadperdeimsfalure
    });


    function _loadperdeimsSuccess(data, status) {
        if (typeof data !== 'object' || !isArray(data.perdiems)) {
            console.log("Unexpected server response: Status - " + status + " returnedData - " + JSON.stringify(data));
            $('#listperdiem').html("<p style='color:red'>There was a problem loading per diem items, please try again");
            return;
        }
        //perdiemCollect
        //tid, tlocation, tclass, tamount, tcurr, status
        if (data.perdiems.length) {
            //alert(data.perdiems.length);
            outputVar = '<table class="table table-responsive table-striped table-hover table-bordered"><tbody>';
            for (var idx = data.perdiems.length - 1; idx >= 0; --idx) {
                // _addPerdiemItem(data.perdiems[idx].tid, data.perdiems[idx].plocale, data.perdiems[idx].pClass, data.perdiems[idx].pAmount, data.perdiems[idx].pCurr);
                outputVar += '<tr><td>' + data.perdiems[idx].plocale + '</td><td>' + data.perdiems[idx].pClass + '</td> <td>' + data.perdiems[idx].pAmount + '</td> <td>' + data.perdiems[idx].pCurr + '</td><td><span title="delete item" id="' + data.perdiems[idx].tid + '" class="btn btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></span>&nbsp; <span title="edit item" id="' + data.perdiems[idx].tid + '" class="btn btn-xs btn-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span></td></tr>';
            }
            outputVar += '</tbody></table>';
            $('#listperdiem').html(outputVar);
        } else {
            $('#listperdiem').html("<p style='color:red'>No Per diem item");
        }
    }


    function _loadperdeimsfalure(request, status, errorMsg) {
        $('#loadingperdiem').html("<p style='color:red'>Sorry, We Could not load per diem");
        console.log("Error: request - " + JSON.stringify(request) + " | status "
                + status + " | errorMsg " + errorMsg);
    }




    /********************************************BEGINNING OF ADDING PER DIEM ****************************************/
    $('#perdiemAdd').click(function () {
        var pLocation = $('#pLocation').val();
        var sClass = $('#sClass').val();
        var perdiemAmount = $('#perdiemAmount').val();
        var sCurrency = $('#sCurrency').val();

        if (pLocation == "" || sClass == "" || perdiemAmount == "" || sCurrency == "") {
            $('#perdiemMsg').html("Please make sure all fields are filled").addClass('alert alert-danger');
        } else {
            $('#perdiemMsg').html("Processing request, please wait").addClass('errorRed');
            $('#perdiemAdd').attr('disabled', true);
            var dataString = new FormData(document.getElementById('addperdiemform'));
            $.ajax({
                type: "POST",
                url: GLOBALS.appRoot + "travelstart/postnewperdiem",
                processData: false,
                cache: false,
                contentType: false,
                data: dataString,
                dataType: "json",
                timeout: 600000,
                success: _perdiemSuccess,
                error: _addtodoFailure
            });

        }

    });


    function _perdiemSuccess(data, status) {
        //dashboard.config.todoMsgUIElem.html("");
        if (typeof data !== 'object' || typeof data.status !== 'number' || typeof data.msg !== 'string') {
            $('#perdiemMsg').html("Sorry, There was an error while trying to add perdiem");
            console.log("Unexpected server response: Status - " + status + " returnedData - " + JSON.stringify(data));
            return;
        }

        if (data.status) {
            _addPerdiemItem(data.tid, data.tlocation, data.tclass, data.tamount, data.tcurr, data.status);
            $('#pLocation').val('');
            $('#sClass').val('');
            $('#perdiemAmount').val('');
            $('#sCurrency').val('');
            //$('#perdiemMsg').html(data.msg).addClass('alert alert-success');
            $('#perdiemMsg').html(data.msg).addClass('errorGreen');
            $('#perdiemAdd').attr('disabled', false);
        } else {
            $('#perdiemMsg').html(data.msg).addClass('alert alert-warning');
        }

    }

    function _addPerdiemItem(tid, tlocation, tclass, tamount, tcurr, status) {
        var perdiemItemCt = 0;
        var perdiemItemTextPrefix = "per";
        var perdiemtodelete = "dI";
        var perdiemtoEdit = "ed";

        if (!perdiemItemCt) {
            $('#perdiemCollect').html("");
        }

        var perdieminfo = {};

        perdieminfo[tid] = {tlocation: tlocation, tclass: tclass, tamount: tamount, tcurr: tcurr, status: status};

        //$('#perdiemCollect').prepend('<li><span title="delete item" id="' + perdiemtodelete + '-' + tid + '" class="glyphicon glyphicon-remove" style="font-size:9px; color:#333333; padding:4px;"></span><span title="edit item" id="' + perdiemtoEdit + '-' + tid + '" class="glyphicon glyphicon-pencil" style="font-size:9px; color:#333333; padding:4px;cursor:pointer;"></span>' + '<span style="word-break:break-word;" id="' + perdiemItemTextPrefix + '-' + tid + '">' + tlocation + '</span>' + '<div class="pull-right hidden-xs"></div></li>');
        $('#perdiemCollect').prepend('<td>' + tlocation + '</td><td>' + tclass + '</td><td>' + tamount + '</td><td>' + tcurr + '</td><td><span title="delete item" id="' + perdiemtodelete + '-' + tid + '" class="btn btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></span>&nbsp; <span title="edit item" id="' + perdiemtoEdit + '-' + tid + '" class="btn btn-xs btn-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span></td>');

        ++perdiemItemCt;
    }


    function _addtodoFailure(request, status, errorMsg) {
        $('#perdiemMsg').html("Error Processing Request, Please Try Again..");
        $('#perdiemAdd').attr('disabled', false);
        console.log("Error: request - " + JSON.stringify(request) + " | status "
                + status + " | errorMsg " + errorMsg);
    }



    $('#perHotel').click(function (e) {
        var action = GLOBALS.appRoot + "travelstart/dHtel_dKsv";
        var hLocation = $('#hLocation').val();
        var hAmount = $('#hAmount').val();
        var haddress = $('#haddress').val();
         var hotelCost = $('#hotelCost').val();
        var hName = $('#hName').val();
        var cPerson = $('#cPerson').val();
         var hotelEmail = $('#hotelEmail').val();
        if (hLocation == "" || hAmount == "" || hotelCost == "" || haddress == "" || cPerson == "" || hName == "") {
            $('#showError').html("Please make sure all fields are filled").addClass("errorRed");
        } else {
            $('#showError').html("Processing Location, Please wait...");
            $.post(action, {hName: hName, hotelEmail: hotelEmail, hotelCost: hotelCost, hLocation: hLocation, hAmount: hAmount, haddress: haddress, cPerson: cPerson}, function (data) {
                if (data.msg) {
                    $('#showError').html(data.msg).addClass("errorGreen");
                    $('#hLocation').val('');
                    $('#hsClass').val('');
                    $('#hAmount').val('');
                    $('#hotelCost').val('');
                    $('#haddress').val('');
                    $('#cPerson').val('');
                    $('#hName').val('');
                     $('#hotelEmail').val('');
                    setTimeout(function () {
                        window.location.reload(1);
                    }, 100);
                }
            })
                    .fail(function () {
                        $('#showError').html("Error Loading Data, Please try again").addClass("alert alert-danger");
                    });
        }

    });






    $("#nowSubmitUpdate").click(function (event) {


        var staffID = $('#staffID').val();
        var benName = $('#benName').val();
        var benEmail = $('#benEmail').val();

        var sDate = $('#exsDate').val();
        var rDate = $('#exrDate').val();
        var hodEmail = $('#hodEmail').val();
        var logistics = $('#logistics').val();
        var purpose = $('#purpose').val();

        var tFromlocation = $('#tFromlocation').val();
        var tTolocation = $('#tTolocation').val();
        var warefoffice = $('#warefoffice').val();
        var travelID = $('#travelID').val();
        var exid = $('#exid').val();

        if (benEmail == "" || validateEmail(benEmail) == false) {
            $('#benEmail').addClass('errorMsgTravel');
            $('.errorEmail').html("**Enter Valid Email**");
        } else {
            $('.errorEmail').hide();
        }


        if (hodEmail == "") {
            $('#hodEmail').addClass('errorMsgTravel');
            $('.errorHOD').html("**Select HOD**");
        } else {
            $('.errorHOD').hide();
        }


        var bankName = $('#bankName').val();
        var acctNum = $('#acctNum').val();
        var dHotels = $('#dHotels').val();

        if (rDate < sDate) {
            alert("returned date cannot be greater than start date");
            return;
        }

        var input = $(this);
        $('#tFromlocation').each(function () {
            var count = 1;
            if ($(this).val() === "") {
                //error += "<p>Please select or to location</p>";
                input.removeClass("valid").addClass("invalid");
                return false;
            }
            count = count + 1;
        });

        $('#tTolocation').each(function () {
            var count = 1;
            if ($(this).val() === "") {
                //error += "<p>Please select or to location</p>";
                input.removeClass("valid").addClass("invalid");
                return false;
            }
            count = count + 1;
        });

        $('#exrDate').each(function () {
            var count = 1;
            if ($(this).val() === "") {
                //error += "<p>Make sure dates are collected</p>";
                input.removeClass("valid").addClass("invalid");
                return false;
            }
            count = count + 1;
        });


        $('#exsDate').each(function () {
            var count = 1;
            if ($(this).val() === "") {
                //error += "<p>Make sure dates are collected</p>";
                input.removeClass("valid").addClass("invalid");
                return false;
            }
            count = count + 1;
        });


        $('#logistics').each(function () {
            var count = 1;
            if ($(this).val() === "") {
                //error += "<p>Make sure dates are collected</p>";
                input.removeClass("valid").addClass("invalid");
                return false;
            }
            count = count + 1;
        });

        if (staffID && benName && benEmail && sDate && rDate && hodEmail && logistics && warefoffice) {

            $('.mainError').html("Processing Flight Request, Please wait...").addClass('errorRed');
            $('#nowSubmitUpdate').attr('disabled', true);
            $('.mainError').append('<img src="https://c-iprocure.com/expensepro/public/images/loading.gif" style="width:20px"/>');
            var dataString = new FormData(document.getElementById('travelStartFormEdit'));
            $.ajax({
                type: "POST",
                url: GLOBALS.appRoot + "travels/processformedit",
                processData: false,
                cache: false,
                contentType: false,
                data: dataString,
                dataType: "json",
                timeout: 600000,
                success: function (data) {
                    if (data.status === 3) {
                        $('#nowSubmitUpdate').attr('disabled', true);
                        $('#travelStartFormEdit').fadeOut();
                        $('.mainError').fadeOut();
                        $('.myMessage').html(data.msg);
                        $('.myMessage').fadeIn();
                    } else if (data.status === 0) {
                        $('#nowSubmitUpdate').attr('disabled', false);
                        $('.mainError').html(data.msg).addClass('errorRed');
                    } else if (data.status === 1) {
                        $('#nowSubmitUpdate').attr('disabled', false);
                        $('.mainError').html(data.msg).addClass('errorRed');
                    } else if (data.status === 2) {
                        $('#nowSubmitUpdate').attr('disabled', false);
                        $('.mainError').html(data.msg).addClass('errorRed');
                    }

                },
                error: function () {
                    $('.mainError').html("Error Processing Request, Please Try Again..");
                    $('#nowSubmitUpdate').attr('disabled', false);
                }
            });
        }


    });








    //////////**************BEGINNING OF SEARCH RESULT *****************//////////////////////////

    //This section deals search by date and account officer and category
    $('#expensetravel').click(function () {

        var start = $('#start').val();
        var end = $('#end').val();
        var dex = $("input[name='dex']:checked").val();
        var unit = $('#unit').val();
        var status = $('#status').val();

        if (unit == "" || start == "" || end == "" || dex == "" || status == "") {
            alert("Please make sure you select a unit and enter a Start and End Date and make sure you select either of the set criteria");
        } else {
            $('#results').html('Loading Result, Please wait.....');
            $.ajax({
                url: GLOBALS.appRoot + "travels/getdetalsofsearch",
                method: "POST",
                data: {start: start, end: end, dex: dex, unit: unit, status: status},
                dataType: "text",
                success: function (data) {
                    $('#results').html(data);
                }
            });
        }
    });




    //This section deals search by date and account officer and category
    $('#myexpenseCode').click(function () {

        var aCode = $('#aCode').val();
        var ex_end = $('#ex_end').val();
        var ex_start = $('#ex_start').val();

        if (aCode == "" || ex_start == "" || ex_end == "") {
            alert("Please make sure you select a unit and enter a Start and End Date and make sure you select either of the set criteria");
        } else {
            $('#results').html('Loading Result, Please wait.....');
            $.ajax({
                url: GLOBALS.appRoot + "travels/getexpenseCode",
                method: "POST",
                data: {ex_start: ex_start, ex_end: ex_end, aCode: aCode},
                dataType: "text",
                success: function (data) {
                    $('#results').html(data);
                }
            });
        }
    });
/////////*****************END OF SEARCH RESULT *******************////////////////////////////


    //This section deals search by date and account officer and category
    $('#travelBystaff').click(function () {

        var dex = $("input[name='dexs']:checked").val();
        var ef_end = $('#ef_end').val();
        var sf_start = $('#sf_start').val();
        var userEmail = $('#userEmail').val();

        //alert(dex);
        if (userEmail == "" || dex == "" || sf_start == "" || ef_end == "") {
            alert("Select Date and Criteria");
        } else {
            $('#results').html('Loading Result, Please wait.....');
            $.ajax({
                url: GLOBALS.appRoot + "travels/staffSearchme",
                method: "POST",
                data: {sf_start: sf_start, ef_end: ef_end, dexs: dex, userEmail: userEmail},
                dataType: "text",
                success: function (data) {
                    $('#results').html(data);
                }
            });
        }
    });


//This section deals search by date and account officer and category
    $('#rejectnowbywarefare').click(function () {
        var action = GLOBALS.appRoot+"travels/rejectwarefareOfficer";
        var mainID = $('#mainID').val();
        var addComment = $('#addComment').val();
        if (mainID == "" || addComment =="") {
            $('#flyError').html("Please make sure you add comment");
        } else {
            $.post(action, {mainID: mainID, addComment: addComment}, function (data) {
                if (data.msg) {
                    if(data.status == 1){
                        $('#flyError').html(data.msg).addClass("alert alert-success");
                        setTimeout(function () {
                            window.top.location = GLOBALS.appRoot + "travels/Dxk_udYz/"
                        }, 100);
                     }else{
                          $('#flyError').html(data.msg).addClass("alert alert-danger");
                     }
                }
            }).fail(function () {
                        $('#flyError').html("Error processing request, Please try again").addClass("alert alert-danger");
                        
                    });
        }
    });





//This section deals search by date and account officer and category
    $('#processflightbyofficer').click(function () {
        var action = GLOBALS.appRoot+"travels/processflightonly";
        var mainID = $('#mainID').val();
        var processdFlight = $("input[name='processdFlight']:checked").val();
        if (mainID == "") {
            $('#flyError').html("Please make sure you add comment");
        } else {
            $.post(action, {mainID: mainID, processdFlight: processdFlight}, function (data) {
                if (data.msg) {
                    if(data.status == 1){
                        $('#flyError').html(data.msg).addClass("alert alert-success");
                        setTimeout(function () {
                            window.top.location = GLOBALS.appRoot + "travels/Dxk_udYz/"
                        }, 100);
                     }else{
                          $('#flyError').html(data.msg).addClass("alert alert-danger");
                     }
                }
            }).fail(function () {
                        $('#flyError').html("Error processing request, Please try again").addClass("alert alert-danger");
                        
                    });
        }
    });
    
    

   $('#addFlightCost').click(function () {
      var flightAgency =  $('#flightAgency').val();
      var flightName =  $('#flightName').val();
      var flightAmount =  $('#flightAmount').val();
      var flightDetails =  $('#flightDetails').val();
      //var flightID =  $('#flightID').val();
      var myAttachment = $('#myAttachment').val();
      var flightID = $('#flightID').val();
      var travelID = $('#travelID').val();
      var hodtoaprove = $('#hodtoaprove').val();
       var dataString = new FormData(document.getElementById('flightForm'));
       if (travelID == "" || flightID == "") {
            $('#flyError').html('Important variables to process this page is missing, Please contact IT');
        }else if(flightAgency == "" || flightName == "" || flightAmount == ""){
           $('#flyError').html('Flight Amount and Flight Details and Flight Name Cannot be empty');
       }else {
            $('#flyError').html('Loading Result, Please wait.....');
            $('#addFlightCost').attr('disabled', true);
            $.ajax({
                url: GLOBALS.appRoot + "travelstart/processAirticket",
                method: "POST",
                data: dataString,
                processData: false,
                cache: false,
                contentType: false,
                dataType: "json",
                timeout: 600000,
                success: function (data) {
                    if(data.status == 1){
                        $('#flyError').html(data.msg).addClass('errorRed');
                         setTimeout(function () {
                            window.top.location = GLOBALS.appRoot + "travels/oooOOOflight_NOW67482h2O/"
                        }, 100);
                    }else if (data.status == 0){
                       $('#addFlightCost').attr('disabled', false);
                         $('#flyError').html(data.msg).addClass('errorRed');;  
                    }else if (data.status == 5){
                       $('#addFlightCost').attr('disabled', true);
                         $('#flyError').html(data.msg).addClass('errorRed');;  
                    }
                   
                },
                error: function () {
                    $('#flyError').html("Error Processing Flight Request, Please Try Again..");
                    $('#addFlightCost').attr('disabled', false);
                }
            });
        }
      
  
   });


    $('.viewFlight').click(function(e){
	 var id = $(this).attr('data-id');
          $.ajax({

        url: GLOBALS.appRoot + "travelstart/flightdetailsauthority/" + id,
        type: "GET",
        dataType: "JSON"
        , success: function (data) {
            $('#loaddepdetails').html('loading travel details, please wait....');
             
            var output = '<h5><span class="btn btn-sm btn-danger">TRAVEL REQUEST DETAILS</span></h5>';
            
            output += '<table class="table table-responsive table-hover"><tr><td>From</td><td>To</td><td>Start Date</td><td>End Start</td><td>Days</td></tr>';
            for (var idx = 0; idx < data.fL.length; ++idx) {
                //output += '<option value='+ data.fL[idx].from+'>'+ data.fL[idx].to+' '+ data.ci[idx].sDate+'</option>';
                output += '<tr><td>'+ data.fL[idx].from+'</td><td>'+ data.fL[idx].to+'</td><td>'+ data.fL[idx].sDate+'</td><td>'+ data.fL[idx].eDate+'</td><td>'+ data.fL[idx].diff+'</td></tr>';
                }
                output  +='</table>';
            $('#loaddepdetails').html(output);
            
        }}).error(function () {
        $('#loaddepdetails').html("<br/>Error Loading flightDetails, please try again....");
        $('#loaddepdetails').addClass("errorRed");

    });
});






 //Processing multiple checkbox
    $("#batchpayment").click(function(){
       //Initializing the array for the check box
       
       var lang = [];
       // Initializing array with Checkbox checked values
        $("input[name='dflightCheck[]']:checked").each(function(){
            lang.push(this.value);
            //lang.push(parseInt($(this).val()));
        });
       
        if(lang != ""){
             $('.showError').html('Sending Request please wait, please wait...');
            $.ajax({
                //url: GLOBALS.appRoot + "dprocess/maketillrequest",
                url: GLOBALS.appRoot + "travelstart/createbatchrequest",
                type: 'post',
                data: {lang:lang},
                dataType: 'JSON',
                success: function(response){
                     //$('#showErrorrequest').html('Sending Request please wait, please wait...');
                    if (response.status == 1) {
                        $('.showError').html(JSON.stringify(response.msg)).addClass('alert alert-success');
                         setTimeout(function(){window.top.location= GLOBALS.appRoot + "travels/UUUUUUUx0dsl123854mybatchedrequest/"} , 100);
                    }else if (response.status == 0) {
                        $('.showError').html(JSON.stringify(response.msg)).addClass('alert alert-danger');
                    }
                }
            });
        }else{
            alert("please select the checkbox(s) you want to batch");
        }
    });
    
    
    
     $("#paynowbatched").click(function(){
        
         var batchtitle =  $('#batchtitle').val();
         var batchCode =  $('#batchCode').val();
         var batchedAmount =  $('#batchedAmount').val();
         var batchedDate =  $('#batchedDate').val();
         var dhod =  $('#dhod').val();
         var daccountant = $('#daccountant').val();
         var vendor = $('#vendor').val();
         var dCurrencyType =  $('#dCurrencyType').val();
         var expenseCode =  $('#expenseCode').val();
         var comment =  $('#comment').val();
         var batchedId =  $('#batchedId').val();
         var sumID =  $('#sumID').val();
         var doexplode =  $('#doexplode').val();
         var getHotelName =  $('#getHotelName').val();
         
          
         var dataString = new FormData(document.getElementById('batingpayment')); //postArticles
          
          if(batchedId == "" || dCurrencyType == "" ||  comment == "" || vendor == "" || daccountant == "" || batchedAmount == ""){
              $('#batchError').html("please make sure all fields are filled").addClass('alert alert-danger');
          }else{
               $('#batchError').html("Processing Request, Please wait....").addClass('alert alert-success');
               $('#paynowbatched').hide();
               
                $.ajax({
                type: "POST",
                url: GLOBALS.appRoot + "travelstart/processexpensebatch",
                data: dataString,
                contentType: false,
                processData: false,
                cache: false,
                dataType: 'JSON',
                
                success: function (data) {
                  if (data.status == 1 && data.type=='flight') {
                    $('#showError').html(data.msg).addClass("errorGreen");
                    $('#paynowbatched').hide();
                    $('#comment').val('');
                    $('#daccountant').val('');
                    $('#dhod').val('');
                   setTimeout(function(){window.top.location= GLOBALS.appRoot + "travels/oooOOOflight_NOW67482h2O/"} , 100);
                }else if(data.status == 1 && data.type=='hotel'){
                    $('#showError').html(data.msg).addClass("errorGreen");
                    $('#paynowbatched').hide();
                    $('#comment').val('');
                    $('#daccountant').val('');
                    $('#dhod').val('');
                   setTimeout(function(){window.top.location= GLOBALS.appRoot + "travels/hotelbygroup/"} , 100);
                        
                 }else if(data.status== 0){
                  $('#showError').html(data.msg).addClass("errorGreen"); 
                  $('#paynowbatched').show();
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



     
     
      $('.viewHotels').click(function(e){
          e.preventDefault();
               var id = $(this).attr('data-id');
                $.ajax({

              url: GLOBALS.appRoot + "travelstart/hotelauthoritydetails/" + id,
              type: "GET",
              dataType: "JSON"
              , success: function (data) {
                  $('#loaddepdetails').html('loading travel details, please wait....');

                  var output = '<h5><span class="btn btn-sm btn-danger">HOTEL REQUEST</span></h5>';

                  output += '<table class="table table-responsive table-hover"><tr><th>From</th><th>To</th><th>Start Date</th><th>End Start</th><th>Days</th></tr>';
                  for (var idx = 0; idx < data.fL.length; ++idx) {
                      output += '<h4>'+ data.fL[idx].title+'</h4>';
                      output += '<tr><td>'+ data.fL[idx].from+'</td><td>'+ data.fL[idx].to+'</td><td>'+ data.fL[idx].sDate+'</td><td>'+ data.fL[idx].eDate+'</td><td>'+ data.fL[idx].diff+'</td></tr>';
                      }
                  output  +='</table>';
                  
                   //output  +='<hr/>';
                   output += '<table class="table table-responsive table-hover"><tr><th>Local</th><th>Logistic</th><th>Purpose</th></tr>';
                  for (var idx = 0; idx < data.fL.length; ++idx) {
                      output += '<tr><td>'+ data.fL[idx].amLocal+'</td><td>'+ data.fL[idx].log+'</td><td>'+ data.fL[idx].purpose+'</td></tr>';
                      }
                  output  +='</table>';
                  
                  
                   output += '<table class="table table-responsive table-hover"><tr><th>Hotel</th><th>Days Spent</th><th>Amount Spent</th><th>Balance</th><th>Paid Status</th></tr>';
                  for (var idx = 0; idx < data.fL.length; ++idx) {
                      output += '<tr><td>'+ data.fL[idx].hID+'</td><td>'+ data.fL[idx].daySpent+'</td><td>'+ data.fL[idx].amtSpent+'</td><td>'+ data.fL[idx].balance+'</td><td>'+ data.fL[idx].hPay+'</td></tr>';
                      }
                  output  +='</table>';
                  
                  $('#loaddepdetails').html(output);

              }}).error(function () {
              $('#loaddepdetails').html("<br/>Error Loading flightDetails, please try again....");
              $('#loaddepdetails').addClass("errorRed");

          });
      });





       $('#addHertzCost').click(function () {
        var hertAmount =  $('#hertAmount').val();
        var transportID = $('#transportID').val();
        
         var dataString = new FormData(document.getElementById('addTransForm'));
         if (hertAmount == "" || transportID == "") {
              $('#flyError').html('Please add Transport');
          }else {
              $('#flyError').html('Adding Transport, Please wait.....');
            $('#addHertzCost').attr('disabled', true);
            $.ajax({
                url: GLOBALS.appRoot + "travelstart/processhertztransport",
                method: "POST",
                data: dataString,
                processData: false,
                cache: false,
                contentType: false,
                dataType: "json",
                timeout: 600000,
                success: function (data) {
                    if(data.status == 1){
                         setTimeout(function () {
                            window.top.location = GLOBALS.appRoot + "travels/fjorHertz009X_10mins/"
                        }, 100);
                    }else if (data.status == 0){
                       $('#addHertzCost').attr('disabled', false);
                         $('#flyError').html(data);  
                    }
                   
                },
                error: function () {
                    $('.flyError').html("Error Processing Flight Request, Please Try Again..");
                    $('#addHertzCost').attr('disabled', false);
                }
            });
        }
      
      
   });
   
   
   
   
    $('#paytoexpensepronow').click(function(e){
        
        var dTitle = $('#dTitle').val();
        var dDate = $('#dDate').val();
        var dBeneficiary = $('#dBeneficiary').val();
        var dEmail = $('#dEmail').val();
        var dAmountPaid = $('#dAmountPaid').val();
        var dRetiredAmount = $('#dRetiredAmount').val();
        var dBalance = $('#dBalance').val();
        var dVerified = $('#dVerified').val();
        var dLocation = $('#dLocation').val();
        var dUnit = $('#dUnit').val();
        var daccountgroup = $('#daccountgroup').val();
        var dcomment = $('#dcomment').val();
        var dRequestID = $('#dRequestID').val();
        var mainID = $('#mainID').val();
        var icuhaseen = $('#icuhaseen').val();
        var dCashier = $('#dCashier').val();
        var dCurrency = $('#dCurrency').val();
         var dhod = $('#dhod').val();
         var dICUwhoconfirmed = $('#dICUwhoconfirmed').val();
        var myhodwhoapproves = $('#myhodwhoapproves').val();
        var action =GLOBALS.appRoot + "travelstart/processpaymentforexpensewhynow";
        
        
        if(dcomment == ""){
            $('.myError').html("Please make sure you add a comment and select an account group").addClass('errorRed');
        }else if(dRequestID == "" || mainID ==""){
             $('.myError').html("Important Variable to process this page is missing please contact IT").addClass('errorRed'); 
        }else if(icuhaseen != 'yes'){
            $('.myError').html("Please wait for ICU to verify Reimbursement before payment").addClass('errorRed');  
            
        }else{
            $('.myError').html("Processing Request, Please wait...").addClass('errorGreen');
            //$('#paytoexpensepronow').hide();
            $.post(action, {dCurrency: dCurrency, dCashier: dCashier, icuhaseen: icuhaseen, dTitle: dTitle, dDate: dDate, dBeneficiary: dBeneficiary, 
                    dEmail: dEmail, dEmail: dEmail, dAmountPaid: dAmountPaid, daccountgroup: daccountgroup, myhodwhoapproves: myhodwhoapproves,
                    dRetiredAmount: dRetiredAmount, dBalance: dBalance, dVerified: dVerified, dhod: dhod, dICUwhoconfirmed: dICUwhoconfirmed, 
                    dLocation: dLocation, dUnit: dUnit, dcomment: dcomment, dRequestID: dRequestID, mainID: mainID}, function (data) {
                if (data.status == 2) {
                    $('.myError').html(data.msg).addClass("errorGreen");
                    //$('#paytoexpensepronow').hide();
                    $('#dcomment').val('');
                 setTimeout(function(){window.top.location= GLOBALS.appRoot + "recieveables/"} , 100);
                }else if(data.status == 1){
					$('.myError').html(data.msg).addClass("errorGreen");
				}
                
            }).fail(function () {
               $('.myError').html("Error Loading Data, Please try again").addClass("alert alert-danger");
               //$('#paytoexpensepronow').show();
             });
            
        }
        
        
    });
   
    
    
    //This section deals search by date and account officer and category
    $('#withfromexpensepro').click(function () {
       
        var action = GLOBALS.appRoot+"travels/rejectwarefareOfficerbothinexpensepro";
        var travelID = $('#travelID').val();
        var textme = $('#textme').val();
        var benEmail = $('#benEmail').val();
        if (travelID == "" || textme =="") {
            $('.mainError').html("Please make sure you add comment");
        } else {
            $.post(action, {travelID: travelID, textme: textme, benEmail: benEmail}, function (data) {
                if (data.msg) {
                    if(data.status == 1){
                        $('.mainError').html(data.msg).addClass("alert alert-success");
                        setTimeout(function () {
                            window.top.location = GLOBALS.appRoot + "travels/Dxk_udYz/"
                        }, 100);
                     }else{
                          $('.mainError').html(data.msg).addClass("alert alert-danger");
                     }
                }
            }).fail(function () {
                        $('.mainError').html("Error processing request, Please try again").addClass("alert alert-danger");
                        
                    });
        }
    });
    
    

}); /************************ END OF FIRST DOCUMENT READY **********************************/







/********************************** DOCUMENT READY FOR VIEW ALL REQUEST BY ADMIN *******************************/


$(document).ready(function () {

    $('.flightloadingrequest').append('<div style="text-align:center;"><img src="https://c-iprocure.com/expensepro/public/images/giphy.gif" style="width:300px"/></div>');

    $.ajax({
        type: "GET",
        url: GLOBALS.appRoot + "travelstart/getallrequestforflightbus",
        dataType: "json",
        timeout: 60000,
        success: _loadallflightrequest,
        error: _loadfailurerequest
    });


    function _loadallflightrequest(data) {
        if (typeof data !== 'object' || !isArray(data.allflight)) {
            console.log("Unexpected server response: Status - " + status + " returnedData - " + JSON.stringify(data));
            $('.flightloadingrequest').html("<p class='alert alert-danger'>There was a problem loading all request, please try again, or check your internet");
            return;
        }
        //perdiemCollect
        //tid, tlocation, tclass, tamount, tcurr, status
        if (data.allflight.length) {
            //alert(data.perdiems.length);
            outputVar = '<table  id="mydata" class="table table-responsive table-striped table-hover table-bordered"><thead><th><b>StaffID</b></th><th><b>Name</b></th><th><b>Location</b></th><th><b>Unit</b></th><th><b>Officer</b></th><th><b>&nbsp;</b></th></thead><tbody>';
            for (var idx = data.allflight.length - 1; idx >= 0; --idx) {
                // _addPerdiemItem(data.perdiems[idx].tid, data.perdiems[idx].plocale, data.perdiems[idx].pClass, data.perdiems[idx].pAmount, data.perdiems[idx].pCurr);
                outputVar += '<tr><td>' + data.allflight[idx].sID + '</td><td>' + data.allflight[idx].sN + '</td> <td>' + data.allflight[idx].sL + '</td><td>' + data.allflight[idx].sU + '</td><td>' + data.allflight[idx].sWa + '</td><td><button title="View Details" onClick= addtransport(\'' + data.allflight[idx].tcsr + '\',\'' + data.allflight[idx].tid + '\') class="btn btn-xs btn-primary"><i class="fa fa-file-archive-o" aria-hidden="true"></i></button>&nbsp; <span title="Re-Calculate" onClick= recalculate(\'' + data.allflight[idx].tcsr + '\',\'' + data.allflight[idx].tid + '\') class="btn btn-xs btn-danger"><i class="fa fa-expeditedssl" aria-hidden="true"></i></span></td></tr>';
            }
            outputVar += '</tbody></table>';
            $('.flightloadingrequest').html(outputVar);
        } else {
            $('.flightloadingrequest').html("<p style='color:red'>No flight request");
        }
    }


    function _loadfailurerequest(request, status, errorMsg) {
        $('.flightloadingrequest').html("<center>Error Processing Request, Please Try Again or Check Your Internet</center>").addClass('alert alert-danger');
        console.log("Error: request - " + JSON.stringify(request) + " | status "
                + status + " | errorMsg " + errorMsg);
    }



});

/********************************** END OF DOCUMENT READY FOR VIEW ALL REQUEST BY ADMIN *******************************/


function addtransport(tcsr, id) {

    setTimeout(function () {
        window.top.location = GLOBALS.appRoot + "travelstart/getdetailsfordetails/" + tcsr + "/" + id
    }, 100);
}
;


function recalculate(tcsr, id) {

    setTimeout(function () {
        window.top.location = GLOBALS.appRoot + "travelstart/recal_perxd90_4kdd_smskk4500sds_/" + tcsr + "/" + id
    }, 100);
}


function buildconfirmation(dataid){
      var action = GLOBALS.appRoot+"travelstart/processcashconfirmation";
          
          if(dataid == ""){
             alert("Important Variable to Render this page is missing"); 
          }else{
              $('#errorMe').html('Processing, Please Wait').addClass('errorRed');
             $.post(action, {dataid: dataid},  function(data){
			if(data.msg){
                        $('#errorMe').html(data.msg).addClass("errorGreen");
                        setTimeout(function(){window.top.location= GLOBALS.appRoot + "recieveables/"} , 100);
			}
		})
                 .fail(function() {
                    $('#showError').html("Error Processing Data, Please try again").addClass("alert alert-danger");
                    
                  });
          }
}


function verifyRequest(rdataid){
      var action = GLOBALS.appRoot+"travelstart/verifypaymentbystaffwhocares";
          
          if(rdataid == ""){
             alert("Important Variable to Render this page is missing"); 
          }else{
              $('#errorMe').html('Processing, Please Wait').addClass('errorRed');
             $.post(action, {rdataid: rdataid},  function(data){
                if(data.status == 1){
                  $('#errorMe').html(data.msg).addClass("errorGreen");
                  setTimeout(function(){window.top.location= GLOBALS.appRoot + "recieveables/"} , 100);
		}else if(data.status == 2){
                  $('#errorMe').html(data.msg).addClass("errorRed");   
                }else if(data.status == 0){
                  $('#errorMe').html(data.msg).addClass("errorRed");   
                }
            }).fail(function() {
                    $('#showError').html("Error Processing Data, Please try again").addClass("alert alert-danger");
                    
                  });
          }
}

function notapplication(mainid){
    
    var action = GLOBALS.appRoot+"travelstart/notapplicablerequest/" + mainid;
         
          if(mainid == ""){
             alert("Important Variable to Render this page is missing"); 
          }else{
              $('.spanError').html('Processing, Please Wait').addClass('errorRed');
             $.post(action, {mainid: mainid},  function(data){
			if(data.msg){
                        $('.spanError').html(data.msg).addClass("errorGreen");
                        setTimeout(function(){window.top.location= GLOBALS.appRoot + "travels/oooOOOflight_NOW67482h2O/"} , 900);
			}
		})
                 .fail(function() {
                    $('.spanError').html("Error Processing Data, Please try again").addClass("alert alert-danger");
                    
                  });
          }
}



function nothertzapp(mainid){
    
    var action = GLOBALS.appRoot+"travelstart/nothertzapply/" + mainid;
          
          if(mainid == ""){
             alert("Important Variable to Render this page is missing"); 
          }else{
              $('.spanError').html('Processing, Please Wait').addClass('errorRed');
             $.post(action, {mainid: mainid},  function(data){
			if(data.msg){
                        $('.spanError').html(data.msg).addClass("errorGreen");
                        setTimeout(function(){window.top.location= GLOBALS.appRoot + "travels/fjorHertz009X_10mins/"} , 900);
			}
		})
                 .fail(function() {
                    $('.spanError').html("Error Processing Data, Please try again").addClass("alert alert-danger");
                    
                  });
          }
}


function verifyforhod(rdataid){
      var action = GLOBALS.appRoot+"travelstart/verifyreimbursementforhod";
          
          if(rdataid == ""){
             alert("Important Variable to Render this page is missing"); 
          }else{
              $('#errorMe').html('Processing, Please Wait').addClass('errorRed');
             $.post(action, {rdataid: rdataid},  function(data){
                if(data.status == 1){
                  $('#errorMe').html(data.msg).addClass("errorGreen");
                  setTimeout(function(){window.top.location= GLOBALS.appRoot + "recieveables/"} , 100);
		}else if(data.status == 2){
                  $('#errorMe').html(data.msg).addClass("errorRed");   
                }else if(data.status == 0){
                  $('#errorMe').html(data.msg).addClass("errorRed");   
                }
            }).fail(function() {
                    $('#showError').html("Error Processing Data, Please try again").addClass("alert alert-danger");
                    
                  });
          }
}




function approveflight(mainid){
    
    var action = GLOBALS.appRoot+"travelstart/approveflight/" + mainid;
         
          if(mainid == ""){
             alert("Important Variable to Render this page is missing"); 
          }else{
              $('.spanError').html('Processing, Please Wait').addClass('errorRed');
             $.post(action, {mainid: mainid},  function(data){
			if(data.msg){
                        $('.spanError').html(data.msg).addClass("errorGreen");
                        setTimeout(function () { window.location.reload(1); }, 1000);
			}
		})
                 .fail(function() {
                    $('.spanError').html("Error Processing Data, Please try again").addClass("alert alert-danger");
                    
                  });
          }
}



function verifyflight(mainid){
    
    var action = GLOBALS.appRoot+"travelstart/verifyflight/" + mainid;
         
          if(mainid == ""){
             alert("Important Variable to Render this page is missing"); 
          }else{
              $('.spanError').html('Processing, Please Wait').addClass('errorRed');
             $.post(action, {mainid: mainid},  function(data){
			if(data.msg){
                        $('.spanError').html(data.msg).addClass("errorGreen");
                        setTimeout(function () { window.location.reload(1); }, 1000);
			}
		})
                 .fail(function() {
                    $('.spanError').html("Error Processing Data, Please try again").addClass("alert alert-danger");
                    
                  });
          }
}






   $('#addFlightexternal').click(function () {
      var flightAgency =  $('#flightAgency').val();
      var flightName =  $('#flightName').val();
      var flightAmount =  $('#flightAmount').val();
      var flightDetails =  $('#flightDetails').val();
      var myAttachment = $('#myAttachment').val();
      var hodtoaprove = $('#hodtoaprove').val();
      var name = $('#name').val();
      
      var tFromlocation = $('#tFromlocation').val();
      var tTolocation = $('#tTolocation').val();
      var exsDate = $('#exsDate').val();
      var exrDate = $('#exrDate').val();
      var purpose = $('#purpose').val();
      
       var dataString = new FormData(document.getElementById('flightForm'));
       if (name == "") {
            $('#flyError').html('Please add a name');
        }else if (flightAgency == "" || flightAmount == "") {
            $('#flyError').html('Important variables to process this page is missing, Please contact IT');
        }else if(tFromlocation == "" || tTolocation == "" || exsDate == "" || exrDate == "" || purpose == ""){
           $('#flyError').html('All Flight Details are Compulsory');
       }else {
            $('#flyError').html('Loading Result, Please wait.....');
            $('#addFlightCost').attr('disabled', true);
            $.ajax({
                url: GLOBALS.appRoot + "travelstart/processExternalTicket",
                method: "POST",
                data: dataString,
                processData: false,
                cache: false,
                contentType: false,
                dataType: "json",
                timeout: 600000,
                success: function (data) {
                    if(data.status == 1){
                        $('#flyError').html(data.msg).addClass('errorRed');
                         setTimeout(function () {
                            window.top.location = GLOBALS.appRoot + "travels/oooOOOflight_NOW67482h2O/"
                        }, 100);
                    }else if (data.status == 0){
                       $('#addFlightCost').attr('disabled', false);
                         $('#flyError').html(data.msg).addClass('errorRed');;  
                    }else if (data.status == 5){
                       $('#addFlightCost').attr('disabled', true);
                         $('#flyError').html(data.msg).addClass('errorRed');;  
                    }
                   
                },
                error: function () {
                    $('#flyError').html("Error Processing Flight Request, Please Try Again..");
                    $('#addFlightCost').attr('disabled', false);
                }
            });
        }
      
  
   });
   
   
   
   
   //This section deals search by date and account officer and category
    $('#getaccountcodeonly').click(function () {

        var start = $('#acc_start').val();
        var end = $('#acc_end').val();
        var unit = $('#acc_unit').val();
        var status = $('#acc_status').val();
         //var currency = $('#acc_currency').val();
        

        if (unit == "" || start == "" || end == "" || status == "") {
            alert("Please make sure you select a unit and enter a Start and End Date and make sure you select either of the set criteria");
        } else {
            $('#results').html('Loading Result, Please wait.....');
            $.ajax({
                url: GLOBALS.appRoot + "travels/getaccountcode",
                method: "POST",
                data: {start: start, end: end, unit: unit, status: status},
                dataType: "text",
                success: function (data) {
                    $('#results').html(data);
                }
            });
        }
    });