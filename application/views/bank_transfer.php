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
                                <h4 class="title">BANK TRANSFER 

                                </h4>

                                <p class="category">transaction for bank transfer only</p>
                            </div>


                            <div class="card-content table-responsive">

                                <table class="table table-responsive table-hover table-condensed" id="mydata">
                                    <thead class="text-primary">
                                    <th>ID</th>
                                    <th>Date </th>
                                    <th>Description</th>
                                    <th>Unit</th>
                                    <th>Vendor</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                    </thead>
                                    <tbody>
                                        <?php if ($result) { ?>
                                            <?php
                                            foreach ($result as $get) {
                                                $id = $get->id;
                                                $description_transfer = $get->description_transfer;
                                                $tr_dateCreated = $get->tr_dateCreated;
                                                $tr_dUnit = $get->tr_dUnit;
                                                $tr_vendor = $get->tr_vendor;
                                                $tr_exAmount = $get->tr_exAmount;
                                                $staus = $get->status;
                                                 $file_new_name = $get->file_new_name;
                                                 $code = $get->tr_exCode;

                                                if ($staus == '1') {
                                                    $mainStauts = "<span class='btn btn-xs btn-danger'>pending</span>";
                                                    $btn = "";
                                                } else if ($staus == '2') { //With HOD
                                                    $mainStauts = "<span class='btn btn-xs btn-warning'>with icu</span>";
                                                } else if ($staus == '3') { //With ICU
                                                    $mainStauts = "<span class='btn btn-xs btn-warning'>with account</span>";
                                                } else if ($tillType == '4') { // With Account
                                                    $mainStauts = "<span class='btn btn-xs btn-warning'>paid</span>";
                                                } else {
                                                    $mainStauts = "";
                                                }


                                                if ($staus == '1' && $getApprovalLevel == '2') { //HOD to approve
                                                    $btn = "<button id='$id' class='btn btn-xs btn-teal hodapprovalme'>Approve</button>";
                                                } else if ($staus == '2' && $getApprovalLevel == '3') { //ICU to appprove
                                                    $btn = "<button id='$id' class='btn btn-xs btn-primary hodapprovalme'>Verify</button>";
                                                } else if ($staus == '3' && $getApprovalLevel == '7') {
                                                    $btn = "<button id='$id' class='btn btn-xs btn-danger hodapprovalme'>Pay</button>";
                                                } else if ($staus == '1' && $getApprovalLevel == '6') {
                                                    $btn = "<button id='$id' class='btn btn-xs btn-info hodapprovalme'>Approve</button>";
                                                }else{
                                                    $btn = "";
                                                }
                                                //    $newrand = random_string('alnum', 16);
                                                ?> 
                                        
                                                <tr>
                                                    <td><?php echo $id; ?></td>
                                                    <td><?php echo $tr_dateCreated; ?></td>
                                                    <td><a target="_blank" href="<?php echo base_url(). "public/documents/".$file_new_name ; ?>"><?php echo $description_transfer; ?></a>
                                                        <br/><b>Code : <?php echo $this->generalmd->getsinglecolumn("codeName", "unitaccountcode", "codeNumber", $code); ?>    - <?php echo $code; ?></b>
                                                    </td>
                                                    <td><?php echo $this->generalmd->getsinglecolumn("unitName", "cash_unit", "id", $tr_dUnit); ?></td>
                                                    <td><?php echo str_replace("_", " ", $tr_vendor); ?></td>
                                                    <td><?php echo "₦" . @number_format($tr_exAmount, 2); ?></td>
                                                    <td><?php echo $mainStauts; ?></td>
                                                    <td>
                                                        <?php echo $btn; ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>

                                        <?php } ?>
                                    </tbody>
                                </table>
                                <hr/>

                            </div>
                        </div>
                    </div>

                    <!-- End of Request Details with Status -->

                    <!-- POP UP BOX HERE -->
                    <div id="popup-box" class="popup-position">
                        <div id="popup-wrapper">
                            <div id="popup-container">
                                <span class="pull-right"><a href="javascript:void(0)" onClick="toggle_visibility('popup-box');">close</a></span>
                                <span id="eloaddformerror"></span>
                                <span id="loaddepdetails"></span>
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
            $(document).ready(function () {

                $('.hodapprovalme').click(function (e) {
                    var id = $(this).attr('id');
                    var action = GLOBALS.appRoot+ "postrequest/approvetransfer";
                    if (id === "") {
                         toastr.info('Important Variable Missing');
                    } else {

                        $('#showError').html("Processing, Please wait...");

                        $.post(action, {id: id}, function (data) {
                            if (data.status === 200) {
                              toastr.info(data.msg);
                              setTimeout(function () { window.location.reload(1); }, 1000);
                            }
                        }).fail(function () { toastr.info('Error Loading Data, Please try again');  });
                    }
                });
            });

        </script>
        <?php echo $footer; ?>