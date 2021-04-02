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
    $password = $_POST['password'];

    if($stmt = mysqli_prepare($db, "SELECT email, password FROM account WHERE email = ? and password = ?")){
        mysqli_stmt_bind_param($stmt, "ss", $entered_email, $entered_password);

        $entered_email = $email;
        $entered_password = $password;

        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt) == 1){
                mysqli_stmt_bind_result($stmt, $email, $turned_pw);

                if(mysqli_stmt_fetch($stmt)){
                    if($turned_pw == $password){
						
						//User
						$resultUser = mysqli_query($db, "SELECT COUNT(*) AS cntUser FROM user WHERE email = '$email'");
						
						if (!$resultUser){
							printf("Error: %s\n", mysqli_error($db));
							exit();
						}
						
						$cntUser = mysqli_fetch_array($resultUser)['cntUser'];
						if($cntUser == 1){  // user
							session_start();
							$_SESSION['email'] = $email;
							$_SESSION['password'] = $password;
							$resultUserData = mysqli_query($db, "SELECT user_id FROM user WHERE email = '$email'");
							$_SESSION['user_id'] = mysqli_fetch_array($resultUserData)['user_id'];
							//echo "<p><b></b> " . $_SESSION['user_id']  . "</p>";
							header("location: welcomeUser.php");
						}
						
						
						
						//Curator
						$resultCur = mysqli_query($db, "SELECT COUNT(*) AS cntCur FROM curator WHERE email = '$email'");
						
						if (!$resultCur){
							printf("Error: %s\n", mysqli_error($db));
							exit();
						}
						
						
						$cntCur = mysqli_fetch_array($resultCur)['cntCur'];
						if($cntCur == 1){  
							session_start();
							$_SESSION['email'] = $email;
							$_SESSION['password'] = $password;
							$resultCurData = mysqli_query($db, "SELECT cur_id FROM curator WHERE email = '$email'");
							$_SESSION['cur_id'] = mysqli_fetch_array($resultCurData)['cur_id'];
							header("location: welcomeCurator.php");
						}
						
						
						
						
						//Publisher
						$resultPub = mysqli_query($db, "SELECT COUNT(*) AS cntPub FROM publisher WHERE email = '$email'");
						
						if (!$resultPub){
							printf("Error: %s\n", mysqli_error($db));
							exit();
						}
						
						
						$cntPub = mysqli_fetch_array($resultPub)['cntPub'];
						if($cntPub == 1){  
							session_start();
							$_SESSION['email'] = $email;
							$_SESSION['password'] = $password;
							$resultPubData = mysqli_query($db, "SELECT pub_id FROM publisher WHERE email = '$email'");
							$_SESSION['pub_id'] = mysqli_fetch_array($resultPubData)['pub_id'];
							header("location: welcomePublisher.php");
						}
						
						
						
						
						//Developer
						$resultDev = mysqli_query($db, "SELECT COUNT(*) AS cntDev FROM developer WHERE email = '$email'");
						
						if (!$resultDev){
							printf("Error: %s\n", mysqli_error($db));
							exit();
						}
						
						
						$cntDev = mysqli_fetch_array($resultDev)['cntDev'];
						if($cntDev == 1){  
							session_start();
							$_SESSION['email'] = $email;
							$_SESSION['password'] = $password;
							$resultDevData = mysqli_query($db, "SELECT dev_id FROM developer WHERE email = '$email'");
							$_SESSION['dev_id'] = mysqli_fetch_array($resultDevData)['dev_id'];
							header("location: welcomeDeveloper.php");
						}
						
						
						//Admin
						$resultAd = mysqli_query($db, "SELECT COUNT(*) AS cntAd FROM admin WHERE email = '$email'");
						
						if (!$resultAd){
							printf("Error: %s\n", mysqli_error($db));
							exit();
						}
						
						
						$cntAd = mysqli_fetch_array($resultAd)['cntAd'];
						if($cntAd == 1){  
							session_start();
							$_SESSION['email'] = $email;
							$_SESSION['password'] = $password;
							$resultAdData = mysqli_query($db, "SELECT admin_id FROM admin WHERE email = '$email'");
							$_SESSION['admin_id'] = mysqli_fetch_array($resultAdData)['admin_id'];
							header("location: welcomeAdmin.php");
						}
						
                    }
                }
            }else{
                echo "<script type='text/javascript'>alert('Invalid email or password entered.');</script>";
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
    <title>Sign In</title>
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
        <h5 id="mainHeader" class="navbar-text">~VGDS~</h5>
		<div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="signup.php" class="nav-link">Don't you have an account? Sign Up</a>
                </li>
            </ul>
        </div>
        </div>
    </nav>	
    <div id="one">
	<p><a></a></p>
        <div id="two">
            <br><br>
			<br><br>
            <h2 id="myHeader">Sign In</h2>
            <p></p>
			<br><br>
            <form id="logining" action="" method="post">
                <div class="form-group">
                    <input type="text" name="email" class="form-control" id="email" placeholder="e-mail">

                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" id="password" placeholder="password">

                </div>
				<br><br>
                <div class="form-group">
                    <input onclick="checkEmpty()" class="btn btn-success" value="Sign In">
                </div>
            </form>
        </div>
    </div>
</div>



<script type="text/javascript">
    function checkEmpty() {
        var emailVal = document.getElementById("email").value;
        var passwordVal = document.getElementById("password").value;
        if (emailVal === "" || passwordVal === "") {
            alert("Fill email and password.");
        }
        else {
            var form = document.getElementById("logining").submit();
        }
    }
</script>
</body>
</html>