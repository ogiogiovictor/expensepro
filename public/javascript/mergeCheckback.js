function nl2br (str, is_xhtml) {
    if (typeof str === 'undefined' || str === null) {
        return '';
    }
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
}

//BEGINNING OF MODAL FOR ACCOUNT PAYABLE
$('.mergebackcheque').click(function (e) {
    var id = $(this).attr('data-id');

    var outputs = '<p id="deprocess"><h3 class="btn btn-block btn-fill btn-primary btnblue">Add Cheque Back Details</h3></p><textarea class="" rows="3" name="dChequeBack" id="dChequeBack" cols="55" placeholder="Add the Content that will appear at the back of the cheque"></textarea><br/><button onClick="fillmergechequeback(' + id + ')" class="btn btn-xs btn-fill btn-primary">OK</button>';
    $('#myacctputalert').html(outputs);
});

//});

function fillmergechequeback(id) {

    var action = GLOBALS.appRoot + "home/pushcontentatbackformergecheque";
    var chequeID = id;
    
    var dChequeBack = $('#dChequeBack').val();
    
    if (dChequeBack == "") {
        $('#deprocess').html("Please enter cheque content").addClass('errorRed');
    } else {
        $('#deprocess').html("Adding Content, Please wait...");
        $.post(action, { chequeID: chequeID, dChequeBack: dChequeBack }, function (data) {
            if (data.status == 200) {
                $('#deprocess').html(data.msg).addClass('errorGreen');
                setTimeout(function () { window.top.location = GLOBALS.appRoot + "home/printerbackmerge/" + chequeID }, 100);
            }
        })
            .fail(function () {
                $('#rejectrequest').html("Error Loading Data, Please try again");
            });
    }
}


$('.usebankinsteadofpayee').click(function (e) {
    var id = $(this).attr('data-id');
     var action_merger = GLOBALS.appRoot + "home/changedbank";
    if(id == ""){
        alert("important variable to process page is missing");
    }else{
        $.post(action_merger, { id: id }, function (data) {
            if (data.status == 200) {
                $('#deprocess').html(data.msg).addClass('errorGreen');
                setTimeout(function () { window.location.reload(1); }, 1000);
            }
        })
    }
});


/*
  postData(action, {"id": checkmerge})
        .then(data => console.log(JSON.stringify(data))) // JSON-string from `response.json()` call
        .catch(error => console.error(error));
 */


/*
function postData(url = ``, data = {}) {
  // Default options are marked with *
    return fetch(url, {
        method: "POST", // *GET, POST, PUT, DELETE, etc.
        mode: "cors", // no-cors, cors, *same-origin
        cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
        credentials: "same-origin", // include, *same-origin, omit
        headers: {
           "Content-Type": "application/json",
            // "Content-Type": "application/x-www-form-urlencoded",
        },
        redirect: "follow", // manual, *follow, error
        referrer: "no-referrer", // no-referrer, *client
        body: JSON.stringify(data), // body data type must match "Content-Type" header
    })
    .then(response => response.json()); // parses response to JSON
}
*/