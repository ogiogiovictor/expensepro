<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="<?php echo base_url(); ?>assets/img/sidebar-1.jpg">

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

               
                    <div class="col-md-12">     

                        <form name="batchedHotel" id="batchedHotel" method="POST" action="<?php echo base_url(); ?>travelstart/hotelbeingbatched">
                            <!-- Inside Content Begins  Here -->
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header" data-background-color="blue">
                                        <h4 class="title"><span class="tastkform"><span style="color:white">SEND FOR PAYMENTS</span></span></h4>
                                         <span><a class="category btn btn-xs btn-danger" href="<?php echo base_url(); ?>travels/rejected">Batched Request</a></span>
                                    </div>

                                    <div class="card-content">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th><b>ID</b></th>
                                                    <th><b>Date</b></th> 
                                                    <th><b>Batch Title</b></th>
                                                    <th><b>Amount</b></th>
                                                    <th><b>BatchCode</b></th>
                                                     <th><b>Batch Status</b></th>
                                                      <th style="width:150px"><b>Action</b></th>
                                                </tr>
                                                </thead>
                                                      
                                                <tbody id="contract_list">
                                                  
                                                <?php
                                                    if($getallpayments){
                                                        foreach($getallpayments as $get){
                                                            $id = $get->id;
                                                            $batchTitle = $get->batchTitle;
                                                            $sumlID = $get->sumlID;
                                                            $batchAmount = $get->batchAmount;
                                                            $batchedBy = $get->batchedBy;
                                                            $batchCode = $get->batchCode;
                                                            $dateBatched = $get->dateBatched;
                                                            $batchedStatus = $get->batchedStatus;
                                                            $type = $get->type;
                                                            
                                                            if($batchedStatus == "pending"){
                                                                $batchedStatusShow = "";
                                                                //$batchedStatusShow = "<a href='".base_url()."travelstart/batchinvoiceforpayment/$id/$sumlID' class='btn btn-xs btn-danger'>Send</button>";
                                                            }else{
                                                                $batchedStatusShow = $batchedStatus;
                                                            }
                                                           
                                                 ?>
                                                  <tr>
                                                        <td><?php echo $id; ?></td>
                                                        <td><?php echo $dateBatched; ?> </td>
                                                         <td><?php echo $batchTitle; ?> </td>
                                                    <td><?php echo @number_format($batchAmount, 2); ?> </td>
                                                        <td><?php echo $batchCode; ?></td>
                                                        <td><?php echo $batchedStatus; ?></td>
                                                         <td>
                                                             <a href="<?php echo base_url(); ?>/travels/xmyHo4444mdsktel/<?php echo $sumlID; ?>" class="btn btn-xs btn-primary">View</a>
                                                             <?php echo $batchedStatusShow; ?>
                                                         </td>
                                                    </tr>
                                               
                                                
                                                <?php
                                                  }
                                                    }
                                                ?>
                                              </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- End of Request Details with Status -->

                    </div>   
                    
                    
                    
                    
                    
                    
                    
                </div>


            </div>
        </div>
        <!-- Main Outer Content Ends  Here -->
        <script src="<?php echo base_url(); ?>public/javascript/bookhotel.js"></script>
            <script type="text/javascript">
            $(document).ready(function () {
        
          $(document).on('click', '.newdatelog', function () {
                    $(this).datepicker({
                        //dateFormat: 'yy-mm-d',
                        format: 'yyyy-mm-dd',
                        weekStart: 1,
                        color: 'red'
                    });
                });



            });
        </script>
        <?php echo $footer; ?>
