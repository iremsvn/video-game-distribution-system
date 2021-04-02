<?php
@ob_start();
session_start();
include("config.php");


$level_num = "";
$level_reward = "";

if(php_sapi_name() == 'cli'){$xxx = $_SERVER["SHELL"];}
else{$xxx = $_SERVER["REQUEST_METHOD"];}
	

if($xxx == "POST"){
	
	if($_POST['ach_reward'] < 0){
		echo "<script type='text/javascript'>alert('Invalid reward point!');</script>";
	}
	else{
		$level_num = $_SESSION['selected_level_num'];
		$ach_name = $_POST['ach_name'];
		$ach_description = $_POST['ach_description'];
		$ach_reward = $_POST['ach_reward'];
		

		if($stmt = mysqli_prepare($db, "SELECT ach_name FROM achievement WHERE ach_name = ?")){
			mysqli_stmt_bind_param($stmt, "s", $entered_ach);

			$entered_ach = $ach_name;

			if(mysqli_stmt_execute($stmt)){
				mysqli_stmt_store_result($stmt);
				if(mysqli_stmt_num_rows($stmt) == 1){
					echo "<script type='text/javascript'>alert('This achievement name already exists!');</script>";
				}else{
					$admin_id = $_SESSION['admin_id'];
					$resultAdd = mysqli_query($db, "INSERT INTO achievement (ach_name, ach_description, ach_reward, level_num) VALUES ('$ach_name', '$ach_description', '$ach_reward', '$level_num')");
					if (!$resultAdd) {
						printf("Error: %s\n", mysqli_error($db));
						exit();
						//header("location: index.php");
					}
					
					echo "<script type='text/javascript'>alert('Achievement added to the level.');</script>";
				}

			}
		}

		mysqli_stmt_close($stmt);
	}

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Level</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style type="text/css">
		body{ font: 20px Times New Roman, sans-serif; text-align: center; color:white; }
        #one { text-align: center; margin-bottom: 10px; }
        #two { display: inline-block; }
		
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
                    <a href="welcomeAdmin.php" class="nav-link">Back</a>
                </li>
				<li class="nav-item">
                    <a href="index.php" class="nav-link">Logout</a>
                </li>
            </ul>
        </div>

   </nav>
    <div id="one">
	<p><a></a></p>
        <div id="two">
		<br><br>
		<br><br>
			<h3 id="myHeader" class="page-header" style="font-weight: bold;" >Add New Achievement</h3>
			
			
			 <?php
				$level_num = $_SESSION['selected_level_num'];
				echo "<td>Level:&nbsp" . $level_num . "</td>";
			?>
			<br><br>
            <form id="logining" action="" method="post">
                <div class="form-group">
                    <input type="ach_name" name="ach_name" class="form-control" id="ach_name" placeholder="name">

                </div>
				
				<div class="form-group">
                    <input type="ach_description" name="ach_description" class="form-control" id="ach_description" placeholder="description">

                </div>
				
                <div class="form-group">
                    <input type="ach_reward" name="ach_reward" class="form-control" id="ach_reward" placeholder="reward points">

                </div>
	
				<br><br>
				
				<div>
					<p><a onclick="checkEmpty()" class="myButton">Add</a></p>
				</div>
				
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
function checkEmpty() {
		var nameVal = document.getElementById("ach_name").value;
        var rewardVal = document.getElementById("ach_reward").value;
		var desVal = document.getElementById("ach_description").value;
        if (nameVal === "" || rewardVal === "" || desVal === "") {
            alert("Fill all fields!");
        }
        else {
            var form = document.getElementById("logining").submit();
        }
    }
</script>
</body>
</html>