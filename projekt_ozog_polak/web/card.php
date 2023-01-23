<?php
    session_start();
?>
<html>
    <head>
        <title>Thunder Pizza</title>
        <link rel="shortcut icon" href="../png/pizza.png"/>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
         <!-- BOTSTRAP -->
         <link rel="stylesheet"href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- --- -->

        <!-- CSS -->
        <link rel="stylesheet"href="../css/main_style.css">
        <!-- --- -->

        <!-- AJAX -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- --- -->
        
        <!-- FontAwesome -->
        <link rel="stylesheet" href="fontawesome/css/all.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <!-- --- -->

        <link href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/4.9.95/css/materialdesignicons.css" rel="stylesheet">
    </head>


<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
    
    <div id="pricing" class="container-fluid">
        <div class = "container-fluid">
            <div class = "text-center" style ="color:white">
                <h2>Koszyk</h2>
            </div>
            <div class="container bootstrap snippets bootdey">
            <div class="col-md-12 col-sm-12 content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info panel-shadow">
                            <div class="panel-heading">
                                <h3 style = "margin-left:30%">
                                <img class="img-circle img-thumbnail" src="../png/user.png" style = "width:13%; height:10%;">
                                Twoje przedmioty w koszyku
                                </h3>
                            </div>
                            <div class="panel-body"> 
                                <div class="table-responsive">
                                <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Nazwa Pizzy</th>
                                                <th>Skladniki</th>
                                                <th>Rozmiar</th>
                                                <th>Ilość</th>
                                                <th></th>
                                                <th>Cena</th>
                                                <th>Całość</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $total = 0;
                                            $mala = 0;
                                            $srednia = 7;
                                            $duza = 13;
                                                if(isset($_SESSION['cart']))
                                                {
                                                    foreach($_SESSION['cart'] as $key => $value)
                                                    {
                                                        $total = $total + $value['cena'];
                                                        echo'
                                                        <tr>
                                                            <td><strong>'.$value['nazwa'].'</strong></td>
                                                            <td>'.$value['skladniki'].'</td>   
                                                            <td> 
                                                                <form action="m_card.php" method = "POST">
                                                                    <select id ="number_qnt_size-'.$key.'" name ="size_pizza" class="options_size form-control" onchange ="this.form.submit()">
                                                                        <option value ="'.$value['rozmiar'].'">'.$value['rozmiar'].'</option>
                                                                        <optgroup label="Wybierz Rozmiar Pizzy">
                                                                        <option value="Mała 28cm | + 0 zł">Mała 28cm | + 0 zł</option>
                                                                        <option value="Średnia 40cm | + 7 zł">Średnia 40cm + 7zł</option>
                                                                        <option value="Duża 55cm | + 13 zł">Duża 55cm + 13zł</option>
                                                                    </select>
                                                                    <input type = "hidden" name="item_name" value = "'.$value['nazwa'].'">
                                                                </form>
                                                                <td>
                                                                    <form action = "m_card.php" method = "POST">
                                                                        <input class="qnt form-control" id ="number_qnt-'.$key.'" type="number" name = "mod_qnt" onchange ="this.form.submit()" value="'.$value['ilosc'].'" min = "1" max = "10">
                                                                        <input type = "hidden" name="item_name" value = "'.$value['nazwa'].'">
                                                                    </form>
                                                                </td>
                                                                <td>
                                                                    <form action="m_card.php" method = "POST">
                                                                        <button name = "remove_item" class="btn btn-default"><i class="fas fa-trash"></i></button>
                                                                        <input type = "hidden" name="item_name" value = "'.$value['nazwa'].'">
                                                                    </form>
                                                                </td>
                                                            </td>
                                                            <td><p>'.$value['cena'].' zł</p><input type = "hidden" class = "iprice" value = "'.$value['cena'].'"></td>
                                                            <td id = "price_for_pizzas"><p class = "itotal">'.$value['cena'].'</p></td>
                                                        </tr>
                                                        ';
                                                    }
                                                }  
                                            ?>
                                            <?php
                                            if(isset($_SESSION['zalogowany'])){
                                                echo '
                                                <form action = "purchase.php" method = "POST">
                                                    <tr>
                                                        <td>
                                                            <div class="form-group">
                                                                <label for="specialNotes">Notatka do zamówienia:</label>
                                                                <textarea class="form-control" name="specialNotes" id="specialNotes" rows="3" placeholder="Treść"></textarea>
                                                            </div>
                                                        </td>
                                                        <td colspan="5" class="text-right" id = "gtotal-text"><strong>Cena całkowita</strong></td>
                                                        <td id = "gttotal"><?php echo $total;?> zł</td>
                                                    </tr>
                                                    <tr>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <td>
                                                                    <input type ="text" class="form-control" name="discount_input" id="discount_input" placeholder="Kupon">
                                                                    <label for="specialNotes">Kod Rabatowy</label>
                                                                </td>
                                                                <td>
                                                                    <button type ="button" class="input-group-text" id="button-addonTags" onclick = "discount_func()">Dodaj</button>
                                                                </td>
                                                            </div>
                                                        </div>
                                                    </tr>
                                                    <button name = "purchase" class="btn btn-warning pull-right">Zamów<span class="glyphicon glyphicon-chevron-right"></span></a>
                                                </form> '
                                                ;
                                            }else{
                                                echo '
                                                    <a href="../web/rejestracja.php" class="btn btn-primary pull-right">Kliknij aby założyc konto i złożyć zamówienie<span class="glyphicon glyphicon-chevron-right"></span></a>'
                                                    ;
                                                }
                                        ?>
                                </tbody>
                        </table>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>


    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><i class="fas fa-pizza"></i></a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <?php 
                    $count = 0;
                    if(isset($_SESSION['cart'])){
                        $count = count($_SESSION['cart']);
                    };
                    if(isset($_SESSION['zalogowany'])){
                        echo ('
                            <li><a href="../user_web/index_user.php">STRONA GŁÓWNA</a></li>
                            <li><a href="../user_web/pizza_user.php">MENU</a></li>
                            <li><a href="../user_web/about_user.php">KONTAKT</a></li>
                            <li><a href="../user_web/user.php" style = "text-transform: uppercase">'.$_SESSION['display_name'].'</a></li>
                            <li><a href="../web/card.php"><i class="fas fa-shopping-cart"></i>('.$count.')</a></li>
                            <li><a href="../web/logout.php" style = "text-transform: uppercase">WYLOGUJ SIĘ</a></li>
                        ');
                    }else{
                        echo ('
                            <li><a href="index.php">STRONA GŁÓWNA</a></li>
                            <li><a href="pizza.php">MENU</a></li>
                            <li><a href="about.php">KONTAKT</a></li>
                            <li><a href="logowanie.php">LOGOWANIE</a></li>
                            <li><a href="card.php"><i class="fas fa-shopping-cart"></i>('.$count.')</a></li>
                        ');
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <footer class="footer">
        <a href="#myPage" title="To Top">
        <span class="glyphicon glyphicon-chevron-up"></span>Thunder Pizza<a href="Thunder" title="Visit OurWebsite "></a>
        </a>
    </footer>   

    <script>
        var total_gt = 0 ;                            
        var qnt = document.getElementsByClassName('qnt');
        var itotal = document.getElementsByClassName('itotal');
        var price = document.getElementsByClassName('iprice');
        var price_size = document.getElementsByClassName('options_size');         
        var gtotal = document.getElementById('gttotal');      
        var gtotal_text = document.getElementById('gtotal-text'); 
        total_gt = 0;
        cena = 0;
        for(i = 0 ; i <price.length ; i++){
            price_value = price_size[i].value;
            price_split = price_value.split(' '); 
            price_pizza = parseInt(price_split[4]);
            itotal[i].innerText = (parseInt(price_pizza) + parseInt(price[i].value)) * (qnt[i].value);

            total_gt = total_gt + (parseInt(price_pizza) + parseInt(price[i].value)) * (qnt[i].value);
        }
        gtotal.innerText = total_gt + " zł";
        var discount_text = document.getElementById('discount_input');   
        var uzyty = false;
        function discount_func(){
            price = document.getElementById('gttotal').innerHTML; 
            var liczba = price.split(' ');
            var zmienna = parseFloat(liczba[0]);
            const kupony = [
                {name: 'thunder10', discount: 0.9}, 
                {name: 'thunder20', discount:0.8}, 
                {name: 'ulicaciewyjasni30', discount:0.7},
            ]
            for(let i = 0; i < kupony.length; i++){
                if(discount_text.value == kupony[i].name){
                    if(!uzyty){
                        uzyty = true;
                        var new_price = 0;
                        new_price = parseInt(zmienna) * kupony[i].discount;
                        newest_price = Number(Math.round(new_price + 'e+2') + 'e-2');
                        gtotal.innerHTML = "<s>"+ price +"</s><br>" + newest_price.toString() + " zł";
                        // discount_text.disabled = true;
                        // $.ajax({
                        //     url: "../web/purchase.php",
                        //     type: 'GET',
                        //     data: {
                        //         isdiscount: true,
                        //         znizka : kupony[i].discount,
                        //     },
                        // });
                        for(i = 0 ; i < price.length ; i++){
                            document.getElementById("number_qnt-"+i).disabled = true;
                            document.getElementById("number_qnt_size-"+i).disabled = true;
                        }
                    }
                }
            }
        }
    </script>

</body>

</html>


