<?php require_once("include/db.php"); ?>
<?php require_once("include/session.php"); ?>

<?php

	function Redirect_to($new_site)
	{
		header("location:".$new_site);
		exit;
	}

	function login_admin($username, $password)
	{
		global $conn;
		$password = md5($password);
		$query = "SELECT * FROM registration WHERE username='$username' AND password='$password'" ;
		$execute = mysqli_query($conn,$query) or die('Error');
		if($admin=mysqli_fetch_assoc($execute))
		{
			return $admin;
		}
	}

	function login_student($username, $password)
	{
		global $conn;
		$query = "SELECT * FROM student_info WHERE PRN='$username' AND passwd='$password'" ;
		$execute = mysqli_query($conn,$query) or die('Error');
		if($admin=mysqli_fetch_assoc($execute))
		{
			return $admin;
		}
	}

	function login_required()
	{
		if(isset($_SESSION["user_id"]))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function login_requireds()
	{
		if(isset($_SESSION["PRN"]))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function login_confirm()
	{
		if(!login_required())
		{
			$_SESSION["ErrorMessage"] = "Login required...!";
			Redirect_to("loginn.php");
		}
	}

	function login_confirms()
	{
		if(!login_requireds())
		{
			$_SESSION["ErrorMessage"] = "Login required...!";
			Redirect_to("sign_in.php");
		}
	}

	function grade($total){
		$grade;
		if($total >= 80  and $total <= 100){
			$grade = 'A+';
		}elseif($total >=72 and $total < 80){
			$grade = 'A';
		}elseif($total >=62 and $total < 72){
			$grade = 'B+';
		}elseif($total >=55 and $total < 62){
			$grade = 'B';
		}elseif($total >=50 and $total < 55){
			$grade = 'C+';
		}elseif($total >=40 and $total < 50){
			$grade = 'C';
		}else{
			$grade = 'F';
		}
		return $grade;
	}
?>
