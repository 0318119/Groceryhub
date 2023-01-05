

<!DOCTYPE html>

<html lang="en">



<?php 



error_reporting( 0 );

include_once 'includes/dbh.inc.php';

include 'includes/header_inc.php'; 

?>





        <section class="whitepage" style="padding: 0;">

            <div class="">

                <div class="row">

                    <!-- <div class="no-gutter"> -->

                    <div id="topbar" style=";">

                        <div class="content-crumb-div" >

                                <a class="fileTrail" href="index.php">Home</a>   

                                <i style="font-size: 1rem;" class="fa fa-arrow-right"></i> 

                                Login!

                                

                        </div>

                    </div>

                    <!-- </div> -->

                </div>

                <div class="mydiv" style="height: 260px; margin-top:220px; background-color: white;">

                  <div class="row">

                    <div class="col-lg-12">       

                      

                    <div class="onStep center" data-animation="fadeInUp" data-time="300" style="padding-right:15px;">

                                    <!-- <h2 class="onStep" data-animation="fadeInRight" data-time="0">Login to Continue!</h2> -->

                                    

                                    <!-- forgot password area -->

                                    <div data-form-type="forget_form">

                                    

                                    <h2 class="onStep" data-animation="fadeInRight" data-time="0">Forget Password?</h2>

                                        <form method="post" name="forgotform" id="forgotform">

                                            <div class="form-group">
                                                <input type="email" name="email_addressforgot" required class="form-control btn-rounded center" id="email_addressforgot" placeholder="Email Address" style="width:70%;">
                                            </div>

                                            <div class="form-group" style="margin-top:-25px !important;">

                                                <button value="1" id="forget" name="forget" type="submit" class="btn btn-rounded btn-yellow btn-block">Reset Password!</button>

                                            </div>

                                            <div id="formResult_forget" class='alert alert-danger' style="margin-top:-10px !important; display:none;"></div>

                                            <div id="formResult_forget_suc" class='alert alert-success' style="margin-top:-10px !important; display:none;"></div>

                                        </form>

                                    </div>

                                    <!-- forgot password area -->

                                    

                                   

                                </div>

                        

                    

                    </div><!-- /.col-lg-6 -->

                  </div><!-- /.row -->

                </div>



                <div class="owl-carousel" id="owl-slider-home" style="margin-top:-25px !important; margin-bottom:-25px !important;">

    

    <div class="item imgbg" style="background-image:url(img/gallery-home/1.jpg)">

      <!-- intro -->

      <div class="overlay-clasic v-align">

        <div class="col-md-10 col-xs-11">

          

          

        </div>

      </div>

      <!-- intro end -->

    </div>



    <div class="item imgbg" style="background-image:url(img/gallery-home/2.jpg)">

      <!-- intro -->

      <div class="overlay-clasic v-align">

        <div class="col-md-10 col-xs-11">

          

          

        </div>

      </div>

      <!-- intro end -->

    </div>



    <div class="item imgbg" style="background-image:url(img/gallery-home/3.jpg)">

      <!-- intro -->

      <div class="overlay-clasic v-align">

        <div class="col-md-10 col-xs-11">

          

          

        </div>

      </div>

      <!-- intro end -->

    </div>

    

    

     




    

    

  </div>



            </div>

        </section>

        <!-- section -->





<!-- Footer Start/End/JS -->

<?php include 'includes/footer_inc.php'?>



</html>