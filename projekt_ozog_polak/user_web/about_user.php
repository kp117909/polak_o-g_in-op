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

    <div id="contact" class="container-fluid">
        <div class="container-fluid">
            <h2 class="text-center">Kontakt</h2>
            <div class="row">
                <div class="col-sm-5">
                    <p>W razie problemów prosimy o kontakt!</p>
                    <p><span class="glyphicon glyphicon-map-marker"></span> Rzeszów, Polska</p>
                    <p><span class="glyphicon glyphicon-phone"></span> +48 1515151515</p>
                    <p><span class="glyphicon glyphicon-envelope"></span> ThunderPizza@thebesta.com</p>
                    </div>
                        <div class="col-sm-7">
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <input class="form-control" id="name" name="name" placeholder="Imie" type="text"required>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <input class="form-control" id="email" name="email" placeholder="Nazwisko" type="email"required>
                                </div>
                            </div>
                            <textarea class="form-control" id="comments" name="comments" placeholder="Informacje"rows="5"></textarea><br>
                            <div class="row">
                                <div class="col-sm-12 form-group">
                                    <button class="btn btn-default pull-right" type="submit">Wyślij</button>
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

    <div class="row" style = "margin-bottom:5%;">
        <div class="col-lg-12">
            <div style="width: 60%; margin-left:21%; border-radius: 30px; overflow:hidden;"><iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=Rzesz%C3%B3w%20Kasprowicza1+(Thunder%20pizza)&amp;t=&amp;z=17&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a href="https://www.gps.ie/wearable-gps/">wearable gps</a></iframe></div>
            </div>
        </div>
    </div>
    <!-- <div class = "colmap">
        <div style="width: 35%; margin-left:35%; border-radius: 10px;" ><iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=Rzesz%C3%B3w%20Kasprowicza1+(Thunder%20pizza)&amp;t=&amp;z=17&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a href="https://www.gps.ie/wearable-gps/">wearable gps</a></iframe></div>
    </div> -->
    <footer class="footer">
        <a href="#myPage" title="To Top">
            <span class="glyphicon glyphicon-chevron-up"></span>Thunder Pizza<a href="Thunder" title="Visit OurWebsite "></a>
        </a>
    </footer>

    <footer class="footer">
        <a href="#myPage" title="To Top">
        <span class="glyphicon glyphicon-chevron-up"></span>Thunder Pizza<a href="Thunder" title="Visit OurWebsite "></a>
        </a>
    </footer>
</body>
</html