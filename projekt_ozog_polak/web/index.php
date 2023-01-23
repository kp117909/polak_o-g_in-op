
<?php
    session_start();
    if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']== true)){
        header('Location: ../user_web/index_user.php');
        exit();
    }
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
    </head>


<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

    <div id="about" class="container-fluid">
        <div class="jumbotron text-center">
            <h1 style = "color: #F2B84B;"><img src="../png/pizza.png"></h1>
            <p style = "font-size:30px">Zamów już teraz</p>
            <form action ="rejestracja.php" method = "GET" class="form-inline">
            <div class="input-group">
                <input type="email" class="form-control" name ="email" size="50" placeholder="Adress Email"  style = "height:50px; font-size:20px;">
                    <div class="input-group-btn">
                        <input type="submit" value = 'Załóż konto' class="btn btn-danger" style = "height:50px;  font-size:17px"><a href = "rejestracja.php" style = "color:white"></a></input>
                    </div>
                </div>
            </form>
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
                    <li><a href="index.php">STRONA GŁÓWNA</a></li>
                    <li><a href="pizza.php">MENU</a></li>
                    <li><a href="about.php">KONTAKT</a></li>
                    <li><a href="logowanie.php">LOGOWANIE</a></li>
                    <?php
                    $count = 0;
                        if(isset($_SESSION['cart'])){
                            $count = count($_SESSION['cart']);
                        }
                    ?>
                    <li><a href="card.php"><i class="fas fa-shopping-cart"></i>(<?php echo $count; ?>)</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <footer class="footer">
        <a href="#myPage" title="To Top">
        <span class="glyphicon glyphicon-chevron-up"></span>Thunder Pizza<a href="Thunder" title="Visit OurWebsite "></a>
        </a>
    </footer>

</body>
</html