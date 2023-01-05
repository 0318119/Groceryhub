<!DOCTYPE html>

<html lang="en">



<?php 



error_reporting( 0 );

include_once 'includes/dbh.inc.php';

include 'includes/header_inc.php'; 

?>







<style>
.wrapper {
  min-height: 100%;
}

html {
  font-size: 10px;
  box-sizing: border-box;
}

.section-form {
  border: 1px solid black;
  padding: 20px 20px;
  border-radius: 20px;
}

.section-form li{
  list-style: none;
  position: relative;
  text-align: center;
}
.section-form li::after{
  position: absolute;
  content: "";
  top: 70%;
  left: 24%;
  border-bottom:  5px solid #31d47d;
  height: 50px;
  width: 50%;
  margin: auto;
}
.section-form li .fa-user{
  color: white;
  font-size: 50px;
  background-color: #31d47d;
  padding: 30px;
  border-radius: 50%;

}
footer{
   margin-top: 614px !important;
  }

@media(max-width:622px)
{
  .section-form li::after{
  position: unset;
  }
}

@media(max-width:768px)
{
  footer{
   margin-top: 324px;
  }
}

.form {
  display: block;
}

.form-group {
  margin-bottom: 20px;
}

.form-label,
.form-input {
  display: block;
  width: 100%;
}

.form-label {
  cursor: pointer;
  margin-bottom: 5px;
  margin-left: 51px;
  font-size: 20px;
}

.form-input {
  padding: 10px;
  background-color: transparent;
  border: 0;
}
.form-input:focus {
  outline: none;
  background-color: #f0f7f9;
}

.form-footer {
  text-align: right;
}

.button {
  color: white;
  white-space: nowrap;
  background-color: #31d47d;
  padding: 10px 20px;
  margin: auto;
  border: 0;
  border-radius: 2px;
  font-size: 20px;
  display: block;
  transition: all 150ms ease-out;
  width: auto;
  border-radius: 20px;
}
.button:focus, .button:hover {
  background-color: #219d5b;
}

.form-addon {
  position: relative;
  display: table;
  width: 100%;
  border: 1px solid #bcdae5;
  background-color: #fff;
  border-radius: 27px;
}
.form-addon .form-input,
.form-addon .form-addon__addon {
  display: table-cell;
  vertical-align: middle;
}
.form-addon .form-input {
  width: 100%;
}
.form-addon .form-addon__addon {
  position: relative;
  width: 40px;
  text-align: center;
}
.form-addon .form-addon__addon:before {
  content: "";
  position: absolute;
  top: 4px;
  right: 0;
  height: calc(100% - 8px);
  border-right: 1px solid #bcdae5;
}

.form-addon__icon {
  position: absolute;
  color: #31d47d;
  font-size: 0.8rem;
  line-height: 1;
  top: 50%;
  transform: translateY(-50%);
  right: 10px;
}

/* .toaster {
  position: fixed;
  z-index: 1;
  top: 10px;
  right: 10px;
} */

.toast {
  color: #fff;
  padding: 20px;
  margin-bottom: 10px;
  border-radius: 2px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
  opacity: 0;
  transform: translateY(-10px) rotateY(40deg);
  transition: all 300ms ease;
}
.toast.toast--show {
  transform: translateY(0) rotateY(0);
  opacity: 1;
}

.toast--success {
  background-color: #31d47d;
}

.toast--error {
  background-color: #f42866;
}


/*---------------------------------------------*\
    GentleForm related styles
\*---------------------------------------------*/
.form-addon .form-addon__icon {
  transform: translateY(0);
  opacity: 0;
  transition: transform 150ms ease, opacity 150ms ease;
}
.form-addon.is-valid [class*=icon-valid], .form-addon.is-invalid [class*=icon-invalid] {
  transform: translateY(-50%);
  opacity: 1;
}
.form-addon.is-invalid {
  background-color: #fef4f7;
  border-color: #f989ab;
}
.form-addon.is-invalid .form-addon__icon {
  color: #f42866;
}
.form-addon.is-invalid .form-addon__addon:before {
  border-color: #f989ab;
}


</style>

<!-- slider -->

