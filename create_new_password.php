

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

                <div class="mydiv" style="height: 460px; margin-top:220px; background-color: white;">

                  <div class="row">

                    <div class="col-lg-12">       

                      

                    <div class="onStep center" data-animation="fadeInUp" data-time="300" style="padding-right:15px;">

                                    <!-- <h2 class="onStep" data-animation="fadeInRight" data-time="0">Login to Continue!</h2> -->

                                    

                                    <!-- forgot password area -->

                                    <div data-form-type="forget_form">

                                    

                                    <h2 class="onStep" data-animation="fadeInRight" data-time="0">Create New Password!</h2>

                                    <?php 
                                    
                                    $selector = $_GET['selector'];
                                    $validator = $_GET['validator'];

                                    if(empty($selector) || empty($validator)) {
                                        echo "We could not validate your request.";
                                    } else {
                                        if (ctype_xdigit($selector) !== FALSE && ctype_xdigit($validator) !== FALSE) {
                                            
                                            echo "
                                            <form class=signup-form name='reset-password-submit' action='includes/create_new_password.inc.php' method='POST'>
                                            <input type='hidden' name='selector' value='" . $selector . "'>
                                            <input type='hidden' name='validator' value='" . $validator . "'>
                                        <div class='form-group'>
                                            <label for='password'>New Password 
                                            <input class='form-control btn-rounded center' type='password' name='password' placeholder='Enter a new password'>
                                            </label>
                                        </div>
                                        <div class='form-group'>
                                            <label for='passwordRepeat'>Repeat Password 
                                            <input class='form-control btn-rounded center' type='password' name='passwordRepeat' placeholder='Repeat new password'>
                                            </label>
                                        </div>
                                            ";

                                            
                                            if (isset($_GET['reset'])) {
                                                if ($_GET['reset'] == "success") {
                                                    echo "<center><h2 style=color:green;>Password Successfully Updated!</h2></center>";
                                                }
                                            }
                                            
                                            if (isset($_GET['error'])) {
                                                $loginError = $_GET['error'];
                                                echo "<center style=color:red;>$loginError</center>";
                                            }
                                            echo"
                                            <br>
                                            <center><button class='btn btn-success' type='submit'>Submit New Password</button></center>

                                            </form>
                                            ";
                                        }
                                    }
                                    
                                    ?>

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