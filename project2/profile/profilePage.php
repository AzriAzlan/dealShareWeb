<?php
session_start();

require_once "../pdo.php";
$uid=$_SESSION['user_id'];
$user = $pdo->query("SELECT * FROM users a inner join users_information b on a.user_id=b.user_id WHERE a.user_id = $uid");
$user_row = $user->fetch(PDO::FETCH_ASSOC);

$useremail = $user_row['user_email'];
$usertype = $user_row['user_type'];
$username = $user_row['user_name'];
$userage = $user_row['user_age'];
$usernumber = $user_row['user_number'];
$useraddress = $user_row['user_address'];
$usergender = $user_row['user_gender'];
$userpostcode = $user_row['user_postal'];
$usercountry = $user_row['user_country'];


if(isset($_POST['submit'])) {

	$username=$_POST['newUsername'];
	$email=$_POST['newUseremail'];
	$age=$_POST['newUserage'];
	$number=$_POST['newUsernumber'];
	$address=$_POST['newUseraddress'];
	$postcode=$_POST['newUserpostcode'];
	$country=$_POST['newUsercountry'];


 	$stmt = $pdo->prepare("UPDATE users SET user_name='$username',user_email='$email' WHERE user_id = $uid");
 	$stmt->execute();

    $stmt = $pdo->prepare("UPDATE users_information SET user_age='$age',user_number='$number',user_address='$address',user_postal='$postcode',user_country='$country' WHERE user_id = $uid");
 	$stmt->execute();

 	$_SESSION['username']=$username;

	header("Refresh:0");


}



?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>

      <link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
      <script src = "https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

</head>
<body>

   <!--navigation-->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="#">DealShare</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="main-navigation">

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../home/homepage.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../newDeal/userIntReg1.php">Register Deal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../savedDeal/dealShare.php">Saved Deals</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../rewardPage/rewardpage.php">Reward</a>
                </li>
                 <li class="nav-item">
                    <a href="#"><img width=35; src="https://icon-library.com/images/profile-icon-white/profile-icon-white-3.jpg"></a>
                    
                </li>

            </ul>
          
    </nav>


<div class="container">
    <div style="margin-top: 60px;" class="main-body">
    
    
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="../newDeal/profileIcon.png" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4><?php echo($username); ?></h4>
                      <p class="text-secondary mb-1"><?php echo($uid); ?></p>
                      <a href="postedDeals.php"><input type="button" class="btn btn-outline-primary" value="My Posted Deals"></input></a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card mt-3">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
       
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                   
                  </li>

                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                   
                  </li>

                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
              
                  </li>

                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                   
                  </li>

                </ul>
              </div>


            </div>
            <div class="col-md-8">
              <div class="card mb-3">
             <form action="profilePage.php" method="POST">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Username</h6>
                    </div>
                    <div class="col-sm-9 text-secondary" id="username">
                      <?php echo($username); ?>
                    </div>
                  </div>
                   <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Age</h6>
                    </div>
                    <div class="col-sm-9 text-secondary" id="userage">
                      <?php echo($userage) ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary" id="useremail">
                      <?php echo($useremail) ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Mobile</h6>
                    </div>
                    <div class="col-sm-9 text-secondary" id="usernumber">
                      <?php echo($usernumber); ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary" id="useraddress">
                      <?php echo($useraddress); ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Postcode</h6>
                    </div>
                    <div class="col-sm-9 text-secondary" id="userpostcode">
                      <?php echo($userpostcode); ?>
                    </div>
                  </div>
                    <hr>
                  <div class="row">
                    <div class="col-sm-3" >
                      <h6 class="mb-0">Country</h6>
                    </div>
                    <div class="col-sm-9 text-secondary" id="usercountry">
                      <?php echo($usercountry); ?>
                    </div>
                  </div>
                   <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Gender</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo($usergender); ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                     <div  id="go" class="col-sm-2">
                      <a class="btn btn-info" onclick="editDetails();" >Edit</a>
                    </div>
                    <div class="col-sm-2">
                      <a class="btn btn-info" id="cancel" onclick="window.location.reload();" style="display: none;" >Cancel</a>
                    </div>

                  </div>
                </div>
            </form>
              </div>


            </div>
          </div>

        </div>
    </div>

<script type="text/JavaScript">


  function editDetails() {

  document.getElementById("cancel").style.display="block";

  var button = document.getElementById("go");
  var newbutton = document.createElement("input");
  newbutton.setAttribute("type", "submit");
  newbutton.setAttribute("name", "submit");
  newbutton.setAttribute("class", "btn btn-info");
  newbutton.setAttribute("value", "Submit");
  button.parentNode.replaceChild(newbutton, button);

  var username = document.getElementById("username");
  var newusername = document.createElement("input");
  newusername.setAttribute("type", "text");
  newusername.setAttribute("name", "newUsername");
  newusername.setAttribute("value", "<?php echo($username)?>");
  username.parentNode.replaceChild(newusername, username);

  var userage = document.getElementById("userage");
  var newuserage = document.createElement("input");
  newuserage.setAttribute("type", "text");
  newuserage.setAttribute("name", "newUserage");
  newuserage.setAttribute("value", "<?php echo($userage)?>");
  userage.parentNode.replaceChild(newuserage, userage);

  var useremail = document.getElementById("useremail");
  var newuseremail = document.createElement("input");
  newuseremail.setAttribute("type", "text");
  newuseremail.setAttribute("name", "newUseremail");
  newuseremail.setAttribute("value", "<?php echo($useremail)?>");
  useremail.parentNode.replaceChild(newuseremail, useremail);

  var usernumber = document.getElementById("usernumber");
  var newusernumber = document.createElement("input");
  newusernumber.setAttribute("type", "text");
  newusernumber.setAttribute("name", "newUsernumber");
  newusernumber.setAttribute("value", "<?php echo($usernumber)?>");
  usernumber.parentNode.replaceChild(newusernumber, usernumber);

  var useraddress = document.getElementById("useraddress");
  var newuseraddress = document.createElement("input");
  newuseraddress.setAttribute("type", "text");
  newuseraddress.setAttribute("name", "newUseraddress");
  newuseraddress.setAttribute("value", "<?php echo($useraddress)?>");
  useraddress.parentNode.replaceChild(newuseraddress, useraddress);

  var userpostcode = document.getElementById("userpostcode");
  var newuserpostcode = document.createElement("input");
  newuserpostcode.setAttribute("type", "text");
  newuserpostcode.setAttribute("name", "newUserpostcode");
  newuserpostcode.setAttribute("value", "<?php echo($userpostcode)?>");
  userpostcode.parentNode.replaceChild(newuserpostcode, userpostcode);


  var usercountry = document.getElementById("usercountry");
  var newusercountry = document.createElement("input");
  newusercountry.setAttribute("type", "text");
  newusercountry.setAttribute("name", "newUsercountry");
  newusercountry.setAttribute("value", "<?php echo($usercountry)?>");
  usercountry.parentNode.replaceChild(newusercountry, usercountry);

  }

</script>


</body>
</html>