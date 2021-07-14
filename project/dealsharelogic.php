<?php
//pdo
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=dealShare','root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(!(isset($_POST['dealID'])) && !(isset($_POST['promocode'])) && !(isset($_POST['name']))){
    //Display all registered deal
     $stmts = $pdo->query('SELECT d.deal_id,d.deal_name, d.deal_logo, d.promo_code, d.tagLine, d.reward, d.reward_unit, d.description,s.user_id FROM deal d inner join saved_deals s on d.deal_id=s.deal_id where s.user_id=1');
    $result = $stmts->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $dealID=htmlentities($row['deal_id']);
        echo
            '<div class="col-lg-3 card content" style="background-color:#00BFFF">
                   <img height=120 width=120 src="data:image/jpeg;base64,'.base64_encode($row['deal_logo']).'"/>
                    <div class="card-body" style="height:250px">  
                        <h5 class="card-title" style="color:black;text-align:center;">'. htmlentities($row['deal_name']) . '</h5>
                        <p class="card-text">'. htmlentities($row['tagLine']) . '</p>
                        <p class="card-text">'. htmlentities($row['description']) . '</p>
                        <p class="card-text">'. htmlentities($row['reward']). htmlentities($row['reward_unit']) . '</p>
                    </div>
                    <a href="rewardpage.php?deal_id='.$dealID.'" class="btn btn-success" style="margin-bottom:5px">REDEEM</a>

                    <!-- Button to Open the Modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#'.htmlentities($row['deal_id']).'" style="margin-bottom:20px">
                        Share
                    </button>
                    <!-- The Modal -->
                    <div class="modal" id="'.htmlentities($row['deal_id']).'">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
        
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">'.htmlentities($row['deal_name']).'</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <p class="card-text">'. htmlentities($row['tagLine']) . '</p>
                                    <p class="card-text">'. htmlentities($row['description']) . '</p>
                                    <p class="card-text">'. htmlentities($row['reward']). htmlentities($row['reward_unit']) . '</p>
                                </div>
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <div data-href="http://localhost/deal%20application/homepage.php" data-layout="button" data-size="large">
                                        <a target="_blank"
                                            href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Flocalhost%2Fdeal%2520application%2Fhomepage.php&amp;src=sdkpreparse"
                                            class="fb-xfbml-parse-ignore"><img src="Icon/fb.png" style="height:50px; margin:10px"></a>
                                    </div>
                                    <a href="https://www.instagram.com/?url=http://localhost/deal%20application/dealshare.php"><img src="Icon/instagram-round-icon-png-5.jpg" style="height:50px; margin:10px"></a>
                                    <a href="http://www.twitter.com/share?url=http://localhost/deal%20application/dealshare.php"><img src="Icon/twittericon.png" style="height:50px; margin:10px"></a>
                                    <a href="whatsapp://send?text='.htmlentities($row['deal_name']).'" data-action="share/whatsapp/share"><img src="Icon/wa.png" style="height:50px; margin:10px"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
    }
}
?>