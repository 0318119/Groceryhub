<!DOCTYPE html>
<html lang="en">

<?php 

error_reporting( 0 );
include_once 'includes/dbh.inc.php';
include 'includes/header_inc.php'; 

if (isset($_GET['cid'])) {
    $cid = $_GET['cid'];
    if ( $_GET['cid']== '0' ) {
        //echo '<script>console.log("Zero")</script>'; 
        echo '<script>window.cid="0";</script>'; 
    } else {
        //echo '<script>console.log("NoZero")</script>';
        echo '<script>window.cid="'.$_GET['cid'].'";</script>';  
    }   
} else {
    echo '<script>window.cid="0";</script>'; 
}
//echo '<script>window.upc="'.$rid.'";</script>';

?>
<style>
/* .dataTables_filter */

/* #recipe-list_filter {
        float: left !important;
    } */
</style>

<section class="whitepage">
<!-- style="margin-bottom:-60px;" -->
    <div class="container-fluid" style="margin-bottom:0px;">
        <div class="row">
            <!-- <div class="no-gutter"> -->
            <div id="topbar" style=";">
                <div class="content-crumb-div">
                    <a class="fileTrail" href="index.php">Home</a>
                    <i style="font-size: 1rem;" class="fa fa-arrow-right"></i>
                    Recipe Editor!
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="no-gutter">


                <!-- content left halfbg-->
                <div class="col-md-12" style="">
                    <div class="onStep" data-animation="fadeInUp" data-time="200">
                            <div style="">
                                <!-- spacer -->
                                <div class="space-half"></div>
                                <h5 class="" style='text-transform: uppercase;'>Recipe Editor! </h5>
                            </div>
                    </div>
                    <div id="" class="onStep" data-animation="fadeInLeftBig" data-time="200" style="margin-top: 25px;">

                        <div class="panel panel-default">
                            <div class="panel-heading">Recipe Catagory: 
                            <form style="display:inline-block;">
                                <select class="productEditorCatSelect" style="width:200px;" id='cid' name='cid' onchange="this.form.submit()">
                                    <option name=products value=Products>All Categories</option>';
<?php
                                    $sql2 = "SELECT cat_name FROM categories WHERE isrecipe='1' ORDER BY cat_name ASC";
                                    $results2 = mysqli_query($conn, $sql2);
                                    $queryResult2 = mysqli_num_rows($results2);
                                    if ($queryResult2 > 0) {
                                        while ($row2 = mysqli_fetch_array($results2)) {
                                            $cat_name = htmlspecialchars($row2['cat_name']);
                                            echo "<option name='$cat_name' value=\"$cat_name\">$cat_name</option>";
                                        }
                                    }
?>
 
                                </select>
                            </form>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table id='recipe-list' class='table table-striped table-bordered table-hover '>
                                        <thead class='thead-dark'>
                                            <tr>
                                                <th>Recipe Media</th>
                                                <th>Recipe Title</th>
                                                <th>Category</th>
                                                <th>Date Created</th>
                                                <th>Reviews</th>
                                                <th width="180">Update</th>            
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot class='thead-dark'>
                                            <tr>
                                                <th>Recipe Media</th>
                                                <th>Recipe Title</th>
                                                <th>Category</th>
                                                <th>Date Created</th>
                                                <th>Reviews</th>
                                                <th>Update</th>            
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>  
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
        
    </div>
</section>
<!-- section -->


<!-- Footer Start/End/JS -->
<?php include 'includes/footer_inc.php'?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap.min.css">
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap.min.js"></script>

<script>
    $(document).ready(function () {
        console.log(window.cid);
    $('#recipe-list').DataTable({
    "autoWidth": false,
    "bSort": false,
    "destroy": true,
    "responsive": true,
    "pagingType": "simple_numbers",
    "bLengthChange": false,
    "pageLength": 5,
    "dom": '<"pull-left"tf><"pull-right"ti><"pull-right"l>tp',
    "bInfo": true,
    "searching": true,
    "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
    "lengthMenu": true,
    
    "ajax": "includes/action.php?recipe_list="+window.cid,
    //dom:"<'myfilter'f><'mylength'l>t"
    // "columns": [
    //     { "width": "10%" },
    //     { "width": "15%" },
    //     { "width": "10%" },
    //     { "width": "55%" }
    // ]
    
    });
    $.fn.dataTable.ext.errMode = function (settings, helpPage, message) {
    };

 
    });
    

    $(document).on('click', '#delRecipe', function (e) {
      //alert("Location");
      e.preventDefault();
      e.stopImmediatePropagation();
      //alert("hello");
      var rid = $(this).attr("data-rid");
      var rname = $(this).attr("data-rname");
      console.log(rid+" | "+rname);
      // var hid_laststep = $('#hid_laststep').val();
      // hid_laststep = (hid_laststep * 1) + 1;
      //data-rid

      $.confirm({
            title: 'Delete: '+rname+' Recipe?',
            content: '<b>The Recipe Table with their Ingredient and their Direction will also be deleted!</b><br>This dialog will automatically trigger \'cancel\' in 6 seconds if you don\'t respond.',
            autoClose: 'cancelAction|8000',
            buttons: {
                deleteUser: {
                    text: 'delete recipe',
                    action: function () {
                        $.ajax({
                            url: 'includes/action.php',
                            type: "POST",
                            data: {
                                'delRecipeNow': rid
                                },
                            success: function (response) {
                            console.log(response);
                            
                            //return false;
                            if (response.indexOf("110") >= 0) {
                                return false;
                            } else {
                                location.reload(true);
                            //     return false

                            }
                            
                            //location.reload(true);
                            }
                        });
                        //$.alert('Deleted the Recipe!');
                    }
                },
                cancelAction: function () {
                    //$.alert('action is canceled');
                }
            }
        });
    
    
    });
    
    //$('#recipe-list_wrapper > div').removeClass('pull-right');
    //$('recipe-list_wrapper.dataTables_filter').removeClass('pull-left');
    //$('#recipe-list_filter.dataTables_filter').addClass('pull-left');
    //$('.dataTables_filter').addClass('pull-left');
</script>
</html>