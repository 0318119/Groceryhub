<!DOCTYPE html>
<html lang="en">

<?php 

error_reporting( 0 );
include_once 'includes/dbh.inc.php';
include 'includes/header_inc.php'; 
?>

<style>



.landingPhotos0{
    width: 100% !important;
    max-height: 100%;
    padding: 30px;
    border-radius: 135px;
    clear:both;
}
.left-img{
    float: left;
}
.right-txt{
    float: right;
    padding-right: 50px;
    padding-top: 30px;
}

@media(max-width:1024px)
{
    .right-txt{
    width: 40%;
}
}

@media(max-width:892px)
{
    .about-img-border{
        width: 455px !important;
    }
}


.landingPhotos_desktop {
    width: 100% !important;
    max-height: 100%;
    padding: 9px;
    border-radius: 193px 0 193px 0 !important;
    border: 2px solid #f1c40f;
    transition: all .4s linear;
}
.hover_img{
    position: relative;
    overflow: hidden;
}
.hover_img:after {
    position: absolute;
    content: "";
    left: -80%;
    top: -22px;
    height: 115%;
    width: 80%;
    background-color: #27ae5faf;
    overflow: hidden;
    clip-path: polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);
}
.hover_img:hover:after{
    left: 100%;
    transition: all .5s;
}


.sec{
    padding: 9px;
}
.sec ul > .blockText{
    border: 1px solid #27ae60;
    padding: 20px;
    border-radius: 5%;
}


/* Mobile Section start from here */
.landingPhotos-mobile {
    padding: 10px;
}
.mobile-slogan{
    position: relative;
}
.mobile-slogan:after {
    position: absolute;
    content: "";
    top: 96%;
    left: 34%;
    border-bottom: 2px solid #000;
    width: 28%;
}



img[alt='mobile image']
{
    border: 2px dashed red;
    padding: 30px;
    border-radius: 10%;
    margin-top: 30px;
}
ul[after="text-border"]
{
   position: relative;
}
ul[after="text-border"]:after
{
    position: absolute;
    content: "";
    top: 100%;
    left: 19%;
    border-bottom: 2px solid #000;
    width: 50%;
}





