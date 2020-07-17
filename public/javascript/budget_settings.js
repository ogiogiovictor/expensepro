const setBudget = document.querySelector('#setup_budget');
setBudget.addEventListener('click', (e) => pushBudget(event));
 
var smallBudget = "http://localhost:8080/expenseprov2/budget/budgetsetup/";

const pushBudget = (event) => {
    event.preventDefault();
    const selectUnit = document.querySelector('#selectUnit').value;
    const year = document.querySelector('#year');
    const amount = document.querySelector('#amount');
    const monthinyear = document.querySelector('#monthinyear').value;
    const comments = document.querySelector('#comments').value;
   
    /* if(dType == "" || dType == null || emailAddress){
       alert("please select type");
       return;
    } */
    //typeof(elementEmail) != 'undefined' && elementEmail != null
    if (!document.getElementById("selectUnit") || !document.getElementById("amount") || !document.getElementById("amount") || !document.getElementById("monthinyear") ){
        //alert("Please fill out all fields");
        toastr.error("Please fill out all fields",  {timeOut: 150000});
        return;
    }else{
    
    const data = {
        
        selectUnit : selectUnit,
        year : year,
        amount : amount, 
        monthinyear : monthinyear,
        comments : comments,
    }
    
    $.post(smallBudget, $('#setupBudgetparams').serialize(),  function(data){
           toastr.info("Preparing Budget, please wait....",  {timeOut: 100});
        if(data.status === 200){
            let newHtml, html;
            let hplace = document.getElementById("contract_list");
            html = '<tr><td>#</td><td>%selectUnit%</td><td>%year%</td><td>%monthinyear%</td><td>%amount%</td><td>%amount%</td></tr>';
                  newHtml = html.replace('%selectUnit%', selectUnit);
                  newHtml = newHtml.replace('%year%', data.idata.year);
                  newHtml = newHtml.replace('%monthinyear%', monthinyear);
                  newHtml = newHtml.replace('%amount%', data.idata.amount);
                   newHtml = newHtml.replace('%amount%', data.idata.budget_lock);
                  hplace.insertAdjacentHTML('afterbegin', newHtml);
                  toastr.success("Budget Successfully Setup",  {timeOut: 150000});
                  setTimeout(function(){ window.location.reload(1); });
        }else if(data.status === 400){
            toastr.error("We cannot process your request at the moment, please try later",  {timeOut: 150000});
        }else if(data.status === 401){
            toastr.error("Please make sure all fields are field",  {timeOut: 150000});
        }else if(data.status === 402){
            toastr.error("Unit Budget Already Exist",  {timeOut: 150000});
        }else{
            alert("Error Processing Request");
        }
    });
    
    }
}


var lockOverview = "http://localhost:8080/expenseprov2/budget/locking/";

 $('.unlock').click(function(e){
    var assetid = $(this).attr('id');
    if(!assetid){
       toastr.error("Important Variable to Render Page Is Missing",  {timeOut: 150000});  
    }else{
        
         toastr.info("Locking Down Payment",  {timeOut: 150000});  
         $.post(lockOverview, {assetid: assetid}, function (data) {
              if (data.status === 200) {
                 toastr.success("Budget Successfully Locked",  {timeOut: 150000});
                   setTimeout(function(){ window.location.reload(1); });
             }else if (data.warr) {
                 toastr.error("Error Processing Request",  {timeOut: 150000});  
             }
         });
    }
    
 });



