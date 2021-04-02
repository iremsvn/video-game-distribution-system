<?php
@ob_start();
session_start();
include("config.php");


if(php_sapi_name() == 'cli'){$xxx = $_SERVER["SHELL"];}
else{$xxx = $_SERVER["REQUEST_METHOD"];}

$selected_game_id = $_SESSION['selected_game_id'];

//to select a game
if($xxx == "POST") {
	
/*
	//echo "<p><b></b> " . $given_game_id  . "</p>";
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
*/

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Accounts</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style type="text/css">
        body{ font: 18px Times New Roman, sans-serif; text-align: center; color:white; }
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
                    <a href="welcomeUser.php" class="nav-link">Back</a>
                </li>
                <li class="nav-item">
                    <a href="logout.php" class="nav-link" >Logout</a>
                </li>
            </ul>
        </div>

   </nav>



<nav class="navbar navbar-expand-md">

	<?php
		$user_id = $_SESSION['user_id'];
		$email = $_SESSION['email'];
		$resultAccountData = mysqli_query($db, "SELECT username FROM account WHERE email = '$email'");
		$resultUserData = mysqli_query($db, "SELECT num_friends FROM user WHERE user_id = '$user_id'");
		$username = mysqli_fetch_array($resultAccountData)['username'];
		echo "<p>Welcome,&nbsp;&nbsp;" . $username  . "</p>";
	?>

</nav>
   

		<br><br>
	
        <?php
		$result = mysqli_query($db, "SELECT game_name, genre, game_version, price FROM game WHERE game_id = '$selected_game_id'");
        $result1 = mysqli_query($db, "SELECT game_release, requirements FROM game WHERE game_id = '$selected_game_id'");
		$result2 = mysqli_query($db, "SELECT game_description FROM game WHERE game_id = '$selected_game_id'");
		
        if (!$result) {
            printf("Error: %s\n", mysqli_error($db));
            exit();
        }


		echo "<table class=\"table table-lg table-striped\">
            <tr>
			<th>Game</th>
            <th>Genre</th>
            <th>Price</th>
            <th>Version</th>
            </tr>";

        while($row = mysqli_fetch_array($result)) {
            echo "<tr>";
			echo "<td>" . $row['game_name'] . "</td>";
            echo "<td>" . $row['genre'] . "</td>";
            echo "<td>" . $row['price'] . "</td>";
			echo "<td>" . $row['game_version'] . "</td>";
            echo "</tr>";
        }
		
		echo "<table class=\"table table-lg table-striped\">
            <tr>
            <th>Release Date</th>
            <th>Requirements</th>
            </tr>";

        while($row = mysqli_fetch_array($result1)) {
            echo "<tr>";
            echo "<td>" . $row['game_release'] . "</td>";
            echo "<td>" . $row['requirements'] . "</td>";
            echo "</tr>";
        }
		
		echo "<table class=\"table table-lg table-striped\">
            <tr>
            <th>Description</th>
            </tr>";

        while($row = mysqli_fetch_array($result2)) {
            echo "<tr>";
            echo "<td>" . $row['game_description'] . "</td>";
            echo "</tr>";
        }
		
        
		echo "</table>";
        ?>
		
		<form id="logining" action="" method="post">
			</div>
				<p>
					<input type="submit" class="btn btn-success" name="btnBuy" value="--Buy--"> &nbsp; &nbsp;</input>
					<input type="submit" class="btn btn-danger" name="btnBuy" value="See Mods"> </input>
				</p>
			</div>
		</form>
		
	</body>
</html>
