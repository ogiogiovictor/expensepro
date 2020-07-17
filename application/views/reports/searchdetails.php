
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
                                <h4 class="title">ACCOUNT CODE</h4>
                                <p class="category"><?php echo $dCode; ?> - <?php echo $this->mainlocation->nameCode($dCode); ?></p>
                            </div>

                            <div class="card-content">  
                                <table class="table table-condensed table-responsive" id="mydata">
	                                    <thead class="text-primary">
	                                    	<th style="width:200px">Description of Item</th>
                                                <th>Details</th>
                                                <th>Code</th>
						<th>Amount</th>
                                                <th>Date</th>
                                                
	                                    </thead>
	                                    <tbody>
                               <?php
                               $doSum = "";
                                if($getWtransact){
                                       foreach ($getWtransact as $get) {
                                          $requestID = $get->requestID;
                                          $ex_Details = $get->ex_Details;
                                          $ex_Amount = $get->total;
                                          $ex_Code = $get->ex_Code;
                                          $datepaid = $get->datepaid;
                                         
                                          if($ex_Amount){
                                              $doSum += $ex_Amount;
                                          }
                                           
                                 ?>
                                  <tr>
                                    <td><?php echo $this->mainlocation->descriptionofitem($requestID); ?></td>
                                    <td><?php echo $ex_Details; ?></td>
                                    <td><?php echo $ex_Code; ?></td>
                                    <td><?php echo $ex_Amount; ?></td>
                                    <td><?php echo $datepaid; ?></td> 
                                 </tr>
                                <?php
                                           
                                       }
                                }
                               ?>
                                 </tbody>
	                      </table>
                         <?php echo '<div><br/><b>Total : ' . @number_format(@$doSum, 2) . '</b><br/><small>Date Range: From: ' . $start . '  To:  ' . $end . '</small></div>'; ?>
                        </div>
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

            });

        </script> 

        <?php echo $footer; ?>