<?php require_once("include/db.php"); ?>
<?php require_once("include/session.php"); ?>
<?php require_once("include/function.php"); ?>
<?php login_confirm() ;?>

<?php
	if(isset($_POST["submit"]))
	{
		$category=mysqli_real_escape_string($conn, $_POST["category"]);
		//$id = mysqli_real_escape_string($conn,$_POST["id"]);
		$currentTime=time();
		$dateTime=strftime("%B-%d-%Y : %H:%M:%S",$currentTime);
		$dateTime;
		$admin = ucwords($_SESSION["Username"]);
		if(empty($category))
		{
			// echo "it's empty";
			$_SESSION["ErrorMessage"]="All fields must be filled out";
			header("Location:dashboard.php");
			exit;
		}
		elseif(strlen($category)<3)
		{
			$_SESSION["ErrorMessage"]="name shold atleat 3 chars";
			header("Location:dashboard.php");
			exit;
		}
		else
		{
			global $conn;
			$query = "INSERT INTO branches(datetime, name,creator_name)
				VALUES('$dateTime','$category','$admin')";
			$execute = mysqli_query($conn,$query) or die('Error');

			if($execute){
				$_SESSION["SuccessMessage"] = " branch has been added...";
			}
			else{
				$_SESSION["ErrorMessage"] = "branch not inserted";
			}

		}

	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Dashboard</title>
  <link rel="stylesheet" type="text/css" href="Css/bootstrap.min.css">
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="Css/public.css">
  <link rel="stylesheet" href="Css/dashboardstyle.css">
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
						      <li class="nav-item btn ">
						        <a class="nav-link btn btn-outline-success" href="addNewStudent.php">
						          <i class="nav-icon cui-speedometer"></i> Add New Bio
						          <span class="badge badge-primary">NEW</span>
						        </a>
						      </li>
                  <li class="nav-item btn ">
						        <a class="nav-link btn btn-outline-success" href="addNewTeacher.php">
						          <i class="nav-icon cui-speedometer"></i> Add Teacher Bio
						          <span class="badge badge-primary">NEW</span>
						        </a>
						      </li>
						      <li class="nav-item nav-itemdropdown btn">
						        <a class="nav-link nav-dropdown-toggle btn btn-primary" href="branches.php">
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
			<h1>Manage Branches</h1>

				<?php
					// echo "it is empty field";
					echo Message();
					echo SuccessMessage();
				 ?>

			<div>
				<form action="branches.php" method="POST">
					<fieldset>
					<div class="form-group">
						<label class="fieldinform" for="categoryname">Name:</label>
						<input class="form-control col-sm-4" type="text" name="category" id="categoryname" placeholder="Name">
					</div>
					<input class="btn btn-primary" type="submit" name="submit" value="Add New Branch">
					</fieldset>
				</form>
			</div>
			<br>
			<div class="table-responsive ">
				<table class="table table-striped table-hover">
					<tr>
						<th class="tht">Sr. No.</th>
						<th class="tht">Date & Time</th>
						<th class="tht">Branch Name</th>
						<th class="tht">Creator Name</th>
						<th class="tht"> Action</th>

					</tr>
				<?php
				global $conn;
				$query = "SELECT * FROM branches ORDER BY id  desc";
				$execute = mysqli_query($conn,$query) or die('Error');
				$sr_no = 0;

				while($row=mysqli_fetch_array($execute,MYSQLI_ASSOC))
				{

				$id = $row["id"];
				$dateTime = $row["datetime"];
				$categoryname = $row["name"];
				$creator_name = $row["creator_name"];
				$sr_no++;
				?>
				<tr>
					<td><?php echo $sr_no; ?></td>
					<td><?php echo $dateTime; ?></td>
					<td><?php echo htmlentities($categoryname); ?></td>
					<td><?php echo htmlentities($creator_name); ?></td>
					<td><a href="delete_branch.php?id=<?php echo $id; ?>"><span class="btn btn-danger">Delete</span></a></td>
				</tr>
				<?php } ?>
				</table>
			</div>

		</div> <!-- ending of main area -->
 	</div><!-- ending of main row -->
</div><!-- ending of main container -->

<br>
<div class="footer" style="background: black;color: grey;text-decoration: none; opacity: .8; font-weight:bold;text-align: center;
height: 0px auto">
<span>Developed BY | Khole Rohit | &copy;2018-2023 --All right reserved.</span><br>
<span>This site is for study purose only</span>
</div>


</body>
</html>
