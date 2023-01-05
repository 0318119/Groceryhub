<?php 

//error_reporting(0);

session_start(); 



function getURL() {

    $uri = $_SERVER['REQUEST_URI'];

    //echo $uri; // Outputs: URI



    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";



    $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

    //echo $url; // Outputs: Full URL



    $query = $_SERVER['QUERY_STRING'];

    return $url; // Outputs: Query String

}





function isMobile() {

    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);

}



?>



<head>

    <meta charset="utf-8">

    <title>GroceryHUB | Interactive Groceries & Recipies</title>

    <meta content="" name="description">

    <meta content="" name="author">

    <meta content="" name="keywords">

    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">

    <!-- favicon -->

    <link href="img/favicon1.png" rel="icon" sizes="32x32" type="image/png">

    <!-- Bootstrap CSS -->

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- font themify CSS -->

    <link rel="stylesheet" href="css/themify-icons.css">

    <!-- font awesome CSS -->

    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- stock CSS -->

    <link href="css/animated-stock.css" rel="stylesheet">

    <link href="css/owl.carousel.css" rel="stylesheet">

    <link href="css/owl.theme.css" rel="stylesheet">

    <link href="css/owl.transitions.css" rel="stylesheet">

    <link href="css/stock-style.css" rel="stylesheet">

    <link href="css/queries-stock.css" media="all" rel="stylesheet" type="text/css">

</head>



<?php

echo "<!-- Testing -->";

$current_file_name = basename($_SERVER['PHP_SELF']);

echo "<!-- Testing -->";

    if( ($current_file_name != 'index.php') ) {

        echo '<body>';

        //echo '<!-- '.$filename.' -->';

    } else {

        echo '<body class="home">';

        //echo '<!-- '.$filename.' -->';

    }

                   

