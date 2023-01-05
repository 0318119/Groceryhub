
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
                    <?php 

                    if(isset($_GET['rid'])) {
                        $rid = mysqli_real_escape_string($conn, $_GET['rid']);
                        echo '<script>window.upc="'.$rid.'";</script>';
                        if (isset($_SESSION['u_id'])) {
                        $uid = mysqli_real_escape_string($conn, $_SESSION['u_id']);
                        $permissions_level = mysqli_real_escape_string($conn, $_SESSION['perms']);  
                        }
                        
                        //$sql = "SELECT * FROM products LEFT OUTER JOIN product_photos ON products.item_upc = product_photos.upc WHERE products.item_upc=$item_upc LIMIT 1";
                        $sql = "SELECT * FROM recipes WHERE recipe_id=".$rid." LIMIT 1";
                        //echo "<h1>".$sql."</h1>";
                        $results = mysqli_query($conn, $sql);
                        $queryResults = mysqli_num_rows($results);
                        if ($queryResults > 0) {
                            $row = mysqli_fetch_array($results);
                                $rname = $row['recipe_name'];
                                $rcate = $row['rcate'];
                                $ralergy = $row['ralergy'];
                                $rcreator = $row['user_id'];
                                $rdate = $row['datetime'];
                        }
                        }
                                //echo "<h4 class=searchResults><a href='results.php?catSelect=" . htmlspecialchars($item_cat) . "&subCatSelect=&search='>$item_cat</a> / <a href='results.php?catSelect=" . htmlspecialchars($item_cat) . "&subCatSelect=" . htmlspecialchars($item_sub_cat) . "&search='>$item_sub_cat</a> / $item_name</h4><br><br>";
                    ?>
                        <div class="content-crumb-div" >
                                <a class="fileTrail" href="index.php">Home</a> 
                                <i style="font-size: 1rem;" class="fa fa-arrow-right"></i> 
                                <a class="fileTrail" href="recipes.php">Recipes</a>
                                <i style="font-size: 1rem;" class="fa fa-arrow-right"></i> 
                                <a class="fileTrail" href="<?php echo "results.php?htype=Recipes&catSelect=" . htmlspecialchars($rcate) . "&subCatSelect=&search=" ?>"><?php echo $rcate; ?></a>
                                <i style="font-size: 1rem;" class="fa fa-arrow-right"></i> 
                                <?php echo $rname; ?>

                        </div>
                    
                    </div>
                    <!-- </div> -->
                </div>
                <div class="row">
                    <div class="no-gutter">
                        <!-- Left Area -->
                        <div class="col-md-2 onStep hidden-xs" data-animation="fadeInLeft" data-time="0" style="background-color:#F8F7F5 !important; height: 800px !important;">
                            kljl;kjl;kjl;kj
                        </div>
                        
                        <!-- Recipe Details Coming  -->
                        <div class="col-md-8 col-sm-12">
                            <div class="col-md-6 onStep" data-animation="fadeInLeft" data-time="0" style="background-color:#fff !important; ">
                                <div class="col-md-12 col-sm-12">


                               kasj;lka;skldjf l;fkaj sdkl;fj adkl al;sdkfj al;skdjf al;ksdjf
                                    

                                </div>
                                <!-- Second Slider end -->
                            </div> <!-- creator's Recipes End -->
                        </div> <!-- middle column end -->
                       
                
                        
                        
                        <!-- Right Area Start -->
                        <!-- right content -->
                        <div class="col-md-2 hidden-xs" id="mobile-sidebar">
                            <aside class="onStep" data-animation="fadeInUp" data-time="600">

                                <!-- widget -->
                                <!-- <div style="margin:25px !important;">List Quick View</div> -->
                                <h5 style="text-transform: capitalize; margin-left:0px;">List Quick View</h5>
                                <div class="space-single devider-widget" style="margin-top:-25px !important;">
                                </div>
                                <form method='POST' action='my_list.php'>
                                    <button class='btn btn-rounded btn-yellow' style="width:75%;">Review List</button>
                                </form>

                                <div id="myList" class="recent">


                                <?php 
            
                                if (isset($_SESSION['u_id'])) {
                                    $uid = $_SESSION['u_id'];
                                    echo "<div class='list pull-left'>";
                                    $sql = "SELECT * FROM grocery_lists INNER JOIN products ON grocery_lists.item_upc = products.item_upc WHERE grocery_lists.user_id = ".$uid." ORDER BY grocery_lists.item_name";
                                    $result = mysqli_query($conn, $sql);
                                    $queryResults = mysqli_num_rows($result);
                                    if ($queryResults > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $item_upc = $row['item_upc'];
                                            $item_qty = $row['item_quantity'];
                                            $item_name = $row['item_name'];
                                            $sql6 = "SELECT * FROM product_photos WHERE upc = $item_upc";
                                            $result6 = mysqli_query($conn, $sql6);
                                            $row6 = mysqli_fetch_assoc($result6);
                                            $link = $row6['link'];
                                            echo "<div class='product-container-thumbnail'>
                                                    <div id=product-photo-thumbnail>
                                                        <a href=details.php?upc=".$item_upc.">";
                                                        if ($row['has_image'] == 1) {
                                                        $filename = "img/".$item_upc."*";
                                                        $fileinfo = glob($filename);
                                                        $fileExt = explode(".", $fileinfo[0]);
                                                        $fileActualExt = $fileExt[1];
                                                        $file = "img/resized".$item_upc.".".$fileActualExt;
                                                        
                                                        echo "<img id=resultPhoto-thumbnail src=$file alt=$item_name onerror=this.src='img/noimageavailable.png'>";
                                                        } else {
                                                        echo "<img id=resultPhoto-thumbnail src='$link' alt=$item_name onerror=this.src='img/noimageavailable.png'>"; 
                                                        }
                                                        echo "</a>
                                                        </div>
                                                        <div id='listInfo' type='submit' name='item-details'>
                                                            <div id=product-info-thumbnail>
                                                                <a id=resultInfo-thumbnail href='details.php?upc=$item_upc'><span style='line-height: 1 !important; margin-top:-18px;'>".$row['item_name']."</span></a>   
                                                            </div>
                                                        </div>
                                                        <div id=adjust>";
                                                    if ($item_qty <= 1) {
                                                            echo"<div id=deleteForm>
                                                            <form id=delete method='POST' action='includes/action.php?dupc=".$item_upc."'>
                                                                <input type=hidden id=dupc name=dupc value=".$item_upc.">
                                                                <button class=listDelete uid=".$uid." qty=".$item_qty." id=".$item_upc." type='submit' value=".$item_upc.">&times;</button>
                                                            </form>
                                                            </div>";
                                                            } else {
                                                            echo "<form id=adjustDownForm method='POST' action='includes/action.php'>
                                                                <input type=hidden id=item_to_adjust_d name=item_to_adjust_d value=".$item_upc.">
                                                                <input type=hidden id=quantityd name=quantityd value=".$item_qty.">
                                                                <button class='adjustDownBtn' uid=".$uid." qty=".$item_qty." id=".$item_upc." type='submit' name='adjustDownBtn'>-</button>
                                                            </form>";  
                                                            }
                                                            echo"<h5 id=resultQty-thumbnail>".$row['item_quantity']."</h5>
                                                            <form id=adjustUpForm method='POST' action='includes/action.php'>
                                                                <input type=hidden id=item_to_adjust_u name=item_to_adjust_u value=".$item_upc.">
                                                                <input type=hidden id=quantityu name=quantityu value=".$item_qty.">
                                                                <button class='adjustUpBtn' uid=".$uid." qty=".$item_qty." id=".$item_upc." type='submit' name='adjustUpBtn'>+</button>
                                                            </form>
                                                        </div>
                                                </div>";
                                            }   
                                        
                                    } else {
                                        echo "<br>
                                            <h4 id='listMessege'>Items in your grocery list will appear here. Start adding some items to your list!</h4>
                                            <br>";
                                    }
                                        echo "</div>";
                                }
                                
                                ?>


                                </div>
                                <!-- widget end -->
                            </aside>
                        </div>
                        <!-- right content end -->
                    </div>
                    
                    <!-- Right Area -->
                        
                </div>
                
                   
                
                
            </div>
        </section>
        <!-- section -->
