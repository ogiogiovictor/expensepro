
 $("#addgovlevies").click(function(){
    
    var action = GLOBALS.appRoot + "setup/processvattax";
    var vat = $('#vat').val(); 
    var withold = $('#withold').val(); 
   
    if(vat == "" || withold ==""){
        $('#insurerror').html('Please make sure all filed are filled');
    }else{
        
        $('#insurerror').html('Setting up VAT Processes, Please wait.....').addClass('errorRed');
         $.post(action,  $('#vatwitholdtax').serialize(), function (data) {
              if (data.msg) {
                  $('#insurerror').html(data.msg).addClass('alert alert-success');
                  setTimeout(function(){window.top.location= GLOBALS.appRoot + "setup/setuplevies/"} , 100);
                 $('#vatactnumber').val('');
                  $('#vat').val('');
                  
             }else if (data.warr) {
                  $('#insurerror').html(data.warr).addClass('errorRed')
             }
         });
    }
    
 });
 
 
 
 
  $("#addwitholdingtax").click(function(){
    
    var action = GLOBALS.appRoot + "setup/processwitholding";
    var details = $('#details').val(); 
    var witholding = $('#witholding').val(); 
    var actwitholdnumber = $('#actwitholdnumber').val(); 
   
    if(details == "" || witholding =="" || actwitholdnumber ==""){
        $('#insurerror').html('Please make sure all filed are filled');
    }else{
        
        $('#insurerror').html('Setting up VAT Processes, Please wait.....').addClass('errorRed');
         $.post(action,  $('#witholdtax').serialize(), function (data) {
              if (data.msg) {
                  $('#insurerror').html(data.msg).addClass('errorGreen');
                  setTimeout(function(){window.top.location= GLOBALS.appRoot + "setup/witholdingtax/"} , 100);
                 $('#details').val('');
                 $('#witholding').val('');
                 $('#actwitholdnumber').val('');
                  
             }else if (data.warr) {
                  $('#insurerror').html(data.warr).addClass('errorRed')
             }
         });
    }
    
 });


 function load_Page(pageToLoad, caller) {
   //$("#partialLoader").load(pageToLoad);
   $('.pageContent').hide();
   $('#' + pageToLoad).show();
   $(".menuitem").removeClass('activeMenu');
   $("#" + caller).addClass('activeMenu');
 }
 
 
 
 $("#addCode").click(function(e){
    $( ".closing" ).toggle( 'slow' );
    $( "#open" ).toggle('slide');
 });
