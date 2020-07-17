<div class="row">
                                        <div class="col-md-3">
                                            
                                           <div style="margin-left:20px; margin-top:5px; width:250px; padding:5px; border:1px solid whitesmoke">
                                                <form class="form-inline" role="form" action="<?php echo base_url().'accountspaid/getsearchbytype'; ?>" method="POST">

                                                    <br/>
                                                    <span style="color:blue">Search Parameter : ID, Amount, Benficiary, Requester, Email, Amount </span><br/>

                                                    <select style="width:200px"  name="searchcriteria" class="form-controls">
                                                        <option value="">Select Criteria</option>
                                                        <option value="id">ID</option>
                                                        <option value="fullname">Requester Name</option>
                                                        <option value="benName">Beneficiary Name</option>
                                                        <option value="dAmount">Amount</option>
                                                    </select>
                                                    <br/>
                                                     <input style="width:200px" name="search" placeholder="" type="text" class="form-controls"  id="search">
                                                     <br/>
                                                     <button type="submit" class="btn btn-xs btn-facebook">Go</button>

                                                <!--<button style="margin-top:30px" type="submit" class="btn btn-sm btn-facebook">Go</button>-->
                                                </form>
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="col-md-3">
                                            
                                            <div style="margin-left:20px; margin-top:5px; width:250px; padding:5px; border:1px solid whitesmoke">
                                                <form class="form-inline" role="form" action="<?php echo base_url().'accountspaid/getformonthyear'; ?>" method="POST">

                                                    <br/>
                                                    <span style="color:blue">Search Parameter : Month / Year </span><br/>

                                                    <select style="width:200px"  name="dyear" id="dyear" class="form-controls">
                                                        <option value="">Select Year</option>
                                                        <option value="2017">2017</option>
                                                        <option value="2018">2018</option>
                                                        <option value="2019">2019</option>
                                                    </select>
                                                    <br/>
                                                   
                                                  
                                                    <select style="width:200px"  name="dmonth" id="dmonth" class="form-controls">
                                                       <option value="">Select Month</option>
                                                       <option value="01">January</option>
                                                       <option value="02">February</option>
                                                       <option value="03">March</option>
                                                       <option value="04">April</option>
                                                       <option value="05">May</option>
                                                       <option value="06">June</option>
                                                       <option value="07">July</option>
                                                       <option value="08">August</option>
                                                       <option value="09">September</option>
                                                       <option value="10">October</option>
                                                       <option value="11">November</option>
                                                       <option value="12">December</option>
                                                    </select>
                                                    
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
                                                     <select style="width:200px"  name="dUnit" id="dUnit" class="form-controls">
                                                       <option value="">Select Unit</option>
                                                       <?php echo $dunit; ?>
                                                    </select>
                                                     
                                                     <button type="submit" class="btn btn-xs btn-facebook">Go</button>

                                                <!--<button style="margin-top:30px" type="submit" class="btn btn-sm btn-facebook">Go</button>-->
                                                </form>
                                            </div>
                                            
                                        </div>
                                        
                                        
                                        
                                        <div class="col-md-3">
                                             <div style="margin-left:20px; margin-top:5px; width:250px; padding:5px; border:1px solid whitesmoke">
                                                <form class="form-inline" role="form" action="<?php echo base_url().'accountspaid/searchunpaidchequesms'; ?>" method="POST">

                                                    <br/>
                                                    <span style="color:blue">Search Range : By Range(Amount) </span><br/>

                                                    <select style="width:200px"  name="searchrange" id="searchrange" class="form-controls">
                                                        <option value="">Select Range</option>
                                                        <option value="1000, 50000">1000 - 50,000</option>
                                                        <option value="50000, 500000">50,000 - 500,000</option>
                                                        <option value="500000, 5000000">500,000 - 5,000,000</option>
                                                        <option value="5000000, 10000000">5,000,000 - 10,000,000</option>
                                                        <option value="10000000, 30000000">10,000,000 - 30,000,000</option>
                                                        <option value="30000000, 60000000">30,000,000 - 60,000,000</option>
                                                        <option value="60000000, 100000000">60,000,000 - 100,000,000</option> 
                                                    </select>
                                                    <br/>
                                                    
                                                     <button type="submit" class="btn btn-xs btn-facebook">Go</button>

                                                <!--<button style="margin-top:30px" type="submit" class="btn btn-sm btn-facebook">Go</button>-->
                                                </form>
                                            </div>
                                        </div>
                                        
                                        
                                        
                                        <div class="col-md-3">
                                            <!--four -->
                                        </div>
                                    </div>