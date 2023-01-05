<?php  
//session_start();
error_reporting(1);
    //include_once 'includes/dbh.inc.php';


    // $locuser_ip = getenv('REMOTE_ADDR');
    // $locgeo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$locuser_ip"));
    // $loccountry = $locgeo["geoplugin_countryName"];
    // $locstate = $locgeo["geoplugin_regionName"];
    // $loccity = $locgeo["geoplugin_city"]; 
    //echo $city;   


$extension = "ffmpeg";
$extension_soname = $extension . "." . PHP_SHLIB_SUFFIX;
$extension_fullname = PHP_EXTENSION_DIR . "/" . $extension_soname;

// load extension
if(!extension_loaded($extension)) {
    dl($extension_soname) or die("Can't load extension $extension_fullname\n");
}

?>
