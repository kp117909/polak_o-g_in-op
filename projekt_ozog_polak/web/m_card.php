<?php
session_start();

if($_SERVER["REQUEST_METHOD"]=="GET"){
    if($_GET["creator"])
    {
        if(isset($_SESSION['cart'])){
                $myitems = array_column($_SESSION['cart'], 'nazwa');
                if(in_array($_GET['nazwa'], $myitems)){
                    if(isset($_SESSION['zalogowany'])){
                        echo'<script>
                            window.location.href = "../user_web/pizza_user.php";
                        </script>';
                    }else{
                        echo'<script>
                            window.location.href = "pizza.php";
                        </script>';
                    }
                }else{   
                    $count=count($_SESSION['cart']);
                    $_SESSION['cart'][$count]=array('nazwa'=>$_GET['nazwa'],'cena'=>$_GET['cena'],'ilosc'=>1,'img'=>"",'skladniki' =>$_GET['skladniki'], 'rozmiar'=>'Mała 28cm | + 0 zł');
                    if(isset($_SESSION['zalogowany'])){
                        echo'<script>
                        window.location.href = "../user_web/pizza_user.php";
                    </script>';
                    }else{
                    echo'<script>
                        window.location.href = "pizza.php";
                    </script>';
                    }
                }
        }else{
            $_SESSION['cart'][0]=array('nazwa'=>$_GET['nazwa'],'cena'=>$_GET['cena'],'ilosc'=>1,'img'=>"", 'skladniki' =>$_GET['skladniki'], 'rozmiar'=>'Mała 28cm | + 0 zł'); 
            if(isset($_SESSION['zalogowany'])){
                echo'<script>
                window.location.href = "../user_web/pizza_user.php";
            </script>';
            }else{
            echo'<script>
                window.location.href = "pizza.php";
            </script>';
            }
        }
    }
}

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    if(isset($_POST["Add_To_Cart"]))
    {
        if(isset($_SESSION['cart'])){
                // $myitems = array_column($_SESSION['cart'], 'nazwa');
                // if(in_array($_POST['nazwa'], $myitems)){
                //     if(isset($_SESSION['zalogowany'])){
                //         echo'<script>
                //             window.location.href = "../user_web/pizza_user.php";
                //         </script>';
                //     }else{
                //         echo'<script>
                //             window.location.href = "pizza.php";
                //         </script>';
                //     }
                // }else{   
                    $count=count($_SESSION['cart']);
                    $_SESSION['cart'][$count]=array('nazwa'=>$_POST['nazwa'],'cena'=>$_POST['cena'],'ilosc'=>1,'img'=>$_POST['img'],'skladniki' =>$_POST['skladniki'], 'rozmiar'=>'Mała 28cm | + 0 zł');
                    if(isset($_SESSION['zalogowany'])){
                        echo'<script>
                        window.location.href = "../user_web/pizza_user.php";
                    </script>';
                    }else{
                    echo'<script>
                        window.location.href = "pizza.php";
                    </script>';
                    }
                // }
        }else{
            $_SESSION['cart'][0]=array('nazwa'=>$_POST['nazwa'],'cena'=>$_POST['cena'],'ilosc'=>1,'img'=>$_POST['img'], 'skladniki' =>$_POST['skladniki'], 'rozmiar'=>'Mała 28cm | + 0 zł '); 
            if(isset($_SESSION['zalogowany'])){
                echo'<script>
                window.location.href = "../user_web/pizza_user.php";
            </script>';
            }else{
            echo'<script>
                window.location.href = "pizza.php";
            </script>';
            }
        }
    }

    if(isset($_POST['remove_item'])){
        foreach($_SESSION['cart'] as $key => $value){
            if($value['nazwa'] == $_POST['item_name']){
                unset($_SESSION['cart'][$key]);
                $_SESSION['cart'] = array_values($_SESSION['cart']);
                if(isset($_SESSION['zalogowany'])){
                    echo'<script>
                    window.location.href = "../web/card.php";
                </script>';
                }else{
                echo '<script>
                    window.location.href = "../web/card.php";
                    </script>;
                ';
                }
            }

        }
    }

    if(isset($_POST['mod_qnt'])){
        foreach($_SESSION['cart'] as $key => $value){
            if($value['nazwa'] == $_POST['item_name']){
                $_SESSION['cart'][$key]['ilosc'] = $_POST['mod_qnt'];
                if(isset($_SESSION['zalogowany'])){
                    echo'<script>
                    window.location.href = "../web/card.php";
                </script>';
                }else{
                echo '<script>
                    window.location.href = "../web/card.php";
                    </script>;
                ';
                }
            }
        }
    }
    if(isset($_POST['size_pizza'])){
        foreach($_SESSION['cart'] as $key => $value){
            if($value['nazwa'] == $_POST['item_name']){
                $_SESSION['cart'][$key]['rozmiar'] = $_POST['size_pizza'];
                echo $_SESSION['cart'][$key]['rozmiar'];
                echo $_SESSION['cart'][$key]['nazwa'];
                if(isset($_SESSION['zalogowany'])){
                    echo'<script>
                    window.location.href = "../web/card.php";
                </script>';
                }else{
                echo '<script>
                    window.location.href = "../web/card.php";
                    </script>;
                ';
                }
            }
        }
    }
}


?>
