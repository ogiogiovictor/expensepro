<link href="http://davidstutz.de/bootstrap-multiselect/dist/css/bootstrap-multiselect.css" rel="stylesheet">
<style type="text/css">
    .multiselect-container>li>a>label {
        padding: 4px 20px 3px 20px;
      }
     
</style>

<div class="wrapper">
    <div class="sidebar" data-color="blue" data-image="<?php echo base_url(); ?>assets/img/sidebar-1.jpg">

        <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
        -->

        <?php echo $sidebar; ?>

    </div>

    <div class="main-panel">

        <!-- Navigation Begins Here -->
        <?php echo $menu; ?>
        <!-- Navigation Ends Here -->



        <!-- Main Outer Content Begins Here --> 
        <div class="content">
            <div class="container-fluid">
                <div class="row">

                    <!-- Beginning of Request Details with Status -->

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header" data-background-color="blue">
                                <h4 class="title">MY DOCUMENT</h4> 

<!--<a href="<?php echo base_url(); ?>"><div class="pull-right">Back</div></a>-->

                                <p class="category">All Uploaded Documents</p>

                            </div>


                            <div class="card-content table-responsive">
                               
                                <table class="table table-responsive table-striped table-hover">
                                    <thead class="text-primary">
                                    <th>&nbsp;</th>
                                    <th>Doc</th>
                                    <th>Request Title</th>
                                    <th>Document Name</th>
                                    
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($getallresult) {

                                            foreach ($getallresult as $get) {

                                                $id = $get->id;
                                                //$getresultinID = $this->generalmd->getdresult("*", "cash_fileupload", "f_requestID", $id);
                                                $getresultinID = $this->generalmd->getdresultfromfile("cash_fileupload", "f_requestID", $id, "mimeType");
                                                if ($getresultinID) {
                                                    foreach ($getresultinID as $doc) {
                                                        $docid = $doc->fid;
                                                        $f_requestID = $doc->f_requestID;
                                                        $origFilename = $doc->origFilename;
                                                        $newFilename = $doc->newFilename;
                                                        $ext = $doc->ext;
                                                        $mimeType = $doc->mimeType;
                                                        $dateUploaded = $doc->dateUploaded;

                                                        if ($mimeType == "image/jpeg") {
                                                            $myview = "<img src=" . base_url() . "public/documents/$origFilename  style='width:50px'/>";
                                                        } else if ($mimeType == "application/vnd.openxmlformats-officedocument.wordprocessingml.document") {
                                                            $myview = "<img src=" . base_url() . "public/mysheets/doc.png  style='width:50px'/>";
                                                        } else if ($mimeType == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") {
                                                            $myview = "<img src=" . base_url() . "public/mysheets/sheet.png  style='width:50px'/>";
                                                        } else if ($mimeType == "application/vnd.openxmlformats-officedocument.presentationml.presentation") {
                                                            $myview = "<img src=" . base_url() . "public/mysheets/slides.png  style='width:50px'/>";
                                                        } else if ($mimeType == "message/rfc822" || $mimeType == "application/vnd.ms-outlook") {
                                                            $myview = "<img src=" . base_url() . "public/mysheets/outlook.png  style='width:50px'/>";
                                                        } else if ($mimeType == "text/html") {
                                                            $myview = "<img src=" . base_url() . "public/mysheets/html.png  style='width:50px'/>";
                                                        } else if ($mimeType == "application/zip") {
                                                            $myview = "<img src=" . base_url() . "public/mysheets/exe.png  style='width:50px'/>";
                                                        } else {
                                                            $myview = "<img src=" . base_url() . "public/mysheets/images.jpg  style='width:50px'/>";
                                                        }
                                                        ?>

                                                        <tr>
                                                            <td><input type="checkbox" name="myCheck" id="myCheck" value="<?php echo $docid; ?>"/></td>
                                                            <td style="padding:5px"><?php echo $myview; ?></td>
                                                            <td style="width:300px"><?php echo $this->generalmd->getsinglecolumn("ndescriptOfitem", "cash_newrequestdb", "id", $f_requestID); ?></td>
                                                            <td style="width:300px"><a href="<?php echo base_url(); ?>public/documents/<?php echo $origFilename; ?>"><?php echo $origFilename; ?></a></td>
                                                            <td></td>

                                                        </tr>

                                                        <?php
                                                    }
                                                }
                                            }
                                        }
                                        ?>
                                                        
                                   <a name="myCheck" class="btn btn-xs btn-danger" href="#" name="pullallhods" id="pullallhods" onClick="toggle_visibility('popup-box');">
                                    Share
                                    </a>
                                                                                  
                                    </tbody>
                                </table></div>


                        </div>
                    </div>
                    
                    
                    <form id="form1">


