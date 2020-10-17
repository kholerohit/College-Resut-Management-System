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
    <link rel="stylesheet" type="text/css" href="Css/public.css">
    <link rel="stylesheet" href="Css/dashboar.css">
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
         <a class="nav-link" href="student.php">User Profil<span class="sr-only">(current)</span></a>
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
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="squadfree/index.html">About site</a>
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
      <div class="col-sm-8">

        <h2 id="heading" class="align-items-center mt-4 text-center"> Profile Image</h2>
        <td><img class="img-responsive img-round img-fluid" style="width:500 px; height: px;" src="upload/<?php echo $_SESSION["image"];?>"></td>
      </div>
      <div class="col-sm-4">

        <h2 id="heading" class="align-items-center mt-4 text-center"> Student Detail </h2>
        <div class=" text-center">
          <div class="">
            <label class="fieldinform" for="title">PRN:</label>
            <td style=" color: red;" class="fieldinform"><?php echo $_SESSION["PRN"]; ?></td>
          </div>
          <div class="">
            <label class="fieldinform  " for="title">Student Name:</label>
            <td class="fieldinform"><?php echo $_SESSION["name"]; ?></td>
          </div>
          <div class="">
            <label class="fieldinform  " for="title">Email:</label>
            <td class="fieldinform"><?php echo $_SESSION["email"]; ?></td>
          </div>
          <div class="">
            <label class="fieldinform  " for="title">Mobile NO.:</label>
            <td class="fieldinform"><?php echo $_SESSION["mo_no"]; ?></td>
          </div>
          <div class="">
            <label class="fieldinform  " for="title">Stream:</label>
            <td class="fieldinform"><?php echo $_SESSION["stream"]; ?></td>
          </div>
          <div class="">
            <label class="fieldinform  " for="title">Current Year:</label>
            <td class="fieldinform"><?php echo $_SESSION["year"]; ?></td>
          </div>
          <div class="">
            <label class="fieldinform  " for="title">Address:</label>
            <td class="fieldinform"><?php echo $_SESSION["addrs"]; ?></td>
          </div>
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
