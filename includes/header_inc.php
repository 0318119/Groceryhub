<?php 
//error_reporting(0);
session_start(); 

function curPageURL() {
    $pageURL = 'http';
    if(isset($_SERVER["HTTPS"]))
    if ($_SERVER["HTTPS"] == "on") {
        $pageURL .= "s";
    }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}

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

    $locuser_ip = getenv('REMOTE_ADDR');
    $locgeo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=".$locuser_ip));
    $loccountry = $locgeo["geoplugin_countryName"];
    $locstate = $locgeo["geoplugin_regionName"];
    $loccity = $locgeo["geoplugin_city"]; 

$_SESSION['last_url'] = getURL();
?>

<head>
    <meta charset="utf-8">
    <title>GroceryHUB | Interactive Groceries & Recipies</title>
    <meta content="" name="description">
    <meta content="Micheal" name="author">
    <meta content="" name="keywords">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <!-- favicon -->
    <!-- <link href="img/favicon1.png" rel="icon" sizes="32x32" type="image/png"> -->
    <link rel="icon" type="image/png" sizes="64x64" href="img/grocery_bag.png">
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
    <link href="css/effective-breadcrumbs.css" rel="stylesheet">
</head>

<body>

    <!-- preloader -->
    <div class="bg-preloader"></div>
    <div class="preloader">
        <div class="mainpreloader">
            <img class="logo-preloader" alt="preloaderlogo" src="img/ajax-loader.gif"> <span>loading</span>
            <img alt="logo" src="img/grocery_logo-03.png">
        </div>
    </div>
    <!-- preloader end -->

    <!-- main menu -->
    <section aria-label="menu" class="whitepage-menu" id="menu-block">

        <div class="wrap-menu">
            <?php if (isset($_SESSION['u_id'])) { ?>

            <div class="wrap-menu-child">
                <small>Hi, <?php echo $_SESSION['u_first'].' '.$_SESSION['u_last']; ?>
                    <a style="margin-left: 15px;" href="myaccount.php">
                    <i class="fa fa-cog fa-xs" style="font-size:10px !important;margin-right:5px;" aria-hidden="true"></i>My Account</a>
                </small>
                <ul>
                    <li>

                    </li>
                    <li class="init-menu">
                        <a class="link actived" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="init-menu">
                        <a class="link" href="shop.php">My Shop</a>
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

                    <?php if ( $_SESSION['perms'] >= 9 ) { ?>
                    <li class="init-menu dropdown">
                        <a class="dropdown-link" href="#">Admin Links <i class="fa fa-angle-double-right"
                                aria-hidden="true"></i></a>
                        <ul class="dropdown-container">
                            
                            <li class="init-menu">
                                <a class="link" href="users_management.php">Users Management</a>
                            </li>
                            <li class="init-menu">
                                <a class="link" href="product_editor.php">Product Editor</a>
                            </li>
                            <li class="init-menu">
                                <a class="link" href="enterprice.php">Add New Product</a>
                            </li>
                            <li class="init-menu">
                                <a class="link" href="recipe_editor.php">Recipe Editor</a>
                            </li>
                        </ul>
                    </li>
                    <?php } ?>
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
                    <button class="btn btn-rounded btn-yellow btn-block" id='logoutButton' type='submit'
                        name='submit'>Logout</button>
                </form>
            </div>
            <?php } else { ?>
            <div class="wrap-menu-child">
                <h2 class="title">
                    <small style="font-size: 18px;">
                        <a href="login.php" class="btn-lg btn-rounded ">Login / Signing In</a>
                    </small>
                </h2>
                <br><br>
                <h2 class="title">
                    <small style="font-size: 18px;">
                        <a href="register.php" class="btn-lg btn-rounded ">Signup with Us!</a>
                    </small>
                </h2>
                <br><br>
                <h2 class="title">
                    <small style="font-size: 18px;">
                        <a href="forgotpassword.php" class="btn-lg btn-rounded ">Forgot Password!</a>
                    </small>
                </h2>
                <br><br>

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
    <!-- nav -->
    <div class="navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="row">

                <?php 
                    if ( isset($_SESSION['u_id']) ) {
                        $muserloc = $_SESSION['city'].', '.$_SESSION['state'];
                        $_SESSION['muserloc'] = $muserloc;
                        echo '<input type="hidden" id="muserloc" name="muserloc" value="'.$_SESSION['muserloc'].'">';
                    } else {
                        if ( isset($_SESSION['muserloc']) ) {

                        } else {
                            $muserloc = $loccity.', '.$locstate;
                            $_SESSION['muserloc'] = $loccity.', '.$locstate;
                            echo '<input type="hidden" id="muserloc" name="muserloc" value="'.$_SESSION['muserloc'].'">';
                        }
                        
                    }
                
                ?>

                <!-- logo -->
                <a class="navbar-brand" href="index.php"><img alt="logo" src="img/grocery_logo-03.png"
                        title="GroceryHUB.us" style=""></a>
                        <!-- Current Location -->
                        <span id="loccity" title="Click to change your desired state!"><i class="fa fa-map-marker fa-xs" style="font-size:10px !important;margin-right:5px;" aria-hidden="true"></i><?php echo $_SESSION['muserloc']; ?></span>

                        <div id='nav-container'>
                            <ul id='loggedin-nav'>
                                <?php 
                                if (isset($_SESSION['u_id'])) { 
                                    echo "<li><a class='headera' href='my_list.php'>My List</a></li>";
                                } else {
                                    echo "<li><a class='headera' href='login.php'>
                                    <i class='fa fa-sign-in fa-xs' style='font-size:14px !important;margin-right:5px;' aria-hidden='true'></i>
                                    SIGN-IN</a></li>";
                                    echo "<li><a class='headera' href='register.php'>
                                    <i class='fa fa-users fa-xs' style='font-size:12px !important;margin-right:5px;' aria-hidden='true'></i>
                                    SIGN-UP</a></li>";
                                    // echo "<li><a class='headera' href='myaccount.php'>My Account&nbsp;&nbsp;</a></li>";
                                }

                                ?>
                                
                                
                            </ul>
                </div>
                <!-- mainmenu start -->
                <div class="menu-init" id="main-menu">
                    <!-- search bar will come here -->
                </div>
                <!-- mainmenu end -->

            </div>
        </div>
        <!-- container -->
    </div>
    <!-- nav end -->
    <!-- |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
    <!-- content wraper -->
    <div class="content-wrapper">

        <!-- menu icon start -->
        <!-- menu icon-->
        
        <?php 
        //getURL() != 'https://groceryhub.demo-lc.com/'
        if ( isset($_SESSION['u_id']) ) {

            echo '
            <div id="nav-icon">
            <div class="bg-nav-icon"></div>
            <span>close</span>
            <div class="menu-line"></div>
            <div class="menu-line1"></div>
            <div class="menu-line2"></div>
        </div>
            ';

        } 

        
        ?>
        
        <!-- menu icon end -->
        <?php 
                                    
        if (!isset($_GET['htype'])) {
            $_GET['htype'] = "Groceries";
        }
        
        ?>

        <?php if (isset($_SESSION['u_id'])) { ?>
        <div class="menu_search">
            <!-- Hello Testing Hello -->
            <form id='headersearch' action='results.php' method='GET'>

                <div class="">
                    <div class="row">

                        <div class="col-md-10 pull-left">

                            <div class="col-sm-3 pull-left">
                                <div class="myradio">
                                    <div class="input-group">
                                        <div id="radioBtn" class="btn-group">
                                            <?php if ( ($_GET['htype'] == 'Groceries') || (isset($_GET['upc'])) ) { ?>
                                            <a class="btn btn-success btn-lg active" data-toggle="happy"
                                                data-title="Groceries">GROCERIES</a>
                                            <a class="btn btn-success btn-lg notActive" data-toggle="happy"
                                                data-title="Recipes">RECIPES</a>
                                            <input type="hidden" name="htype" id="htype" value="Groceries">

                                            <?php } else { ?>
                                            <a class="btn btn-success btn-lg notActive" data-toggle="happy"
                                                data-title="Groceries">GROCERIES</a>
                                            <a class="btn btn-success btn-lg active" data-toggle="happy"
                                                data-title="Recipes">RECIPES</a>
                                            <input type="hidden" name="htype" id="htype" value="Recipes">
                                            <?php }  ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-1" style="width:73px !important;">
                                <select class='form-control' id='catSelect' name='catSelect' onchange='this.form.submit()'>
                                    <option class=catSelectOption name='products' value='Products'>Filter</option>
                                    <option class='catSelectOption' name='products' value='Products'>ALL CATEGORIES
                                    </option>";
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-group" style="height: 40px !important;border:none; margin-top:-1px;">

                                    <div class="input-group-btn" style="">
                                        <input id="headersearchinput" type="search" name="search" class="form-control"
                                            placeholder="Search for..."
                                            <?php if (isset($_GET['search'])) { $search = $_GET['search']; echo" value='$search'";} ?>
                                            style="" autocomplete="off">

                                        <button id='headersearchbutton' class="btn btn-lg" type='submit'><i
                                                class="fa fa-search"></i></button>
                                        <button id='scan' class="btn btn-lg" type="button"><i
                                                class="fa fa-barcode"></i></button>
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
        <?php } ?>

        <!-- section -->

