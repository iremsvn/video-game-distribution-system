<?php
@ob_start();
session_start();
include("config.php");


if(php_sapi_name() == 'cli'){$xxx = $_SERVER["SHELL"];}
else{$xxx = $_SERVER["REQUEST_METHOD"];}

$_SESSION['selected_level_num'] = "";

//to select a game
if($xxx == "POST") {
	if (isset($_POST['level_num'])) {
		$_SESSION['selected_level_num'] = $_POST['level_num'];
	
		echo "<script LANGUAGE='JavaScript'>
            window.location.href = 'seeAchievements.php'; 
        </script>";
    } 
	elseif (isset($_POST['add_ach'])) {
		$_SESSION['selected_level_num'] = $_POST['add_ach'];
	
		echo "<script LANGUAGE='JavaScript'>
            window.location.href = 'addAchievement.php'; 
        </script>";
    } 
	
}

  
/*
//to delete
if($xxx == "POST") {
    $given_aid = $_POST['given_aid'];
    $customer_id = $_SESSION['cid'];

    $result = mysqli_query($db,"DELETE FROM owns WHERE cid ='$customer_id' AND aid='$given_aid'");

    if (!$result) {
        printf("Error: %s\n", mysqli_error($db));
        exit();
    }else{
        echo "<script LANGUAGE='JavaScript'>
            window.alert('Successfully deleted.');
            window.location.href = 'welcome.php'; 
        </script>";
    }

}
*/

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
                <li id="upButton" class="nav-item">
                    <a href="addLevel.php" class="button">Add Level</a>
                </li>
				<li id="upButton" class="nav-item">
                    <a href="allLevels.php" class="button">See All Levels</a>
                </li>
            </ul>
        </div>
</nav>
   
		<br><br>
        <h3 id="myHeader" class="page-header" style="font-weight: bold;" >Added Levels</h3>
		<br><br>
        <?php
		$admin_id = $_SESSION['admin_id'];
        //echo "<p><b></b> " . $user_id  . "</p>";
        //$result = mysqli_query($db, "SELECT game_name, genre, price FROM game NATURAL JOIN owns NATURAL JOIN account WHERE cid = '$customer_id'");
		
       $result = mysqli_query($db, "SELECT level_num, level_reward FROM level WHERE admin_id = '$admin_id'");

        if (!$result) {
            printf("Error: %s\n", mysqli_error($db));
            exit();
        }

        echo "<table class=\"table table-lg table-striped\">
            <tr>
            <th>Level Number</th>
            <th>Completion Reward</th>
            <th>See Achievements</th>
			<th>Add Achievement</th>
            </tr>";

        while($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['level_num'] . "</td>";
            echo "<td>" . $row['level_reward'] . "</td>";
            echo "<td> <form action=\"\" METHOD=\"POST\">
                    <button type=\"submit\" name = \"level_num\"class=\"btn btn-danger btn-sm\" value =".$row['level_num'] .">See</button>
                    </form>
                     
                  </td>";
			echo "<td> <form action=\"\" METHOD=\"POST\">
                    <button type=\"submit\" name = \"add_ach\"class=\"btn btn-danger btn-sm\" value =".$row['level_num'] .">Add</button>
                    </form>
                     
                  </td>";
            echo "</tr>";
        }

        echo "</table>";
        ?>
		
	</body>
</html>