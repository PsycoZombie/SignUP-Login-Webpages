<?php
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/

//make sure to enter your mysql credentials and other details below
$host="";
$port="";
$socket="";
$user="";
$password="";
$dbname="";

$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());
$regno=htmlspecialchars($_POST['regno']);
$name=htmlspecialchars($_POST['name']);
$semester=htmlspecialchars($_POST['semester']);
$course=htmlspecialchars($_POST['course']);
$adm_year=htmlspecialchars($_POST['adm_year']);
$dob=htmlspecialchars($_POST['dob']);
$address=htmlspecialchars($_POST['address']);
$district=htmlspecialchars($_POST['district']);
$state=htmlspecialchars($_POST['state']);
$country=htmlspecialchars($_POST['country']);
$pincode=htmlspecialchars($_POST['pincode']);
$loginqr = "INSERT INTO studentslist (regno, name, semester, course, adm_year, dob, address, district, state, country, pincode) VALUES (" . $regno . ", \"" . $name . "\", \"" . $semester . "\", \"" . $course . "\", " . $adm_year . ", \"" . $dob . "\", \"" . $address . "\", \"" . $district . "\", \"" . $state . "\", \"" . $country . "\", " . $pincode . ");";
$statement = $con->prepare($loginqr);
try {
    if(!$statement->execute())
	;
} catch (mysqli_sql_exception $e) { //for register number check
    if($con->errno == 1062){
        $con->close();
        die("user already exists. please login");
    }
}
$con->close();
$username=htmlspecialchars($_POST['username']);
$password=htmlspecialchars($_POST['password']);
$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
$query="select sid from studentslist where regno=".$regno.";";
$sid="";
$doquerry=mysqli_query($con,$query);
while($final=mysqli_fetch_array($doquerry)){
    $sid=$final['sid'];
    $insert = "INSERT INTO auth (sid, username, password) VALUES (" . $sid . ",\"" . $username  . "\", \"" . hash('sha512',$password) . "\");";
    $stat=$con->prepare($insert);
	try {
    if(!$stat->execute())
	 $con->close();
    echo("Registration Successfull");
    echo('<p>Please <a href="login.html">login</a>.</p>');
    die("");
} catch (mysqli_sql_exception $e) { //for username check
    if($con->errno == 1062){
        $dltqry="delete from studentslist where regno=".$regno.";";
        $dltstat=$con->prepare($dltqry);
        $dltstat->execute();
        $con->close();
        die("username not available");
    }
}
    break;
}
$con->close();
?>