html,body{
  width: 100%;
  height: 100%;
  background-color: #3a3a3a;
}
.wrapper{
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100%;
  height: 100%;
}
.wrapper .typewriter {
  font-family: sans-serif;
  color: green;
  /* padding-left: 30px; */
  text-align: center;
  display: inline-flex;
  line-height: 47px !important;
  font-size: 45px;
}
.wrapper .typewriter-text {
  padding-left: 20px;
  color: #ffe509;
  border-right: solid #ffe509 2px;
  text-transform: uppercase;
  animation: cursor all .4s  infinite;
  font-weight: bold;
  font-size: 45px !important;
  margin-top: -1px;
}
@keyframes cursor {
  from { border-color: #ffe509; }
  to { border-color: transparent; }
  
}

@media (max-width: 440px) {
  .wrapper .typewriter { font-size: 35px !important; }
  .wrapper .typewriter-text { font-size: 35px !important; }
}

@media (max-width: 365px) {
  .wrapper .typewriter { font-size: 30px !important; }
  .wrapper .typewriter-text { font-size: 30px !important; }
}






</style>
<!-- slider -->
<section class="whitepage">
    <div class="container-fluid">
        <div class="row">
            <div class="no-gutter">
                <section class='main-container-landing'>
                    <!-- <div class="welcomeBox" style="width: 100%;">
                        <h2 class='slogan' typing="slogan" style="font-size: 50px;">FRESH GROCERY </h2>
                          </div> -->
                          <div class='wrapper'>
  <p class='typewriter'>FRESH
  <span class='typewriter-text' data-text='[ "GROCERY SHOPPING. ",  "RECIPIES. " ]'></span>
  </p>
</div>

                </section>

                <!-- slider end -->


                <!-- about destop -->
                <section class='intro-container box' id="content-desktop" style="height: 420px; box-shadow: 1px 1px 10px gray; margin: 20px 0;">


                    <div class='howToLeft left-img about-img-border' style="width: 580px;">
                        <img class='landingPhotos0' src='img/slider4-layer3.png' alt="about of img">
                    </div>
                    <div class='howToRight right-txt about-txt-border'>
                        <ul style=" margin-top: 40px;">
                            <h2 class='slogan' style="font-size: 50px;color: #1F1F1F;font-family: sans-serif;font-weight: 700;">About
                                <stan style="font-size: 40px;font-weight: 700;line-height: initial;color: #4bcc4b"> Us </stan>
                            </h2>
                            <h2 class='intro about-txt'>
                                Finding delicious, healthy recipes can be difficult, and finding the
                                ingredients for high quality meals at a decent price can be even harder. We're here to
                                support each other in finding great meal ideas at the best price in town!
                            </h2>
                        </ul>
                    </div>
                </section>
                <!-- aboutend -->


                <!-- about mobile -->

                <section class='intro-container' id="content-mobile" style="height: 710px;">


                    <div class='howToLeft'>
                        <img class='landingPhotos-mobile' src='img/slider4-layer3.png' style="width: 870px;">
                    </div>
                    <div class='howToRight-mobile'>
                        <ul style="padding: 0px;margin: 0px;">
                            <h2 class='slogan mobile-slogan' style="font-size: 30px;color: #1F1F1F; font-family: sans-serif;font-weight: 700;line-height: 1;">
                                About <stan style="font-size: 25px;font-weight: 700;line-height: initial;color: #4bcc4b; border-bottom: 2px solid #4bcc4b;"> Us </stan>
                            </h2>
                            <h2 class='intro' style="padding: 20px;">Finding delicious, healthy recipes can be difficult, and finding the
                                ingredients for high quality meals at a decent price can be even harder. We're here to
                                support each other in finding great meal ideas at the best price in town!</h2>
                        </ul>
                    </div>
                </section>

                <!-- about  mobile end -->






           <!-- First Start desktop -->

              <section class='homePage-container'>
                    <div class='howToLeft sec' id="content-desktop">
                        <ul>
                            <h2 class='blockText'>Search for groceries and build your shopping list.</h2>
                        </ul>

                    </div>
                    <div class='howToRight' id="content-desktop">
                        <img class='landingPhotos landingPhotos_desktop' src='img/shutterstock_searching_for_groceries_small.jpg'>
                    </div>
              </section>

           <!-- First desktop end-->


                <!-- First Start Mobile -->

                <section class='homePage-container' id="content-mobile">
                    
                    <div class='howToRight-mobile'>
                        <img class='landingPhotos' src='img/shutterstock_searching_for_groceries_small.jpg' alt="mobile image">
                    </div>

                    <div class='howToLeft-mobile' id="content-mobile">
                        <ul after="text-border">
                            <h2 class='blockText'>Search for groceries and build your shopping list.</h2>
                        </ul>

                    </div>
                </section> 

                 <!-- First Mobile end -->


            


                <!-- Second Start desktop -->

                <section class='homePage-container'>
                    <div class='howToLeft' id="content-desktop">
                        <img class='landingPhotos landingPhotos_desktop' src='img/shutterstock_mom_daughter_Cooking_small.jpg'>
                    </div>
                    <div class='howToRight sec' id="content-desktop">
                        <ul>

                            <h2 class='blockText'>Contribute your favorite recipes and broaden your tastes by trying
                                recipes others have contributed.</h2>

                        </ul>
                    </div>
                </section>

                <!-- Second desktop end-->


                <!-- Second Start Mobile -->

                <section class='homePage-container' id="content-mobile">

                    <div class='howToRight-mobile'>
                        <img class='landingPhotos' src='img/shutterstock_mom_daughter_Cooking_small.jpg' alt="mobile image">
                    </div>

                    <div class='howToLeft-mobile' id="content-mobile">
                        <ul after="text-border">
                            <h2 class='blockText'>Contribute your favorite recipes and broaden your tastes by trying
                                recipes others have contributed.</h2>
                        </ul>
                    </div>
                </section>

                 <!-- Second Mobile end -->





                <!-- Third Start desktop -->

                <section class='homePage-container'>
                    <div class='howToLeft sec' id="content-desktop">
                        <ul>
                            <h2 class='blockText'>Predictive grocery lists help you never forget those staple items you
                                love and need!</h2>

                        </ul>
                    </div>
                    <div class='howToRight' id="content-desktop">
                        <img class='landingPhotos landingPhotos_desktop' src='img/shutterstock_phone_shopping_list_smaller.jpg'>
                    </div>
                </section>

                <!-- Third desktop end -->


                 <!-- Third Start Mobile -->

                <section class='homePage-container' id="content-mobile">

                    <div class='howToRight-mobile'>
                        <img class='landingPhotos' src='img/shutterstock_phone_shopping_list_smaller.jpg' alt="mobile image">
                    </div>

                    <div class='howToLeft-mobile' id="content-mobile">
                        <ul after="text-border">
                            <h2 class='blockText'>Predictive grocery lists help you never forget those staple items you
                                love and need!</h2>
                        </ul>
                    </div>
                </section>

                <!-- Third Mobile end -->






               <!-- Forth Start desktop -->

                <section class='homePage-container'>
                    <div class='howToLeft' id="content-desktop">
                        <img class='landingPhotos landingPhotos_desktop' src='img/shutterstock_family_smaller.jpg'>
                    </div>
                    <div class='howToRight sec' id="content-desktop">
                        <ul>
                            <h2 class='blockText'>Compare cost and variety locally and choose the best fit.</h2>
                        </ul>
                    </div>
                </section>

             <!-- Forth desktop end -->


                <!-- Forth Start Mobile -->

                <section class='homePage-container' id="content-mobile">
                   
                    <div class='howToRight-mobile'>
                        <img class='landingPhotos' src='img/shutterstock_family_smaller.jpg' alt="mobile image">
                    </div>

                    <div class='howToLeft-mobile' id="content-mobile">
                        <ul after="text-border">
                            <h2 class='blockText'>Compar cost and variety locally and choose the best fit.</h2>
                        </ul>
                    </div>
                </section>

                <!-- Forth Mobile end -->






             <!-- Five Start desktop -->

                <section class='homePage-container'>
                    <div class='howToLeft sec' id="content-desktop">
                        <ul>

                            <h2 class='blockText'>Help the community by confirming prices at the store.</h2>
                        </ul>
                    </div>
                    <div class='howToRight' id="content-desktop">
                        <img class='landingPhotos landingPhotos_desktop' src='img/shutterstock_woman_shopping_smaller.jpg'>
                    </div>
                </section>

             <!-- Five desktop end -->



                <!-- Five Start Mobile -->

                <section class='homePage-container' id="content-mobile">
                
                    <div class='howToRight-mobile'>
                        <img class='landingPhotos' src='img/shutterstock_woman_shopping_smaller.jpg' alt="mobile image">
                    </div>

                    <div class='howToLeft-mobile' id="content-mobile">
                        <ul after="text-border">
                            <h2 class='blockText'>Help the community by confirming prices at the store.</h2>
                        </ul>
                    </div>
                </section>

                <!-- Five Mobile end -->








                <!-- Six Start desktop -->

                <section class='homePage-container'>
                    <div class='howToLeft' id="content-desktop">
                        <img class='landingPhotos landingPhotos_desktop' src='img/shutterstock_eating_food_small.jpg'>
                    </div>
                    <div class='howToRight sec' id="content-desktop">
                        <ul>
                            <h2 class='blockText'>Get meal recommendations based on what's in your pantry.</h2>
                        </ul>
                    </div>
                </section>

                <!-- Six desktop end-->
                <!-- Six Start Mobile -->
                <section class='homePage-container' id="content-mobile">
                   
                    <div class='howToRight-mobile hover_img'>
                        <img class='landingPhotos' src='img/shutterstock_eating_food_small.jpg' alt="mobile image">
                    </div>

                    <div class='howToLeft-mobile' id="content-mobile">
                        <ul after="text-border">
                            <h2 class='blockText'>Get meal recommendations based on what's in your pantry.</h2>
                        </ul>
                    </div>
                </section>
                 <!-- Six Mobile end -->

            </div>
        </div>
    </div>
</section>
<!-- content wraper end -->

<!-- Footer Start/End/JS -->
<?php include 'includes/footer_inc.php'?>
<script>
      $(document).ready(function() {

        typing( 0, $('.typewriter-text').data('text') );

        function typing( index, text ) {

          var textIndex = 1;

          var tmp = setInterval(function() {
            if ( textIndex < text[ index ].length + 1 ) {
                      $('.typewriter-text').text( text[ index ].substr( 0, textIndex ) );
                      textIndex++;
                  } else {
              setTimeout(function() { deleting( index, text ) }, 2000);
              clearInterval(tmp);
            }

              }, 150);

          }

          function deleting( index, text ) {

          var textIndex = text[ index ].length;

          var tmp = setInterval(function() {

            if ( textIndex + 1 > 0 ) {
              $('.typewriter-text').text( text[ index ].substr( 0, textIndex ) );
              textIndex--;
            } else {
              index++;
              if ( index == text.length ) { index = 0; }
              typing( index, text );
              clearInterval(tmp);
            }

              }, 150)

        }

});
    </script>

</html>