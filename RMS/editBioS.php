<?php require_once("include/db.php"); ?>
<?php require_once("include/session.php"); ?>
<?php require_once("include/function.php"); ?>
<?php login_confirms() ;?>

<?php
	if(isset($_POST["submit"]))
	{
    $PRN = $_SESSION["PRN"];
    $name = $_SESSION["name"];
    $mo_no = $_SESSION["mo_no"];
    $email = $_SESSION["email"];
    $stream = $_SESSION["stream"];
    $addrs = $_POST["addrs"];
    $year = $_SESSION["year"];
    $image = $_POST["photo"];
		$currentTime=time();
		$dateTime=strftime("%d-%B-%Y : %H:%M:%S",$currentTime);
		$dateTime;
		// $admin = $_SESSION["Username"];

		$ImageName=$_FILES["Image"]["name"];
		$ImageTmpName=$_FILES["Image"]["tmp_name"];
		$ImageSize = $_FILES["Image"]["size"];
		$ImageError = $_FILES["Image"]["error"];
		$ImageType = $_FILES["Image"]["type"];
		$ImageExt = explode('.', $ImageName);
		$ImageActualExt = strtolower(end($ImageExt));

		$allowed = array('jpg','JPG','jpeg','JPEJ','png','PNG');


    // echo "<h1>".$_SESSION["PRN"]."</h1>";

		if(empty($PRN))
		{
			// echo "it's empty";
			$_SESSION["ErrorMessage"]="All fields must be filled out";
			header("Location:editBioS.php");
			exit;
		}
		elseif(strlen($PRN)<3)
		{
			$_SESSION["ErrorMessage"]="PRN should atleast 3 digit long";
			header("Location:editBioS.php");
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
							header("Location:student.php");
							exit;
						}
						else
						{
							$_SESSION["ErrorMessage"] = "Bio not inserted";
							header("Location:student.php");
							exit;
						}
					}
					else
					{
						$_SESSION["ErrorMessage"]="Too Big filesize!";
						header("Location:student.php");
						exit;
					}
				}
				else
				{
					$_SESSION["ErrorMessage"]="Error while uploading..!";
					header("Location:student.php");
					exit;
				}

			}
			else
			{
				$_SESSION["ErrorMessage"]="file format not supported..!";
				header("Location:student.php");
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
<div class="container">
<nav class="navbar navbar-expand-lg nav-item fixed-top navbar-dark bg-dark">
 <span class="navbar-brand brand">MY College</span>
 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls=" navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
   <span class="navbar-toggler-icon"></span>
 </button>

 <div class="collapse navbar-collapse" id="navbarSupportedContent">
   <ul class="navbar-nav mr-auto">
     <li class="nav-item active">
       <a class="nav-link" href="student.php">User Profile<span class="sr-only">(current)</span></a>
     </li>
     <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Result
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="ise1.php">ISE1(Odd)</a>
        <a class="dropdown-item" href="ise2.php">ISE2(Odd)</a>
        <a class="dropdown-item" href="ese1.php">ESE(Odd)</a>
        <a class="dropdown-item" href="ise3.php">ISE1(Even)</a>
        <a class="dropdown-item" href="ise4.php">ISE2(Even)</a>
        <a class="dropdown-item" href="ese2.php">ESE(Even)</a>
      </div>
    </li>
     </li>
       <li class="nav-item">
       <a class="nav-link" href="editBioS.php">Edit Profile</a>
     </li>
   </ul>
   <form action="Blog.php" class="form-inline my-2 my-lg-0">
     <input class="form-control mr-sm-2" type="search" placeholder="Search"  name="search" aria-label="Search">
     <button class="btn btn-outline-success my-2 my-sm-0"  name="search_button" type="submit">Search</button>
   </form>
 </li class="out">
   <li class=" out btn btn-outline-success my-2 my-sm-0">
   <a href="logouts.php">Log Out</a>
 </li>
 </div>
</nav>
</div>
<!-- navbar ended -->
<div class="container">
	<div class="row">

		<div class="col-sm-2">

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
                $stream = $_SESSION["stream"];
                $addrs = $row["addrs"];
                $year = $_SESSION["year"];
			          $image = $row["photo"];
			      	}

			          ?>
            <form action="editBioS.php?edit=<?php echo $_SESSION["PRN"];?>" method="POST"  enctype="multipart/form-data">
        			<fieldset>
      			    <div class="form-group">
        					<label class="fieldinform" for="title">PRN:</label>
        					<input value="<?php echo @$PRN ;?>"
        					class="form-control col-sm-4" type="text" name="PRN" id="PRN" placeholder="<?php echo $_SESSION["PRN"]; ?>" readonly>
        				 </div>
                <div class="form-group">
                  <label class="fieldinform" for="title">Name:</label>
                  <input value="<?php echo @$name ;?>"
                  class="form-control col-sm-4" type="text" name="name" id="name" placeholder="<?php echo $_SESSION["name"]; ?>" readonly>
                </div>
                <div class="form-group">
                  <label class="fieldinform" for="title">Year:</label>
                  <input value="<?php echo @$year ;?>"
                  class="form-control col-sm-4" type="text" name="year" id="year" placeholder="<?php echo $_SESSION["year"]; ?>" readonly>
                </div>
                <div class="form-group">
                  <label class="fieldinform" for="title">Mo. No.:</label>
                  <input value="<?php echo @$mo_no ;?>"
                  class="form-control col-sm-4" type="text" name="mo_no" id="mo_no" placeholder="<?php echo $_SESSION["mo_no"]; ?>" readonly>
                </div>
                <div class="form-group">
                  <label class="fieldinform" for="title">Email:</label>
                  <input value="<?php echo @$email ;?>"
                  class="form-control col-sm-4" type="text" name="email" id="email" placeholder="<?php echo $_SESSION["email"]; ?>" readonly>
                </div>
        				<div class="form-group">
        					<label class="fieldinform" for="category_select">Branch:</label>
        					<select class="form-control col-sm-4" id="category_select" name="branch" readonly>
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
                  <td><img class="img-responsive img-round img-fluid" style="width:100 px; height: 50px;" src="upload/<?php echo $_SESSION["image"];?>"></td>
      						<input value="<?php echo $image ;?>" type="File" class="form-control col-sm-4" id="image_select" name="Image">
      					</div>
      					<div class="form-group">
        				 <label class="fieldinform" for="post_area">Addrs:</label>
        					<textarea  class="form-control col-sm-4" name="addrs" id="post_area"><?php echo $_SESSION["addrs"]; ?></textarea>
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
