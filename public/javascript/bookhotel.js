let dType = document.querySelector('#dType');
dType.addEventListener('change', (e) => getStaffType(event));

const hotelbooking = document.querySelector('#bookmenow');
hotelbooking.addEventListener('click', (e) => bookhotelnow(event));
 
var action = "http://localhost:8080/expenseprov2/travels/getiftypestaff/";
var addhotelbooking = "http://localhost:8080/expenseprov2/travels/bookhotel/";


const getStaffType = (event) => {
    let dtypeValue = document.querySelector('#dType').value;
    
    
     if(dtypeValue == ""){
        alert("You must select a Type");
        return;
    }else{
        
        $.post(action, {dtypeValue: dtypeValue}, function (data) {
          if(!data.result){
             document.querySelector('#pickemail').innerHTML = "<input type='text' class='form-controls' name='emailAddress' id='emailAddress' />";
          }else{
              const { result } = data;
              const [ profile ] = result;
              //const name = profile.email;
             outputVar = '<select class="form-controls dType" name="emailAddress" id="emailAddress" data-live-search="true">';
            
            for (var idx = data.result.length - 1; idx >= 0; --idx) {
                outputVar += ' <option value="' + data.result[idx].email + '">' + data.result[idx].fname + '  ' + data.result[idx].lname + '</option>';
               
            }
           
            outputVar += '</select>';
            document.querySelector('#pickemail').innerHTML = outputVar;
          }

       });
        
     } 

}


const bookhotelnow = (event) => {
    event.preventDefault();
    const dType = document.querySelector('#dType').value;
    const elementEmail = document.querySelector('#emailAddress');
    const dhod = document.querySelector('#dhod');
    
    const whichhotel = document.querySelector('#whichhotel').value;
    const hFrom = document.querySelector('#hFrom').value;
    const hTo = document.querySelector('#hTo').value;
    const dReason = document.querySelector('#dReason').value
    
    /* if(dType == "" || dType == null || emailAddress){
       alert("please select type");
       return;
    } */
    //typeof(elementEmail) != 'undefined' && elementEmail != null
    if (!document.getElementById("emailAddress") || !document.getElementById("dhod") || !document.getElementById("whichhotel") ){
        //alert("Please fill out all fields");
        toastr.error("Please fill out all fields",  {timeOut: 150000});
        return;
    }else{
    
    const emailAddress = document.querySelector('#emailAddress').value;
    const data = {
        
        dType : dType,
        emailAddress : emailAddress,
        whichhotel : whichhotel, 
        hFrom : hFrom,
        hTo : hTo,
        dReason : dReason,
        dhod: dhod
        
    }
    $.post(addhotelbooking, $('#bookhotelNOW').serialize(),  function(data){
        toastr.info("Sending Request, please wait....",  {timeOut: 100});
        if(data.status == 200){
            let newHtml, html;
            let hplace = document.getElementById("contract_list");
             html = '<tr><td>#</td><td>%type%</td><td>%email%</td><td>%destination%</td></tr>';
                  newHtml = html.replace('%type%', dType);
                  newHtml = newHtml.replace('%email%', emailAddress);
                  newHtml = newHtml.replace('%destination%', hFrom + "- " + hTo);
                  hplace.insertAdjacentHTML('afterbegin', newHtml);
                  toastr.success("Hotel Successfully Added",  {timeOut: 150000});
        }else if(data.status == 401){
              toastr.error("Please make sure all fields are filled",  {timeOut: 150000});
        }else{
            alert("Error Processing Request");
        }
    });
    
    }
}





/*
  postData(action, {"id": checkmerge})
        .then(data => console.log(JSON.stringify(data))) // JSON-string from `response.json()` call
        .catch(error => console.error(error));
*/


function postData(url = ``, data = {}) {
  // Default options are marked with *
    return fetch(url, {
        method: "POST", // *GET, POST, PUT, DELETE, etc.
        mode: "no-cors", // no-cors, cors, *same-origin
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
