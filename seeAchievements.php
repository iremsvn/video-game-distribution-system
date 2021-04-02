<?php
@ob_start();
session_start();
include("config.php");


if(php_sapi_name() == 'cli'){$xxx = $_SERVER["SHELL"];}
else{$xxx = $_SERVER["REQUEST_METHOD"];}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Accounts</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style type="text/css">
        body{ font: 20px Times New Roman, sans-serif; text-align: center; color:white; }
		#one { text-align: center; margin-bottom: 10px; }
        #two { display: inline-block; }
        p { margin-bottom: 10px;}
        th, td { padding: 5px; text-align: left; }
		#mainHeader {
			color: blueviolet;
			font: 32px Times New Roman, sans-serif;
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
                    <a href="welcomeAdmin.php" class="nav-link">Back</a>
                </li>
				<li class="nav-item">
                    <a href="index.php" class="nav-link">Logout</a>
                </li>
            </ul>
        </div>
        
   </nav>



<nav class="navbar navbar-expand-md">

	<?php
		//$user_id = $_SESSION['user_id'];
		$email = $_SESSION['email'];
		$resultAccountData = mysqli_query($db, "SELECT username FROM account WHERE email = '$email'");
		//$resultUserData = mysqli_query($db, "SELECT num_friends FROM user WHERE user_id = '$user_id'");
		$username = mysqli_fetch_array($resultAccountData)['username'];
		echo "<p>Welcome,&nbsp;&nbsp;" . $username  . "</p>";
	?>
        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
            <ul class="navbar-nav ml-auto">
             
            </ul>
        </div>
</nav>


		<br><br>
        <h3 id="myHeader" class="page-header" style="font-weight: bold;" >Achievements</h3>
	
        <?php
		
		$level_num = $_SESSION['selected_level_num'];
		echo "<td>Level:&nbsp" . $level_num . "</td>";
		echo "<br><br>";
        $result = mysqli_query($db, "SELECT ach_name, ach_reward, ach_description FROM achievement WHERE level_num = '$level_num'");

        if (!$result) {
            printf("Error: %s\n", mysqli_error($db));
            exit();
        }

        echo "<table class=\"table table-lg table-striped\">
            <tr>
            <th>Name</th>
			<th>Reward</th>
			<th>Description</th>
            </tr>";

        while($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['ach_name'] . "</td>";
            echo "<td>" . $row['ach_reward'] . "</td>";
			echo "<td>" . $row['ach_description'] . "</td>";
      
        }		

        echo "</table>";
		
        ?>
		
	</body>
</html>