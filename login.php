<?php
/*
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$username=$_POST['username'];
$password=$_POST['password'];
*/
echo"<br>";

//make sure to enter your mysql credentials and other informations below
$mysqlhost="";
$mysqlusr="";
$mysqlpass="";
$mysqldbname="";
$mysqlport="";
$mysqlsocket="";


$con=new mysqli($mysqlhost,$mysqlusr,$mysqlpass,$mysqldbname,$mysqlport,$mysqlsocket);
$query="select * from auth where username=\"".$username."\";";
$doquerry=mysqli_query($con,$query);
if(mysqli_num_rows($doquerry)==0)
die("user not registered");
while ($row=mysqli_fetch_array($doquerry)) {
    if(hash('sha512',$password)==$row['password']){
	$qy="select sid from auth where username=\"".$username."\";";
	$doqy=mysqli_query($con,$qy);
	$array=mysqli_fetch_array($doqy);
	$sid=$array['sid'];
	$qy="select * from studentslist where sid=\"".$sid."\";";
	$doqy=mysqli_query($con,$qy);
	echo ('<HTML>
		<head>	
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
	        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
		</head>
		<BODY class="bg-info">');
	$array=mysqli_fetch_array($doqy);
		echo'<p class="h1 text-center text-primary pt-5 pb-5" id="headingid"><strong>Student Details</strong></p>';
		echo "<div class='container'><table class='table table-bordered table-dark table-striped'>";
		echo"<tr><th>sid</th><td>".$array['sid']."</td></tr>";
		echo"<tr><th>regno</th><td>".$array['regno']."</td></tr>";
		echo"<tr><th>name</th><td>".$array['name']."</td></tr>";
		echo"<tr><th>semester</th><td>".$array['semester']."</td></tr>";
		echo"<tr><th>course</th><td>".$array['course']."</td></tr>";
		echo"<tr><th>year of admission</th><td>".$array['adm_year']."</td></tr>";
		echo"<tr><th>date of birth</th><td>".$array['dob']."</td></tr>";
		echo"<tr><th>address</th><td>".$array['address']."</td></tr>";
		echo"<tr><th>district</th><td>".$array['district']."</td></tr>";
		echo"<tr><th>state</th><td>".$array['state']."</td></tr>";
		echo"<tr><th>country</th><td>".$array['country']."</td></tr>";
		echo"<tr><th>pincode</th><td>".$array['pincode']."</td></tr>";
		echo"</table>";
	$con->close();
	echo('<p> New registration? <a href="newreg.html">Sign up here</a>.</p>');
	echo('</div></BODY></HTML>');
	die("");
    }
}
$con->close();
    die("wrong password");
?>