<?php 

// --------------------------------------------- 

?>

<!-- Footer Start/End/JS -->
<?php include 'includes/footer_inc.php'?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap.min.css">
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap.min.js"></script>



<script>
    function changeThis(id) {
        //console.log(id);
      var cname=document.getElementById(id).className;
      var ab=document.getElementById(id+"_hidden").value;
      //document.getElementById(cname+"rating").innerHTML=ab;
      document.getElementById("phprating").value =ab;
      console.log(ab);

      for(var i=ab;i>=1;i--)
      {
         document.getElementById(cname+i).src="img/star2.png";
      }
      var id=parseInt(ab)+1;
      for(var j=id;j<=5;j++)
      {
         document.getElementById(cname+j).src="img/star1.png";
      }
    }
    $('#mytest').click(function (e) { 
     e.preventDefault();
     //console.log("hello");
     //alert("hello");
        $.confirm({
        title: 'Rate It!',
        content: '<form method="post" action="">' +
                    '<div class="form-group"> ' +
                    '<div class="divRating" >' +
                        '<input type="hidden" id="php1_hidden" value="1">' +
                        '<img src="img/star1.png" onmouseover="changeThis(this.id);" id="php1" class="php">' +
                        '<input type="hidden" id="php2_hidden" value="2">' +
                        '<img src="img/star1.png" onmouseover="changeThis(this.id);" id="php2" class="php">' +
                        '<input type="hidden" id="php3_hidden" value="3">' +
                        '<img src="img/star1.png" onmouseover="changeThis(this.id);" id="php3" class="php">' +
                        '<input type="hidden" id="php4_hidden" value="4">' +
                        '<img src="img/star1.png" onmouseover="changeThis(this.id);" id="php4" class="php">' +
                        '<input type="hidden" id="php5_hidden" value="5">' +
                        '<img  src="img/star1.png" onmouseover="changeThis(this.id);" id="php5" class="php">' +
                    '</div>' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="pwd">Your Review About Recipe:</label>' +
                    '<textarea class="form-control" id="review" name="review" rows="3" maxlength="100"></textarea>' +
                    '<div style="font-size:9px;">Max <span id="txtleft" style="font-size:11px; color:red; margin:0px; padding:0px;white-space: nowrap !important;display: inline-block;">150</span> Characters Limit. </div>' +
                    '<input type="hidden" name="phprating" id="phprating" value="" >' +
                    '<input type="hidden" name="upc" id="upc" value="<?php echo $_GET["rid"]; ?>">' +
                    '<input type="hidden" name="uid" id="uid" value="<?php echo $_SESSION['u_id']; ?>">' +
                    '<input type="hidden" name="isrecipe" id="isrecipe" value="1">' +
                    '</div>' +
                    '' +
                    '<div id="ratresult" class="alert alert-success pull-right" style="padding:3px; margin:3px; font-size:10px; display:none;"></div>' +
                '</form>',
                
        buttons: {
            formSubmit: {
                text: 'Submit',
                btnClass: 'btn-blue',
                action: function () {
                    var upc = $('#upc').val();
                    var isrecipe = $('#isrecipe').val();
                    var uid = $('#uid').val();
                    var review = $('#review').val(); 
                    var phprating = $('#phprating').val(); 
                    console.log(upc +' | '+uid+' | '+phprating);
                    $.ajax({
                        url: 'includes/action.php',
                        method: 'POST',
                        data: {
                        'review': review,
                        'upc': upc,
                        'isrecipe': isrecipe,
                        'uid': uid,
                        'prorating': phprating
                        },
                        success: function (response) {
                        console.log(response);
                        if ( response == "true") {
                            $("#ratresult").html("Rating Successfully Submited!");
                            $("#ratresult").fadeIn();
                            setTimeout(function() {
                            //$("#successMessage").hide('blind', {}, 500)
                            location.reload(true);
                        }, 3000);
                            return false;
                        }
                        $("#ratresult").html(response);
                        $("#ratresult").fadeIn();
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
            cancel: function () {
                //close
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
     
 });

 
    $(document).ready(function () {
        console.log(window.upc);
    $('#recipe_rating_table').DataTable({
    "autoWidth": false,
    "bSort": false,
    "destroy": true,
    "responsive": true,
    "pagingType": "simple_numbers",
    "bLengthChange": false,
    "pageLength": 10,
    "dom": '<"pull-right"tf><"pull-right"ti><"pull-right"l>tp',
    "bInfo": true,
    "searching": false,
    "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
    "lengthMenu": true,
    "ajax": "includes/action.php?review_upc="+window.upc,
    "columns": [
        { "width": "10%" },
        { "width": "15%" },
        { "width": "10%" },
        { "width": "55%" }
    ]
    
    });
    $.fn.dataTable.ext.errMode = function (settings, helpPage, message) {
    };

    $("#creatorid").click(function() {
        $('html,body').animate({
            scrollTop: $("#creatorarea").offset().top - 500},
            'slowest');
    });
 
    });

    function clickmee(chuk, chak){
        $('#champakalibtn').prop('disabled', true);

        $.ajax({
            url: 'includes/action.php',
            method: 'POST',
            data: {
            'rec_rid': chuk,
            'rec_uid': chak
            },
            success: function (response) {
            console.log(response);

            $("#step_2_now").fadeOut(100);
            if ( response == "true") {
                $('#adlistResult').html("All Ingredients Successfully added into your Shopping List!");
                $("#adlistResult").fadeTo(2000, 500).slideUp();
                
                return false;
            } else {
                alert(response);
            }
            return false;

            //location.reload(true);
            }
        });

       

        $('.progress-bar').animate(
            {width:'100%'}, 
            {duration:3000}      
        );
        //$('.progress-bar').html("Processing Now...");
        //wait(3000);  //7 seconds in milliseconds
        //$('.progress-bar').html("Processed All Ingredients Successfully.....").fadeIn();
    }
    function wait(ms){
        var start = new Date().getTime();
        var end = start;
        while(end < start + ms) {
            end = new Date().getTime();
        }
    }
</script>
<style>
    /* .carousel-control .icon-prev, 
.carousel-control .icon-next {
    font-size: 100px;
} */
.glyphicon-chevron-right, .glyphicon-chevron-left {
    font-size: 10px !important;
}

.carousel-control.left {
    background-image: linear-gradient(to right,rgba(0,0,0,0) 0,rgba(0,0,0,0) 100%);
}
.carousel-control.right {
    background-image: linear-gradient(to right,rgba(0,0,0,0) 0,rgba(0,0,0,0) 100%);
}
.carousel-control {
    color: black;
}

.carousel-control:focus, .carousel-control:hover {
    color: black;
}

h5 {
        text-transform: uppercase; margin: 0; position: absolute; top: 50%; -ms-transform: translateY(-50%); transform: translateY(-50%); 
        
    }
    .progress-bar { 
    height:30px;
    background:#449D44; 
    width:0px;
    text-align:center;
    border: 1px solid gray;
    color: #232323;
    align: center;
}

.pp{
  height:30px;
  width : 100%;
  background-color: #efefef;
  border: 1px solid gray;
}
</style>
</html>