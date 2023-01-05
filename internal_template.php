
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
                    <div id="topbar" style=";">topbar</div>
                    <!-- </div> -->
                </div>
                <div class="row">
                    <div class="no-gutter">


                        <!-- content left -->
                        <div class="col-md-5 onStep" data-animation="fadeInLeft" data-time="0" style="background-color:#F8F7F5 !important; min-height: 800px !important;">

                            <div class="col-md-12 col-xs-10">
                                <!-- spacer -->
                                <div class="space-half"></div>
                                <!-- <div class="space-double hidden-sm hidden-xs"></div> -->
                                <!-- spacer end -->
                                <div class="subtitle">
                                    <h5 style="color:#333; ">Image Gallery Section</h5>
                                </div>
                            </div>


                        </div>
                        <!-- content left end -->

                        <!-- content right -->
                        <div class="col-md-7" style="">

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
                                <div class="col-md-9">
                                    <div class="onStep" data-animation="fadeInUp" data-time="300">

                                        <div style="margin:25px !important;">Product Brief</div>

                                    </div>
                                </div>
                                <!-- left content end -->

                                <!-- right content -->
                                <div class="col-md-3">
                                    <aside class="onStep" data-animation="fadeInUp" data-time="600">

                                        <!-- widget -->
                                        <div style="margin:25px !important;">My List with Tags</div>
                                        <!-- widget end -->
                                    </aside>
                                </div>
                                <!-- right content end -->

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