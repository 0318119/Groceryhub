
<!DOCTYPE html>
<html lang="en">

<?php 

error_reporting( 0 );
include_once 'includes/dbh.inc.php';
include 'includes/header_inc.php'; 

$sql = "SELECT * FROM users WHERE user_uid='".$_SESSION['u_id']."' OR user_email='".$_SESSION['u_email']."'";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);

?>


        <section class="whitepage">
            <div class="container-fluid">
                <div class="row">
                    <!-- <div class="no-gutter"> -->
                    <div id="topbar" style=";">
                        <div class="content-crumb-div" >
                                <a class="fileTrail" href="index.php">Home</a>   
                                <i style="font-size: 1rem;" class="fa fa-arrow-right"></i> 
                                My Account!
                                
                        </div>
                    </div>
                    <!-- </div> -->
                </div>
                <div class="row">
                    <div class="no-gutter">


                        <!-- content left -->
                        <div class="col-md-6 onStep" data-animation="fadeInLeft" data-time="0" style="height: 100% !important;">

                            <div class="col-md-12 col-xs-12">
                                <!-- spacer -->
                                <div class="space-half"></div>
                                <!-- <div class="space-double hidden-sm hidden-xs"></div> -->
                                <!-- spacer end -->
                                <!-- <div class="subtitle">
                                    <h5 style="color:#333; ">Image Gallery Section</h5>
                                </div> -->
                                <div class="onStep center" data-animation="fadeInUp" data-time="300" style="padding-right:15px;">

                                    <!-- forgot password area -->
                                    <div >
                                    
                                    <h2 class="onStep" data-animation="fadeInRight" data-time="0">I'm Following</h2>
                                        <!-- <form method="post" action='includes/action.php'> -->
                                            <table class="table table-bordered table-hover">
                                    <?php 
                                    $sql4 = "SELECT a.*, b.* FROM `users_follow` AS a, `users` AS b WHERE a.`follower` = ".$row["user_id"]." AND a.following = b.user_id";
                                    $results4 = mysqli_query($conn, $sql4);
                                    $queryResult4 = mysqli_num_rows($results4);
                                    if ($queryResult4 > 0) {
                                        $numrows = 0;
                                        while ( $row4 = mysqli_fetch_array($results4) ) {
                                            $numrows++;
                                            echo '<tr>
                                                    <td>'.$numrows.'</td>
                                                    <td>'.$row4["user_first"].' '.$row4["user_last"].'</td>
                                                    <td><button id="delunfollow" class="btn btn-sm btn-warning" data-uid="'.$row4["id"].'">Un-Follow</button></td>
                                                    </tr>';
    
                                        }    
                                    } else {
                                        echo '<tr>
                                                    <td rowspan="3">You are not Following any user!</td>
                                                    </tr>';
                                    }
                                    
                                    
                                    ?>
                                    
                                            </table>
                                            
                                            
                                        <!-- </form> -->
                                    </div>
                                    <!-- forgot password area -->
                                </div>
                            </div>


                        </div>
                        <!-- content left end -->

                        <!-- content right -->
                        <div class="col-md-6" style="">

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

                                    <div class="onStep col-md-11" data-animation="fadeInUp" data-time="300" style="padding-left:15px;">
                                        <h2 class="onStep" data-animation="fadeInRight" data-time="0">My Profile!</h2>
                                        <div data-form-type="signup_form">

                                            <form method="post" id="signupUpdate" name="signupUpdate" action="" autocomplete="off">

                                                <div class="form-group">
                                                        <label for="rcate">My Prefered Diet! (Recipe Category)</label>
                                                        <select class="form-control form-control-lg" id="rcate" name="rcate" required="required" >
                                                            <option name="0" value="0">Select Any</option>
                                                            <?php 
                                                            $sqlcat = "SELECT * FROM categories WHERE isrecipe=1 ORDER BY cat_name ASC";

                                                            $resultcat = mysqli_query($conn, $sqlcat);
                                                            $queryResultcat = mysqli_num_rows($resultcat);

                                                            if($queryResultcat > 0) {
                                                                while($row22 = mysqli_fetch_array($resultcat)) {
                                                                    if ( $row22['cat_name'] == $row['rcate'] ) {
                                                                        echo '<option name="'.$row22['id'].'" value="'.$row22['cat_name'].'" selected="selected">'.$row22['cat_name'].' - '.$row22['isrecipe_desc'].'</option>';
                                                                    } else {
                                                                        echo '<option name="'.$row22['id'].'" value="'.$row22['cat_name'].'">'.$row22['cat_name'].' - '.$row22['isrecipe_desc'].'</option>';
                                                                    }
                                                                    
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                </div>
                                                <div class="form-group">
                                                        <label for="ralergy">My Allergies & Restrictions (optional)</label>
                                                        <?php 
                                                        $sqla = "SELECT * FROM recipe_allergies ORDER BY allergy_name ASC";

                                                        $resulta = mysqli_query($conn, $sqla);
                                                        $queryResulta = mysqli_num_rows($resulta);

                                                        if($queryResulta > 0) {
                                                            while($rowa = mysqli_fetch_array($resulta)) {
                                                                $HiddenProducts = explode(',',$row['ralergy']);
                                                                if (in_array($rowa['id'], $HiddenProducts)) {
                                                                    echo '
                                                                    <div class="custom-checkbox" style="margin-left:15px;">
                                                                        <div class="form-check">
                                                                            <label>
                                                                                <input type="checkbox" name="ralergy[]" value="'.$rowa['id'].'" checked> <span class="label-text">'.$rowa['allergy_name'].'</span>
                                                                            </label>
                                                                        </div>
                                                                        
                                                                    </div>';
                                                                } else {

                                                                echo '
                                                                <div class="custom-checkbox" style="margin-left:15px;">
                                                                    <div class="form-check">
                                                                        <label>
                                                                            <input type="checkbox" name="ralergy[]" value="'.$rowa['id'].'" > <span class="label-text">'.$rowa['allergy_name'].'</span>
                                                                        </label>
                                                                    </div>
                                                                    
                                                                </div>
                                                            
                                                                ';
                                                                }
                                                            }
                                                        }
                                                        
                                                        ?>
                                                </div>                                                
                                                <div class="form-group">
                                                    <label for="first_name">First Name (required, at least 2 characters)</label>
                                                    <input type="text" name="first_name" class="form-control btn-rounded" id="first_name" placeholder="First Name" value="<?php echo $row['user_first']; ?>" autocomplete="false" required>

                                                </div>

                                                <div class="form-group">
                                                    <label for="last_name">Last Name (required, at least 2 characters)</label>
                                                    <input type="text" name="last_name" required class="form-control btn-rounded" id="last_name" placeholder="Last Name" value="<?php echo $row['user_last']; ?>">

                                                </div>

                                                <div class="form-group">
                                                    <label for="last_name">State </label>
                                                    <select id="state" name="state" class="form-control signup-form-select" style="border-radius: 25px;" required>
                                                    <option name="" value="">State</option>
                                                    <?php
                                                    
                                                    $sql2 = "SELECT DISTINCT state_code FROM us_cities";
                                                    $result2 = mysqli_query($conn, $sql2);
                                                    //$resultCheck = mysqli_num_rows($result);
                                                    
                                                    while ($row2 = mysqli_fetch_assoc($result2)) {
                                                        if( $row2["state_code"] == $row['user_state'] ) {
                                                            echo '<option name="'.$row2["state_code"].'" value="'.$row2["state_code"].'" selected>'.$row2["state_code"].'</option>';
                                                        } else {
                                                            echo '<option name="'.$row2["state_code"].'" value="'.$row2["state_code"].'">'.$row2["state_code"].'</option>';
                                                        }
                                                        
                                                    }
                                                    
                                                    ?>
                                                   
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="last_name">City </label>
                                                    <input type="text" name="city" required class="form-control" id="city" placeholder="Enter Your City" value="<?php echo $row['user_city']; ?>">
                                                    <ul class="citySearchList">
                                                    </ul>
                                                </div>

                                                <div class="form-group">
                                                    <label for="email_book">Email Address (a.k.a. username cant be changed!)  </label>
                                                    <input type="email" name="email_book" required class="form-control btn-rounded" id="email_book" placeholder="Email Address" value="<?php echo $row['user_email']; ?>" disabled>
                                                    <input type="hidden" id="huid" value="<?php echo $row['user_id']; ?>">
                                                </div>  

                                                <!-- <div class="form-group">
                                                    <label for="last_name">Password </label>
                                                    <input type="password" name="password" required  class="form-control btn-rounded" id="password" placeholder="Password" autocomplete="off">
                                                </div>                                               -->

                                                <!-- <div class="form-group">
                                                    <label for="last_name">Confirm Password </label>
                                                    <input type="password" name="password2" required  class="form-control btn-rounded" id="password2" placeholder="Retype Password" autocomplete="off">

                                                </div> -->

                                                <div class="alert alert-danger" role="alert" id="formResult_error" style="display:none; margin-top:-5px !important;"></div>
                                                <div class="alert alert-success" role="alert" id="formResult_success" style="display:none; margin-top:-5px !important;"></div>

                                                <div class="form-group">
                                                    <button value="1" id="UpdatesignupForm" name="UpdatesignupForm" type="submit" class="btn btn-rounded btn-yellow btn-block" >Update</button>

                                                </div>

                                            </form>

                                        </div>
                                    </div>

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

<script>

$(document).on('click', '#delunfollow', function (e) {
  //e.preventDefault();
//console.log("hellooooooooo");
console.log( $('#delunfollow').attr("data-uid") );
var unfollowDEL = $('#delunfollow').attr("data-uid");

$.ajax({
      url: 'includes/action.php',
      type: 'post',
      data: { 
        'unfollowDEL': unfollowDEL
      },
      success: function (response) {
        var msg = "";
        if (response == "110") {
          msg = 'User have been updated!';
          location.reload();
          //$("#formResult_success").html(msg);
          //$('#formResult_success').fadeIn();
        } else {
          msg = response;//"Invalid username and password!";
          console.log(msg);
          //$("#formResult_register").html(msg);
          //$('#formResult_register').fadeIn();
        }
        
      }
    });

});

//----Account Update Area--------------------------------------
$(document).on('click', '#UpdatesignupForm', function (e) {
  e.preventDefault();
  
  console.log("Account Update Area!");
  
  var rcate = $( "#rcate option:selected" ).val(); //text()
  var ralergy = new Array();
      $('input[name="ralergy[]"]:checked').each(function(){
        ralergy.push($(this).val());
      });

  var first_name = $('#signupUpdate #first_name').val();
  var last_name = $('#signupUpdate #last_name').val();
  //var email_book = $('#signupUpdate #email_book').val();
  var state = $('#signupUpdate #state option:selected').val();
  var city = $('#signupUpdate #city').val();
  var huid = $('#signupUpdate #huid').val();
  //var username = $('#signupUpdate #email_book').val();
  //var password = $('#signupUpdate #password').val();
  //var password2 = $('#signupUpdate #password2').val();
  //var agreement_check = $('#agreement_check').val();

  //console.log(state);
  //console.log($('#state').children('option:selected').index());

  if (first_name.length < 3) {
    //$( "#first_name" ).after( "<b>Please enter a name 3 characters or more.</b>" );
    alert('Please enter a First Name 3 characters or more.');
    $('#first_name').focus();
    return false;
  } 
  //return;
  if (last_name.length < 3) {
    //$( "#first_name" ).after( "<b>Please enter a name 3 characters or more.</b>" );
    alert('Please enter a Last Name 3 characters or more.');
    $('#last_name').focus();
    return false;
  } 

//   emailReg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
//   if(!emailReg.test(email_book) || email_book == '') {
//      alert('Please enter a valid email address.');
//      $('#email_book').focus();
//      return false;
//   } else {
//     $('#signupFormNow #username').val($('#signupFormNow #username').val());
//   }

  if ($('#signupFormNow #state').children('option:selected').index() == 0) {
    //$( "#first_name" ).after( "<b>Please enter a name 3 characters or more.</b>" );
    alert('Please Choose any State.');
    $('#state').focus();
    return false;
  } 

  if (city.length < 3) {
    //$( "#first_name" ).after( "<b>Please enter a name 3 characters or more.</b>" );
    alert('Please enter a City.');
    $('#city').focus();
    return false;
  } 

//   if (password.length < 8) {
//     alert('Please enter a Password 8 characters or more.');
//     $('#signupFormNow #password').focus();
//     return false;
//   } 

//   if (password != password2) {
//     alert('Both Passwords are not equal');
//     $('#signupFormNow #password2').focus();
//     return false;
//   } 


    $.ajax({
      url: 'includes/signup.inc.php',
      type: 'post',
      data: { 
        'rcate': rcate,
        'ralergy': ralergy,
        'first_name': first_name, 
        'last_name': last_name,
        //'email_book': email_book,
        'state': state,
        'city': city,
        'huid': huid
        //'username': username,
        //'password': password 
      },
      success: function (response) {
        var msg = "";
        if (response == "1") {
          msg = 'User have been updated!';
          $("#formResult_success").html(msg);
          $('#formResult_success').fadeIn();
        } else {
          msg = response;//"Invalid username and password!";
          $("#formResult_register").html(msg);
          $('#formResult_register').fadeIn();
        }
        
      }
    });
});


//----END Account Update Area--------------------------------------

</script>

</html>