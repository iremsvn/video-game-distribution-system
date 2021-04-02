<?php
@ob_start();
session_start();
include("config.php");


$email = "";
$password = "";

if(php_sapi_name() == 'cli'){$xxx = $_SERVER["SHELL"];}
else{$xxx = $_SERVER["REQUEST_METHOD"];}
	

if($xxx == "POST"){
    $email = $_POST['email'];
	$username = $_POST['username'];
    $name = $_POST['name'];
	$surname = $_POST['surname'];
    $password = $_POST['password'];
	$address = $_POST['address'];
    $age = $_POST['age'];

    if($stmt = mysqli_prepare($db, "SELECT email FROM account WHERE email = ?")){
        mysqli_stmt_bind_param($stmt, "s", $entered_email);

        $entered_email = $email;

        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt) == 1){
                echo "<script type='text/javascript'>alert('This email is already registered!');</script>";
            }else{
                $_SESSION['email_new'] = $email;
                $_SESSION['username_new'] = $username;
				$_SESSION['name_new'] = $name;
                $_SESSION['surname_new'] = $surname;
				$_SESSION['password_new'] = $password;
                $_SESSION['address_new'] = $address;
				$_SESSION['age_new'] = $age;
				header("location: type.php");
            }

        }
    }

    mysqli_stmt_close($stmt);

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
			<h3 id="myHeader" class="page-header" style="font-weight: bold;" >Sign Up</h3>
			<br><br>
            <form id="logining" action="" method="post">
                <div class="form-group">
                    <input type="email" name="email" class="form-control" id="email" placeholder="email">

                </div>
                <div class="form-group">
                    <input type="username" name="username" class="form-control" id="username" placeholder="username">

                </div>
				<div class="form-group">
                    <input type="name" name="name" class="form-control" id="name" placeholder="name">

                </div>
				<div class="form-group">
                    <input type="surname" name="surname" class="form-control" id="surname" placeholder="surname">

                </div>
				<div class="form-group">
                    <input type="age" name="age" class="form-control" id="age" placeholder="age">

                </div>
				<div class="form-group">
                    <input type="address" name="address" class="form-control" id="address" placeholder="address">

                </div>
				<div class="form-group">
                    <input type="password" name="password" class="form-control" id="password" placeholder="password">
                </div>
				<br><br>
				
				<div>
					<p><a onclick="checkEmpty()" class="myButton">Create</a></p>
				</div>
				
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
function checkEmpty() {
		var emailVal = document.getElementById("email").value;
        var usernameVal = document.getElementById("username").value;
		var nameVal = document.getElementById("name").value;
		var surVal = document.getElementById("surname").value;
		var ageVal = document.getElementById("age").value;
		var addVal = document.getElementById("address").value;
		var passVal = document.getElementById("password").value;
        if (usernameVal === "" || emailVal === "" || nameVal === "" || surVal === "" || ageVal === "" || addVal === "" || passVal === "") {
            alert("Fill all fields!");
        }
        else {
            var form = document.getElementById("logining").submit();
        }
    }
</script>
</body>
</html>