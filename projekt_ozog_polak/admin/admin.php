<?php
    session_start();
    require_once '../web/config.php';

    if($_SESSION['isadmin'] == 0){
        header('Location: ../user_web/index_user.php');
        exit;
    }
    $count = 0;
    if(isset($_SESSION['cart'])){
        $count = count($_SESSION['cart']);
    };

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Thunder Pizza</title>
        <link rel="shortcut icon" href="../png/pizza.png"/>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
          <!-- BOTSTRAP -->
        <link rel="stylesheet"href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css%22%3E">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js%22%3E"></script>
        <!-- --- -->

        <!-- CSS -->
        <link rel="stylesheet"href="../css/main_style.css">
        <!-- --- -->

        <!-- AJAX -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js%22%3E"></script>
        <!-- --- -->
        
       <!-- JS -->
       <script src = "../js/ap.js"></script>
        <!--  -->

        <!-- FontAwesome -->
        <link rel="stylesheet" href="fontawesome/css/all.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <!-- --- -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/4.9.95/css/materialdesignicons.css" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>

    </head>


<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

    <div class="container bootstrap snippets bootdey">
        <div class="row" style = "margin-top: 5%;">
          <div class="profile-nav col-md-3">
              <div class="panel">
                  <div class="user-heading round">
                      <a href="#">
                          <img src="../png/user.png" alt="">
                      </a>
                      <h1></h1>
                      <p><?php echo $_SESSION['email'];?></p>
                  </div>
        
                  <ul class="nav nav-pills nav-stacked">
                      <li><a href="../user_web/user.php"> <i class="fa fa-user"></i> Profile</a></li>
                      <li><a href="../user_web/user_edit.php"> <i class="fa fa-edit"></i>Edytuj Profil</a></li>
                      <?php 
                        if($_SESSION['isadmin'] == 1){
                            echo '<li class="active"><a href="../admin/admin.php"> <i class="mdi mdi-flash"></i></i>Panel Admina</a></li>';
                        }
                      ?>
                      <li><a href="../user_web/orders_user.php"> <i class="mdi mdi-bookmark-outline"></i></i>Twoje zamówienia</a></li>
                  </ul>
              </div>
          </div>
          <div class="profile-info col-md-9">
              <div class="panel">
                  <div class="bio-graph-heading">
                      Panel dodawania Pizzy
                  </div>
                  <div class="panel-body bio-graph-info">
                      <h1>Informacje</h1>
                      <form action="admin.php" method="post">
                            <div class="row">
                                <div class="bio-row">
                                    <label class="small mb-1" for="nazwa">Nazwa Pizzy</label>
                                    <input class="form-control" name="nazwa" id="nazwa" type="text" required>
                                </div>
                                <div class="bio-row">
                                    <label class="small mb-1" for="cena">Cena</label >
                                    <input class="form-control" name="cena" id="cena" type="number" min = "1" required>
                                </div>
                                <div class="bio-row">
                                    <label class="small mb-1" for="img">Zdjęcie Pizzy</label>
                                    <select title="Wybierz zdjęcie" class="selectpicker" name="img" id="img"> 
                                        <option selected data-content="<img style = 'width:20%; height:20%;'src ='../png/classic.png'> <span class='text-dark'>Classic</span>">../png/classic.png</option>
                                        <option data-content="<img style = 'width:20%; height:20%;'src ='../png/ham.png'> <span class='text-dark'>Szynka</span>">../png/ham.png</option>
                                        <option data-content="<img style = 'width:20%; height:20%;'src ='../png/margherita.png'> <span class='text-dark'>Margherita</span>">../png/margherita.png</option>
                                        <option data-content="<img style = 'width:20%; height:20%;'src ='../png/pepperoni.png'> <span class='text-dark'>Pepperoni</span>">../png/pepperoni.png</option>
                                        <option data-content="<img style = 'width:20%; height:20%;'src ='../png/oriental.png'> <span class='text-dark'>Oriental</span>">../png/oriental.png</option>
                                    </select>
                                </div>
                                <div class="bio-row">
                                        <label class="small mb-1" for="zawartosc">Zawartość</label>
                                </div>
                                <div class="bio-row">
                                    <select class="selectpicker" title="Wybierz składniki" id = "skladniki" multiple>
                                    <?php
                                    $resultaty = @$polaczenie->query("SELECT * FROM skladniki ORDER By nazwa");
                                    $rowsNumber = mysqli_num_rows($resultaty);    
                                    $ilosc=0;                        
                                    if ($rowsNumber > 0){
                                        while ($skladniki = $resultaty->fetch_assoc()) {
                                        echo'<option value="'.$skladniki['id'].'">'.$skladniki['nazwa'].'</option>' ;
                                        }
                                    }
                                    mysqli_close($polaczenie); 
                                ?> 
                                </select> 
                                </div>
                            </div>
                            <input type="submit" name="add" id = "submit_data" value="Zapisz" style = "border-radius:0px!important" class="btn btn-warning btn-block btn-lg" tabindex="7">
                        </form>
                        </div>
                    </div>  
                    <hr>
                    <div class="panel">
                        <form action = "csv.php" method = "POST">
                            <input type="submit" name="zapis_csv" value="Zapisz Pizze z Menu do CSV" style = "border-radius:0px!important" class="btn btn-warning btn-block btn-lg" tabindex="8">
                            <input name="nazwa_pliku_csv"  class="form-control input-lg" placeholder="Nazwa Pliku[bez .csv]" tabindex="9" required>
                        </form>
                  </div>
                  <hr>
                  <div class="panel">
                        <form action = "csv.php" method = "POST">
                            <input type="submit" name="wczytaj_csv" value="Wczytaj Skladniki do Pizzy z CSV" style = "border-radius:0px!important" class="btn btn-warning btn-block btn-lg" tabindex="10">
                            <input name="nazwa_pliku_csv"  class="form-control input-lg" placeholder="Nazwa Pliku[bez .csv]" tabindex="11" required>
                        </form>
                  </div>
                </div>
                  <hr>
                  <div class="profile-info col-md-12">
                  <div class="panel">
                  <div class="bio-graph-heading">
                      Zamówienia Klientów
                  </div>
                      <div class="table-responsive">
                    <table class="table">
                            <thead>
                                <tr>
                                    <th>Data zamówienia</th>
                                    <th>Klient</th>
                                    <th>Produkt</th>
                                    <th>Skladniki</th>
                                    <th>Ilość</th>
                                    <th>Cena</th>
                                    <th>Rozmiar</th>
                                    <th>Notatka</th>
                                </tr>
                            </thead>
                            <tbody>
                  <?php
                    require_once '../web/config.php';                   
                    $query = @$polaczenie2 ->query("SELECT * FROM zamowienia LEFT JOIN zarzadzanie_zamowieniami ON zamowienia.id_zam = zarzadzanie_zamowieniami.id ORDER BY data DESC");
                    $querysum = @$polaczenie2 ->query("SELECT sum(cena) as suma FROM zamowienia");
                        while($user_fetch_solo = $query->fetch_assoc()){
                            echo'
                                <tr>
                                    <td>'.$user_fetch_solo['data'].'</td> 
                                    <td>'.$user_fetch_solo['email'].'</td>
                                    <td><strong>Pizza '.$user_fetch_solo['nazwa_pizzy'].'</strong></td>
                                    <td>'.$user_fetch_solo['skladniki'].'</td>   
                                    <td>
                                        '.$user_fetch_solo['ilosc'].'
                                    </td>
                                    <td>
                                        '.$user_fetch_solo['cena']. 'zł
                                    </td>
                                    <td>
                                        '.$user_fetch_solo['rozmiar'].'
                                    </td>
                                    <td>
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal'.$user_fetch_solo['id_zam'].'">
                                        Notatka
                                    </button>
                                    </td>
                                </tr>

                                <div class="modal fade" style = "margin-top:5%;" id="exampleModal'.$user_fetch_solo['id_zam'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Notatka do zamówienia</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        '.$user_fetch_solo['notatka'].'
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-warning" data-dismiss="modal">Zamknij</button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                ';
                            }
                        while($user_fetch_price = $querysum->fetch_assoc()){
                            echo '     
                            <tr>
                                <td colspan="6" class="text-right"><strong>Cena całkowita zarobiona na zamówieniach '.round($user_fetch_price['suma'], 3).' zł</strong></td>
                            </tr>
                            ';
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

    <div class="row" style = "margin-top:5%">

            <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index_user.php"><i class="fas fa-pizza"></i></a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="../user_web/index_user.php">STRONA GŁÓWNA</a></li>
                    <li><a href="../user_web/pizza_user.php">MENU</a></li>
                    <li><a href="../user_web/about_user.php">KONTAKT</a></li>
                    <li><a href="../user_web/user.php" style = "text-transform: uppercase"><?php echo $_SESSION['display_name'];?></a></li>
                    <li><a href="../web/card.php"><i class="fas fa-shopping-cart"></i>(<?php echo $count;?>)</a></li>
                    <li><a href="../web/logout.php" style = "text-transform: uppercase">WYLOGUJ SIĘ</a></li>
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
            var tablica_value = [];
            $(document).ready(function() {
                $("#submit_data").click(function() {
                $.ajax({
                    url: "nowa_pizza.php",
                    type: 'GET',
                    data: {
                        submit : '1',
                        tab :$('#skladniki').val()
                    },
                    success: function(data) {
                        alert("Pizza została dodana do menu!");
                    }
                });
            }); });
        </script>
                                
        <?php
            $select_menu = @$polaczenie2->query("SELECT * FROM menu ORDER BY id DESC LIMIT 1");
            $rooow = $select_menu->fetch_assoc();
            $max_id = ($rooow['id'] + 1);
            $_SESSION['max_id'] = $max_id;
            if(isset($_POST['add'])){
                $nazwa = $_POST['nazwa'];
                $cena = $_POST['cena'];
                $img = $_POST['img'];
                $correct = true;
                if(empty($_POST['nazwa'])){
                    $correct = false;
                }

                if(empty($_POST['cena'])){
                    $correct = false;
                }

                if(empty($_POST['img'])){
                    $correct = false;
                }

                if($correct){
                    for($i = 0 ; $i < 2; $i++){
                        if($i == 0){
                            $sql = "UPDATE menu SET nazwa = '$nazwa', cena = '$cena', img = '$img' ORDER BY id DESC LIMIT 1";
                            $stmtinsert = $db->prepare($sql);
                            $stmtinsert->execute();
                        }else{
                            $sql = "INSERT INTO menu (id) VALUES(?) ";
                            $mysql_add = $db->prepare($sql);
                            $rezulty = $mysql_add->execute([$max_id]);
                        }
                    }
                }
            }
        ?>  

    
</body>
</html>