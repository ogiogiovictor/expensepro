$(document).ready(function(){
   
   fetch('http://localhost/expensepro/API/dashboard/index')
  .then(function(response) {
    return response.json();
  })
  .then(function(myJson) {
    console.log(JSON.stringify(myJson));
  });
  
});