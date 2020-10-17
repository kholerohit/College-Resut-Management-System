<?php require_once("include/db.php"); ?>
<?php require_once("include/session.php"); ?>
<?php require_once("include/function.php"); ?>
<?php login_confirm() ;?>

<?php
	if(isset($_POST["submit"]))
	{
    $PRN = $_SESSION["PRN"];
    $name = $_POST["name"];
    $mo_no = $_POST["mo_no"];
    $email = $_POST["email"];
    $stream = $_POST["stream"];
    $addrs = $_POST["addrs"];
    $year = $_POST["year"];
    $image = $_POST["photo"];
		$currentTime=time();
		$dateTime=strftime("%d-%B-%Y : %H:%M:%S",$currentTime);
		$dateTime;
		$admin = $_SESSION["Username"];

		$ImageName=$_FILES["Image"]["name"];
		$ImageTmpName=$_FILES["Image"]["tmp_name"];
		$ImageSize = $_FILES["Image"]["size"];
		$ImageError = $_FILES["Image"]["error"];
		$ImageType = $_FILES["Image"]["type"];
		$ImageExt = explode('.', $ImageName);
		$ImageActualExt = strtolower(end($ImageExt));

		$allowed = array('jpg','JPG','jpeg','JPEJ','png','PNG');

		if(empty($PRN))
		{
			// echo "it's empty";
			$_SESSION["ErrorMessage"]="All fields must be filled out";
			header("Location:edit_student.php");
			exit;
		}
		elseif(strlen($PRN)<3)
		{
			$_SESSION["ErrorMessage"]="PRN should atleast 3 digit long";
			header("Location:edit_student.php");
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

						$editid = $_GET['edit'];
						$query = "UPDATE student_info SET dateTime='$dateTime', name='$name', mo_no='$mo_no',
            email='$email',stream='$stream',photo='$ImageNameNew',addrs='$addrs',year='$year'  WHERE PRN='$PRN'";

						$execute = mysqli_query($conn,$query) or die('Error0');
						move_uploaded_file($ImageTmpName,$Target);
						if($execute)
						{
							$_SESSION["SuccessMessage"] = " Bio has been updated...";
							header("Location:dashboard.php");
							exit;
						}
						else
						{
							$_SESSION["ErrorMessage"] = "Bio not inserted";
							header("Location:dashboard.php");
							exit;
						}
					}
					else
					{
						$_SESSION["ErrorMessage"]="Too Big filesize!";
						header("Location:dashboard.php");
						exit;
					}
				}
				else
				{
					$_SESSION["ErrorMessage"]="Error while uploading..!";
					header("Location:dashboard.php");
					exit;
				}

			}
			else
			{
				$_SESSION["ErrorMessage"]="file format not supported..!";
				header("Location:dashboard.php");
				exit;
			}

		}

	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Post</title>
  <link rel="stylesheet" type="text/css" href="Css/bootstrap.min.css">
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="Css/public.css">
  <link rel="stylesheet" type="text/css" href="Css/dashboardstyle.css">
</head>
<body>


 <!-- Navbar starting -->
<nav class="navbar navbar-expand-lg nav-item fixed-top navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls=" navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="Blog.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="squadfree/index.html">About Us</a>
      </li>
        <li class="nav-item">
        <a class="nav-link" href="squadfree/index.html">Contact Us</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="squadfree/index.html">Services</a>
          <a class="dropdown-item" href="squadfree/index.html">Feature</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="squadfree/index.html">About site</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
    <form action="Blog.php" class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search"  name="search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0"  name="search_button" type="submit">Search</button>
    </form>
  </div>
