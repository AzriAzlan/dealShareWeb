<?php
session_start();

//pdo
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=dealShare','root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(!(isset($_POST['dealID'])) && !(isset($_POST['promocode'])) && !(isset($_POST['name']))){
    $stmts = $pdo->query('SELECT d.deal_id,d.deal_name, d.deal_logo, d.promo_code, d.tagLine, d.reward, d.reward_unit, d.description,r.deal_status FROM deal d inner join deal_review r on d.deal_id=r.deal_id where r.deal_status="approved"');
    $result = $stmts->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $dealnum=htmlentities($row['deal_id']);

        echo
        '<div class="col-lg-3 card content" style="background-color:#00BFFF">
                <img height=120 width=120 src="data:image/jpeg;base64,'.base64_encode($row['deal_logo']).'"/>
                <div class="card-body" style="height:250px">  
                    <h5 class="card-title" style="color:black;text-align:center;">'. htmlentities($row['deal_name']) . '</h5>
                    <p class="card-text">'. htmlentities($row['tagLine']) . '</p>
                    <p class="card-text">'. htmlentities($row['description']) . '</p>
                    <p class="card-text">'. htmlentities($row['reward']). htmlentities($row['reward_unit']) . '</p>
                </div>
                <form method="POST">
                    <button type="submit" name="claim" class="btn btn-dark" style="width:100%">SAVE</button>
                </form>
                </div>';
        
        if (isset($_POST['claim'])){
            $sql = "INSERT INTO saved_deals (user_id,deal_id) VALUES (:userid,:dealid)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(':userid' => $_SESSION['user_id'],':dealid' => $row['deal_id']));
    
        }
    }

}

else if(isset($_POST['dealID']) && $_POST['dealID']>=0 ){
    $userid = $_SESSION["user_id"];
    $dealID=$_POST['dealID'];
    $stmts = $pdo->query("SELECT deal_id,deal_name, deal_logo, promo_code, tagLine, reward, reward_unit, description FROM deal where deal_id=$dealID");
    $result = $stmts->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        echo
            '<div class="col-lg-3 card content" style="background-color:#00BFFF">
                <img src="data:image/jpeg;base64,'.base64_encode($row['deal_logo']).'"/>
                <div class="card-body" style="height:250px">  
                    <h5 class="card-title" style="color:black;text-align:center;">'. htmlentities($row['deal_name']) . '</h5>
                    <p class="card-text">'. htmlentities($row['tagLine']) . '</p>
                    <p class="card-text">'. htmlentities($row['description']) . '</p>
                    <p class="card-text">'. htmlentities($row['reward']). htmlentities($row['reward_unit']) . '</p>
                </div>
                <form method="POST">
                    <button type="submit" name="claim" class="btn btn-primary" style="width:100%">Claim</button>
                </form>
            </div>';
            
        if (isset($_POST['claim'])){
            //insert into deal_page statement
        }
    }
}
?>