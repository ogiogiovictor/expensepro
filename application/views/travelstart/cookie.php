<style type="text/css">
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


                    <!-- Inside Content Begins  Here -->

                    <!-- Beginning of Request Details with Status<div class="col-md-6 col-md-offset-3 bgback"> -->

                    <div class="col-md-10 col-md-offset-1 bgback">  
                        <!--<span class="pull-right"><small><?php //echo date('Y-m-d H:i:s');   ?></small></span>-->
                        <div class="card">

                            <div class="card-content">
                                <div class="card-header text-center" data-background-color="blue">
                                    <center><div class="mymainform"> <span class="tastkform"><span style="color:white"><a href="#">COOKIE POLICY</a></span></span>&nbsp;</div></center>
                           <!--<center><small class="mycoustomalert">Note:please make sure you fill all fields</small> </center>-->
                                </div>
                                <br/>

                                <div class="myMessage">
                                    <form name="travelStartForm" id="travelStartForm" enctype="multipart/form-data" method="POST" onSubmit="return false;">

                                        <div class="dtabs">

                                            <ul class="tabs">
                                                <li class="tab-link current" data-tab="tab-1"><b>COOKIE INFORMATION</b></li>
                                            </ul>

                                            <div id="tab-1" class="tab-content current">
                                                <span id="message"></span>

                                                <div class="row">
                                                          
                                                    <div class="col-md-12">
                                                    
                                                        
                                                        <h3>About Cookies</h3>
                                                        Cookies are a kind of short-term memory for the web. They are stored in your browser and enable a site to ‘remember’ little bits of information between pages or visits. Cookies can be used by web servers to identify and track users as they navigate different pages on a website, and to identify users returning to a website. Cookies may be either “persistent” cookies or “session” cookies. A persistent cookie consists of a text file sent by a web server to a web browser, which will be stored by the browser and will remain valid until its set expiry date (unless deleted by the user before the expiry date). A session cookie, on the other hand, will expire at the end of the user session, when the web browser is closed.
                                                        <br/>
                                                        <h3>Cookies on our Website</h3>
                                                        <ul>
                                                            <li>We use both SESSION COOKIES (which expire once you close your web browser) and PERSISTENT COOKIES (which stay on your device until you delete them).
                                                        </li>
                                                        <li>We have also grouped our cookies into the following categories, to make it easier for you to understand why we need them: </li>
                                                        <li>
                                                            <b>(a) Functionality:</b><br/> these cookies enable technical performance of our websites and allow us to ‘remember’ the choices you make and your preferences. 
                                                        
                                                        </li>
                                                        <li>
                                                            <b>(b) Performance:</b><br> these cookies allow us to collect certain information about how you navigate the Sites. They help us to understand which parts of our websites are interesting to you and which are not as well as what we can do to improve them.
                                                        </li>
                                                        </ul>
                                                        
                                                       
                                                        
                                                        <br/>
                                                        <h3>How We Use Cookies</h3>
                                                        Cookies do not contain any information that personally identifies you, but personal information that we store about you may be linked, by us, to the information stored in and obtained from cookies. The cookies used on this website include those which are strictly necessary cookies for access and navigation, cookies that track usage (performance cookies) and remember your choices (functionality cookies). We may use the information we obtain from your use of our cookies for the following purposes: 
                                                       
                                                        <ul>
                                                            <li>to recognise your computer when you visit our website, </li>
                                                            <li>to retain clients’ email addresses and passwords when they log in to our website.</li>
                                                            <li> to track you as you navigate our website, </li>
                                                            <li>to improve the website’s usability i.e. our Live Chat application to answer questions you have in real time,</li>
                                                            <li>to analyse the use of our website - such as how many people visit us each day,</li>
                                                            <li>in the administration of our website.</li>
                                                            
                                                        </ul>
                                                        
                                                        
                                                      
                                                         
                                                        
                                                        
                                                        
                                                         <br/>
                                                         <h3>Third-party cookies</h3>
                                                        In some special cases we also use cookies provided by trusted third parties. The following section details which third party cookies you might encounter through this site.
                                                        <ul>
                                                            <li>This site uses Google Analytics which is one of the most widespread and trusted analytics solution on the web for helping us to understand how you use the site and ways that we can improve your experience. These cookies may track things such as how long you spend on the site and the pages that you visit so we can continue to produce engaging content. 
                                                        For more information on Google Analytics cookies, see the official Google Analytics page.</li> 
                                                            <li>We also use social media buttons and/or plugins on this site that allow you to connect with your social network in various ways. For these to work the following social media sites including; Twitter, Linked in, Facebook, Youtube, Instagram will set cookies through our site which may be used to enhance your profile on their site or contribute to the data they hold for various purposes outlined in their respective privacy policies.
                                                        </li>
                                                        </ul>
                                                        
                                                        <br/>
                                                        <h3>Disabling Cookies</h3>
                                                        You can prevent the setting of cookies by adjusting the settings on your browser (see your browser Help for how to do this). Be aware that disabling cookies will affect the functionality of this and many other websites that you visit. Disabling cookies will usually result in also disabling certain functionality and features of this site. Therefore, it is recommended that you do not disable cookies.
                                                        
                                                        <br/>
                                                        <h3>More information</h3>
                                                        Please do not hesitate to get in touch with us using the contact form on our contact page if you have any questions or queries regarding how we use cookies or anything else on our website.



                                                    </div>

                                                </div><!-- END OF TAB ONE REQUEST INFORMATOIN-->








                                        </div><!-- END OF TABBED CONTENT     -->

                                    </form>
                                </div><!-- END OF myMessage  ID -->
                            </div>  <!-- Endo of Card Content -->   

                        </div>


                    </div>
                    <!-- End of Request Details with Status -->




                    <!-- Inside Content Ends Here -->


                </div>


            </div>
        </div>
        <!-- Main Outer Content Ends  Here --> 
       
        <?php echo $footer; ?>
