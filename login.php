

<!DOCTYPE html>

<html lang="en">



<?php 

error_reporting( 0 );
include_once 'includes/dbh.inc.php';
include 'includes/header_inc.php'; 

?>

        <section class="whitepage" style="padding: 0; background-color:#111111 !important;">
            
                <div class="mydiv" style="height: 370px; margin-top: 230px; background-color: white;">
                  <div class="row">
                    <div class="col-lg-12">                           

                        <div class="onStep center" data-animation="fadeInUp" data-time="300" style="padding-right:15px;">

                                    <h2 class="onStep" data-animation="fadeInRight" data-time="0">Login to Continue!</h2>

                                    <div data-form-type="signup_form">
                                            <form method="post" action="" name="loginform">
                                                <div class="form-group">
                                                    <input type="email" name="uid" required class="form-control btn-rounded center" id="uid" placeholder="Email Address" style="width:70%;">
                                                </div>

                                                <div class="form-group">
                                                    <input type="password" name="pwd" required class="form-control btn-rounded center" id="pwd" placeholder="Password" style="width:70%;">
                                                </div>

                                                <div class="form-group" style="margin-top:-25px !important;">
                                                    <button value="1" id="signinForm" name="signinForm" type="submit"  class="btn btn-rounded btn-yellow btn-block">Login</button>
                                                </div>

                                                <div class="alert alert-danger center" role="alert" id="formResult_login" style="display:none; margin-top:-25px !important;width: 220px;"></div>
                                                <input type="hidden" id="lurl" name="lurl" value="<?php echo getURL(); ?>" >
                                            </form>
                                            <h2 class="title"><small style="font-size: 18px;">
                                              <a href="forgotpassword.php" class="btn-lg btn-rounded ">forgot password?</a></small><br>
                                            </h2>
                                            <h2 class="title center"><small style="font-size: 18px;">
                                              <a href="register.php" class="btn-lg btn-rounded center">Signup with Us!</a></small><br>
                                            </h2>
                                    </div>
                        </div>
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                </div>


                <!-- <div class="owl-carousel" id="owl-slider-home" style="margin-bottom:-25px !important;"> -->

                  <div class="item imgbg" style="background-image:url(img/gallery-home/1.jpg)">
                   
                    <div class="overlay-clasic v-align">
                      <div class="col-md-10 col-xs-11">
                      </div>
                    </div>
                   
                  </div>

                  <!-- <div class="item imgbg" style="background-image:url(img/gallery-home/2.jpg)">
                    
                    <div class="overlay-clasic v-align">
                      <div class="col-md-10 col-xs-11"></div>
                    </div>
                   
                  </div>

                  <div class="item imgbg" style="background-image:url(img/gallery-home/3.jpg)">
                   
                    <div class="overlay-clasic v-align">
                      <div class="col-md-10 col-xs-11"></div>
                    </div>
                  
                  </div> -->

                </div>
            </div>

        </section>
        <!-- section -->




<!-- Footer Start/End/JS -->

<?php include 'includes/footer_inc.php'?>



</html>