?>

    <!-- preloader -->

    <!-- <div class="bg-preloader"></div>

    <div class="preloader">

        <div class="mainpreloader">

            <img class="logo-preloader" alt="preloaderlogo" src="img/ajax-loader.gif"> <span>loading</span>

            <img alt="logo" src="img/grocery_logo-03.png">

        </div>

    </div> -->

    <!-- preloader end -->



    <!-- main menu -->

    <section aria-label="menu" class="whitepage-menu" id="menu-block">



        <div class="wrap-menu">

        <?php if (isset($_SESSION['u_id'])) { ?>

            <div class="wrap-menu-child">

                <small>Hi, <?php echo $_SESSION['u_first'].' '.$_SESSION['u_last']; ?></small>

                <ul>

                    <li>



                    </li>

                    <li class="init-menu">

                        <a class="link actived" href="index.php">Home</a>

                    </li>

                    <li class="init-menu">

                        <a class="link" href="my_list.php">My List</a>

                    </li>

                    <li class="init-menu">

                        <a class="link" href="pantry.php">My Pantry</a>

                    </li>

                    <li class="init-menu">

                        <a class="link" href="past_purchases.php">Past Purchases</a>

                    </li>



                    <li class="init-menu dropdown">

                        <a class="dropdown-link" href="#">Admin Links <i class="fa fa-angle-double-right"

                                aria-hidden="true"></i></a>

                        <ul class="dropdown-container">

                            <li class="init-menu">

                                <a class="link" href="cookbook.php">My Cookbook</a>

                            </li>

                            <li class="init-menu">

                                <a class="link" href="recipes.php">Recipies</a>

                            </li>

                            <li class="init-menu">

                                <a class="link" href="meal_plan.php">My Meal Plan</a>

                            </li>

                            <li class="init-menu">

                                <a class="link" href="create_recipe.php">Create New Recipe</a>

                            </li>

                            <li class="init-menu">

                                <a class="link" href="enterprice.php">Add New Product</a>

                            </li>

                            <li class="init-menu">

                                <a class="link" href="product_editor.php">Product Editor</a>

                            </li>

                        </ul>

                    </li>



                    <!-- <li class="init-menu">

                        

                    </li> -->



                    <!-- <li class="init-menu" style="margin-top: 20px;">

                        <div class="social-icons-subnav">

                            <a href="#"><span class="ti-facebook"></span></a>

                            <a href="#"><span class="ti-twitter"></span></a>

                            <a href="#"><span class="ti-instagram"></span></a>

                            <a href="#"><span class="ti-dribbble"></span></a>

                            <a href="#"><span class="ti-linkedin"></span></a>

                        </div>

                    </li> -->



                </ul>

                <form action='includes/logout.inc.php' method='POST'>

                    <button class="btn btn-rounded btn-yellow btn-block" id='logoutButton' type='submit' name='submit'>Logout</button>

                </form>

            </div>

        <?php } else { ?>

            <div class="wrap-menu-child">

            <h2 class="title"><small style="font-size: 18px;">

            <a href="myaccount.php" class="btn-lg btn-rounded ">Signup with Us!</a></small><br></h2>

                    <div data-form-type="signup_form">

                          <h2 class="title"><small style="font-size: 18px;">Login to continue!</small><br></h2>

                            <form method="post" action="" name="loginform">

                                <div class="form-group">

                                    <input type="email" name="uid" required class="form-control btn-rounded" id="uid" placeholder="Email Address">

                                </div>

                                <div class="form-group">

                                    <input type="password" name="pwd" required class="form-control btn-rounded" id="pwd" placeholder="Password">

                                </div>

                                <div class="form-group" style="margin-top:-25px !important;">

                                    <button value="1" id="signinForm" name="signinForm" type="submit" class="btn btn-rounded btn-yellow btn-block">Login</button>

                                </div>

                                <div class="alert alert-danger" role="alert" id="formResult_login" style="display:none; margin-top:-25px !important;"></div>

                                <input type="hidden" id="lurl" name="lurl" value="<?php echo getURL(); ?>" >

                            </form>

                    </div>

                      

                      <!-- forgot password area -->

                      <div data-form-type="forget_form">

                      <h2 class="title"><small style="font-size: 18px;">Forget Password?</small><br></h2>

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





                <ul>

                    <li class="init-menu" style="margin-top: 20px;">

                        <div class="social-icons-subnav">

                            <a href="#"><span class="ti-facebook"></span></a>

                            <a href="#"><span class="ti-twitter"></span></a>

                            <a href="#"><span class="ti-instagram"></span></a>

                            <a href="#"><span class="ti-dribbble"></span></a>

                            <a href="#"><span class="ti-linkedin"></span></a>

                        </div>

                    </li>

                </ul>

            </div>



        <?php } ?>

            

        </div>

    







    </section>

    <!-- main menu end -->

    <!-- |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->

    

    <!-- |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->

    <!-- content wraper -->

    <div class="content-wrapper">

        <?php if (isset($_SESSION['u_id'])) {  ?>

        <div class="navbar-brand" id="stid"><?php echo $_SESSION['city'].", ".$_SESSION['state']; ?></div>

        <?php } ?>

        <!-- logo -->

        <a class="navbar-brand" href="index.php"><img alt="logo" src="img/grocery_logo-03.png" title="GroceryHUB.us">

        

        </a>

        

        <!-- menu icon start -->

        <!-- menu icon-->

        <div id="nav-icon">

            <div class="bg-nav-icon"></div>

            <span>close</span>

            <div class="menu-line"></div>

            <div class="menu-line1"></div>

            <div class="menu-line2"></div>

        </div>

        

        <!-- menu icon end -->

        <!-- menu icon end -->



        <!-- block-menu -->

        <div class="block-main"></div>

        

        <!-- block-menu end-->

        <?php

        

        if( ($current_file_name != 'index.php') ) {

                //Hide

            

        ?>

        <!-- section -->

        <section class="whitepage no-top no-bottom">

            <div class="container-fluid">

                <div class="row">

                    <div class="no-gutter">



                        <!-- content left -->

                        <div class="col-md-2 fixed onStep" id="lefslider" data-animation="fadeInLeft" data-time="0">

                            <div id="bgslideshow">

                                <div class="imgbg" style="background-image:url(img/gallery-home/3.jpg)"></div>

                                <div class="imgbg" style="background-image:url(img/gallery-home/5.jpg)"></div>

                                <div class="imgbg" style="background-image:url(img/gallery-home/2.jpg)"></div>

                            </div>



                            <div class="overlay-page v-align">

                                <div class="col-md-10 col-xs-11">

                                    <?php 

                                    

                                    if (!isset($_GET['htype'])) {

                                        $_GET['htype'] = "Groceries";

                                    }

                                    

                                    ?>

                                    <!-- spacer -->

                                    <!-- <div class="space-double">

                                        </div> -->

                                    <div class="space-double hidden-sm hidden-xs">

                                    </div>

                                    <!-- spacer end -->

                                    <div class="subtitle">



                                    <div class="row">

                                        <?php if ($_GET['htype']=='Groceries') { ?>

                                        <div id="groc">

                                            <h5 style="color:white;text-transform: uppercase;">Product Categories</h5>

                                            <?php



                                            $sql = "SELECT cat_name FROM categories ORDER BY cat_name ASC";



                                            $result = mysqli_query($conn, $sql);

                                            $queryResult = mysqli_num_rows($result);

                                    

                                            if($queryResult > 0) {

                                                while($row = mysqli_fetch_array($result)) {

                                                    echo "<a href='results.php?htype=Groceries&catSelect=".trim($row['cat_name'])."&search='>

                                                    <div class='col-sm-4 categoryContainer'>

                                                        <p class='searchHint2'><strong>".$row['cat_name']."</strong></p>        

                                                    </div></a>";

                                                }

                                            }

                                            ?>  

                                        </div>

                                        <?php } else { ?>

                                        <div id="recip">

                                            <h5 style="color:white;text-transform: uppercase;">Recipe Categories</h5>

                                                <a href='results.php?htype=Recipes&catSelect=&search='>

                                                   <div class='col-sm-4 categoryContainer'>

                                                        <p class='searchHint2'><strong>N/A</strong></p>        

                                                    </div>

                                                </a>

                                            <?php

                                            //$sql = "SELECT cat_name FROM categories ORDER BY cat_name ASC";



                                            //$result = mysqli_query($conn, $sql);

                                            //$queryResult = mysqli_num_rows($result);

                                    

                                            //if($queryResult > 0) {

                                                //while($row = mysqli_fetch_array($result)) {

                                                    //echo "<a href='results.php?htype=Groceries&catSelect=".trim($row['cat_name'])."&search='>

                                                    //<div class='col-sm-4 categoryContainer'>

                                                    //    <p class='searchHint2'><strong>".$row['cat_name']."</strong></p>        

                                                    //</div></a>";

                                                //}

                                            //}

                                            ?>  

                                        </div>

                                        <?php } ?>  

                                    </div>

                                        

                                    </div>

                                </div>

                            </div>



                        </div>

                        <!-- content left end -->

                        <!-- content right -->

                        <?php 

                        if(isMobile()){

                            // Do something for only mobile users

                            echo '<div class="col-md-12 col-sm-12 col-xs-12 scrollit pull-left">';

                        }

                        else {

                            // Do something for only desktop users

                            echo '<div class="col-md-10 col-sm-10 col-xs-11 scrollit pull-right">';

                        }

                        ?>

                        

                            <div class="menu_search">

                                <!-- Hello Testing Hello -->

                                <form id='headersearch' action='results.php' method='GET'>

                                    

                                    <div class="">

                                        <div class="row">

                                            

                                            <div class="col-md-12 pull-left">



                                                <div class="col-sm-3 pull-left" id="n-option"> 

                                                    <div class="myradio">

                                                        <div class="input-group">

                                                            <div id="radioBtn" class="btn-group">

                                                                <?php if ( ($_GET['htype'] == 'Groceries') || (isset($_GET['upc'])) ) { ?>

                                                                <a class="btn btn-success btn-lg active" data-toggle="happy" data-title="Groceries">GROCERIES</a>

                                                                <a class="btn btn-success btn-lg notActive" data-toggle="happy" data-title="Recipes">RECIPES</a>

                                                                <input type="hidden" name="htype" id="htype" value="Groceries">



                                                                <?php } else { ?>

                                                                <a class="btn btn-success btn-lg notActive" data-toggle="happy" data-title="Groceries">GROCERIES</a>

                                                                <a class="btn btn-success btn-lg active" data-toggle="happy" data-title="Recipes">RECIPES</a>

                                                                <input type="hidden" name="htype" id="htype" value="Recipes">

                                                                <?php }  ?>

                                                            </div>

                                                            

                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="col-sm-1" id="select-option"> 

                                                    <select class='form-control' id='catSelect' name='catSelect' onchange='this.form.submit()' >

                                                        <option class=catSelectOption name='products' value='Products'>Filter</option>

                                                        <option class='catSelectOption' name='products' value='Products'>ALL CATEGORIES</option>";

                                                    </select>

                                                </div>

                                                <div class="col-sm-4"> 

                                                    <div class="input-group" style="">

                                                        

                                                        <div class="input-group-btn" >

                                                            <input id="headersearchinput" type="search" name="search" class="form-control"

                                                                placeholder="Search for..." <?php if (isset($_GET['search'])) { $search = $_GET['search']; echo" value='$search'";} ?> style="" autocomplete="off">



                                                            <button id='headersearchbutton' class="btn btn-lg" type='submit' ><i class="fa fa-search"></i></button>

                                                            <button id='scan' class="btn btn-lg" type="button"><i class="fa fa-barcode"></i></button>

                                                        </div>

                                                        <div class="productSearchList" style="display:none;"></div>

                                                        <div id='barcode-scanner' style="display:none;"></div>

                                                    </div><!-- /input-group -->

                                                </div>



                                                <!-- </form> -->

                                            </div><!-- /.col-lg-6 -->

                                        </div><!-- /.row -->

                                    </div>

                                </form>

                            </div>

<?php 

} 

?>