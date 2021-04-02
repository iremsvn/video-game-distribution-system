<?php
@ob_start();
session_start();
include("config.php");

if(php_sapi_name() == 'cli'){$xxx = $_SERVER["SHELL"];}
else{$xxx = $_SERVER["REQUEST_METHOD"];}

if($xxx == "POST"){	
	if (isset($_POST['btnConfirmType'])) {
		
				$email = $_SESSION['email_new'];
                $username = $_SESSION['username_new'];
				$name = $_SESSION['name_new'];
                $surname = $_SESSION['surname_new'] ;
				$password = $_SESSION['password_new'];
                $address = $_SESSION['address_new'];
				$age = $_SESSION['age_new'];
				$result = mysqli_query($db, "INSERT INTO account (email, username, name, balance, surname, password, address, age) VALUES ('$email', '$username', '$name', '0', '$surname' , '$password' , '$address' , '$age')");
				if (!$result) {
					printf("Error: %s\n", mysqli_error($db));
					exit();
					//header("location: index.php");
				}
				$result2 = mysqli_query($db, "INSERT INTO user (points, num_friends, email) VALUES ('0', '0', '$email')");
				if (!$result2) {
					printf("Error: %s\n", mysqli_error($db));
					exit();
					//header("location: index.php");
				}
				
				header("location: index.php");
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
			font: 25px Times New Roman, sans-serif;
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
			<br><br>
			<h3 id="myHeader" class="page-header" style="font-weight: bold;" >Confirm To Create Your Account as Player Account</h3>
			<h3 id="myHeader" class="page-header" style="font-weight: bold;" >After Confirming You Can Login the System</h3>
			<h3 id="myHeader" class="page-header" style="font-weight: bold;" >Have Fun!</h3>
			<br><br>
            <form id="logining" action="" method="post">
                <div>
					<p><input type="submit" class="myButton" name="btnConfirmType" value="Confirm"> </input></p>
				</div>
            </form>
        </div>
    </div>
</div>


</body>
</html>