$(document).ready(function(){
    $.ajax({
        url : "https://c-iprocure.com/expensepro/supports/getgraphresultforhodreport",
        method : "GET", 
        success: function(data){ 
        var myRequest = [];
        var sumAmount = [];
        
        for(var i in data){
            myRequest.push(data[i].myRequest);
            sumAmount.push(data[i].sumAmount);
        }
        
        var chartdata = {
            labels: myRequest, 
            datasets :[{
                  
            label : 'Individual Expense',
            backgroundColor: [
                'rgba(255, 99, 132, 0.75)',
                'rgba(54, 162, 235, 0.82)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 19)',
                'rgba(153, 102, 255, 1.2)',
                'rgba(55, 159, 64, 2.2)',
                'rgba(76, 109, 64, 1.2)',
                'rgba(255, 86, 255, 1.2)',
                'rgba(255, 100, 100, 1.2)',
                'rgba(255, 110, 240, 4.2)',
                'rgba(255, 10, 20, 1.2)',
                'rgba(155, 99, 90, 2.2)',
                'rgba(159, 199, 80, 2.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(55, 159, 64, 1)',
                'rgba(93, 189, 64, 3.2)',
                'rgba(255, 86, 255, 1.2)',
                'rgba(255, 100, 100, 1.2)',
                 'rgba(255, 110, 2450, 4.2)',
                 'rgba(255, 10, 20, 1.2)',
                 'rgba(155, 99, 90, 2.2)',
                 'rgba(159, 199, 80, 2.2)'
            ],
                //var numSum = parseFloat(sumAmount);
               
                    data: sumAmount
                        
                }],
            
        };
        
        var ctx = document.getElementById("mycanvashod");
        //var ctx = $("mycanvas");
        var barGraph = new Chart(ctx,{
            type: 'doughnut', 
            data: chartdata
        });
        },
        error: function(data){
            alert("error loading graph.");
        }
    });
});