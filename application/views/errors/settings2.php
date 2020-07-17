
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


                    <!-- Inside Content Begins  Here -->

                    <!-- Beginning of Request Details with Status -->
                    <form name="dFormpost" id="dFormpost" onsubmit="return false;"/>
                    <div class="col-md-12">     
                        <div class="card">
                            <div class="card-header text-center" data-background-color="blue">
                                <h4 class="title">&nbsp;&nbsp;DATABASE TABLES</h3>


                            </div>

                            <div class="addform" style="margin-top:10px; padding:10px">
                                <div id="bankerror"></div>
                                <?php
                                if ($getSet) {
                                   // print_r($getSet);
                                    // echo "<table class='table table-responsive table-hovered'><tr><th>Table Name</th><th>Action</th></tr>";
                                    foreach ($getSet as $value) {
                                         //print_r($value['TABLE_NAME']);
                                        $getexplode = explode(",", $value['COLUMN_NAME']);
                                        
                                        $tableName = $value['TABLE_NAME'];
                                        $columName = $value['COLUMN_NAME'][0];
                                    }
                                }
                                // echo "</table>";
                               /* echo "First<br/><hr/>";
                                echo $value['TABLE_NAME'];
                                echo "<hr/>"; */
                                echo $tableName;
                                echo "<br/>";
                                ?>

                                <div class="table-responsive">
                                    <table class="table table-responsive table-bordered table-striped table-hovered" id="reqeustapproval">
                                        <thead class="text-primary">
                                            <?php
                                            $mainModule = $tableName;
                                            $getallresultMainTable = $this->primary->getdresultfordbseven("*", $mainModule, "", "");

                                             //print_r($getallresultMainTable);
                                             //echo "<br/><hr/>";
                                            $colunmNames = "";
                                            $getallresult = $this->primary->getcolumnames($mainModule);
                                            //var_dump($getallresult);
                                            if ($getallresult) {
                                                echo "<tr>";
                                                echo "<th>Chk</th>";
                                                foreach ($getallresult as $get) {

                                                    echo "<th>" . $get['COLUMN_NAME'] . "</th>";

                                                    $colunmNames .= $get['COLUMN_NAME'] . ",";
                                                }
                                                echo "<th>Action</th>";
                                                echo "</tr>";
                                            }
                                            ?>
                                        </thead>
                                        <tbody>

<?php
// echo "<br/><hr/> We are here<hr/>";
//echo $colunmNames;
//echo "<hr/>";

if ($getallresultMainTable) {
    foreach ($getallresultMainTable as $tabledefinition) {
        $explodecolumnItem = explode(",", $colunmNames);
       
        echo "<tr>";
        echo "<td><center><input type='checkbox' name='noID[]' id='noID' value='".$explodecolumnItem[0].','.$tableName.'-'.$tabledefinition->$explodecolumnItem[0]."'/>" . $tabledefinition->$explodecolumnItem[0] . "</center></td>";
        foreach ($explodecolumnItem as $key => $value) {
            //  echo $key." - ". $value. "<br/>";
            if ($key != "" && $value == "") {
                
            } else {
                echo "<td>" . trim($tabledefinition->$explodecolumnItem[$key]) . "</td>";
            }
        }
        echo "<td><a href='".base_url()."settings/eHr/$tableName/$getallresult/$explodecolumnItem'><button class='btn btn-xs btn-success fa fa-edit'></a></button>&nbsp;&nbsp;&nbsp;&nbsp;<button id='delicious' data-id='".$tabledefinition->$explodecolumnItem[0]."'  class='btn btn-xs btn-danger fa fa-trash'></button></td>";
        echo "</tr>";
    }
    echo "<input type='hidden' name='pK' id='pK' value='".$tabledefinition->$explodecolumnItem[0]."' />";
    echo "<input type='hidden' name='tableN' id='tableN' value='".$tableName."' />";
}
?>


                                        </tbody>
                                    </table>


                                    <div><button id="track" class="btn btn-sm btn-danger">Tracking...</button></div>
                                </div>
                            </div>
                            <hr/>



                            <div class="card-content">
                                <div  id="dynamicload">

                                    <!-- Beginnin of Form -->
                                    <span id="hotelMsg"></span>
                                    <div>
                                        <?php
                                       // $fileList = glob('xxx/*');
                                       //Loop through the array that glob returned.
                                       // foreach($fileList as $filename){
                                           //Simply print them out onto the screen.
                                         //  echo $filename, '<br>'; 
                                        //}
                                        
                                       
                                        ?>
                                    </div>

                                    <!-- End of Form -->

                                </div>
                            </div>



                        </div>
                    </div>
                    <!-- End of Request Details with Status -->
                </form>



                    <!-- Inside Content Ends Here -->


                </div>
            </div>
        </div>
        <!-- Main Outer Content Ends  Here -->  




<?php echo $footer; ?>
        <script>
            $(document).ready(function () {

                $('#reqeustapproval').DataTable({
                    dom: 'Bfrtip',
                    buttons: ['excel', 'pdf']
                });





                $('#delicious').click(function (e) {
                     var id = $(this).attr('data-id');
                     //alert(id);
                });


                $('#track').click(function (e) {

                    var action = GLOBALS.appRoot+"API/settings/seal/";
                    var lang = [];
                    var tableN = $('#tableN').val();
                    var pK = $('#pK').val();
                    
                    $("input[name='noID[]']:checked").each(function () {
                        lang.push(this.value);
                        //lang.push(parseInt($(this).val()));
                    });
                    
                    alert(lang);
                    if (lang != "") {
                        //alert(lang);
                        $('#bankerror').html("Processing Request, Please wait....<br/>").addClass("errorRed");
                         //$.post(action, {lang: lang, tableN: tableN, pK: pK}, function (data) {
                         $.post(action, $('#dFormpost').serialize(), function (data) {
                             alert(data);
                          if(data.status == 200){
                              //alert(data.msg);
                              //setTimeout(function(){ window.top.location.reload(1) } , 100);
                          }else{
                              alert(data.msg);
                          }
                         });
                    } else {
                        alert(lang+ "nothing to send");
                    }

                });

            });




        </script>   