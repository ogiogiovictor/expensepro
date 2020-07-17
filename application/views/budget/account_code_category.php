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

                    <div class="col-md-4">     

                        <form name="accountCodeCategory" id="accountCodeCategory"  onsubmit="return false;">
                            <!-- Inside Content Begins  Here -->
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header" data-background-color="blue">
                                        <h4 class="title"><span class="tastkform"><span style="color:white">ITEM BUDGET SETUP</span></span></h4>

                                    </div>


                                    <div class="card-content">


                                        <div class="col-md-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Add Category</label>
                                                <input type="text"   class="form-controls" name="icategory" id="icategory" />
                                            </div>
                                        </div>




                                        <center><button class="btn btn-sm btn-danger" id="add_category">Add Account Category</button></center>

                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- End of Request Details with Status -->

                    </div>   



                    <div class="col-md-8">     

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="blue">
                                    <h4 class="title">
                                        <span class="tastkform" style="color:white">
                                            <span style="color:white">ACCOUNT CATEGORY </span>
                                           </span>
                                    </h4>


                                </div>

                                <div class="card-content">
                                    <div class="table-responsive" style="height:410px; overflow: scroll">
                                        <table class="table table-responsive table-bordered table-hovered" >
                                            <thead>
                                                <tr>
                                                    <th><b>id</b></th> 
                                                    <th><b>Category Group</b></th>
                                                </tr>
                                            </thead>

                                            <tbody id="contract_list" >

                                                <?php 
                                                    if($allCategory){
                                                        foreach($allCategory as $get){
                                                            $id  = $get->id;
                                                            $group_name  = $get->group_name;
                                                 ?>
                                                
                                                
                                                <tr>
                                                    <td><?php echo $id; ?></td>
                                                    <td><?php echo $group_name; ?></td>
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

                        <!-- End of Request Details with Status -->

                    </div>   










                </div>
            </div>

            <!-- Main Outer Content Ends  Here -->
            <script type="text/javascript">
                $(document).ready(function () {

                    $('#add_category').click(function (e) {

                        var pushBudget_Item = "http://localhost:8080/expenseprov2/budget/postaccountcodecategory/";
                        const icategory = document.querySelector('#icategory');
                      
                        if (icategory == "") {
                            toastr.info("Category Cannot Be Empty", {timeOut: 150000});
                        } else {

                            $.post(pushBudget_Item, $('#accountCodeCategory').serialize(), function (data) {
                                if (data.status === 200) {
                                    toastr.success("Category Successfully Setup", {timeOut: 150000});
                                   setTimeout(function () {
                                        window.location.reload(1);
                                    });
                                   
                                } else{
                                   toastr.error("Ooop! Something Went Wrong, Please Try Again Later", {timeOut: 150000}); 
                                }
                            });
                        }

                    });

                });
            </script>
<?php echo $footer; ?>
