function ajaxObj( meth, url ) {
	var x = new XMLHttpRequest();
	x.open( meth, url, true);
	x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	return x;
}
function ajaxReturn(x){
	if(x.readyState == 4 && x.status == 200){
	    return true;	
	}
}

 function toggle_visibility(id) {

        var e = document.getElementById(id);
        if (e.style.display == 'block') {
            e.style.display = 'none';
        } else {
            e.style.display = 'block';
        }
    }
 
 
  $(document).ready(function() {
     $('#mycashtoremove').hide();
     $('#mychequaccout').hide();
     $('#mycurrencyType').hide();
     $('#mysageref').hide();
     $('#mypayeeName').hide();
     $('#mypayeeNameCheque').hide();
    $('select[name="paymentType"]').on('change',function(){
        var  others = $(this).val();
        if(others == "2"){  
        //$('#dcashier').attr('disabled','disabled'); 
        $('#mycashtoremove').hide();
        $('#mychequaccout').show();
        $('#mycurrencyType').show();
         $('#mysageref').show();
         $('#mypayeeNameCheque').show();
         $('#mypayeeName').hide();
         }else if(others == "1"){
         $('#mycashtoremove').show();
         $('#mychequaccout').hide();
         $('#mycurrencyType').hide();
         $('#mypayeeName').show();
          $('#mysageref').hide();
          $('#mypayeeNameCheque').hide();
        }else if(others == ""){
            $('#mycashtoremove').hide();
             $('#mychequaccout').hide();
             $('#mycurrencyType').hide();
              $('#mysageref').hide();
              $('#mypayeeName').hide();
              $('#mypayeeNameCheque').hide();
        }  

      });
      
    $( "#showmakerequestform" ).click( function() {
    $( "#makerequestformfortill" ).toggle( 'slow' );
    }); 
    
     $( "#viewtransact" ).click( function() {
    $( "#viewrequest" ).toggle( 'slow' );
    }); 
    
    
    //Processing multiple checkbox
    $("#makeRequest").click(function(){
       //Initializing the array for the check box
       
       var lang = [];
       // Initializing array with Checkbox checked values
        $("input[name='dChecked[]']:checked").each(function(){
            lang.push(this.value);
            //lang.push(parseInt($(this).val()));
        });
        
        if(lang != ""){
             $('#showErrorrequest').html('Sending Request please wait, please wait...');
            $.ajax({
                //url: GLOBALS.appRoot + "dprocess/maketillrequest",
                url: GLOBALS.appRoot + "action/cashierstillrequest",
                type: 'post',
                data: {lang:lang},
                dataType: 'JSON',
                success: function(response){
                     //$('#showErrorrequest').html('Sending Request please wait, please wait...');
                    if (response.status == 1) {
                        $('#showErrorrequest').html(JSON.stringify(response.msg)).addClass('alert alert-success');
                         //setTimeout(function () { window.location.reload(1); }, 5000); 
                         setTimeout(function(){window.top.location= GLOBALS.appRoot + "home/myrequest/"} , 100);
                    }else if (response.status == 0) {
                        $('#showErrorrequest').html(JSON.stringify(response.msg)).addClass('alert alert-danger');
                    }else if (response.status == 2) {
                        $('#showErrorrequest').html(JSON.stringify(response.msg)).addClass('alert alert-danger');
                    }else if (response.status == 3) {
                        $('#showErrorrequest').html(JSON.stringify(response.msg)).addClass('alert alert-danger');
                    }
                }
            });
        }else{
            alert("please select a checkbox");
        }
    });
      
 });