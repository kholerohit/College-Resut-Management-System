<?php require_once("include/db.php"); ?>
<?php require_once("include/session.php"); ?>
<?php require_once("include/function.php"); ?>
<?php login_confirm() ;?>

<?php
	if(isset($_POST["submit"]))
	{
		$PRN = mysqli_real_escape_string($conn, $_POST["PRN"]);
    $passwd = mysqli_real_escape_string($conn, $_POST["email"]);
		$name = mysqli_real_escape_string($conn, $_POST["name"]);
		$mo_no = mysqli_real_escape_string($conn, $_POST["mo_no"]);
		$currentTime = time();
    $extra1 = "1";
    $extra2 = "2";
    $extra3 = "3 ";
    $admin_panel_id = 4;
		$dateTime = strftime("%d-%B-%Y : %H:%M:%S",$currentTime);
		$dateTime;
		$email = mysqli_real_escape_string($conn, $_POST["email"]);
    $stream = mysqli_real_escape_string($conn, $_POST["stream"]);
    $addrs = mysqli_real_escape_string($conn, $_POST["addrs"]);
    $year = mysqli_real_escape_string($conn, $_POST["year"]);
		$ImageName=$_FILES["Image"]["name"];
		$ImageTmpName=$_FILES["Image"]["tmp_name"];
		$ImageSize = $_FILES["Image"]["size"];
		$ImageError = $_FILES["Image"]["error"];
		$ImageType = $_FILES["Image"]["type"];
		$ImageExt = explode('.', $ImageName);
		$ImageActualExt = strtolower(end($ImageExt));

		$allowed = array('jpg','JPG','jpeg','JPEJ','png','PNG');

		if(empty($PRN) || empty($name) || empty($email))
		{
			// echo "it's empty";
			$_SESSION["ErrorMessage"]="All fields must be filled out";
			header("Location:addNewStudent.php");
			exit;
		}
		elseif(strlen($PRN)<6)
		{
			$_SESSION["ErrorMessage"]="PRN should atleast 6 digit long";
			header("Location:addNewStudent.php");
			exit;
		}
		else
		{
			global $conn;

			if(in_array($ImageActualExt, $allowed))
			{
				if ($ImageError === 0)
				{
					if ($ImageSize < 10000000)
					{

						$ImageNameNew = uniqid('',true).".".$ImageActualExt;
						$Target="upload/".$ImageNameNew;
            echo $PRN.$dateTime.$name.$mo_no.$email.$stream.$addrs.$year.$passwd.$ImageNameNew.$admin_panel_id.$extra1.$extra2.$extra3;
						$query = "  INSERT INTO `student_info` (`PRN`, `datetime`, `name`, `mo_no`, `email`, `stream`, `addrs`, `year`, `passwd`, `photo`, `admin_panel_id`, `extra1`, `extra2`, `extra3`)
            VALUES('$PRN', '$dateTime', '$name','$mo_no','$email','$stream','$addrs','$year', '$passwd','$ImageNameNew','$admin_panel_id', '$extra1','$extra2','$extra3')";
						$execute = mysqli_query($conn, $query) or die('Error0');
						move_uploaded_file($ImageTmpName,$Target);
						if($execute)
						{
							$_SESSION["SuccessMessage"] = " Bio has been added...";
							header("Location:dashboard.php");
							exit;
						}
						else
						{
							$_SESSION["ErrorMessage"] = "Post not inserted";
							header("Location:dashboard.php");
							exit;
						}
					}
					else
					{
						$_SESSION["ErrorMessage"]="Too Big filesize!";
						header("Location:addNewStudent.php");
						exit;
					}
				}
				else
				{
					$_SESSION["ErrorMessage"]="Error while uploading..!";
					header("Location:addNewStudent.php");
					exit;
				}

			}
			else
			{
				$_SESSION["ErrorMessage"]="file format not supported..!";
				header("Location:addNewStudent.php");
				exit;
			}

		}

	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Add New Post</title>
  <link rel="stylesheet" type="text/css" href="Css/bootstrap.min.css">
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="Css/public.css">
  <link rel="stylesheet" type="text/css" href="Css/dashboardstyle.css">

</head>
<body>

	<!-- Navbar starting -->
	<!-- Navbar starting -->
	<div class="container">
	  <nav class="navbar navbar-expand-lg nav-item fixed-top navbar-dark bg-dark">
	    <span class="navbar-brand brand">MY College</span>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls=" navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	       <span class="navbar-toggler-icon"></span>
	      </button>

	      <div class="collapse navbar-collapse" id="navbarSupportedContent">
	       <ul class="navbar-nav mr-auto">
	         <li class="nav-item active">
	           <a class="nav-link" href="Blog.php">User Profile<span class="sr-only">(current)</span></a>
	         </li>
	         <li class="nav-item">
	           <a class="nav-link" href="squadfree/index.html">Result</a>
	         </li>
	           <li class="nav-item">
	           <a class="nav-link" href="squadfree/index.html">Edit Profile</a>
	         </li>
	       </ul>
	       <form action="Blog.php" class="form-inline my-2 my-lg-0">
	         <input class="form-control mr-sm-2" type="search" placeholder="Search"  name="search" aria-label="Search">
	         <button class="btn btn-outline-success my-2 my-sm-0"  name="search_button" type="submit">Search</button>
	       </form>
	      </li class="out">
	       <li class=" out btn btn-outline-success my-2 my-sm-0">
	       <a href="logout.php">Log Out</a>
	      </li>
	    </div>
	  </nav>
	</div>
	<!-- navbar ended -->

<div class="container-fluid">
	<div class="row">

		<div class="col-sm-2">
		<h1 class="sidebar-brand">The<br><?php echo ucwords($_SESSION["Username"]) ;?></h1>
						<div class="sidebar-nav">
						  <nav class="sidebar-nav">
						    <ul class="">
						      <li class="nav-item mt-auto btn ">
						        <a class="nav-link  btn btn-outline-success" href="dashboard.php">
						          <i class=""></i> Dashboard
						        </a>
						      </li>
									<li class="nav-item mt-auto btn ">
										<a class="nav-link btn btn-outline-success " href="teacher_board.php" target="_blank">
											<i class="nav-icon cui-cloud-download"></i>Teacher Board</a>
									</li>
						      <li class="nav-item mt-auto btn ">
						        <a class="nav-link btn btn-primary" href="addNewStudent.php">
						          <i class="nav-icon cui-speedometer"></i> Add Student Bio
						          <span class="badge badge-primary">NEW</span>
						        </a>
						      </li>
                  <li class="nav-item btn ">
						        <a class="nav-link btn btn-outline-success" href="addNewTeacher.php">
						          <i class="nav-icon cui-speedometer"></i> Add Teacher Bio
						          <span class="badge badge-primary">NEW</span>
						        </a>
						      </li>
						      <li class="nav-item nav-itemdropdown btn btn-outline-suc">
						        <a class="nav-link nav-dropdown-toggle btn btn-outline-success" href="branches.php">
						          <i class="nav-icon cui-puzzle"></i> Branches
						        </a>
						      </li>
						      <li class="nav-item mt-auto btn ">
						        <a class="nav-link  btn btn-outline-success" href="admin.php">
						          <i class="nav-icon cui-cloud-download"></i>Manage Admin</a>
						      </li>
						      <li class="nav-item mt-auto btn">
						        <a class="nav-link btn btn-outline-success" href="Blog.php" target="_blank">
						          <i class="nav-icon cui-cloud-download"></i>Live Blog</a>
						      </li>
						      <li class="nav-item btn">
						        <a class="nav-link btn btn-outline-success" href="loginteacher.php">
						          <i class="nav-icon cui-layers"></i>Manage Teachers
						          <strong></strong>
						          <td>
									</td>
						        </a>
						      </li>
						      <li class="nav-item btn">
						        <a class="nav-link  btn btn-outline-success" href="logout.php">
						          <i class="nav-icon cui-cloud-download"></i>Logout &nbsp</a>
						      </li>

						    </ul>
						  </nav>
						</div>

		</div> <!-- ending of side bar -->

		<div class="col-sm-10">

			<h1>Add New Post</h1>

				<?php
					// echo "it is empty field";
					echo Message();
					echo SuccessMessage();
				 ?>
			<div>
				<form action="addNewStudent.php" method="POST"  enctype="multipart/form-data">
					<fieldset>
					<div class="form-group col-lg-4">
						<label class="fieldinform  " for="title">PRN:</label>
						<input class="form-control" type="text" name="PRN" id="PRN" placeholder="PRN">
					</div>
          <div class="form-group col-lg-4">
						<label class="fieldinform" for="title">Name:</label>
						<input class="form-control" type="text" name="name" id="name" placeholder="name">
					</div>
          <div class="form-group col-lg-4">
						<label class="fieldinform" for="title">Mo. No.:</label>
						<input class="form-control" type="mo_no" name="mo_no" id="mo_no" placeholder="mo_no">
					</div>
          <div class="form-group col-lg-4">
						<label class="fieldinform" for="title">Email:</label>
						<input class="form-control" type="text" name="email" id="email" placeholder="email">
					</div>
          <div class="form-group col-lg-2">
            <label class="fieldinform" for="category_select">Stream:</label>
            <select class="form-control" id="stream" name="stream">
              <?php
              global $conn;
              $query = "SELECT * FROM branches ORDER BY datetime desc";
              $execute = mysqli_query($conn, $query) or die('Error1');
              // $sr_no = 0;

              while($row=mysqli_fetch_array($execute,MYSQLI_ASSOC))
              {

              $id = $row["id"];
              $stream = $row["name"];
              // $sr_no++;
              ?>
              <option><?php echo $stream ;?></option>
              <?php } ;?>
            </select>
          </div>
          <div class="form-group col-lg-4">
						<label class="fieldinform" for="title">Address:</label>
						<input class="form-control" type="text" name="addrs" id="addrs" placeholder="addrs">
					</div>
					<div class="form-group col-lg-2">
						<label class="fieldinform" for="category_select">Years:</label>
						<select class="form-control" id="year" name="year">
							<?php
							global $conn;
							$query = "SELECT * FROM years ORDER BY datetime desc";
							$execute = mysqli_query($conn, $query) or die('Error2');
							// $sr_no = 0;

							while($row=mysqli_fetch_array($execute,MYSQLI_ASSOC))
							{

							$id = $row["id"];
							$year = $row["name"];
							// $sr_no++;
							?>
							<option><?php echo $year ;?></option>
							<?php } ;?>
						</select>
					</div>
					<div class="form-group">
						<label class="fieldinform" for="image_select">Select Image:</label>
						<input 	type="file" class="form-control col-sm-4" id="image_select" name="Image">
					</div>
					<input class="btn btn-primary" type="submit" name="submit" value="Add Student Bio">
					</fieldset>
				</form>
			</div>
			</div>


		</div> <!-- ending of main area -->
 	</div><!-- ending of main row -->
</div><!-- ending of main container -->

<br>
<div class="footer footerc" style="background: black;color: grey;text-decoration: none; opacity: .8; font-weight:bold;text-align: center;
height: 0px auto">
<span>Developed BY | Khole Rohit | &copy;2018-2023 --All right reserved.</span><br>
<span>This site is for study purose only</span>
</div>

</body>
</html>
