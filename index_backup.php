<!DOCTYPE html>
<html lang="en">

<?php include 'includes/header.php'; ?>


<!-- home -->
<!-- background slider -->

<div class="mydiv">
    <div class="row">
    <form id='headersearch' action='results.php' method='GET'>
    <div class="myradioHome">
            <div class="input-group">
                <div id="radioBtn" class="btn-group">
                    <a class="btn btn-success btn-lg active" data-toggle="happy" data-title="GROCERIES">GROCERIES</a>
                    <a class="btn btn-success btn-lg notActive" data-toggle="happy" data-title="RECIPIES">RECIPIES</a>
                </div>
                <input type="hidden" name="htype" id="htype" value="Groceries">
            </div>
        </div>
            <div class="col-lg-12">
                <select class='form-control' id=catSelect name=catSelect onchange='this.form.submit()'
                    style="width:321px; height:35px;background-color:#efefef; outline: none;box-shadow: none;border-radius:0px !important;">
                    <!-- <option class=catSelectOption name=products value=Products>
                        FILTER</option> -->
                    <option class=catSelectOption name=products value=Products>
                        ALL CATEGORIES</option>";
                </select>
                <div class="input-group" style="">

                    <div class="input-group-btn">
                        <input id="headersearchinput" type="search" name="search" class="form-control"
                            placeholder="Search for..."
                            <?php if (isset($_GET['search'])) { $search = $_GET['search']; echo" value='$search'";} ?>
                            style="height: 46px !important;width:220px !important;border-style:none; background-color:#efefef;margin-top:0;border:none;box-shadow: none;-webkit-box-shadow: none; -moz-box-shadow: none;-moz-transition: none;-webkit-transition: none;border-radius:0px !important;"
                            autocomplete="off">

                        <button id='headersearchbutton' class="btn btn-lg" type='submit'><i class="fa fa-search"></i></button>
                        <button id='scan' class="btn btn-lg" type="button"><i class="fa fa-barcode"></i></button>
                    </div>
                    <div class="productSearchList" style="display:none;"></div>
                    <div id='barcode-scanner'></div>
                </div><!-- /input-group -->
                <!-- </form> -->
            </div><!-- /.col-lg-6 -->
        
    </div><!-- /.col-lg-6 -->
    </form>