</nav>
<!-- navbar ended -->
<div class="container-fluid">
	<div class="row">

		<div class="col-sm-2">
		<h1 class="sidebar-brand">The<br>Khole Rohit</h1>
						<div class="sidebar-nav">
						  <nav class="sidebar-nav">
						    <ul class="">
						      <li class="nav-item">
						        <a class="nav-link" href="dashboard.php">
						          <i class=""></i> Dashboard
						        </a>
						      </li>
						      <li class="nav-item">
						        <a class="nav-link" href="addNewPost.php">
						          <i class="nav-icon cui-speedometer"></i> Add New Post
						          <span class="badge badge-primary">NEW</span>
						        </a>
						      </li>
						      <li class="nav-item nav-dropdown">
						        <a class="nav-link nav-dropdown-toggle" href="categories.php">
						          <i class="nav-icon cui-puzzle"></i> Categories
						        </a>
						      </li>
						      <li class="nav-item mt-auto">
						        <a class="nav-link nav-link-success" href="admin.php">
						          <i class="nav-icon cui-cloud-download"></i>Manage Admin</a>
						      </li>
						      <li class="nav-item mt-auto">
						        <a class="nav-link nav-link-success" href="Blog.php">
						          <i class="nav-icon cui-cloud-download"></i>Live Blog</a>
						      </li>
						      <li class="nav-item mt-auto">
						        <a class="nav-link nav-link-success" href="logout.php">
						          <i class="nav-icon cui-cloud-download"></i>Logout &nbsp</a>
						      </li>

						    </ul>
						  </nav>
						</div>

		</div> <!-- ending of side bar -->

		<div class="col-sm-10">
			<h1>Update Bio</h1>

				<?php
					// echo "it is empty field";
					echo Message();
					echo SuccessMessage();
				 ?>

			<div>
				<?php
					global $conn;
					$search = @	$_GET['edit'];
					$query = "SELECT * FROM student_info
					WHERE PRN='$search'";
					$execute = mysqli_query($conn,$query) or die('Error1');
					while($row=mysqli_fetch_array($execute,MYSQLI_ASSOC))
			        {
                $PRN = $row["PRN"];
                $name = $row["name"];
                $mo_no = $row["mo_no"];
                $email = $row["email"];
                $stream = $row["stream"];
                $addrs = $row["addrs"];
                $year = $row["year"];
			          $image = $row["photo"];
			      	}

			          ?>
            <form action="edit_student.php?edit=<?php echo $search;?>" method="POST"  enctype="multipart/form-data">
        			<fieldset>
      			    <div class="form-group">
        					<label class="fieldinform" for="title">PRN:</label>
        					<input value="<?php echo @$PRN ;?>"
        					class="form-control col-sm-4" type="text" name="PRN" id="PRN" placeholder="PRN">
        				 </div>
                <div class="form-group">
                  <label class="fieldinform" for="title">Name:</label>
                  <input value="<?php echo @$name ;?>"
                  class="form-control col-sm-4" type="text" name="name" id="name" placeholder="name">
                </div>
                <div class="form-group">
                  <label class="fieldinform" for="title">Year:</label>
                  <input value="<?php echo @$year ;?>"
                  class="form-control col-sm-4" type="text" name="year" id="year" placeholder="year">
                </div>
                <div class="form-group">
                  <label class="fieldinform" for="title">Mo. No.:</label>
                  <input value="<?php echo @$mo_no ;?>"
                  class="form-control col-sm-4" type="text" name="mo_no" id="mo_no" placeholder="mo_no">
                </div>
                <div class="form-group">
                  <label class="fieldinform" for="title">Email:</label>
                  <input value="<?php echo @$email ;?>"
                  class="form-control col-sm-4" type="text" name="email" id="email" placeholder="email">
                </div>
        				<div class="form-group">
        					<label class="fieldinform" for="category_select">Branch:</label>
        					<select class="form-control col-sm-4" id="category_select" name="stream">
        						<?php
        						global $conn;
        						$query = "SELECT * FROM branches ORDER BY datetime desc";
        						$execute = mysqli_query($conn,$query) or die('Error');
        						// $sr_no = 0;
        							while($row=mysqli_fetch_array($execute,MYSQLI_ASSOC))
      							{
        							$PRN = $row["PRN"];
      							$categoryname = $row["name"];
      							// $sr_no++;
      							?>
      							<option><?php echo $categoryname ;?></option>
      							<?php } ;?>
      						</select>
      					</div>
      					<div class="form-group">
      						<label class="fieldinform" for="image_select">Profile To Edit:</label>
      						<img style="width: 100px; height: 50px;" src="upload/<?php echo htmlentities($image);?>">
      						<input value="<?php echo $image ;?>" type="File" class="form-control col-sm-4" id="image_select" name="Image">
      					</div>
      					<div class="form-group">
        				 <label class="fieldinform" for="post_area">Addrs:</label>
        					<textarea  class="form-control col-sm-4" name="addrs" id="post_area"><?php echo @$addrs ;?></textarea>
        				</div>
        				<input class="btn btn-primary" type="submit" name="submit" value="Update Bio">
        				</fieldset>
        		</form>
			</div>
			<br>

			</div>


		</div> <!-- ending of main area -->
 	</div><!-- ending of main row -->
</div><!-- ending of main container -->

<<br>
<div class="footer" style="background: black;color: grey; opacity: .8; text-decoration: none;font-weight:bold;text-align: center;
height: 0px auto">
<span>Developed BY | Khole Rohit | &copy;2018-2023 --All right reserved.</span><br>
<span>This site is for study purose only</span>
</div>

</body>
</html>
