function request_page(pn) {
    var result_box = document.getElementById('results_box');
    var pagination_controls = document.getElementById('pagination_controls');
    //var html_output = "";

    result_box.innerHTML = "<center>Loading <img style='width:40px' src='https://c-iprocure.com/expensepro/public/images/loading.gif' /></center>";
    var hr = new XMLHttpRequest();
    hr.open("POST", "https://c-iprocure.com/expensepro/travels/paginationparsertravel", true);

    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //hr.setRequestHeader("Content-type", "application/json", true);
    hr.onreadystatechange = function () {
        if (hr.readyState === 4 && hr.status === 200) {

            var dataArray = JSON.parse(hr.responseText);

            var status = "";
            var aLevel = "";
            var newapprovals = "";
            var html_output = `<div style="clear:both"></div><hr/>
                                <table class="table table-responsive table-hover table-condensed">
                                    <thead class="text-primary">
                                        <th>ID</th>
                                         <th>Date</th>
                                        <th>Staff ID</th>
                                        <th>Staff Name</th>
                                        <th>Unit</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                         <th>Action</th></thead><tbody>`;
           // for (var x = 0; x < dataArray.length - 1; x++) {
                for(var x = dataArray.length -1; x >=0; x--){
                if (dataArray[x].approval == 0) {
                    newapprovals = "<span style='color:indigo'>Pending</span>";
                } else if (dataArray[x].approval == 1) {
                    newapprovals = "<span style='color:red'>Awaiting Approval</span>";
                } else if (dataArray[x].approval == 2) {
                    newapprovals = "<span style='color:grey'>Rejected</span>";
                } else if (dataArray[x].approval == 3) {
                    newapprovals = "<span style='color:blue'>Awaiting Payment</span>";
                } else if (dataArray[x].approval == 4) {
                    newapprovals = "<span style='color:cyan'>Paid</span>";
                } else {
                    newapprovals = "pending";
                }


                html_output += "<tr><td>" + dataArray[x].id + "</td><td>" + dataArray[x].dateCreated + "</td><td>" + dataArray[x].staffID + "</td><td>" + dataArray[x].staffName + "</td><td>" + dataArray[x].unit + "</td><td>" + dataArray[x].sTotal + "</td><td>" + newapprovals + "</td><td><a href=''><button class='btn btn-xs btn-primary'>View</button></a></td></tr>";
            }
            html_output += `</tbody></table>`;
            result_box.innerHTML = html_output;


            ////////////////////////////////////////// THIS IS WHERE THE SEARCH COMES IN ////////////////////////////////////

            document.getElementById('searchAll').addEventListener('keypress', pushsearchdb);
            /////////////////////////////////////// END OF THE SEARCH ////////////////////////////////////////////////////


        }
    }

    hr.send("rpp=" + rpp + "&last=" + last + "&pn=" + pn);

    //Change the Pagination controls
    var paginationCtrls = "";
    // Only if there is more than 1 page worth of result give the user paination controls
    if (last !== 1) {
        if (pn > 1) {
            paginationCtrls += '<center><button class="btn btn-xs btn-primary" onclick="request_page(' + (pn - 1) + ')">&lt;</button>';
        }
        paginationCtrls += '&nbsp; &nbsp; &nbsp;<b>Page ' + pn + ' of ' + last + '</b> &nbsp; &nbsp; ';
        if (pn !== last) {
            paginationCtrls += '<button class="btn btn-xs btn-primary" onclick="request_page(' + (pn + 1) + ')">&gt;</button><center>';
        }
    }
    pagination_controls.innerHTML = paginationCtrls;


}


//actionpost = "http://localhost/expenseprov2/travels/searchforcontent";
var actionpost = "https://c-iprocure.com/expensepro/travels/searchforcontent";
function pushsearchdb() {
    var postSearch = document.getElementById('searchAll').value;
    var results_box = document.getElementById('results_box');

    if (postSearch != "") {
        results_box.innerHTML = "Gettign Results, please wait....";
        $.post(actionpost, { dopost: postSearch }, function (data) {
            if (data) {

                var html_output = `<div style="clear:both"></div><hr/>
                                <table class="table table-responsive table-hover table-condensed">
                                    <thead class="text-primary">
                                        <th>ID</th>
                                         <th>Date</th>
                                        <th>Staff ID</th>
                                        <th>Staff Name</th>
                                        <th>Unit</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                         <th>Action</th></thead><tbody>`;

                //for (var x = 0; x < data.length; x++) {
                    for(var x = data.length -1; x >=0; x--){
                    if (data[x].approval == 0) {
                        newapprovals = "<span style='color:indigo'>Pending</span>";
                    } else if (data[x].approval == 1) {
                        newapprovals = "<span style='color:red'>Awaiting Approval</span>";
                    } else if (data[x].approval == 2) {
                        newapprovals = "<span style='color:grey'>Rejected</span>";
                    } else if (data[x].approval == 3) {
                        newapprovals = "<span style='color:blue'>Awaiting Payment</span>";
                    } else if (data[x].approval == 4) {
                        newapprovals = "<span style='color:cyan'>Paid</span>";
                    } else {
                        newapprovals = "pending";
                    }

                html_output += "<tr><td>" + data[x].id + "</td><td>" + data[x].dateCreated + "</td><td>" + data[x].staffID + "</td><td>" + data[x].staffName + "</td><td>" + data[x].unit + "</td><td>" + data[x].sTotal + "</td><td>" + newapprovals + "</td><td><a href=''><button class='btn btn-xs btn-primary'>View</button></a></td></tr>";
                
            }
                html_output += `</tbody></table>`;
                results_box.innerHTML = html_output;

            } else {
                results_box.innerHTML = "No Result";
            }
        });

    } else {
        request_page(1)
    }



}