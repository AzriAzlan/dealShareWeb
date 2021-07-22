<?php
ob_start();
session_start();
//pdo
require_once "../pdo.php";

if(!(isset($_GET['dealID'])) && !(isset($_POST['promocode'])) && !(isset($_POST['name']))){
    //Display all registered deal
    $stmts = $pdo->prepare('SELECT deal_id,deal_name,deal_logo, promo_code,tagLine,reward,reward_unit,description,validity, company_address, company_postcode, company_country
    FROM deal 
    where deal_id=:dealID');
    $stmts -> execute(array(
        ':dealID' => $_GET['deal_id']
    ));
    $result = $stmts->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $check = "SELECT COUNT(deal_id) from saved_deals where user_id = :uid and deal_id = :did";
        $statement = $pdo->prepare($check);
        $statement -> execute(array(
            'uid' => $_SESSION['user_id'],
            'did' => $_GET['deal_id']
        ));
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach($results as $rows){
            $count = $rows['COUNT(deal_id)'];
            $default = "0";

        $dealID=htmlentities($row['deal_id']);
        echo
            '<img class="col-lg-3" src="data:image/jpeg;base64,'.base64_encode($row['deal_logo']).'"/ style="margin-top:10px; height:300;">
            <div class="col-lg-9" style="margin-top:10px">';
            if(!strcmp($count,$default)){
                echo '<form method="POST">
                <button class="btn float-right" type="submit" name="claim" style="background:none; border:none; " >
                    <i class="fa fa-bookmark-o fa-3x" aria-hidden="true"></i>
                </button>
                </form>';
            }
            else{
                echo'
                <i class="fa fa-bookmark fa-3x float-right" aria-hidden="true"></i>';
            }
            echo'<h1 style="color:black; text-align:center; font-size:50px; text-transform: uppercase;">'. htmlentities($row['deal_name']) . '</h1>
                <div class="row" style="border-top-style:solid; border-bottom-style:solid;">
                    <p class="col-lg-6" style="text-align:left;">Promo code: <strong>'. htmlentities($row['promo_code']) . '</strong></p>
                    <p class="col-lg-6" style="text-align:right;"> Expired: '. htmlentities($row['validity']) . '</p>
                </div>
                <h5>Description:</h5>
                <ul>'. htmlentities($row['description']) . '</ul>
                <h5>Tagline:</h5>
                <ul>'. htmlentities($row['tagLine']) . '</ul>
                <h5>Reward Redeem:</h5>
                <ul>'. htmlentities($row['reward']). htmlentities($row['reward_unit']) . '</ul>
                <h5>Address:</h5>
                <ul>'. htmlentities($row['company_address']).'</br>'. htmlentities($row['company_postcode']) .'</br>'. htmlentities($row['company_country']) .'</ul>
            </div>';
            if (isset($_POST['claim'])){
                $sql = "INSERT INTO saved_deals (user_id,deal_id) VALUES (:userid,:dealid)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array(
                    ':userid' => $_SESSION['user_id'],
                    ':dealid' => $dealID
                ));
                echo '<script>
                    jQuery(function($){
                        alert(\'Deal Saved\');
                    });
                    location.href="../savedDeal/dealShare.php"
                    </script>';
                ob_end_flush();
                }
            }
    }
}
?>