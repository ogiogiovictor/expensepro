
let mergeCheckBtn = document.querySelector('#mergeC');
mergeCheckBtn.addEventListener('click', (e) => mergeCheck(event));
 
var action = "http://localhost/expenseprov2/home/mergedcheck/";


const mergeCheck = (event) => {
     //var checkmerge = $("input[name='dChecking']:checked").val(); // FOR SINGLE BUTTON
     
     //FOR MULTIPLE BUTTONS
     var checkmerge = $('input:checkbox[name="dChecking[]"]').map(function() {
            return this.checked ? this.value : undefined;
     }).get();
     if(checkmerge == ""){
         toastr.info("Please select the checkboxs that you want to merge",  {timeOut: 1500});
        return;
    }else{
        
        $.post(action, {checkmerge: checkmerge}, function (data) {
                if(data.mainID){
                     toastr.success("Processing Merger, please hold on",  {timeOut: 150000});
                     setTimeout(function(){
                         window.top.location= GLOBALS.appRoot + "home/mergedCheckd/" + data.mainID
                     } , 100); 
                }else{
                    toastr.error("Error Processing Request please try again later",  {timeOut: 150000}); 
                }
              });
        
        
     }

}




//BEGINNING OF MODAL FOR ACCOUNT PAYABLE
$('.mergebackcheque').click(function (e) {
    alert("i am here");
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