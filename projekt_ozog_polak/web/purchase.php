<?php
    session_start();
    require_once '../web/config.php';
    $con = mysqli_connect($host, $db_user, $db_pass, $db_name);
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST['purchase'])){
            $discount = 1;
            if($_POST['discount_input'] == "thunder10"){
                $discount = 0.9;
            }elseif($_POST['discount_input'] == "thunder20"){
                $discount = 0.8;
            }elseif($_POST['discount_input'] == "ulicaciewyjasni30"){
                $discount = 0.7;
            }
            $sql = "INSERT INTO zarzadzanie_zamowieniami (email ,nr_telefonu ,adress ,nr_zamieszkania, `miasto`) VALUES(?,?,?,?,?)";
            $stmtinsert = $db->prepare($sql);
            $result = $stmtinsert->execute([$_SESSION['email'],$_SESSION['phonenumber'], $_SESSION['address'],$_SESSION['nr_zamieszkania'],$_SESSION['city']]);
            if($result){
                $Order_id = $db->lastInsertId();
                $sql2 = "INSERT INTO zamowienia (id_zam ,nazwa_pizzy ,skladniki ,cena, ilosc, rozmiar, data, notatka) VALUES(?,?,?,?,?,?,?,?)";
                $stmtinsert2 = $db->prepare($sql2);
                if($stmtinsert2){
                    foreach($_SESSION['cart'] as $key => $values){
                        $split_price = explode(" ", $values['rozmiar']); 
                        $price_size = $split_price[4];
                        $size = $split_price[0];
                        $price_all = ($values['cena'] + $price_size) * $values['ilosc'] * $discount;
                        $data = date('Y-m-d H:i:s');
                        $result2 = $stmtinsert2->execute([$Order_id, $values['nazwa'] ,$values['skladniki'] ,$price_all, $values['ilosc'], $size, $data, $_POST['specialNotes']]);
                    }         
                    unset($_SESSION['cart']);
                    echo"<script>
                        window.location.href = '../user_web/orders_user.php';
                    </script>
                    ";
                }
            }else{
                echo" :(";
            }
        }
    }




?>