<?php require("include/session.php"); ?>
<?php require("include/db.php"); ?>
<?php require("include/function.php"); ?>
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

        <h2 id="heading" class="align-items-center mt-4 text-center"> Result of ESE(Odd)</h2>
        <div class="table-responsive ">
				<table class="table table-striped table-hover">
					<tr>
            <th id="tht7" class="tht">Cource Code</th>
						<th id="tht8" class="tht">Course Name</th>
						<th id="tht1" class="tht">ISE1</th>
						<th id="tht2" class="tht">ISE2</th>
						<th id="tht3" class="tht">PR-ICA</th>
						<th id="tht4" class="tht">PR-ESE</th>
            <th id="tht5" class="tht">TH-ISA</th>
            <th id="tht6" class="tht">TH-ESE</th>
            <th id="tht6" class="tht">Total</th>
            <th id="tht6" class="tht">Grade</th>
					</tr>
					<?php
          $prn = $_SESSION['PRN'];
					global $conn;
          $query = "SELECT * FROM marks where PRN = '$prn'";
          $execute = mysqli_query($conn,$query) or die('Error8');
          $row=mysqli_fetch_array($execute,MYSQLI_ASSOC);
          $i1_id = $row["f1_id"];

          // echo 'hyy'.$i1_id;
          $query = "SELECT * FROM exam_detail where id = '$i1_id'";
          $execute = mysqli_query($conn,$query) or die('Error9');
          $row2=mysqli_fetch_array($execute,MYSQLI_ASSOC);
          $status = $row2["status"];
          $subject_id1 = $row2["subject_id1"];
          $subject_id2 = $row2["subject_id2"];
          $subject_id3 = $row2["subject_id3"];
          $subject_id4 = $row2["subject_id4"];
          $subject_id5 = $row2["subject_id5"];


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
                  $i1s1 = $row1["i1s1"];
                  $i1s2 = $row1["i1s2"];
                  $i1s3 = $row1["i1s3"];
                  $i1s4 = $row1["i1s4"];
                  $i1s5 = $row1["i1s5"];

                  $i2s1 = $row1["i2s1"];
                  $i2s2 = $row1["i2s2"];
                  $i2s3 = $row1["i2s3"];
                  $i2s4 = $row1["i2s4"];
                  $i2s5 = $row1["i2s5"];

                  $e1s1 = $row1["e1s1"];
                  $e1s2 = $row1["e1s2"];
                  $e1s3 = $row1["e1s3"];
                  $e1s4 = $row1["e1s4"];
                  $e1s5 = $row1["e1s5"];

                  $isa1s1 = $row1["isa1s1"];
                  $isa1s2 = $row1["isa1s2"];
                  $isa1s3 = $row1["isa1s3"];
                  $isa1s4 = $row1["isa1s4"];
                  $isa1s5 = $row1["isa1s5"];

                  $subject_id1_t = $i1s1 + $i2s1 + $e1s1 + $isa1s1;
                  $subject_id2_t = $i1s2 + $i2s2 + $e1s2 + $isa1s2;
                  $subject_id3_t = $i1s3 + $i2s3 + $e1s3 + $isa1s3;
                  $subject_id4_t = $i1s4 + $i2s4 + $e1s4 + $isa1s4;
                  $subject_id5_t = $i1s2 + $i2s2 + $e1s2 + $isa1s5;

                  $subject_id1_g1 = grade($subject_id1_t);
                  $subject_id2_g1 = grade($subject_id2_t);
                  $subject_id3_g1 = grade($subject_id3_t);
                  $subject_id4_g1 = grade($subject_id4_t);
                  $subject_id5_g1 = grade($subject_id5_t);

			          ?>
			    <tr>
          <td><?php  echo htmlentities($subject_id1); ?></td>
          <td><?php  echo "s1"; ?></td>
					<td><?php  echo htmlentities($i1s1); ?></td>
					<td><?php  echo htmlentities($i2s1); ?></td>
          <td><?php  echo '-'; ?></td>
          <td><?php  echo '-'; ?></td>
					<td><?php  echo htmlentities($isa1s1); ?></td>
					<td><?php  echo htmlentities($e1s1); ?></td>
          <td><?php  echo $subject_id1_t; ?></td>
          <td><?php  echo $subject_id1_g1; ?></td>
					</tr>
          <tr>
          <td><?php  echo htmlentities($subject_id2); ?></td>
          <td><?php  echo "s2"; ?></td>
          <td><?php  echo htmlentities($i1s2); ?></td>
          <td><?php  echo htmlentities($i2s2); ?></td>
          <td><?php  echo '-'; ?></td>
          <td><?php  echo '-'; ?></td>
          <td><?php  echo htmlentities($isa1s2); ?></td>
          <td><?php  echo htmlentities($e1s2); ?></td>
          <td><?php  echo $subject_id2_t; ?></td>
          <td><?php  echo $subject_id2_g1; ?></td>
          </tr>
          <tr>
          <td><?php  echo htmlentities($subject_id3); ?></td>
          <td><?php  echo "s3"; ?></td>
          <td><?php  echo htmlentities($i1s3); ?></td>
          <td><?php  echo htmlentities($i2s3); ?></td>
          <td><?php  echo '-'; ?></td>
          <td><?php  echo '-'; ?></td>
          <td><?php  echo htmlentities($isa1s3); ?></td>
          <td><?php  echo htmlentities($e1s3); ?></td>
          <td><?php  echo $subject_id3_t; ?></td>
          <td><?php  echo $subject_id3_g1; ?></td>
          </tr>
          <tr>
          <td><?php  echo htmlentities($subject_id4); ?></td>
          <td><?php  echo "s4"; ?></td>
          <td><?php  echo htmlentities($i1s4); ?></td>
          <td><?php  echo htmlentities($i2s4); ?></td>
          <td><?php  echo '-'; ?></td>
          <td><?php  echo '-'; ?></td>
          <td><?php  echo htmlentities($isa1s4); ?></td>
          <td><?php  echo htmlentities($e1s4); ?></td>
          <td><?php  echo $subject_id4_t; ?></td>
          <td><?php  echo $subject_id4_g1; ?></td>
          </tr>
          <tr>
          <td><?php  echo htmlentities($subject_id5); ?></td>
          <td><?php  echo "s5"; ?></td>
          <td><?php  echo htmlentities($i1s5); ?></td>
          <td><?php  echo htmlentities($i2s5); ?></td>
          <td><?php  echo '-'; ?></td>
          <td><?php  echo '-'; ?></td>
          <td><?php  echo htmlentities($isa1s5); ?></td>
          <td><?php  echo htmlentities($e1s5); ?></td>
          <td><?php  echo $subject_id5_t; ?></td>
          <td><?php  echo $subject_id5_g1; ?></td>
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
        document.getElementById("tht5").style.display = "none";
        }
      </script>
		</table>

        <script>
        window.onload = function () {

        var chart = new CanvasJS.Chart("chartContainer", {
        	animationEnabled: true,
        	title:{
        		text: "Final Result"
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
        			{ label: "S1", y: <?php echo $subject_id1_t ?> },
        			{ label: "S2", y: <?php echo $subject_id2_t ?> },
        			{ label: "S3", y: <?php echo $subject_id3_t ?> },
        			{ label: "S4", y: <?php echo $subject_id4_t ?> },
        			{ label: "S5", y: <?php echo $subject_id5_t ?> },
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
