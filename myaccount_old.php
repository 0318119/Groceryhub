<!DOCTYPE html>
<html lang="en">

<?php 

include_once 'includes/dbh.inc.php';
include 'includes/header.php'; 

?>

<!-- spacer -->
<div class="space-single hidden-sm hidden-xs">
</div>
<div class="space-half">
</div>
<!-- spacer end -->

<!-- wrapper -->
<div class="row">
    <div class="col-md-11 col-md-offset-1 col-sm-11 col-sm-offset-1 col-xs-11 col-xs-offset-1 pull-left">

        <!-- row content -->
       

            <!-- left content -->
            <div class="col-md-12">
            <h3 class="onStep" data-animation="fadeInRight" data-time="0">My Account</h3>
                <div class="onStep col-md-5" data-animation="fadeInUp" data-time="300" style="padding-right:15px;">
                    <h2 class="onStep" data-animation="fadeInRight" data-time="0">Login to Continue!</h2>
                    
                    <div data-form-type="signup_form">
                            <form method="post" action="" name="loginform">
                                <div class="form-group">
                                    <input type="email" name="uid" required class="form-control btn-rounded" id="uid" placeholder="Email Address">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="pwd" required class="form-control btn-rounded" id="pwd" placeholder="Password">
                                </div>
                                <div class="form-group" style="margin-top:-25px !important;">
                                    <button value="1" id="signupForm" name="signupForm" type="submit" class="btn btn-rounded btn-yellow btn-block">Login</button>
                                </div>
                                <div class="alert alert-danger" role="alert" id="formResult_login" style="display:none; margin-top:-25px !important;"></div>
                            </form>
                    </div>
                      
                      <!-- forgot password area -->
                      <div data-form-type="forget_form">
                      
                      <h2 class="onStep" data-animation="fadeInRight" data-time="0">Forget Password?</h2>
                          <form method="post" action="password_recovery.php" name="forgotform">
                              <div class="form-group">
                                  <input type="email" name="email_addressforgot" required class="form-control btn-rounded" id="email_addressforgot" placeholder="Email Address">
                              </div>
                              <div class="form-group" style="margin-top:-25px !important;">
                                  <button value="1" id="forget" name="forget" type="submit" class="btn btn-rounded btn-yellow btn-block">Reset Password!</button>
                              </div>
                              <div id="formResult_forget" style="margin-top:-25px !important;"></div>
                          </form>
                      </div>
                      <!-- forgot password area -->
                </div>

                <div class="onStep col-md-5" data-animation="fadeInUp" data-time="300" style="padding-left:15px;">
                    <h2 class="onStep" data-animation="fadeInRight" data-time="0">Lets Sign-up with us!</h2>
                    <div data-form-type="signup_form">

                            <form method="post" action="thankyou.php" name="signup" id="signup">

                                <div class="form-group">

                                    <input type="text" name="first_namee" required class="form-control btn-rounded" id="first_name" placeholder="First Name">

                                </div>

                                <div class="form-group">

                                    <input type="text" name="last_namee" required class="form-control btn-rounded" id="last_name" placeholder="Last Name">

                                </div>

                                <div class="form-group">

                                    <input type="email" name="email_book" required class="form-control btn-rounded" id="email_book" placeholder="Email Address">

                                </div>

                                <div class="form-group">

                                    <input type="password" name="password" required  class="form-control btn-rounded" id="password" placeholder="Password">

                                </div>

                                <div class="form-group">

                                    <input type="text" name="phone_book" required class="form-control btn-rounded" id="phone_book1" placeholder="Enter Your Number">

                                </div>

                                <div class="form-group">

                                    <select id="state" name="state" class="form-control signup-form-select" style="border-radius: 25px;" required>
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

                                <div id="formResult"></div>

                                <div class="form-group custom_accept">

                                    <input type="checkbox" class="form-check-input" id="agreement_check">
                                    <label class="form-check-label" for="agreement_check">I Accept <a class="linkcolor" href="https://www.logochemist.com/order/terms.php" target="_blank">Terms & Conditions</a></label>

                                </div>

                                <div class="form-group">

                                    <button value="1" name="signupForm" type="submit" class="btn btn-rounded btn-yellow btn-block" >Signup</button>

                                </div>

                            </form>

                        </div>
                </div>

            </div>
        
            <!-- left content end -->

            

        </div>
        <!-- row content end -->
    </div>
</div>
<!-- wrapper end -->

<!-- spacer -->
<div class="space-single">
</div>

</div>
<!-- content right end -->

</div>
</div>
</div>
</section>
<!-- section end -->


<!-- ScrolltoTop -->
<div id="totop">
    <span class="ti-angle-up"></span>
</div>
<!-- ScrolltoTop end -->

</div>
<!-- content wraper end -->
<?php include 'includes/footer.php'?>