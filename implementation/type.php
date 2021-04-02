<?php
@ob_start();
session_start();
include("config.php");


if(php_sapi_name() == 'cli'){$xxx = $_SERVER["SHELL"];}
else{$xxx = $_SERVER["REQUEST_METHOD"];}
	
$_SESSION['type'] = "";

if($xxx == "POST"){
	
	if (isset($_POST['btnPlayer'])) {
		$_SESSION['type'] = "Player";
        header("location: playerSignUp.php");
    } elseif (isset($_POST['btnCurator'])) {
		$_SESSION['type'] = "Curator";
		header("location: curatorSignUp.php");
    } elseif (isset($_POST['btnPublisher'])) {
		$_SESSION['type'] = "Publisher";
		header("location: publisherSignUp.php");
    } elseif (isset($_POST['btnDeveloper'])) {
		$_SESSION['type'] = "signup";
		header("location: developerSignUp.php");
    }	
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        #one { text-align: center; margin-bottom: 10px; }
        #two { display: inline-block; }
		body{ font: 20px Times New Roman, sans-serif; text-align: center; color:white; }
        p { margin-bottom: 10px;}
        th, td { padding: 5px; text-align: left; }
		#mainHeader {
			color: blueviolet;
			font: 35px Times New Roman, sans-serif;
			text-align: left;
			margin-left: -20px;
		}
		#myHeader {
			color: blueviolet;
			font: 30px Times New Roman, sans-serif;
		}
		
		#upButton {
			font: 20px Times New Roman, sans-serif;
			margin-top: -20px;
			padding: 6px;
			
		}
		.button {
			color: blueviolet;
			}
			
			.filter {
			text-align: right;
			margin-top: 10px;
			margin-right: 20px;
			color: white;
			}
			
		.myButton {
			background:linear-gradient(to bottom, #802bc2 5%, #0e77cc 100%);
			background-color:#802bc2;
			border-radius:38px;
			display:inline-block;
			cursor:pointer;
			color:#ffffff;
			font-family:Times New Roman;
			font-size:18px;
			font-weight: bold;
			padding:10px 15px;
			text-decoration:none;
			color: black;
		}
		.myButton:hover {
			background:linear-gradient(to bottom, #2a98bd 5%, #802bc2 100%);
			background-color:#2a98bd;
		}
		.myButton:active {
			position:relative;
			top:1px;
		}
    </style>
</head>
<body style="background-color:black">
<div class="container">
    <nav class="navbar navbar-expand-md">
        <h5 id="mainHeader" class="navbar-text">~VGDS~ </h5>
        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="index.php" class="nav-link">Back</a>
                </li>
            </ul>
        </div>

   </nav>
    <div id="one">
	<p><a></a></p>
        <div id="two">
            <br><br>
			<h3 id="myHeader" class="page-header" style="font-weight: bold;" >Select Account Type</h3>
			<br><br>
            <form id="logining" action="" method="post">
				
				<div>
					<p><input type="submit" class="myButton" name="btnPlayer" value="Player"> </input></p>
				</div>
				<br><br>
				<div>
					<p><input type="submit" class="myButton" name="btnCurator" value="Curator"> </input></p>
				</div>
				<br><br>
				<div>
					<p><input type="submit" class="myButton" name="btnDeveloper" value="Developer"> </input></p>
				</div>
				<br><br>
				<div>
					<p><input type="submit" class="myButton" name="btnPublisher" value="Publisher"> </input></p>
				</div>
				
				<br><br>
				
            </form>
        </div>
    </div>
</div>



</body>
</html>