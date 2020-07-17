<style type="text/css">
    .basicstyle{
        font-size:25px;
        font-weight: bold;
        padding:15px;
    }
    ul.tabs{
        margin: 0px;
        padding: 0px;
        list-style: none;
    }
    ul.tabs li{
        background: none;
        color: #222;
        display: inline-block;
        padding: 10px 15px;
        cursor: pointer;
    }

    ul.tabs li.current{
        background: #ededed;
        color: #222;
    }

    .tab-content{
        display: none;
        background: #ededed;
        padding: 15px;
    }

    .tab-content.current{
        display: inherit;
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
                                <h4 class="title">Report</h4>
                                <p class="category">Please make sure you select a Date Range</p>
                            </div>

                            <div class="card-content">  
                                <?php
                                $getunit = $this->mainlocation->getallunit();

                                if ($getunit) {
                                    $dunit = "";
                                    foreach ($getunit as $get) {

                                        $id = $get->id;
                                        $unitName = $get->unitName;
                                        $dunit .= "<option  value=\"$id\">" . $unitName . '</option>';
                                    }
                                }
                                ?>	


                                <div class="dtabs">

                                    <ul class="tabs">
                                        <li class="tab-link current" data-tab="tab-1"><b>BY TRANSACTION</b></li>
                                        <li class="tab-link" data-tab="tab-2"><b>BY ACCOUNT/TRANSACTION</b></li>
                                        <li class="tab-link" data-tab="tab-3"><b>BY STAFF</b></li>
                                        <li class="tab-link" data-tab="tab-4"><b>BY ACCOUNT CODE</b></li>
                                    </ul>

                                    <div id="tab-1" class="tab-content current">
                                        <?php
                                        if ($getApprovalLevel == 6 || $getApprovalLevel == 3 || $getApprovalLevel == 5 || $getApprovalLevel == 7) {
                                            echo "<form name='travelexpenseform'  method='POST' action='' onSubmit='return false;' >
                                           
                                        <!-- Rejection includes 5, 6, 12 -->
                                                    <select name='unit' id='unit' style='width:100px'>
                                                        <option value=''>Select Unit</option>
                                                        <option value='all'>All</option>
                                                        $dunit
                                                    </select>
                                                    
                                                    <select name='status' id='status' style='width:100px'>
                                                        <option value=''>Select Status</option>
                                                        <option value='approved'>Paid</option>
                                                        <option value='rejected'>Rejected</option>
                                                        <option value='awaiting'>Awaiting</option>
                                                    </select>
                                                      <span class=''>Start Date</span>&nbsp;<input type='text' style='width:100px' placeholder='yyyy-mm-dd' name='start' id='start' class='justdate' />
                                                       <span class=''>End Date </span>&nbsp;<input type='text' style='width:100px' placeholder='yyyy-mm-dd' name='end' id='end' class='justdate' />
                                                       
                                                       <span style='background-color:#e1e4ea; padding:10px; margin-left:10px; margin-right:10px'><span style='font-weight:bolder; font-size:15px; margin-right:20px;'>Set Criteria</span> 
                                                        <input type='radio' name='dex' id='dex' value='expense'/>&nbsp;<span class=''>Expense  </span>
                                                        <input type='radio' name='dex' id='dex' value='travel'/> &nbsp;<span class=''>Travel  </span>
                                                        <input type='radio' name='dex' id='dex' value='both'/>&nbsp;<span class=''>Both </span>
                                                       </span>
                                                      
                                                      <input type='submit' value='Search' id='expensetravel' name='expensetravel' class='btn btn-md btn-facebook'/>
                                                     
                                        </form>";
                                        }
                                        ?>
                                    </div>   

                                    <div id="tab-2" class="tab-content">
                                       
                                        <?php
                                        if ($getApprovalLevel == 6 || $getApprovalLevel == 3 || $getApprovalLevel == 5 || $getApprovalLevel == 7) {
                                            echo "<form name='travelexpenseform'  method='POST' action='' onSubmit='return false;' >
                                           
                                        <!-- Rejection includes 5, 6, 12 -->
                                                    <select name='aCode' id='aCode' style='width:200px'>
                                                        <option value=''>Select Account Code</option>
                                                        <option value='all'>All</option>
                                                        $fillSelect
                                                    </select>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                      <span class=''>Start Date</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                                      <input type='text' name='ex_start' id='ex_start'  style='width:100px' placeholder='yyyy-mm-dd' class='justdate' />
                                                      &nbsp;&nbsp;&nbsp; 
                                                      <span class=''>End Date </span>&nbsp;&nbsp;&nbsp;&nbsp;
                                                      <input type='text' style='width:100px' placeholder='yyyy-mm-dd' name='ex_end' id='ex_end' class='justdate' />
                                                      
                                                      <input type='submit' value='Search' id='myexpenseCode' name='myexpenseCode' class='btn btn-sm btn-google'/>
                                                     
                                        </form>";
                                        }
                                        ?>

                                    </div>
                                    
                                    <div id="tab-3" class="tab-content">
                                         <?php
                                        if ($getApprovalLevel == 6 || $getApprovalLevel == 3 || $getApprovalLevel == 5 || $getApprovalLevel == 7) {
                                            echo "<form name='travelStaffForm'  method='POST' action='' onSubmit='return false;' >
                                           
                                        <!-- Rejection includes 5, 6, 12 -->
                                                    <select name='userEmail' id='userEmail' style='width:200px'>
                                                        <option value=''>Select Staff</option>
                                                        $allStaff
                                                    </select>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                      <span class=''>Start Date</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                                      <input type='text' name='sf_start' id='sf_start'  style='width:100px' placeholder='yyyy-mm-dd' class='justdate' />
                                                      &nbsp; 
                                                      <span class=''>End Date </span>&nbsp;&nbsp;
                                                      <input type='text' style='width:100px' placeholder='yyyy-mm-dd' name='ef_end' id='ef_end' class='justdate' />
                                                      
                                                       <span style='background-color:#e1e4ea; padding:10px; margin-left:10px; margin-right:10px'><span style='font-weight:bolder; font-size:15px; margin-right:20px;'>Set Criteria</span> 
                                                        <!--<input type='radio' name='dexs' id='dexs' value='expenses'/>&nbsp;<span class=''>Expense  </span>-->
                                                        <input type='checkbox' name='dexs' id='dexs' value='travel'/> &nbsp;<span class=''>Travel  </span>
                                                        <!--<input type='checkbox' name='dexs' id='dexs' value='boths'/>&nbsp;<span class=''>Both </span>-->
                                                       </span>
                                                       
                                                      <input type='submit' value='Search' id='travelBystaff' name='travelBystaff' class='btn btn-sm btn-facebook'/>
                                                     
                                        </form>";
                                        }
                                        ?>
                                    </div>
                                    
                                    
                                    
                                    
                                    
                                    
                                     <div id="tab-4" class="tab-content">
                                         <?php
                                         //<form name='travelexpenseform'  method='POST' action='' onSubmit='return false;' >
                                                 
                                        if ($getApprovalLevel == 6 || $getApprovalLevel == 3 || $getApprovalLevel == 5 || $getApprovalLevel == 7) {
                                             echo "<form name='catmaintform'  method='POST' action='http://localhost:8080/expenseprov2/travels/exportoexcel' >
                                           
                                        <!-- Rejection includes 5, 6, 12 -->
                                                    <select name='acc_unit' id='acc_unit' style='width:100px'>
                                                        <option value=''>Select Unit</option>
                                                        <option value='all'>All</option>
                                                        $dunit
                                                    </select>
                                                    
                                                    <select name='acc_status' id='acc_status' style='width:100px'>
                                                        <option value=''>Select Status</option>
                                                        <option value='approved'>Paid</option>
                                                        <option value='rejected'>Rejected</option>
                                                        <option value='awaiting'>Awaiting</option>
                                                    </select>
                                                    

                                                    <!--<select name='acc_currency' id='acc_currency' style='width:100px'>
                                                        <option value=''>Select Currency</option>
                                                        <option value='NGN'>NAIRA</option>
                                                        <option value='Other'>OTHERS</option>
                                                    </select>-->
                                                    
                                                    
                                                      <span class=''>Start Date</span>&nbsp;<input type='text' style='width:100px' placeholder='yyyy-mm-dd' name='acc_start' id='acc_start' class='justdate' />
                                                       <span class=''>End Date </span>&nbsp;<input type='text' style='width:100px' placeholder='yyyy-mm-dd' name='acc_end' id='acc_end' class='justdate' />
                                                       
                                                      
                                                      <input type='submit' value='Export' id='getaccountcodeonly' name='getaccountcodeonly' class='btn btn-sm btn-danger'/>
                                                     
                                        </form>";
                                        }
                                        ?>
                                    </div>

                                </div><!-- END OF TABBED CONTENT     -->



                            </div>

                            <!-- BEGINNING OF SEARCH RESULT -->

                            <div  class="card-content">
                                <div id="results"></div>
                            </div>
                            <!-- END OF SEARCH RESULT -->


                        </div>
                    </div>

                    <!-- End of Request Details with Status -->




                    <!-- Inside Content Ends Here -->


                </div>
            </div>
        </div>
        <!-- Main Outer Content Ends  Here -->  

        <script>
            $(function () {
                $('#hodall').DataTable({
                    dom: 'Bfrtip',
                    buttons: ['excel', 'pdf']
                            //buttons: [ 'colvis' ]
                });

                $('ul.tabs li').click(function () {
                    var tab_id = $(this).attr('data-tab');

                    $('ul.tabs li').removeClass('current');
                    $('.tab-content').removeClass('current');

                    $(this).addClass('current');
                    $("#" + tab_id).addClass('current');
                });


            });

        </script> 

        <?php echo $footer; ?>