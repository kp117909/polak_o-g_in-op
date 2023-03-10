<?php
    session_start();
    if(!isset($_SESSION['zalogowany'])){
        header('Location: ../web/index.php');
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
       <script src = "js/ap.js"></script>
        <!--  -->

        <!-- FontAwesome -->
        <link rel="stylesheet" href="fontawesome/css/all.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <!-- --- -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/4.9.95/css/materialdesignicons.css" rel="stylesheet">
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
                      <li><a href="user.php"> <i class="fa fa-user"></i> Profile</a></li>
                      <li><a href="user_edit.php"> <i class="fa fa-edit"></i>Edytuj Profil</a></li>
                      <?php 
                        if($_SESSION['isadmin'] == 1){
                            echo '<li><a href="../admin/admin.php"> <i class="mdi mdi-flash"></i></i>Panel Admina</a></li>';
                        }
                      ?>
                      <li class="active"><a href="#"> <i class="mdi mdi-bookmark-outline"></i>Twoje zam??wienia</a></li>
                  </ul>
              </div>
          </div>
          <div class="profile-info col-md-9">
              <div class="panel">
                  <div class="bio-graph-heading">
                      THUNDER PIZZA PROFIL U??YTKOWNIKA
                  </div>
                  <div class="panel-body bio-graph-info">
                      <h1>Zam??wienia</h1>
                      <div class="row">
                      <div class="table-responsive">
                                <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Data zam??wienia</th>
                                                <th>Produkt</th>
                                                <th>Skladniki</th>
                                                <th>Ilo????</th>
                                                <th>Cena</th>
                                                <th>Rozmiar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            require_once '../web/config.php';                   
                                            $query = @$polaczenie ->query("SELECT * FROM zamowienia LEFT JOIN zarzadzanie_zamowieniami ON zamowienia.id_zam = zarzadzanie_zamowieniami.id  WHERE zarzadzanie_zamowieniami.email LIKE '".$_SESSION['email']."' ORDER BY data DESC");
                                            $querysum = @$polaczenie ->query("SELECT sum(cena) as suma FROM zamowienia LEFT JOIN zarzadzanie_zamowieniami ON zamowienia.id_zam = zarzadzanie_zamowieniami.id WHERE zarzadzanie_zamowieniami.email LIKE '".$_SESSION['email']."'");
                                                while($user_fetch_solo = $query->fetch_assoc()){
                                                    echo'
                                                        <tr>
                                                            <td>'.$user_fetch_solo['data'].'</td> 
                                                            <td><strong>Pizza '.$user_fetch_solo['nazwa_pizzy'].'</strong></td>
                                                            <td>'.$user_fetch_solo['skladniki'].'</td>   
                                                            <td>
                                                                '.$user_fetch_solo['ilosc'].'
                                                            </td>
                                                            <td>
                                                                '.$user_fetch_solo['cena']. 'z??
                                                            </td>
                                                            <td>
                                                                '.$user_fetch_solo['rozmiar'].'
                                                            </td>
                                                        </tr>
                                                        ';
                                                    }
                                                while($user_fetch_price = $querysum->fetch_assoc()){
                                                    echo '     
                                                    <tr>
                                                        <td colspan="5" class="text-right"><strong>Cena ca??kowita wydana na zam??wienia '.round($user_fetch_price['suma'], 3).' z??</strong></td>
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
              <div>
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
                    <li><a href="index_user.php">STRONA G????WNA</a></li>
                    <li><a href="pizza_user.php">MENU</a></li>
                    <li><a href="about_user.php">KONTAKT</a></li>
                    <li><a href="user.php" style = "text-transform: uppercase"><?php echo $_SESSION['display_name'];?></a></li>
                    <li><a href="../web/card.php"><i class="fas fa-shopping-cart"></i>(<?php echo $count;?>)</a></li>
                    <li><a href="../web/logout.php" style = "text-transform: uppercase">WYLOGUJ SI??</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <footer class="footer">
        <a href="" title="Thunder Pizza">
            <span class="glyphicon glyphicon-chevron-up"></span>Thunder Pizza<a href="Thunder" title="Visit OurWebsite "></a>
        </a>
    </footer>
</body>
</html