<?php
$dgetheadersession = $this->users->checkUserSession($_SESSION['email']);
if ($dgetheadersession) {
    foreach ($dgetheadersession as $get) {
        $id = $get->id;
        $fname = $get->fname;
        $lname = $get->lname;
        $email = $get->email;
        $accessLevel = $get->accessLevel;
        $uLocation = $get->uLocation;
        $activation = $get->activation;
        $userStatus = $get->userStatus;
        $lastlogin = $get->lastlogin;
    }
}
?>

<div class="logo">
    <a href="#" class="simple-texts">
        <center>TBS - EXPENSE PRO
            <!--<div style="font-size:12px; color:grey;"><?php //echo $_SESSION['email'];    ?></div>-->
            <div style="font-size:12px; color:grey;"><?php echo ucfirst($fname) . " " . ucfirst($lname); ?></div>
        </center>
    </a>

</div>


<div class="sidebar-wrapper">
    <ul class="nav">
        <li class="<?php echo active_link('home'); ?>">
            <a href="<?php echo site_url('home'); ?>">
                <i class="material-icons">apps</i>
                <p>HOME</p>
            </a>
        </li>

        <hr/>
        <li style="font-weight:bold; font-size:18px; margin-left:30px">MY REQUEST</li>

        <li>
            <a href="<?php echo base_url(); ?>home/myawaitingapprovalpending">
                <i class='material-icons'>info</i>
                <p>Pending</p>
            </a>
        </li>

        <li>
            <a href="<?php echo base_url(); ?>home/allapprovedrequest">
                <i class='material-icons'>check_circle</i>
                <p>Approved</p>
            </a>
        </li>

        <li>
            <a href="<?php echo base_url(); ?>home/cancelrejected">
                <i class='material-icons'>cancel</i>
                <p>Rejected</p>
            </a>
        </li>


        <?php
        $getApprovalLevel = $this->mainlocation->getapprovallevel($_SESSION['email']);
        //Get second level approval ID
        $getLevelApprove = $this->users->getSecondlevelapproval($_SESSION['id']);
        ?>

        <li style="font-weight:bold; font-size:18px; margin-left:30px">APPROVALS</li>


        <?php
        if ($getApprovalLevel == 7) {
            ?>
            <li>
                <a href="<?php echo base_url(); ?>accounts/index">
                    <i class='material-icons'>moneybag</i>
                    <p>Request for Approval</p>
                </a>
            </li>
        <?php
        }else{
       ?>

            <li>
                <a href="<?php echo base_url(); ?>home/myapproval">
                    <i class='material-icons'>person</i>
                    <p>Request for Approval</p>
                </a>
            </li>

        <?php
        }
        ?>


            <li>
                <a href="<?php echo base_url(); ?>travels/index">
                    <i class='material-icons'>flight</i>
                    <p>Travel Start</p>
                </a>
            </li>

            <li>
                <a href="<?php echo base_url(); ?>travels/xdmds_xn">
                    <i class='material-icons'>bubble_chart</i>
                    <p>My Travel Request</p>
                </a>
            </li>

            <?php
            $getResult = $this->generalmd->getdresult("*", "main_menu", "menu_place", "1");
            $sessionID = $this->session->id;

            foreach ($getResult as $get) {
                $userid = $get->userid;
                $menu_id = $get->id;
                $doexplode = explode(",", $userid);
                if (in_array($sessionID, $doexplode)) {
                    echo "
                             <li>
                                  <a href='" . base_url() . "$get->menu_link/$menu_id'>
                                     <i class='material-icons'>$get->menu_icon</i>
                                     <p>$get->Name</p>
                                 </a>
                             </li>
                             ";
                }
            }
            ?>





            <?php
           /* $myRecievables = $this->users->getRecievables();
            $whichRecivable = $this->gen->haveAccess($_SESSION['id'], $myRecievables);
            if ($getApprovalLevel == 6 || $whichRecivable == TRUE || $getApprovalLevel == 2) {
                echo " <li>
                            <a href='" . base_url() . "recieveables'>
                                 <i class='material-icons'>bubble_chart</i>
                                  <p>Retirement</p>
                            </a>
                        </li>";
            } */
            ?>



    </ul>
</div>


