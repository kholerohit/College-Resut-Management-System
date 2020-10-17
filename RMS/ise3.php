<?php require_once("include/session.php"); ?>
<?php require_once("include/db.php"); ?>
<?php require_once("include/function.php"); ?>
<?php login_confirms() ;?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>student</title>
    <link rel="stylesheet" type="text/css" href="Css/bootstrap.min.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="Css/dashboardstyle.css">
    <link rel="stylesheet" type="text/css" href="Css/public.css">
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
  <br><br><br>
  <div class="blog-header">
       <h1 id="heading">Welcome in Govt. college of Engg. Jalgaon...!</h1>
  </div>
  <div>
    <?php
      echo Message();
      echo SuccessMessage();
     ?>
  </div>
  <div class="row">
      <div class="col-sm-12">

        <h2 id="heading" class="align-items-center mt-4 text-center"> Result of ISE1(Even)</h2>
        <div class="table-responsive ">
				<table class="table table-striped table-hover">
					<tr>
						<th id="tht" class="tht">S1</th>
						<th id="tht1" class="tht">s2</th>
						<th id="tht2" class="tht">s3</th>
						<th id="tht3" class="tht">s4</th>
						<th id="tht4" class="tht">s5</th>
					</tr>
					<?php
          $prn = $_SESSION['PRN'];
					global $conn;
          $query = "SELECT * FROM marks where PRN = '$prn'";
          $execute = mysqli_query($conn,$query) or die('Error8');
          $row=mysqli_fetch_array($execute,MYSQLI_ASSOC);
          $i1_id = $row["i3_id"];

          // echo 'hyy'.$i1_id;
          $query = "SELECT * FROM exam_detail where id = '$i1_id'";
          $execute = mysqli_query($conn,$query) or die('Error9');
          $row2=mysqli_fetch_array($execute,MYSQLI_ASSOC);
          $status = $row2["status"];

          if($status == 'OFF')
          {
            echo 'Result is not declared yet...!';
          }
          else{

          $query = "SELECT * FROM marks where PRN = '$prn' and  '$status' = 'ON'";
          $execute = mysqli_query($conn,$query) or die('Error8');
          $row1=mysqli_fetch_array($execute,MYSQLI_ASSOC);
			          {
                  $PRN = $row1["PRN"];
                  $i1 = $row1["i3s1"];
                  $i2 = $row1["i3s2"];
                  $i3 = $row1["i3s3"];
                  $i4 = $row1["i3s4"];
                  $i5 = $row1["i3s5"];
			          ?>
			        <tr>
					<td><?php  echo htmlentities($i1); ?></td>
					<td><?php  echo htmlentities($i2); ?></td>
					<td><?php  echo htmlentities($i3); ?></td>
					<td><?php  echo htmlentities($i4); ?></td>
          <td><?php  echo htmlentities($i5); ?></td>
					</tr>

				<?php }
      } ?>

      <script type="text/javascript">
        var status = "<?php echo $status?>";
        if(status == 'OFF' || status == '' || status == 'NULL' || status == 0){
        alert("Result is not publish yet..!");
        document.getElementById("tht").style.display = "none";
        document.getElementById("tht1").style.display = "none";
        document.getElementById("tht2").style.display = "none";
        document.getElementById("tht3").style.display = "none";
        document.getElementById("tht4").style.display = "none";


        }
      </script>
				</table>

        <script>
        window.onload = function () {

        var chart = new CanvasJS.Chart("chartContainer", {
        	animationEnabled: true,
        	title:{
        		text: "ISE1(Even) MARKS"
        	},
        	axisY: {
        		title: "Marks",
        		titleFontColor: "#4F81BC",
        		lineColor: "#4F81BC",
        		labelFontColor: "#4F81BC",
        		tickColor: "#4F81BC"
        	},
        	legend: {
        		cursor:"pointer",
        		itemclick: toggleDataSeries
        	},
        	data: [{
        		type: "column",
        		name: "Ise1 marks(bn)",
        		dataPoints:[
        			{ label: "S1", y: <?php echo $i1 ?> },
        			{ label: "S2", y: <?php echo $i2 ?> },
        			{ label: "S3", y: <?php echo $i3 ?> },
        			{ label: "S4", y: <?php echo $i4 ?> },
        			{ label: "S5", y: <?php echo $i5 ?> },
        		]
        	}]
        });
        chart.render();

        function toggleDataSeries(e) {
        	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
        		e.dataSeries.visible = false;
        	}
        	else {
        		e.dataSeries.visible = true;
        	}
        	chart.render();
        }

        }
        </script>

        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

      </div>
    </div>
  </div>
</div>

<br><br><br>
<div class="footer footerc" style= "color: grey;text-decoration: none; opacity: .8; font-weight:bold;text-align: center;
height: 0px auto">
<span>Developed BY | Team Members | &copy;2018-2023 --All right reserved.</span><br>
<span>This site is for study purose only</span>
</div>

  </body>
</html>
