<?php
//pdo
require_once "../pdo.php";

if(isset($_POST['home'])){
    //$id=$_GET['id'];
    header("Location:../home/homepage.php"); //?id=$id"
}
if(!(isset($_POST['dealID'])) && !(isset($_POST['promocode'])) && !(isset($_POST['name']))){
    //Display all registered deal
    $stmts = $pdo->query('SELECT deal_name, reward, tagline, description FROM deal');
    $result = $stmts->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        //trigger modal
        echo
            '<div class="col-lg-3 imagesdeal" data-toggle="modal" data-target="#'.htmlentities($row['reward']).'">
              <div class="contentdeal" style="color:black;"><strong style="font-size:30px;"> 
                  <p style="text-align:center;">'. htmlentities($row['deal_name']) . '</p>
                  </strong></br>'. htmlentities($row['description']) . '</br>
              </div>';
        //modal
        echo
                '<div id="'.htmlentities($row['reward']).'" class="modal fade" role="dialog">
                    <div class="modal-dialog">';
        //modal content
        echo
                        '<div class="modal-content">
                            <div class="modal-body" style="color:black;"><strong style="font-size:30px;"> 
                                <p style="text-align:center;">'. htmlentities($row['deal_name']) . '</p></strong></br>
                                    Promo Code: '.htmlentities($row['reward']) . '</br>
                                    Tag Line: '.htmlentities($row['tagline']) . '</br>
                                    Description: '.htmlentities($row['description']) . '</br>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn">Claim</button>
                                <button type="button" class="negativebtn">Close</button>
                            </div>
                        </div>
                    </div>
                </div>';
        echo 
        '</div>';
    }
}
else if(isset($_POST['promocode'])){
    //Display all registered deal
    $stmts = $pdo->query("SELECT deal_name, reward, tagline, description FROM deal ORDER BY reward");
    $result = $stmts->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        //trigger modal
        echo 
            '<div class="col-lg-3 imagesdeal" data-toggle="modal" data-target="#'.htmlentities($row['reward']).'">
              <div class="contentdeal" style="color:black;"><strong style="font-size:30px;"> 
                  <p style="text-align:center;">'. htmlentities($row['deal_name']) . '</p>
                  </strong></br>'. htmlentities($row['description']) . '</br>
              </div>';
        //modal
        echo 
                '<div id="'.htmlentities($row['reward']).'" class="modal fade" role="dialog">
                    <div class="modal-dialog">';
        //modal content
        echo
                        '<div class="modal-content">
                            <div class="modal-body" style="color:black;"><strong style="font-size:30px;"> 
                                <p style="text-align:center;">'. htmlentities($row['deal_name']) . '</p></strong></br>
                                    Promo Code: '.htmlentities($row['reward']) . '</br>
                                    Tag Line: '.htmlentities($row['tagline']) . '</br>
                                    Description: '.htmlentities($row['description']) . '</br>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn">Claim</button>
                                <button type="button" class="negativebtn">Close</button>
                            </div>
                        </div>
                    </div>
                </div>';
        echo 
        '</div>';
    }
}
 if(isset($_POST['name'])){
    //Display all registered deal
    $stmts = $pdo->query("SELECT deal_name, reward, tagline, description FROM deal ORDER BY dealName");
    $result = $stmts->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        //trigger modal
        echo 
            '<div class="col-lg-3 imagesdeal" data-toggle="modal" data-target="#'.htmlentities($row['reward']).'">
              <div class="contentdeal" style="color:black;"><strong style="font-size:30px;"> 
                  <p style="text-align:center;">'. htmlentities($row['deal_name']) . '</p>
                  </strong></br>'. htmlentities($row['description']) . '</br>
              </div>';
        //modal
        echo 
                '<div id="'.htmlentities($row['reward']).'" class="modal fade" role="dialog">
                    <div class="modal-dialog">';
        //modal content
        echo
                        '<div class="modal-content">
                            <div class="modal-body" style="color:black;"><strong style="font-size:30px;"> 
                                <p style="text-align:center;">'. htmlentities($row['deal_name']) . '</p></strong></br>
                                    Promo Code: '.htmlentities($row['reward']) . '</br>
                                    Tag Line: '.htmlentities($row['tagline']) . '</br>
                                    Description: '.htmlentities($row['description']) . '</br>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn">Claim</button>
                                <button type="button" class="negativebtn">Close</button>
                            </div>
                        </div>
                    </div>
                </div>';
        echo 
        '</div>';
    }
}
else if(isset($_POST['dealID']) && $_POST['dealID']>=0 ){
    //Display all registered deal
    $dealID=$_POST['dealID'];
    $stmts = $pdo->query("SELECT deal_name, reward, tagline, description FROM deal where deal_id = $dealID");
    $result = $stmts->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        //trigger modal
        echo 
            '<div class="col-lg-3 imagesdeal" data-toggle="modal" data-target="#'.htmlentities($row['reward']).'">
              <div class="contentdeal" style="color:black;"><strong style="font-size:30px;"> 
                  <p style="text-align:center;">'. htmlentities($row['deal_name']) . '</p>
                  </strong></br>'. htmlentities($row['description']) . '</br>
              </div>';
        //modal
        echo 
                '<div id="'.htmlentities($row['reward']).'" class="modal fade" role="dialog">
                    <div class="modal-dialog">';
        //modal content
        echo
                        '<div class="modal-content">
                            <div class="modal-body" style="color:black;"><strong style="font-size:30px;"> 
                                <p style="text-align:center;">'. htmlentities($row['deal_name']) . '</p></strong></br>
                                    Promo Code: '.htmlentities($row['reward']) . '</br>
                                    Tag Line: '.htmlentities($row['tagline']) . '</br>
                                    Description: '.htmlentities($row['description']) . '</br>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn">Claim</button>
                                <button type="button" class="negativebtn">Close</button>
                            </div>
                        </div>
                    </div>
                </div>';
        echo 
        '</div>';
    }
}
?>