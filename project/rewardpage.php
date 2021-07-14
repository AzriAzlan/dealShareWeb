<html>

<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="mycss.css">
    <!-- Load icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
  
     <!--navigation-->

         <nav class="navbar navbar-fixed-top navbar-expand-md justify-content-end bg-dark">
    <a class="navbar-brand" href="#">DealShare</a>
    <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#main-navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="main-navigation">

        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="homepage.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="userIntReg1.php">Register Deal</a>
            </li>
               <li class="nav-item">
                <a class="nav-link" href="dealShare.php">Saved Deals</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="deal_review.php" >Review</a>
            </li>
        </ul>

</nav>

    <!--Content-->
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
        <?php
        //pdo
        $pdo = new PDO('mysql:host=localhost;port=3306;dbname=dealShare','root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dealid=$_GET['deal_id'];
        if(!(isset($_POST['dealID'])) && !(isset($_POST['promocode'])) && !(isset($_POST['name']))){
            //Display all registered deal
            $stmts = $pdo->query("SELECT deal_id,deal_name, deal_logo, promo_code, tagLine, reward, reward_unit, description FROM deal where deal_id=$dealid");
            $result = $stmts->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $dealID=htmlentities($row['deal_id']);
                echo
                    '<div class="col-lg-3 card content " style="background-color:#00BFFF">
                            <h5 class="card-title rounded" style="color:black;text-align:center;background-color:white;padding:10px;margin:10px">'. htmlentities($row['deal_name']) . '</h5>
                            <div class="card-body" style="height:250px">
                                <p class="card-text">'. htmlentities($row['tagLine']) . '</p>
                                <p class="card-text">'. htmlentities($row['description']) . '</p>
                                <p class="card-text">'. htmlentities($row['reward']). htmlentities($row['reward_unit']) . '</p>
                            </div>
                            <a href="#" class="btn btn-success" style="margin-bottom:20px">Redeem</a>
                        </div>';
            }
        }
        ?>
        </div>
    </div>
</body>

</html>