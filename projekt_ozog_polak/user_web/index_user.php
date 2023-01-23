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
<!DOCTYPE php>
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
            <h1><img src="../png/pizza.png"></h1>
            <p style = "font-size:30px">Pizza na wynos</p>
            <form class="form-inline">
            <div class="input-group">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-warning"><a href = "pizza_user.php" style = "color:white">Zamów już teraz!</a></button>
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
                <a class="navbar-brand" href="index_user.php"><i class="fas fa-pizza"></i></a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="index_user.php">STRONA GŁÓWNA</a></li>
                    <li><a href="pizza_user.php">MENU</a></li>
                    <li><a href="about_user.php">KONTAKT</a></li>
                    <li><a href="user.php" style = "text-transform: uppercase"><?php echo $_SESSION['display_name'];?></a></li>
                    <li><a href="../web/card.php"><i class="fas fa-shopping-cart"></i>(<?php echo $count;?>)</a></li>
                    <li><a href="../web/logout.php" style = "text-transform: uppercase">WYLOGUJ SIĘ</a></li>
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