<section class="whitepage">

    <div class="container-fluid">

        <div class="row">

            <div class="no-gutter">

                <section class='main-container-faqs'>

                    <div class="welcomeBox" style="width: 100%;">

                        <h2 class='slogan' style="font-size: 20px !improtant;">CONTACT US </h2>

                    </div>



                </section>



                <!-- slider end -->

                <!-- about destop -->

                <section class='intro-container' id="content-desktop" style="height: 240px;">

                    <div class=''>

                        <ul style=" margin-top: 40px;">
                            <h2 class='slogan'
                                style="font-size: 71px;color: #1F1F1F;font-family: sans-serif;font-weight: 700;">CONTACT
                                US </h2>

                            <h2 class='intro'
                                style="padding: 0;font-size: 16pt;line-height: 32px;width: 50%;margin: auto;margin-top: 28px;">
                                Finding delicious, healthy recipes can be difficult, and finding the
                                ingredients for high quality meals at a decent price can be even harder. We're here to
                                support each other in finding great meal ideas at the best price in town!
                            </h2>
                        </ul>

                        <div class="toaster"></div>

                        <main class="wrapper container">
                            <section class="section-form">
                                <!-- <h1>GentleForm</h1> -->
                                <li><i class="fa fa-user" aria-hidden="true"></i></li>
                                <!-- <p>
                                    Accessible and user-friendly HTML5 form validation library.
                                </p> -->

                                <form name="signup" class="form" novalidate>
                                    <div class="form-group">
                                        <label for="name" class="form-label form-label--required">
                                            Name:
                                        </label>

                                        <div class="form-addon" data-states-for="name">
                                            <div class="form-addon__addon">
                                                <span class="icon-name"></span>
                                            </div>

                                            <input type="text" id="name" name="name" class="form-input"
                                                placeholder="Enter Your Name" required>


                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="name" class="form-label form-label--required">
                                            Subject:
                                        </label>

                                        <div class="form-addon" data-states-for="name">
                                            <div class="form-addon__addon">
                                                <span class="icon-name"></span>
                                            </div>

                                            <input type="text" id="name" name="name" class="form-input"
                                                placeholder="Enter Your Subject" required>


                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="email" class="form-label form-label--required">
                                            Email:
                                        </label>

                                        <div class="form-addon" data-states-for="email">
                                            <div class="form-addon__addon">
                                                <span class="icon-email"></span>
                                            </div>

                                            <input type="email" id="email" name="email" class="form-input"
                                                placeholder="Enter Your Email" required>

                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label for="phone" class="form-label">
                                            Phone number:
                                        </label>

                                        <div class="form-addon" data-states-for="phone">
                                            <div class="form-addon__addon">
                                                <span class="icon-phone"></span>
                                            </div>

                                            <input type="text" id="phone" name="phone" class="form-input"
                                                placeholder="Enter Your Phone Number">
                                        </div>

                                    </div>

                                    <!-- <div class="form-group">
                                        <label for="password" class="form-label form-label--required">
                                            Password <span class="text-muted">(minimum 6 characters)</span>:
                                        </label>

                                        <div class="form-addon" data-states-for="password">
                                            <div class="form-addon__addon">
                                                <span class="icon-password"></span>
                                            </div>

                                            <input type="password" id="password" name="password" class="form-input"
                                                placeholder="********" minlength="6" required>

                                            <span class="form-addon__icon icon-valid"></span>
                                            <span class="form-addon__icon icon-invalid"></span>
                                        </div>

                                        <div data-errors-for="password">
                                            <small class="form-error" data-errors-when="valueMissing">
                                                This field is required.
                                            </small>

                                            <small class="form-error" data-errors-when="tooShort">
                                                Your password should be at least 6 characters long.
                                            </small>
                                        </div>
                                    </div> -->

                                    <div class="form-footer">
                                        <button type="submit" class="button">Sign up</button>
                                    </div>
                                </form>
                            </section>
                        </main>

                    </div>

                </section>

                <!-- aboutend -->




                <!-- about mobile -->

                <section class='intro-container' id="content-mobile" style="height: 400px;">

                    <div class=''>

                        <ul style="padding: 0px;margin: 0px;">

                            <h2 class='slogan'
                                style="font-size: 30px;color: #1F1F1F; margin-top: 20px;font-family: sans-serif;font-weight: 700;line-height: 1;">
                                CONTACT US</h2>

                            <h2 class='intro'>Finding delicious, healthy recipes can be difficult, and finding the
                                ingredients for high quality meals at a decent price can be even harder. We're here to
                                support each other in finding great meal ideas at the best price in town!</h2>

                        </ul>

                    </div>


                    <main class="wrapper container">
                            <section class="section-form">
                                <!-- <h1>GentleForm</h1> -->
                                <li><i class="fa fa-user" aria-hidden="true"></i></li>
                                <!-- <p>
                                    Accessible and user-friendly HTML5 form validation library.
                                </p> -->

                                <form name="signup" class="form" novalidate>
                                    <div class="form-group">
                                        <label for="name" class="form-label form-label--required">
                                            Name:
                                        </label>

                                        <div class="form-addon" data-states-for="name">
                                            <div class="form-addon__addon">
                                                <span class="icon-name"></span>
                                            </div>

                                            <input type="text" id="name" name="name" class="form-input"
                                                placeholder="Enter Your Name" required>


                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="name" class="form-label form-label--required">
                                            Subject:
                                        </label>

                                        <div class="form-addon" data-states-for="name">
                                            <div class="form-addon__addon">
                                                <span class="icon-name"></span>
                                            </div>

                                            <input type="text" id="name" name="name" class="form-input"
                                                placeholder="Enter Your Subject" required>


                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="email" class="form-label form-label--required">
                                            Email:
                                        </label>

                                        <div class="form-addon" data-states-for="email">
                                            <div class="form-addon__addon">
                                                <span class="icon-email"></span>
                                            </div>

                                            <input type="email" id="email" name="email" class="form-input"
                                                placeholder="Enter Your Email" required>

                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label for="phone" class="form-label">
                                            Phone number:
                                        </label>

                                        <div class="form-addon" data-states-for="phone">
                                            <div class="form-addon__addon">
                                                <span class="icon-phone"></span>
                                            </div>

                                            <input type="text" id="phone" name="phone" class="form-input"
                                                placeholder="Enter Your Phone Number">
                                        </div>

                                    </div>

                                    <div class="form-footer">
                                        <button type="submit" class="button">Sign up</button>
                                    </div>

                                </form>
                            </section>
                        </main>

                </section>

                <!-- aboutend -->









            </div>

        </div>

    </div>

</section>

<!-- content wraper end -->



<!-- Footer Start/End/JS -->

<?php include 'includes/footer_inc.php'?>

</html>