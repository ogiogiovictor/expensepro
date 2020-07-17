/* 
 * globals.js 
 * This file contains global definintions applying to all or most files
 */

var GLOBALS = {};

GLOBALS = {
    userInfo: {
        id: null,
        email: null,
        userName: null,
        accessStatus: null
    },
    refreshedTaskInfoCookieName: '__w212ik_',//localhost/hubslink/
    appRoot: 'http://localhost:8080/expenseprov2/', //http://localhost:8080/expenseprov2/
    lockAllUpdates: false
};

$(document).ready(function() {
        $("input[id^='upload_file']").each(function() {
            var id = parseInt(this.id.replace("upload_file", ""));
            $("#upload_file" + id).change(function() {
                if ($("#upload_file" + id).val() !== "") {
                    $("#moreImageUploadLink").show();
                }
            });
        });
 });
 
 
 $(document).ready(function() {
        var upload_number = 2;
        $('#attachMore').click(function() {
            //add more file
            var moreUploadTag = '';
            moreUploadTag += '<span class="element"><span for="upload_file"' + upload_number + '>Upload File ' + upload_number + '</span>';
            moreUploadTag += '<input type="file" id="upload_file' + upload_number + '" name="upload_file' + upload_number + '"/>';
            moreUploadTag += '&nbsp;<a href="javascript:del_file(' + upload_number + ')" style="cursor:pointer;" onclick="return confirm(\"Are you really want to delete ?\")">Delete ' + upload_number + '</a></span>';
            $('<dl id="delete_file' + upload_number + '">' + moreUploadTag + '</dl>').fadeIn('slow').appendTo('#moreImageUpload');
            upload_number++;
        });
    });
    
  function del_file(eleId) {
        var ele = document.getElementById("delete_file" + eleId);
        ele.parentNode.removeChild(ele);
    }
   
 function sumIt() {
    var total = 0, val;
    $('.exAmount').each(function() {
      val = $(this).val();
      val = isNaN(val) || $.trim(val) === "" ? 0 : parseFloat(val);
      total += val;
    });
    //$('#sumAmount').html(Math.round(total));
    $('#sumAmount').html(parseFloat(total).toFixed(2).toLocaleString('en'));
    //$('#total_amount').val(Math.round(total));
    $('#suminput').html('<input type="hidden" name="sumall" id="sumall"  value='+ parseFloat(total).toFixed(2) +' />');
}
    
 $(function() {
  $("#sumAmount").on("change", function() {
    $("#employee_table input").next()
      .before($("<input />").prop("class","exAmount").val(0))
      .before("<br/>");
    sumIt();  
  });


  $(document).on('input', '.exAmount', sumIt);
  sumIt() // run when loading
});