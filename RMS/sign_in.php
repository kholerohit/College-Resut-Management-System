<?php require_once("include/db.php"); ?>
<?php require_once("include/session.php"); ?>
<?php require_once("include/function.php"); ?>

<?php
	if(isset($_POST["submit"]))
	{
		// $category=$_POST["category"];
		$username = mysqli_real_escape_string($conn,$_POST["username"]);
		$password = mysqli_real_escape_string($conn,$_POST["password"]);

		if(empty($username) || empty($password))
		{
			// echo "it's empty";
			$_SESSION["ErrorMessage"]="All fields must be filled out";
			header("Location:sign_in.php");
			exit;
		}
		elseif(strlen($username)<3 || strlen($username)>20 || strlen($password)<8 || strlen($password)>20)
		{
			// echo "it's empty";
			$_SESSION["ErrorMessage"]="Invalid username/password";
			header("Location:sign_in.php");
			exit;
		}
		else
		{
			$login_success = login_student($username, $password);
			// function call
			$_SESSION["PRN"] = $login_success["PRN"];
			$_SESSION["name"] = $login_success["name"];
			$_SESSION["email"] = $login_success["email"];
			$_SESSION["mo_no"] = $login_success["mo_no"];
			$_SESSION["stream"] = $login_success["stream"];
			$_SESSION["year"] = $login_success["year"];
			$_SESSION["addrs"] = $login_success["addrs"];
			$_SESSION["image"] = $login_success["photo"];

			if($login_success)
			{
				$_SESSION["SuccessMessage"] = "Welcome ".ucwords($_SESSION["SName"]).'...!';
				header("Location:student.php");
				exit;
			}
			else
			{
				$_SESSION["ErrorMessage"] = "Invalid username/Password";
				header("Location:sign_in.php");
				exit;
			}
		}

	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="Css/bootstrap.min.css">
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="Css/public.css">
</head>
<style type="text/css">
body{
	background-color: ;
	/*background-image: url("image/");*/
}
</style>
<body>

 <!-- Navbar starting -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="loginteacher.php">Login to college Portal</a>
</nav>
<!-- navbar ended -->

<div class="container-fluid">

	<div class="row">
		<div class="col-sm-4">
		</div>

		<div class="col-sm-4">
			<br><br><br><br>
			<h1 >Welcome...!</h1>

				<?php
					echo Message();
					echo SuccessMessage();
		    ?>

			<div>
				<form action="sign_in.php" method="POST">
					<fieldset>
					<div class="form-group">
						<label class="fieldinform" for="username">Username:</label>
						<input class="form-control" type="text" name="username" id="username" placeholder="username">
					</div>
					<div class="form-group">
						<label class="fieldinform" for="password">Password</label>
						<input class="form-control" type="password" name="password" id="password" placeholder="password">
					</div><br>
					<input class="btn btn-success btn-block" type="submit" name="submit" value="Login">
					</fieldset>
				</form>
			</div>

		</div> <!-- ending of main area -->

 	</div><!-- ending of main row -->
</div><!-- ending of main container -->

</div>
</html>
