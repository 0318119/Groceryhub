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

                <div class="content-crumb-div">

                    <a class="fileTrail" href="index.php">Home</a>

                    <i style="font-size: 1rem;" class="fa fa-arrow-right"></i>

                    Login!



                </div>

            </div>

            <!-- </div> -->

        </div>

        <div class="mydiv" style="height: 650px; margin-top: 140px; background-color: white;">

            <div class="row">

                <div class="col-lg-12">



                    <div class="onStep center" data-animation="fadeInUp" data-time="300" style="padding-right:15px;">

                        <h2 class="onStep" data-animation="fadeInRight" data-time="0">Lets Sign-up with us!</h2>



                        <!-- forgot password area -->

                        <div data-form-type="signup_form">



                            <form method="post" id="signupFormNow" name="signupFormNow" action="">

                                <div class="form-group">
                                    
                                    <select class="form-control form-control-lg" id="rcate" name="rcate" required="required" >
                                        <option name="0" value="" selected>Pick up your Diet!</option>
                                        <?php 
                                        $sqlcat = "SELECT * FROM categories WHERE isrecipe=1 ORDER BY cat_name ASC";

                                        $resultcat = mysqli_query($conn, $sqlcat);
                                        $queryResultcat = mysqli_num_rows($resultcat);

                                        if($queryResultcat > 0) {
                                            while($row = mysqli_fetch_array($resultcat)) {
                                                echo '<option name="'.$row['id'].'" value="'.$row['cat_name'].'">'.$row['cat_name'].' - '.$row['isrecipe_desc'].'</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div> 
                                <div class="form-group">
                                    <label for="ralergy">Allergies & Restrictions <small style="color:red;">(optional)</small> </label><br>
                                    <?php 
                                    $sqla = "SELECT * FROM recipe_allergies ORDER BY allergy_name ASC";

                                    $resulta = mysqli_query($conn, $sqla);
                                    $queryResulta = mysqli_num_rows($resulta);

                                    if($queryResulta > 0) {
                                        while($rowa = mysqli_fetch_array($resulta)) {
                                            echo '
                                            <div class="" style="display:inline-block !important;hight:15px !important;">
                                                
                                                    <label style="display:inline-block !important;margin:0px !important;padding:0px !important;">
                                                        <input type="checkbox" name="ralergy[]" value="'.$rowa['id'].'" style="display:inline-block !important;" > <span class="label-text" style="display:inline-block !important;margin-top:0px;">'.$rowa['allergy_name'].'</span>
                                                    </label>
                                              
                                                
                                            </div>
                                            
                                            ';
                                        }
                                    }
                                    
                                    ?>
                                </div>

                                <div class="form-group">

                                    <div class="row">
                                    <label for="first_name">First/Last Name (required, at least 2 characters)</label>
                                        <div class="col-md-6">
                                            <input type="text" name="first_name" class="form-control btn-rounded" id="first_name" placeholder="First Name" required>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="last_name" required class="form-control btn-rounded" id="last_name" placeholder="Last Name">
                                        </div>
                                    </div>

                                    



                                </div>


                                <div class="form-group">



                                    <input type="email" name="email_book" required class="form-control btn-rounded"
                                        id="email_book" placeholder="Email Address">



                                </div>


                                <div class="form-group">

                                    <div class="row">
                                        <div class="col-md-4">
                                            <select id="state" name="state" class="form-control signup-form-select"
                                            style="" required>

                                            <option name="" value="">State</option>

                                            <option name="AK" value="AK">AK</option>

                                            <option name="AL" value="AL">AL</option>

                                            <option name="AR" value="AR">AR</option>

                                            <option name="AZ" value="AZ">AZ</option>

                                            <option name="CA" value="CA">CA</option>

                                            <option name="CO" value="CO">CO</option>

                                            <option name="CT" value="CT">CT</option>

                                            <option name="DC" value="DC">DC</option>

                                            <option name="DE" value="DE">DE</option>

                                            <option name="FL" value="FL">FL</option>

                                            <option name="GA" value="GA">GA</option>

                                            <option name="HI" value="HI">HI</option>

                                            <option name="IA" value="IA">IA</option>

                                            <option name="ID" value="ID">ID</option>

                                            <option name="IL" value="IL">IL</option>

                                            <option name="IN" value="IN">IN</option>

                                            <option name="KS" value="KS">KS</option>

                                            <option name="KY" value="KY">KY</option>

                                            <option name="LA" value="LA">LA</option>

                                            <option name="MA" value="MA">MA</option>

                                            <option name="MD" value="MD">MD</option>

                                            <option name="ME" value="ME">ME</option>

                                            <option name="MI" value="MI">MI</option>

                                            <option name="MN" value="MN">MN</option>

                                            <option name="MO" value="MO">MO</option>

                                            <option name="MS" value="MS">MS</option>

                                            <option name="MT" value="MT">MT</option>

                                            <option name="NC" value="NC">NC</option>

                                            <option name="ND" value="ND">ND</option>

                                            <option name="NE" value="NE">NE</option>

                                            <option name="NH" value="NH">NH</option>

                                            <option name="NJ" value="NJ">NJ</option>

                                            <option name="NM" value="NM">NM</option>

                                            <option name="NV" value="NV">NV</option>

                                            <option name="NY" value="NY">NY</option>

                                            <option name="OH" value="OH">OH</option>

                                            <option name="OK" value="OK">OK</option>

                                            <option name="OR" value="OR">OR</option>

                                            <option name="PA" value="PA">PA</option>

                                            <option name="RI" value="RI">RI</option>

                                            <option name="SC" value="SC">SC</option>

                                            <option name="SD" value="SD">SD</option>

                                            <option name="TN" value="TN">TN</option>

                                            <option name="TX" value="TX">TX</option>

                                            <option name="UT" value="UT">UT</option>

                                            <option name="VA" value="VA">VA</option>

                                            <option name="VT" value="VT">VT</option>

                                            <option name="WA" value="WA">WA</option>

                                            <option name="WI" value="WI">WI</option>

                                            <option name="WV" value="WV">WV</option>

                                            <option name="WY" value="WY">WY</option>

                                        </select>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" name="city" required class="form-control" id="city" placeholder="Enter Your City">

                                        <div class="citySearchList"></div>
                                        </div>
                                        
                                    </div>    

                                </div>

                               



                                <div class="form-group">



                                    <input type="text" name="username" required class="form-control btn-rounded"
                                        id="username" placeholder="Enter Your UserName">



                                </div>



                                <div class="form-group">

                                    <div class="row">
                                    
                                        <div class="col-md-6">
                                            <input type="password" name="password" required class="form-control btn-rounded" id="password" placeholder="Password">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="password" name="password2" required class="form-control btn-rounded" id="password2" placeholder="Retype Password">
                                        </div>
                                    </div>

                                    



                                </div>


                                <div class="form-group custom_accept">
                                    <input type="checkbox" class="form-check-input" id="agreement_check">
                                    <label class="form-check-label" for="agreement_check">I Accept <a class="linkcolor" href="#" target="_blank">Terms & Conditions</a></label>
                                </div>



                                <div class="form-group" style="height:20px !important;margin-top:0px !important;">

                                    <button value="1" id="signupForm" name="signupForm" type="submit" class="btn btn-rounded btn-yellow btn-block" style="margin-top:0px !important;">Signup</button>

                                    <div class="alert alert-danger" role="alert" id="formResult_register" style="display:none; padding:3px !important; margin-top:-5px !important;"></div>
                                </div>



                            </form>



                        </div>

                        <!-- forgot password area -->





                    </div>





                </div><!-- /.col-lg-6 -->

            </div><!-- /.row -->

        </div>



        <div class="" id="" style="margin-top:-25px !important; margin-bottom:-25px !important;">



            <!-- <div class="item imgbg" style="background-image:url(img/gallery-home/1.jpg)">
                <div class="overlay-clasic v-align">
                    <div class="col-md-10 col-xs-11">
                    </div>
                </div>
            </div> -->

            <div class="item imgbg" style="background-image:url(img/gallery-home/3.jpg)">
                <div class="overlay-clasic v-align">
                    <div class="col-md-10 col-xs-11">
                    </div>
                </div>
            </div>



            <!-- <div class="item imgbg" style="background-image:url(img/gallery-home/3.jpg)">
                <div class="overlay-clasic v-align">
                    <div class="col-md-10 col-xs-11">
                    </div>
                </div>
            </div> -->



        </div>
    </div>

</section>

<!-- section -->





<!-- Footer Start/End/JS -->

<?php include 'includes/footer_inc.php'?>



</html>