<?php
    session_start();
    require_once '../web/config.php';  
    $select_menu = @$polaczenie2->query("SELECT * FROM menu ORDER BY id DESC LIMIT 1");
    $rooow = $select_menu->fetch_assoc();
    $tabela = $_GET['tab'];
    $sql = "INSERT INTO pizza_skladnik (id_pizza, id_skladnika) VALUES(?,?) ";
    $zetete = $db->prepare($sql);
    for($i = 0 ; $i < count($tabela) ; $i++){
        $zetete->execute([$rooow['id'], $tabela[$i]]);
    }
    mysqli_close($polaczenie2); 
?>