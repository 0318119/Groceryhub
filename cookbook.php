
<!DOCTYPE html>
<html lang="en">

<?php 

error_reporting( 0 );
include_once 'includes/dbh.inc.php';
include 'includes/header_inc.php'; 
?>


        <section class="whitepage">
            <div class="container-fluid">
                <div class="row">
                    <!-- <div class="no-gutter"> -->
                    <div id="topbar" style=";">
                        <div class="content-crumb-div">
                        <a class="fileTrail" href="index.php">Home</a>
                        <i style="font-size: 1rem;" class="fa fa-arrow-right"></i>
                        Cookbook!

                        </div>
                    </div>
                    <!-- </div> -->
                </div>
                <div class="row">
                    <div class="no-gutter">

                        <!-- content right -->
                        <div class="col-md-12" style="">

                            <!-- spacer -->
                            <!-- <div class="space-single hidden-sm hidden-xs"></div> -->
                            <div class="space-half"></div>
                            <!-- spacer end -->

                            <!-- wrapper -->
                            <!-- <div class="row"> -->
                            <!-- <div class="col-md-10 col-md-offset-1 col-sm-11 col-sm-offset-1 col-xs-11 col-xs-offset-1 pull-left"> -->

                            <!-- row content -->
                            <div class="row">

                                <!-- left content -->
                                <div class="col-md-12">
                                    <div class="onStep" data-animation="fadeInUp" data-time="300">
                                        <div style="margin:25px !important;">
                                        <h3 class="onStep" data-animation="fadeInRight" data-time="0">Your Cookbook Recipes!</h3>
                                        </div>
                                        <div class="product-area">
<?php
    
   
        
if (isset($_SESSION['u_id'])) {   
    $sql = "SELECT * FROM cookbook INNER JOIN recipes ON cookbook.recipe_id = recipes.recipe_id WHERE cookbook.user_id = ".$_SESSION['u_id']." LIMIT 20";
    $result = mysqli_query($conn, $sql);//execute query
    $queryResult = mysqli_num_rows($result);//total number of rows
    if ($queryResult > 0) {
        while ($row = mysqli_fetch_array($result)) {
                    $rid = $row['recipe_id'];
                    $rname = $row['recipe_name'];
        echo "<form class=product-cards method='POST'>
                        <div id=product-photo>
                            <a href=create_recipe_4.php?rid=".$rid.">
                            <img id=resultPhoto src='img/rid".$rid.".png' alt='No Photo' onerror=this.src='img/noimageavailable.png' class='img-responsive' style='margin: 0 auto; min-width:160px; min-height:160px;'>
                            </a>
                        </div>
                        <div id=product-info>
                            <a href=create_recipe_4.php?rid=".$rid.">
                            <h4 id=resultName name=details>".$rname."</h4>
                            </a>
                        </div>
                    </form>";
                    }
                }
            }
?>
</div><!--Closes product-area div-->

                                    </div>
                                </div>
                                <!-- left content end -->

                                

                            </div>
                            <!-- row content end -->
                            

                            <!-- spacer -->
                            <!-- <div class="space-single"></div> -->

                        </div>
                        <!-- content right end -->

                    </div>
                </div>
            </div>
        </section>
        <!-- section -->


<!-- Footer Start/End/JS -->
<?php include 'includes/footer_inc.php'?>

</html>