</form>
                    <!-- End of Request Details with Status -->
                    
                     <!-- POP UP BOX HERE -->
                            <div id="popup-box" class="popup-position" >
                                <div id="popup-wrapper">
                                    <div id="popup-container">
                                        <span class="pull-right"><a href="javascript:void(0)" onClick="toggle_visibility('popup-box');">close</a></span>
                                        <!--<h3>ADD PERIOD TO ASSET(S)</h3>-->
                                        <span id="eloaddformerror"></span>
                                        <div id="loaddepdetails"></div>
					
                                        

                                    </div>
                                </div>
                            </div>
         <!-- END OF POP UP BOX -->

                    <!-- Inside Content Ends Here -->


                </div>
            </div>
        </div>
        <!-- Main Outer Content Ends  Here -->  


<script type="text/javascript">
(function () {
    
  $('#pullallhods').click(function () {
    var lang = [];
    //var dBankAct = $('#dBankAct');
       // Initializing array with Checkbox checked values
        $("input[name='myCheck']:checked").each(function(){
            lang.push(this.value);
            //lang.push(parseInt($(this).val()));
        });
        // alert(lang);
         if(lang === ""){
             alert("Please make sure you select a checkbox");
             return;
         }else{
            $.ajax({
                url: GLOBALS.appRoot + "documents/getallhod/",
                type: "GET",
                dataType: "JSON"
                , success: function (data) {
                    $('#loaddepdetails').html('loading Supervisors, please wait....');
                    var output = '<small class="category">&nbsp;</small>';
                    
                    var output = '<form id="form1" action="" onSubmit="return false" id="sendmeattach" name="sendmeattach"><div style="padding:20px"><select class="form-controls" id="chkveg">';
                    for (var idx = 0; idx < data.ci.length; ++idx) {
                        output += '<option value="'+ data.ci[idx].email + '">'+ data.ci[idx].fname + ' '+ data.ci[idx].lname + '</option>';
                    }
                    output += '</select><br /><br /><center><button id="processLimit" onClick="sendocumentnow('+lang+')" class="btn btn-sm btn-fill btn-primary">SEND DOCUMENT</button></center></div></form>';
                    $('#loaddepdetails').html(output);

                },
                  error: function(data) {
                    var responseText=JSON.parse(data.responseText);
                     $('#loaddepdetails').html("Error Loading Supervisors, Please try again" + responseText);

                }
              })
             }

        });


})();
 </script>
 
 <script type="text/javascript">


function sendocumentnow(checkbx){
  var action = GLOBALS.appRoot + "documents/sendoctouser";
  var chkveg = $('#chkveg').val();
  if(chkveg === ""){
      $('#eloaddformerror').html("Please select the Person you are sending to");
  }else{
     $('#eloaddformerror').html("<small style='color:red'>Sending Document to '"+ chkveg + "', please wait...</small>");
      $.post(action, {checkbx: checkbx, chkveg: chkveg}, function (data){
           
             if(data.status == 1){
                 $('#eloaddformerror').html(data.msg).addClass('alert-success');
                 setTimeout(function(){window.top.location= GLOBALS.appRoot + "documents/"} , 100);  
             }else{
              $('#eloaddformerror').html(data.msg).addClass('alert-danger');   
            }
           
        });
  }
  
}
 

 </script>
 

<?php echo $footer; ?>