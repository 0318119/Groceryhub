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
                    Users Management!
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
                                <h5 class="" style='text-transform: uppercase;'>User's Management! </h5>
                            </div>
                    </div>
                    <div id="" class="onStep" data-animation="fadeInLeftBig" data-time="200" style="margin-top: 25px;">

                        <div class="panel panel-default">
                            <div class="panel-heading">User's List : </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table id='users-list' class='table table-striped table-bordered table-hover '>
                                        <thead class='thead-dark'>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>City/State</th>
                                                <th>PermissionLevel</th>
                                                <th>Verified</th>
                                                <th>CreatedOn</th>
                                                <th>Update</th>            
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot class='thead-dark'>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>City/State</th>
                                                <th>PermissionLevel</th>
                                                <th>Verified</th>
                                                <th>CreatedOn</th>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

<script>
    $(document).ready(function () {
        console.log(window.cid);
    $('#users-list').DataTable({
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
    
    "ajax": "includes/action.php?users_list=1",
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

    //-----------------------------------
    //--Edit User----------------------
    //-----------------------------------
    function editUser(uid) {
            //return alert(ingred);   // The function returns the product of p1 and p2
            // e.preventDefault();
            // e.stopImmediatePropagation();
            //alert("hello");
            $.confirm({
                title: 'Update User Functions!',
                content: 'url:includes/edit_user_inc.php?uid='+uid,
                onContentReady: function () {
                    var self = this;
                    this.setContentPrepend('<div*</div>');
                    setTimeout(function () {
                        self.setContentAppend('<div>*</div>');
                    }, 2000);
                },
                        
                buttons: {
                    formSubmit: {
                        text: 'Submit',
                        btnClass: 'btn-blue',
                        action: function () {
                            var submitUserUpdate = "Yes";
                            var permissions_level = $('input[name="plevel"]:checked').val();
                            var verified = $('#verified').val();
                            var hid = $('#hid').val();
                            
                            console.log(uid +' | '+permissions_level+' | '+verified);
                            //return;
                            $.ajax({
                                url: 'includes/action.php',
                                method: 'POST',
                                data: {
                                'submitUserUpdate': submitUserUpdate,
                                'permissions_level': permissions_level,
                                'verified': verified,
                                'hid': hid
                                
                                },
                                success: function (response) {
                                console.log(response);
                                //$("#step_2_now").fadeOut(100);
                                if ( response == "true") {
                                    // $("#ratresult").html("Ingredient Successfully Submited!");
                                    // $("#ratresult").fadeIn();
                                    
                                    
                                    setTimeout(function() {
                                        location.reload(true);
                                    }, 1000);
                                    return false;
                                } else {
                                    alert(response);
                                }
                                
                                return false;
                                }
                            });
                        }
                    },
                    cancel: function () {
                    },
                },
                onContentReady: function () {
                    // bind to events
                    var jc = this;
                    this.$content.find('form').on('submit', function (e) {
                        // if the user submits the form by pressing enter in the field. $$formSubmit
                        e.preventDefault();
                        jc.$formSubmit.trigger('click'); // reference the button and click it
                        });
                    }
            });
    }

    //-----------------------------------
    //--Delete Routine-------------------
    //-----------------------------------
    function deleteUser(uid) {
        //alert(ingred);
        //var ingnam = $(this).attr("data-ingnam");
        //var ingnam =$(this).attr("ingnam");
        $.confirm({
            title: 'Delete User ? ID: '+uid,
            content: '<p>This dialog will automatically trigger \'cancel\' in 10 seconds if you don\'t respond.</p><p>All data belongs to that particular user will be remove including his review, recipes etc.</p>',
            autoClose: 'cancelAction|10000',
            buttons: {
                deleteUser: {
                    text: 'delete user',
                    action: function () {
                        //$.alert('Deleted the user!');
                        var ingideleteid = uid;
                        console.log('DelID: '+uid);

                        $.ajax({
                            url: 'includes/action.php',
                            method: 'POST',
                            data: {
                            'userdeleteid': uid                           
                            },
                            success: function (response) {
                            console.log(response);
                            //$("#step_2_now").fadeOut(100);
                            if ( response == "true") {
                                $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
                                    $("#success-alert").slideUp(500);
                                });
                                
                                setTimeout(function() {
                                    $("#step_2_now").load("recipe_step_2.php?rid="+window.rid).fadeIn(500);
                                }, 2000);
                                return false;
                            } else {
                                alert(response);
                            }
                            return false;

                            //location.reload(true);
                            }
                        });
                        //var name = this.$content.find('.name').val();
                        //if(!name){
                            //$.alert('provide a valid name');
                            //return false;
                        //}
                        //$.alert('Your name is ' + name);
                    }
                },
                cancelAction: function () {
                    $.alert('action is canceled');
                }
            }
        });
    }
    
    //$('#recipe-list_wrapper > div').removeClass('pull-right');
    //$('recipe-list_wrapper.dataTables_filter').removeClass('pull-left');
    //$('#recipe-list_filter.dataTables_filter').addClass('pull-left');
    //$('.dataTables_filter').addClass('pull-left');
</script>
</html>