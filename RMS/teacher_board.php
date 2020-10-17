<?php require_once("include/session.php"); ?>
<?php require_once("include/db.php"); ?>
<?php require_once("include/function.php"); ?>
<?php login_confirm() ;?>

<!DOCTYPE html>
<html>
<head>
	<title>Teacher Dashboard</title>
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
										<a class="nav-link btn btn-primary " href="teacher_board.php" target="_blank">
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
			<h1>Admin dashboard</h1>
			<div>
				<?php
					echo Message();
					echo SuccessMessage();
				 ?>
			</div>
			<div class="table-responsive">
				<table class="table table-striped table-hover">
					<tr>
						<th class="tht">No.</th>
						<th class="tht">ID</th>
						<th class="tht">Datetime</th>
						<th class="tht">Name</th>
						<th class="tht">Mo. No.</th>
						<th class="tht">Email</th>
						<th class="tht">Subjects</th>
						<th class="tht">Addrs</th>
            <th class="tht">Photo</th>
            <th class="tht">Action</th>
            <th class="tht">Detail</th>
					</tr>
					<?php
					$srn = 0;
					global $conn;
					$query = "SELECT *  FROM teacher_info ORDER BY id desc";
					$execute = mysqli_query($conn,$query) or die('Error');
					while($row=mysqli_fetch_array($execute,MYSQLI_ASSOC))
			         {
			          $id = $row["id"];
			          $dateTime = $row["datetime"];
			          $name = $row["name"];
			          $mo_no = $row["mo_no"];
			          $email = $row["email"];
			          $subjects = $row["subjects"];
			          $addrs = $row["addrs"];
                $image = $row["photo"];
			          $srn++;
			          ?>
			        <tr>
					<td><?php echo $srn; ?></td>
          <td><?php echo $id; ?></td>
					<td><?php if(strlen($dateTime)>14){$dateTime=substr($dateTime, 0, 14);} echo htmlentities($dateTime); ?></td>
          <td><?php if(strlen($name)>18){$name=substr($name, 0, 18).'...';} echo htmlentities($name); ?></td>
					<td><?php if(strlen($mo_no)>10){$mo_no=substr($mo_no, 0, 12).'...';} echo htmlentities($mo_no); ?></td>
					<td><?php if(strlen($email)>12){$email=substr($email, 0, 12).'...';} echo htmlentities($email); ?></td>
          <td><?php if(strlen($subjects)>12){$subjects=substr($subjects, 0, 12).'...';} echo htmlentities($subjects); ?></td>
          <td><?php if(strlen($addrs)>12){$addrs=substr($addrs, 0, 12).'...';} echo htmlentities($addrs); ?></td>
					<td><img style="width: 100px; height: 50px;" src="upload/<?php echo htmlentities($image);?>"></td>
					<td>
						<a href="edit_teacher.php?edit=<?php echo $id ;?>"><span class="btn btn-warning">Edit ...</span></a>
						<a href="delete_teacher.php?delete=<?php echo $id ;?>"><span class="btn btn-danger">Delete</span></a>
					</td>
					<td>
						<a href="fullpost.php?id=<?php echo $id ;?>" target="_blank"><span class="btn btn-primary">Live Preview</span></a>
					</td>
					</tr>
				<?php } ?>

				</table>
			</div>


		</div> <!-- ending of main area -->
 	</div><!-- ending of main row -->
</div><!-- ending of main container -->

<br>
<div class="footer footerc" style="text-decoration: none; opacity: .8; font-weight:bold;text-align: center;
height: 0px auto">
<span>Developed BY | Khole Rohit | &copy;2018-2023 --All right reserved.</span><br>
<span>This site is for study purose only</span>
</div>


</body>
</html>