</div><!-- /.row -->
</div>
<div id="home">

    <!-- main gallery big -->
    <div class="owl-carousel" id="owl-slider-home">

        <div class="item imgbg" style="background-image:url(img/gallery-home/1.jpg)">
            <!-- intro -->
            <div class="overlay-clasic v-align">
                <div class="col-md-10 col-xs-11">
                    <h1 class="onStep" data-animation="fadeInDown" data-time="900">
                        Contribute your favorite recipes and
                    </h1>

                    <h3 class="onStep" data-animation="fadeInLeft" data-time="600">
                        broaden your tastes by trying recipes others have contributed
                    </h3>

                    <div class="btn-main onStep" data-animation="fadeInUp" data-time="800">
                    <a class="info-gal0" href="#">Join Now!<span class="ti-angle-right"></span></a>
                    </div>

                </div>
            </div>
            <!-- intro end -->
        </div>

        <div class="item imgbg" style="background-image:url(img/gallery-home/2.jpg)">
            <!-- intro -->
            <div class="overlay-clasic v-align">
                <div class="col-md-10 col-xs-11">
                    <h1 class="onStep" data-animation="fadeInDown" data-time="900">
                        get meal recommendations
                    </h1>

                    <h3 class="onStep" data-animation="fadeInLeft" data-time="600">
                        based on what's in your pantry
                    </h3>

                    <div class="btn-main onStep" data-animation="fadeInUp" data-time="1200">
                    <a class="info-gal0" href="#">Join Now!<span class="ti-angle-right"></span></a>
                    </div>

                </div>
            </div>
            <!-- intro end -->
        </div>

        <div class="item imgbg" style="background-image:url(img/gallery-home/3.jpg)">
            <!-- intro -->
            <div class="overlay-clasic v-align">
                <div class="col-md-10 col-xs-11">
                    <h1 class="onStep" data-animation="fadeInDown" data-time="900">
                        predictive grocery lists help you
                    </h1>

                    <h3 class="onStep" data-animation="fadeInLeft" data-time="600">
                        never forget those staple items you love and need!
                    </h3>

                    <div class="btn-main onStep" data-animation="fadeInUp" data-time="1200">
                      <a class="info-gal0" href="#">Join Now!<span class="ti-angle-right"></span></a>
                    </div>
                </div>
            </div>
            <!-- intro end -->
        </div>

        <!-- <div class="item imgbg" style="background-image:url(img/gallery-home/4.jpg)">
       
        <div class="overlay-clasic v-align">
          <div class="col-md-10 col-xs-11">
            <h1 class="onStep" data-animation="fadeInUp" data-time="900">
              Search for groceries and
            </h1>

            <h3 class="onStep" data-animation="fadeInUp" data-time="300">
              Build your Shopping List.
            </h3>

            <div class="btn-main onStep" data-animation="fadeInDown" data-time="500">
              <a href="#">LOGIN<span class="ti-angle-right"></span></a>
            </div>
          </div>
        </div>
        
      </div>

      <div class="item imgbg" style="background-image:url(img/gallery-home/5.jpg)">
        
        <div class="overlay-clasic v-align">
          <div class="col-md-10 col-xs-11">
            <h1 class="onStep" data-animation="fadeInDown" data-time="900">
              Help the Community by
            </h1>

            <h3 class="onStep" data-animation="fadeInLeft" data-time="600">
              Confirming Prices at the Store.
            </h3>

            <div class="btn-main">
              <a href="#">LOGIN<span class="ti-angle-right"></span></a>
            </div>
          </div>
        </div>
       
      </div> -->



    </div>
    <!-- main gallery big end -->

    <!-- Status slider -->
    <div id="owlStatus">
        <div class="owlItems">
            <div class="result">
            </div>
        </div>

        <div class="seperator">
            /
        </div>

        <div class="currentItem">
            <div class="result">
            </div>
        </div>
    </div>
    <!-- Status slider end -->

    <!-- main info gallery -->
    <div class="main-info-gal">
        <div class="block-info-gal"></div>
        <!-- button close -->
        <div class="info-gal-close">
            <span>x</span>
        </div>
        <!-- button close end -->

        <!-- content -->
        <div class="overlay-main-info v-align">
            <div class="col-md-5 col-xs-11">
                <div class="col-md-6">
                    <div class="col">
                        <h2 class="title"><small style="font-size: 18px;">Let’s get started!</small><br><strong> Login
                                to continue</strong></h2>
                        <div class="w-100" data-aos="fade-up">
                            <br><br>
                            <!-- <div class="card-header">
                      <h2 style="color:black;">Welcome to logochemist</h2>
                  </div> -->
                            <!-- <div class="card-body"> -->
                            <!-- <h3>Let’s start the project again<strong>Login to continue</strong></h3> -->

                            <div data-form-type="signup_form">

                                <form method="post" action="login.php" name="loginform">

                                    <!--hidden required values-->

                                    <input type="hidden" attr.id="formType" name="formType">

                                    <input type="hidden" id="referer" name="referer">

                                    <div class="form-group">

                                        <input type="email" name="email_address" required
                                            class="form-control btn-rounded" id="email_address23"
                                            placeholder="Email Address">

                                    </div>

                                    <div class="form-group">

                                        <input type="password" name="password" required class="form-control btn-rounded"
                                            id="password_login" placeholder="Password">

                                    </div>

                                    <div id="formResult"></div>

                                    <div class="form-group">

                                        <button value="1" name="signupForm" type="submit"
                                            class="btn btn-rounded btn-yellow btn-block">Login</button>

                                    </div>
                                    <!-- <div class="text-right mb-2">
                                  <a href="#" data-toggle="modal" id="forget_password" class="btn-sm btn-rounded btn-white-outline"
                                      data-target="forgetPassword"><strong>FORGET PASSWORD?</strong></a>
                              </div> -->

                                </form>

                            </div>
                            <!-- forgot password area -->
                            <div data-form-type="signup_form">
                                <h2 class="title"><small style="font-size: 18px;">Forget Password?</small><br><strong>
                                        Lets Recover It!</strong></h2>
                                <form method="post" action="password_recovery.php" name="forgotform">

                                    <!--hidden required values-->

                                    <div class="form-group">

                                        <input type="email" name="email_address" required
                                            class="form-control btn-rounded" id="email_addressforgot"
                                            placeholder="Email Address">

                                    </div>

                                    <div id="formResult"></div>

                                    <div class="form-group">
                                        <button value="1" name="signupForm" type="submit"
                                            class="btn btn-rounded btn-yellow btn-block">Submit</button>
                                    </div>

                                </form>

                            </div>
                            <!-- forgot password area -->

                            <!-- </div> -->

                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="col">
                        <h2 class="title"><small style="font-size: 18px;">Let’s start the
                                journey!</small><br><strong>Signup to continue</strong></h2>
                        <div class="w-100" data-aos="fade-up">

                            <div data-form-type="signup_form">

                                <form method="post" action="thankyou.php" name="signup" id="signup">

                                    <div class="form-group">

                                        <input type="text" name="first_namee" required class="form-control btn-rounded"
                                            id="first_name" placeholder="First Name">

                                    </div>

                                    <div class="form-group">

                                        <input type="text" name="last_namee" required class="form-control btn-rounded"
                                            id="last_name" placeholder="Last Name">

                                    </div>

                                    <div class="form-group">

                                        <input type="email" name="email_book" required class="form-control btn-rounded"
                                            id="email_book" placeholder="Email Address">

                                    </div>

                                    <div class="form-group">

                                        <input type="password" name="password" required class="form-control btn-rounded"
                                            id="password" placeholder="Password">

                                    </div>

                                    <div class="form-group">

                                        <input type="text" name="phone_book" required class="form-control btn-rounded"
                                            id="phone_book1" placeholder="Enter Your Number">

                                    </div>

                                    <div class="form-group">

                                        <select id="countryid2" name="countryid"                                             class="form-control signup-form-select borderadded" style="border-radius: 25px;" onchange="get_states();" required>
                                             <option value="">No Record Found</option>
                                            
                                        </select>
                                    </div>

                                    <div id="formResult"></div>

                                    <div class="form-group custom_accept">

                                        <input type="checkbox" class="form-check-input" id="agreement_check">
                                        <label class="form-check-label" for="agreement_check">I Accept <a
                                                class="linkcolor" href="https://www.logochemist.com/order/terms.php"
                                                target="_blank">Terms & Conditions</a></label>

                                    </div>

                                    <div class="form-group">

                                        <button value="1" name="signupForm" type="submit"
                                            class="btn btn-rounded btn-yellow btn-block">Signup</button>

                                    </div>

                                </form>

                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!-- content end -->
    </div>
    <!-- main info gallery -->
    <!-- info gallery end -->

</div>
<!-- background slider end -->
<!-- home end -->

<!-- ScrolltoTop -->
<div id="totop">
    <span class="ti-angle-up"></span>
</div>
<!-- ScrolltoTop end -->

</div>
<!-- content wraper end -->

<?php include 'includes/footer.php'?>